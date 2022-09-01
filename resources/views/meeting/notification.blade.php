
    function send_notification($device_token, $title, $notification_type, $message, $extra=array())
    {
        $arrayToSend = array(
            'to' => $device_token,
            'notification' => array(
                'title' => $title,
                'body' => $message,
                'sound' => 'default',
                'badge' => 0
            ),
            'priority' => 'high',
            'data' => array(
                'notification_type' => $notification_type,
                'body' => $message,
                'image' => '',
                'extra' => $extra
            )
        );
        $json = json_encode($arrayToSend);

        //Setup headers:
        $headers = array();
        $headers[] = 'Authorization: key=AAAAaMNKaZg:APA91bHiRecP99xSSe6FP_4xQP9-1UqV-XRwKL25-9Eeg2b9KXqi4haRhdMrH8XYWG1nMQzQewEwAzgS6DLucJNnXpL69Ugtnq6ghmC4BhU-1tjY3TLDM_R8u3N4ytz5feARYaDgvX9V'; // key here
        $headers[] = 'Content-Type: application/json';

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        //Send the request
        $response = curl_exec($ch);
        $result = (array) json_decode($response);

        $err = curl_error($ch);
        //Close request
        curl_close($ch);
        // print_r($result);die;
        if ($result === FALSE) {
            return false;
        } else {
            if(isset($_GET['debug'])){
                print_r($result);die;
            }
            if (isset($res['error'])) {
                return false;
            }
        }
        return true;
    }
    $this->send_notification($rPayment->user->fire_base_token, 'Euronet Support', 'Text', $message);
