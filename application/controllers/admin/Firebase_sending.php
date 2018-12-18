<?php

Class Firebase_sending
{
//    function index($api_key = 'AIzaSyDlKRTXVyBbfjDW_KQnkcQhFd-y7mo_rS0', $fcm_token = 'eCUYeQJly4s:APA91bESY0UFCHAMCcEcfGzKIneicfrybLR8oT7KILb7HfE7L-5RS327xf74vrW8pB3DT_f7cmSxXClKVEvAtT4MgWtfIMxzx9qVQzDvOP13zIHqJqZkrXeV2AYgY79KxbRz1oF8QzbnXi_OMNKXI1Ob3XwoVTToqQ', $title = 'Welcome to Firebase Title Demo', $message = 'This is content demo, please not click here, tks!')
    function index($api_key, $fcm_token, $title, $message)
    {
        // khởi tạo các đối tượng
        $firebase = new Firebase();
        $push = new Push();
        $push->setTitle($title);
        $push->setMessage($message);
        $json = '';
        $response = '';
//            pre($array);
        $json = $push->getPush();

        $response = $firebase->send($fcm_token, $json, $api_key);

        if ($json != '') {
            json_encode($json);
        }
        if ($response != '') {
            echo json_encode($response);
        }
    }
}
// khai báo đối tượng Push
class Push
{
    // push message title // các thuộc tinh
    private $title;
    private $message;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    function __construct()
    {

    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getPush()
    {
        $res = array();
        $res['title'] = $this->title;
//        $res['data']['is_background'] = $this->is_background;
//        $res['data']['message'] = $this->message;
        $res['body'] = $this->message;
//        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }
}

class Firebase
{
    // sending push message to single user by firebase reg id
    public function send($to, $message, $api_key)
    {
//        pre($api_key);
        $fields = array(
            'to' => $to,
            'data' => $message,
            'notification' => $message
        );
        return $this->sendPushNotification($fields, $api_key);
    }

    // function makes curl request to firebase servers
    private function sendPushNotification($fields, $api_key)
    {
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        );
//        pre($headers);
//        die();
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        echo 'json_encode: ' . json_encode($fields);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
//        echo

        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        return $result;
    }
}