<?php
namespace App\Http\Controllers\Auth;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function show()
    {
        return view('auth.loginnew');
    }

    public function redirectToProvider(Request $request)
    {
        //forget old session
        if(isset($_GET['site_id'])) {
            \Session::put("site_id",$_GET['site_id']);
        }
        \Session::forget("social_auth_credientials");

        //validate request
        if (!$request->has("driver") || $request->driver == '' || !$request->has("site_id") || $request->site_id == '') {
            return $this->sendFailedResponse("Sorry - the driver and site id is required");
        }

        //validate driver
        if(!$this->isProviderAllowed($request->driver)) {
            return $this->sendFailedResponse("Sorry - {$request->driver} is not currently supported");
        }

        //validate site
        $site = Site::where("id", $request->site_id)->first();
        $authAppURL = \Config::get("constants.SOCIAL_AUTH_APP_URL");

        if (!$site) {
            return $this->sendFailedResponse("Sorry - the site id {$request->site_id} is not valid (no site found).");
        }
        if ($site->social_auth_credentials_json == NULl || $site->social_auth_credentials_json == '') {
            return $this->sendFailedResponse("Sorry - ({$site->site_name}) didn't setup any social authentication credentials");
        }

        try {
            //Make sure SL is ready
            $this->ensureTheSocialLitePackageIsReady();

            $social_auth_credentials = json_decode($site->social_auth_credentials_json, true);
            if (!isset($social_auth_credentials[$request->driver])) {
                return $this->sendFailedResponse("Sorry - {$request->driver} is not currently supported by {$site->site_name}");
            }
            //check required parameters has value
            if (!isset($social_auth_credentials[$request->driver]["client_id"]) || $social_auth_credentials[$request->driver]["client_id"] == '') {
                return $this->sendFailedResponse("Sorry - {$site->site_name} does not have valid {$request->driver} auth setup");
            }
            if (!isset($social_auth_credentials[$request->driver]["client_secret"]) || $social_auth_credentials[$request->driver]["client_secret"] == '') {
                return $this->sendFailedResponse("Sorry - {$site->site_name} does not have valid {$request->driver} auth setup");
            }
            // if (!isset($social_auth_credentials[$request->driver]["redirect"]) || $social_auth_credentials[$request->driver]["redirect"] == '') {
            //     return $this->sendFailedResponse("Sorry - {$site->site_name} does not have valid {$request->driver} auth setup");
            // }
            
            //credentials            
            $credentials = [
                "client_id"=>$social_auth_credentials[$request->driver]["client_id"],
                "client_secret"=>$social_auth_credentials[$request->driver]["client_secret"],
                "redirect"=>"{$authAppURL}/oauth/{$request->driver}/callback"//https://affiliateambassadorteam.com/oauth/{$request->driver}/callback
            ];
            // return $credentials;

            \Session::put("social_auth_credientials", $credentials);
            return Socialite::driver($request->driver)->redirect();
        } catch (\Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

  
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check required data is returned or not
        return empty($user) || !isset($user["email"]) || $user["email"] == ''
            ? $this->sendFailedResponse("The {$driver} provider does not return email id")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function sendSuccessResponse()
    {
        return redirect()->intended('home');
    }

    protected function sendFailedResponse($msg = null)
    {
        return redirect()->route('social.login')
            ->with(['error' => $msg ?: 'Unable to login, try with another provider to login.']);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        //echo $providerUser->getEmail();
        // check for already has account
        $site_id = \Session::get("site_id");
        $site = Site::where("id", $site_id)->first();
        \Session::forget("site_id");

        $user = Customer::where('email', $providerUser->getEmail())->where('site_id', $site_id)->first();
        $password = 'social_pass_'.mt_rand(1000, 99999).time();
        // if user already found
        if(!empty($user)) {
            // update the avatar and provider that might have changed
            $user->update([
                'avatar' => (isset($providerUser["avatar"]) && $providerUser["avatar"] != '' ? $providerUser["avatar"] : NULL),
                'provider' => $driver,
                'provider_id' => (isset($providerUser["id"]) && $providerUser["id"] != '' ? $providerUser["id"] : NULL),
                'access_token' => (isset($providerUser["token"]) && $providerUser["token"] != '' ? $providerUser["token"] : NULL),
                'password' =>  \Hash::make($password)//set random password
            ]);

            $customer_put['customer']['first_name'] = (isset($providerUser["name"]) && $providerUser["name"] != '' ? $providerUser["name"] : NULL);
            $customer_put['customer']['email'] = $providerUser->getEmail();
            $customer_put['customer']['password'] = $password;
            $customer_put['customer']['password_confirmation'] = $password;

            $get_customer_url = "https://".$site->username.":".$site->password."@".$site->domain."/admin/customers.json?email=".$providerUser->getEmail();

            $get_customer_body = Http::get(trim($get_customer_url));
            $get_customer_body = $get_customer_body->json();

            if(count($get_customer_body['customers'])> 0) {
                $url = "https://".$site->username.":".$site->password."@".$site->domain."/admin/api/2021-04/customers/".$user->customer_id.".json";
                $response = Http::put(trim($url), $customer_put);
            } else {
                $url = "https://".$site->username.":".$site->password."@".$site->domain."/admin/api/2021-04/customers.json";
                $response = Http::post(trim($url), $customer_post);
                if(isset($response->json()['customer']['id'])) {
                    $user = Customer::create([
                        'customer_id' => $response->json()['customer']['id'],
                        'first_name' => (isset($providerUser["name"]) && $providerUser["name"] != '' ? $providerUser["name"] : NULL),
                        'email' => $providerUser->getEmail(),//definitely exists
                        'avatar' => (isset($providerUser["avatar"]) && $providerUser["avatar"] != '' ? $providerUser["avatar"] : NULL),
                        'provider' => $driver,
                        'site_id' => $site_id,
                        'provider_id' => (isset($providerUser["id"]) && $providerUser["id"] != '' ? $providerUser["id"] : NULL),
                        'access_token' => (isset($providerUser["token"]) && $providerUser["token"] != '' ? $providerUser["token"] : NULL),
                        'password' =>  \Hash::make($password)
                    ]);
                }
            }

        } else {
            $customer_post['customer']['first_name'] = (isset($providerUser["name"]) && $providerUser["name"] != '' ? $providerUser["name"] : NULL);
            $customer_post['customer']['email'] = $providerUser->getEmail();
            $customer_post['customer']['password'] = $password;
            $customer_post['customer']['password_confirmation'] = $password;

            $get_customer_url = "https://".$site->username.":".$site->password."@".$site->domain."/admin/customers.json?email=".$providerUser->getEmail();

            $get_customer_body = Http::get(trim($get_customer_url));
            $get_customer_body = $get_customer_body->json();

            if(count($get_customer_body['customers'])> 0) {
                $url = "https://".$site->username.":".$site->password."@".$site->domain."/admin/api/2021-04/customers/".$user->customer_id.".json";
                $response = Http::put(trim($url), $customer_put);
            } else {
                $url = "https://".$site->username.":".$site->password."@".$site->domain."/admin/api/2021-04/customers.json";
                $response = Http::post(trim($url), $customer_post);
                if(isset($response->json()['customer']['id'])) {
                    $user = Customer::create([
                        'customer_id' => $response->json()['customer']['id'],
                        'first_name' => (isset($providerUser["name"]) && $providerUser["name"] != '' ? $providerUser["name"] : NULL),
                        'email' => $providerUser->getEmail(),//definitely exists
                        'avatar' => (isset($providerUser["avatar"]) && $providerUser["avatar"] != '' ? $providerUser["avatar"] : NULL),
                        'provider' => $driver,
                        'site_id' => $site_id,
                        'provider_id' => (isset($providerUser["id"]) && $providerUser["id"] != '' ? $providerUser["id"] : NULL),
                        'access_token' => (isset($providerUser["token"]) && $providerUser["token"] != '' ? $providerUser["token"] : NULL),
                        'password' =>  \Hash::make($password)
                    ]);
                }
            }

        }

        echo '
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <form method="post" action="https://'.$site->site_name.'/account/login" name="customer_login" id="customer_login" accept-charset="UTF-8" style="display:none;">
        <input type="hidden" name="form_type" value="customer_login" />
        <input type="hidden" name="utf8" value="✓" />
        <input type="email" name="customer[email]" class="form-control" id="loginInputName" placeholder="Enter E-mail" value="'.$providerUser->getEmail().'">
        <input type="text" name="customer[password]" class="form-control" id="loginInputEmail" placeholder="Enter Password" value="'.$password.'">
        <input type="submit" name="submit" id="customer_login_submit">
        </form>
        <script type="text/javascript">
            $( document ).ready(function() {
                console.log("test");
                $("#customer_login_submit").trigger("click");
            });
        </script>
        ';
        exit();
        return $this->sendSuccessResponse();
    }

    private function isProviderAllowed($driver)
    {
        return in_array($driver, \Config::get("constants.SOCIAL_AUTH_PROVIDERS")) && config()->has("services.{$driver}");
    }



    //ensure the sociate light package is ready
    public function ensureTheSocialLitePackageIsReady(){
        //check package sociallite package is customized or not
        //C:\xampp\htdocs\laravel_crm\vendor\laravel\socialite\src\SocialiteManager.php
        $SLpackagePath = base_path('vendor/laravel/socialite/src/SocialiteManager.php');
        $SLconfigPath = storage_path("social_lite_config/config.txt");

        $SLpackageContent = file_get_contents($SLpackagePath);
        if(strpos($SLpackageContent, "social_auth_credientials")){
            return true;
        }
        //else customize it
        $conf = file_get_contents($SLconfigPath);
        file_put_contents($SLpackagePath, $conf);
        return true;
    }
}