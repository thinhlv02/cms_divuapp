<?php

Class Add_money extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('cms_add_money_logs_model');
        $this->load->model('user_model');
    }

    function index()
    {

//        pre('ahihi');
//        $json = file_get_contents('http://localhost:3000/');
//        $obj = json_decode($json);
//        var_dump($obj);
//        pre($obj);

//        error_reporting(E_ALL);
//        $port = 3000; // Port the node app listens to
//        $address = '127.0.0.1'; // IP the node app is on
//// Create socket
//        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//        if ($socket === false) {
//            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
//        }
//// Connect to node app
//        $result = socket_connect($socket, $address, $port);
//        if ($result === false) {
//            echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
//        }
//// Data we want to send
//        $data = array('itemid' => '1234567', 'steamid' => '769591951959', 'otherinfo' => 'hi there');
//// Prepares to transmit it
//        $encdata = json_encode($data);
//        socket_write($socket, $encdata, strlen($encdata));
//        socket_close($socket);
//        echo 'Sent data\n';
//
//        die();
        $admin = $this->session->userdata('admin');
//        pre($admin);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $type = $this->input->post('type');
            $userid = $this->input->post('userid');
            $money = $this->input->post('money');
            $sub = $this->input->post('sub');
            $note = $this->input->post('note');
            $sub_content = 'Cộng';
            if ($sub == 2) {
                $money = (-1) * $money;
                $sub_content = 'Trừ';
            }
            $money_id = $this->input->post('money_id');
            $data_log = array(
                'type' => $type,
                'userid' => $userid,
                'note' => $note,
                'money_id' => $money_id,
                'money' => $money,
                'sub' => $sub,
                'admin_name' => $admin->UserName,
            );
//            $area_id = $this->input->post('area_id');
//            $time = $this->input->post('time');
//            $limit = $this->input->post('limit');
//            pre($created);
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            if ($type == 1) {
//                add money to admin,ktv
                $info = $this->admin_model->get_info($userid);
//                pre($info);
                $data_update = array();
                if ($money_id == 1) {
                    $data_update['balance'] = $info->balance + $money;
                }
                if ($money_id == 2) {
                    $data_update['bonus'] = $info->bonus + $money;
                }
                if ($money_id == 3) {
                    $data_update['bonus_introduce_customer'] = $info->bonus_introduce_customer + $money;
                }
//                pre($data_update);
                if ($this->admin_model->update($userid, $data_update)) {
                    $this->cms_add_money_logs_model->create($data_log);
                    //                    gui lenh sang server
//                    int account_id = req.get("account_id").asInt();
//            int type_account_ben_nodeJs = req.get("type_account_ben_nodeJs").asInt();//1 khách hàng, 2 KTV, 6 cộng tác viên

                    $postData = [
                        'cmd' => 301,
                        'account_id' => $userid,
                        'type_account_ben_nodeJs' => $type,
                    ];
//        pre($postData);
                    $result = post_curl($postData);

                    $postData2 = [
                        'cmd' => 303,
                        'account_id' => $userid,
                        'type_account_ben_nodeJs' => $type,
                        'message' => 'Chúc mừng bạn vừa được '.$sub_content.' '.number_format($money).' DiV',
                    ];
//        pre($postData);
                    $result2 = post_curl($postData2);
//        echo $result;
//                    pre($result);
//                    gui lenh sang server
                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                    //        $this->data['view'] = 'admin/add_money/add';
                    redirect(base_url('admin/add_money'));
//                redirect(base_url('admin/add_money' . '?id=' . $id . '#' . $id));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }

            if ($type == 2) {
//                add money to admin,ktv
                $info = $this->user_model->get_info($userid);
//                pre($info);
                $data_update = array();
                if ($money_id == 1) {
                    $data_update['balance'] = $info->balance + $money;
                }
                if ($money_id == 2) {
                    $data_update['reward_point'] = $info->reward_point + $money;
                }
//                pre($data_update);
                if ($this->user_model->update($userid, $data_update)) {
                    $this->cms_add_money_logs_model->create($data_log);
                    $postData = [
                        'cmd' => 301,
                        'account_id' => $userid,
                        'type_account_ben_nodeJs' => $type,
                    ];
//        pre($postData);
                    $result = post_curl($postData);
//                    pre($result);
//                    Push thông báo riêng cho từng khách hàng hiện trong app
//                    int account_id = req.get("account_id").asInt();
//            int type_account_ben_nodeJs = req.get("type_account_ben_nodeJs").asInt();
//            String message = req.get("message").asText();
                    $postData2 = [
                        'cmd' => 303,
                        'account_id' => $userid,
                        'type_account_ben_nodeJs' => $type,
                        'message' => 'Chúc mừng bạn vừa được '.$sub_content.' '.number_format($money).' DiV',
                    ];
//        pre($postData);
                    $result2 = post_curl($postData2);
                    $this->session->set_flashdata('message', 'Cập nhật thành công');
                    redirect(base_url('admin/add_money'));
//                redirect(base_url('admin/add_money' . '?id=' . $id . '#' . $id));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/add_money/add';
//        $this->data['view'] = 'admin/add_money/add';
        $this->load->view('admin/layout', $this->data);
    }
}

?>