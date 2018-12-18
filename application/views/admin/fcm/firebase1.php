<?php

/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Firebase1
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
    public function sendToTopic($to, $message,$api_key)
    {
        $fields = array(
            'to' => '/topics/' . $to,
            'data' => $message,
            'notification' => $message,
        );
        return $this->sendPushNotification($fields,$api_key);
    }

    // sending push message to multiple users by firebase registration ids
    public function sendMultiple($registration_ids, $message,$api_key)
    {
        $fields = array(
            'to' => $registration_ids,
            'data' => $message,
            'notification' => $message
        );

        return $this->sendPushNotification($fields,$api_key);
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

    private function sendPushNotification_orange($fields) {

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
?>