<?php

Class Firebase_sending extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tbl_gcm_api_key_model');
        $this->load->model('user_model');
        $this->load->model('admin_model');
//        $this->load->library('session');
//        pre($agency);
    }

    function index($regId = 25, $group = 1, $title = 'test sending fireabase from controller CI', $message = 'Hello firebase sending')
    {
        $tbl_gcm_api_key = $this->tbl_gcm_api_key_model->get_info(1);
        $api_key = $tbl_gcm_api_key->api_key;

        $firebase = new Firebase();
        $push = new Push();

// optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';
// whether to include to image or not
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;

        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage('http://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);

        $json = '';
        $response = '';;
//    echo 'gr: '.$group;

        $input = array();
        $input['where']['id'] = $regId;
        if ($group == 1) {
            $array = $this->user_model->get_list($input);
        } else {
            $array = $this->admin_model->get_list($input);
        }
//            $array = $this->user_model->get_list($input);
//            pre($array);
        $json = $push->getPush();
//    $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
//    $regId = $row_array['id_register'];
        $regId = $array[0]->fcm_token;
//    echo $regId;
//    die();
        $response = $firebase->send($regId, $json, $api_key);

        if ($json != '') {
            json_encode($json);
        }
        if ($response != '') {
            echo json_encode($response);
        }
    }
}

class Push
{
    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;

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

    public function setImage($imageUrl)
    {
        $this->image = $imageUrl;
    }

    public function setPayload($data)
    {
        $this->data = $data;
    }

    public function setIsBackground($is_background)
    {
        $this->is_background = $is_background;
    }

    public function getPush()
    {
        $res = array();
        $res['title'] = $this->title;
//        $res['data']['is_background'] = $this->is_background;
//        $res['data']['message'] = $this->message;
        $res['body'] = $this->message;
//        $res['data']['image'] = $this->image;
//        $res['data']['payload'] = $this->data;
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

    // Sending message to a topic by topic name
    public function sendToTopic($to, $message, $api_key)
    {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
            'notification' => $message,
        );
        return $this->sendPushNotification($fields, $api_key);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message, $api_key)
    {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
            'notification' => $message
        );

        return $this->sendPushNotification($fields, $api_key);
    }

    // function makes curl request to firebase servers
    private function sendPushNotification($fields, $api_key)
    {
//        require_once __DIR__ . '/config.php';
        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';
//        $tbl_gcm_api_key

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

    private function sendPushNotification_orange($fields)
    {

        require_once __DIR__ . '/config.php';

        // Set POST variables
        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . FIREBASE_API_KEY,
            'Content-Type: application/json'
        );
        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

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