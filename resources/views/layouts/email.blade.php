<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="x-apple-disable-message-reformatting" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>

    <body style="margin: 0; padding: 0;background-color: #f5f5f5;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td style="padding: 10px 0px 30px 0px;">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                        <tr>
                            <td align="center" bgcolor="transparent" style="padding: 40px 0px 40px 0px; color: #153643; font-size: 28px; font-weight: bold; ">
                                <img src="{{url('/images/logo.png')}}" alt={{env('APP_NAME')}} width="200" />
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px; box-shadow: 0px 2px 10px 0px #eaeaea;">
                                @yield('content')
                                <p style="color: #153643;  font-size: 16px; line-height: 20px;">Thank you for using our application!</p>
                                <p style="color: #153643;  font-size: 16px; line-height: 20px;">Regards,<br/>{{env('APP_NAME')}} Team</p>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="transparent" style="padding: 30px 30px 30px 30px;">
                                <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="text-align:center; color: #000000; font-size: 14px;">&copy; {{date('Y')}} <a style="color:#430FB4;" href="{{env('WEBSITE_URL')}}">{{env('APP_NAME')}}</a>. All rights reserved.</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>           