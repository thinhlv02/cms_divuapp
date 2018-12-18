<?php

Class Process extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('user_model');
        $this->load->model('user_temp_address_model');
        $this->load->model('admin_require_payment_model');
        $this->load->model('config_server_model');
        $this->load->model('admin_emergency_model');
        $this->load->model('service_package_user_model');
        $this->load->model('log_payment_cart_user_model');
        $this->load->model('appliance_model');
        $this->load->model('menu_access_model');
        $this->load->model('service_package_maintenance_model');
        $this->load->model('admin_mission_model');
    }

    function process_socket()
    {
//        email_sending($this, 'dieuhoa247ae@gmail.com', 'a123123@', 'test@gmail.comxx', 'Send text from controller process -> ', $attach = '', 'test@gmail.com');
        //echo 'aaaaaaaaaaa';
//        die();
        $cfg = $this->config_server_model->get_list();
        $id = $this->input->post('id');
        $action = $this->input->post('action');

        if (in_array($action, array('ChangeMaintenance', 'NewMaintenance'))) {
            $result = $this->admin_emergency_model->ChangeMaintenance($id);
//            $result = $this->admin_emergency_model->ChangeMaintenance(44);
//        pre($result);
            $result_arr = array();
            foreach ($result as $key => $value) {
                $result_arr[0] = new stdClass();
                $result_arr[0]->id = $value->id;
                $result_arr[0]->user_id = $value->user_id;
                $result_arr[0]->fullname = $value->fullname;
                $result_arr[0]->des = $value->des;
                $result_arr[0]->time = date('d-m-Y', $value->time);
                $result_arr[0]->link = admin_url('admin_mission?date1=' . date('d-m-Y', $value->time) . '&date2=' . date('d-m-Y', $value->time) . '&asset_id=' . $value->id . '#' . $value->id . '');
                $message = "Khách hàng: $value->fullname<br/>SĐT: $value->phone<br/>Địa chỉ: $value->address<br/>Nội dung yêu cầu: $value->des";
//            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $cfg[0]->gmail_to, 'Đổi lịch -> ' . $value->des, $attach = '');
//            email_sending($this, 'dieuhoa247ae@gmail.com', 'a123123@', 'test@gmail.com', date('H:i:s:a'), $attach = '');
                email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $cfg[0]->gmail_to, $message, $attach = '');
            }
//        echo 'sl'.$count;
//        pre($result_arr);
            $json_str = json_encode($result_arr);
            echo $json_str;
        }
        if (in_array($action, array('NewEmergency', 'CancelCallEmergency'))) {
            if ($action == 'NewEmergency') {
                $prefix = 'Cứu hộ khẩn cấp -> ';
            }
            if ($action == 'CancelCallEmergency') {
                $prefix = 'Hủy Cứu hộ khẩn cấp -> ';
            }
//            echo $prefix;
//            die();
            $result = $this->admin_emergency_model->NewEmergency($id);
//        $result = $this->admin_emergency_model->NewEmergency($id=407);
            $result_arr = array();
            foreach ($result as $key => $value) {
                $result_arr[0] = new stdClass();
                $result_arr[0]->id = $value->id;
                $result_arr[0]->user_id = $value->user_id;
                $result_arr[0]->images = $value->images;
                $result_arr[0]->fullname = $value->fullname;
                $result_arr[0]->des = $value->des;
                $result_arr[0]->des_cancel = $value->des_cancel;
                $result_arr[0]->time = date('d-m-Y', $value->time);
                $result_arr[0]->link = admin_url('admin_emergency?date1=' . date('d-m-Y', $value->time) . '&date2=' . date('d-m-Y', $value->time) . '&asset_id=' . $value->id . '#' . $value->id . '');
                $message = "Khách hàng: $value->fullname<br/>SĐT: $value->phone<br/>Địa chỉ: $value->address<br/>Nội dung yêu cầu: $value->des";
            }
            $json_str = json_encode($result_arr);
//        if (!empty($json_str)) {
//            email_sending($this, 'dieuhoa247ae@gmail.com', 'a123123@', 'huogkute2605@gmail.comxx', 'prefix' , '', 'test@gmail.com');
            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $cfg[0]->gmail_to, $prefix . $message, $value->images);
            echo $json_str;
//        }
//        pre($result);
//        pre($result_arr);
        }
//        echo $id;

        if (in_array($action, array('UserUpdateAddress'))) {
            $prefix = 'Cập nhật địa chỉ';
//            $result = $this->admin_emergency_model->NewEmergency($id);
            $result = $this->user_temp_address_model->edit_address($id);
//        $result = $this->admin_emergency_model->NewEmergency($id=407);
            $result_arr = array();
            foreach ($result as $key => $value) {
                $result_arr[0] = new stdClass();
                $result_arr[0]->id = $value->id;
                $result_arr[0]->user_id = $value->user_id;
                $result_arr[0]->province = $value->province;
                $result_arr[0]->district = $value->district;
                $result_arr[0]->ward = $value->ward;
                $result_arr[0]->address = $value->address;
                $result_arr[0]->province_id = $value->province_id;
                $result_arr[0]->district_id = $value->district_id;
                $result_arr[0]->ward_id = $value->ward_id;
                $result_arr[0]->latitude = $value->latitude;
                $result_arr[0]->longitude = $value->longitude;
                $result_arr[0]->fullname = $value->fullname;
                $result_arr[0]->username = $value->username;
                $result_arr[0]->link = admin_url('info_search');
                $message = "Khách hàng: $value->fullname<br/>SĐT: $value->phone<br/>Địa chỉ: $value->address<br/>Nội dung yêu cầu: $prefix";
            }
            $json_str = json_encode($result_arr);
//        if (!empty($json_str)) {
//            email_sending($this, 'dieuhoa247ae@gmail.com', 'a123123@', 'huogkute2605@gmail.comxx', 'prefix' , '', 'test@gmail.com');
            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $cfg[0]->gmail_to, $message, '');
            echo $json_str;
//        }
//        pre($result);
//        pre($result_arr);
        }

        if (in_array($action, array('UserPaymentOrder'))) {
            $prefix = 'Khách hàng Yêu cầu mua đơn hàng';
            $result = $this->admin_emergency_model->NewEmergency($id);
//            $result = $this->log_payment_cart_user_model->get_info_cart_user($search, $date1, $date2, $status, $type_cart,$id='');
            $date = date('Y-m-d');
            $result = $this->log_payment_cart_user_model->get_info_cart_user($search = 1, $date, $date, $status = 'all', 1, $id);
//            echo 'abc';
//            pre($result);
//        $result = $this->admin_emergency_model->NewEmergency($id=407);
            $result_arr = array();
            foreach ($result as $key => $value) {
                $result_arr[0] = new stdClass();
                $result_arr[0]->id = $value->id;
                $result_arr[0]->user_id = $value->user_id;
                $result_arr[0]->address = $value->address;
                $result_arr[0]->username = $value->username;
                $result_arr[0]->detail_cart = $value->detail_cart;
                $result_arr[0]->link = admin_url('log_payment_cart_user');
                $message = "Khách hàng: $value->username<br/>SĐT: $value->phone<br/>Địa chỉ: $value->address<br/>Nội dung yêu cầu: $prefix";
            }
            $json_str = json_encode($result_arr);
//        if (!empty($json_str)) {
//            email_sending($this, 'dieuhoa247ae@gmail.com', 'a123123@', 'huogkute2605@gmail.comxx', 'prefix' , '', 'test@gmail.com');
            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $cfg[0]->gmail_to, $message, '');
            echo $json_str;
//        }
//        pre($result);
//        pre($result_arr);
        }
        if (in_array($action, array('PartnerPaymentOrder'))) {
            $prefix = 'KTV Yêu cầu mua đơn hàng';
            $result = $this->admin_emergency_model->NewEmergency($id);
//            $result = $this->log_payment_cart_user_model->get_info_cart_user($search, $date1, $date2, $status, $type_cart,$id='');
            $date = date('Y-m-d');
            $result = $this->log_payment_cart_user_model->get_info_cart_user($search = 1, $date, $date, $status = 'all', 2, $id);
//            echo 'abc';
//            pre($result);
//        $result = $this->admin_emergency_model->NewEmergency($id=407);
            $result_arr = array();
            foreach ($result as $key => $value) {
                $result_arr[0] = new stdClass();
                $result_arr[0]->id = $value->id;
                $result_arr[0]->user_id = $value->user_id;
                $result_arr[0]->address = $value->address;
                $result_arr[0]->username = $value->username;
                $result_arr[0]->detail_cart = $value->detail_cart;
                $result_arr[0]->link = admin_url('log_payment_cart_user');
                $message = "Khách hàng: $value->username<br/>SĐT: $value->phone<br/>Địa chỉ: $value->address<br/>Nội dung yêu cầu: $prefix";
            }
            $json_str = json_encode($result_arr);
//        if (!empty($json_str)) {
//            email_sending($this, 'dieuhoa247ae@gmail.com', 'a123123@', 'huogkute2605@gmail.comxx', 'prefix' , '', 'test@gmail.com');
            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $cfg[0]->gmail_to, $message, '');
            echo $json_str;
//        }
//        pre($result);
//        pre($result_arr);
        }
    }

    public function add_appliance()
    {
//        $this->input->post('tid');
        $name_ = $this->input->post('name_');
        $manufacturer_ = $this->input->post('manufacturer_');
        $quantity_ = $this->input->post('quantity_');
        $service_package_user_id = $this->input->post('service_package_user_id');
//        echo $service_package_user_id.$name_.$quantity_.$manufacturer_;
        $time = new DateTime();
        $data = array(
            'name' => $name_,
            'manufacturer' => $manufacturer_,
            'quantity' => $quantity_,
            'time' => $time->getTimestamp(),
            'type' => 1,
            'service_package_user_id' => $service_package_user_id,
            'status' => 1,
        );
        if ($this->appliance_model->create($data)) {
            echo 'Thành công';
        } else {
            echo 'Thất bại';
        }
    }

    public function add_menu()
    {
//        $this->input->post('tid');
        $menu_id = $this->input->post('menu_id');
        $employee_id = $this->input->post('employee_id');
//        echo $menu_id.$employee_id;
//        die();
        $data = array(
            'menu_id' => $menu_id,
            'employee_id' => $employee_id
        );
        if ($this->menu_access_model->create($data)) {
            echo 'Thành công';
        } else {
            echo 'Thất bại';
        }
    }

    public function add_regular_appointments()
    {
        $admin = $this->session->userdata('admin');
        $cfg = $this->config_server_model->get_list();
//        $this->input->post('tid');
        $time = $this->input->post('time');
        $admin_id = $this->input->post('admin_id');
        $service_package_user_id = $this->input->post('service_package_user_id');
        $service_package_id = $this->input->post('service_package_id');
//        echo 'kq: '.$time. '-'.$admin_id;
//        die();
//        $manufacturer_ = $this->input->post('manufacturer_');
//        $quantity_ = $this->input->post('quantity_');
//        $service_package_user_id = $this->input->post('service_package_user_id');
//        echo $service_package_user_id.$name_.$quantity_.$manufacturer_;
//        $time = new DateTime();
        $des = 'Lịch hẹn định kỳ khách hàng tháng: ' . date('d-m-Y H:i:s', strtotime($time));
        $data = array(
            'service_package_user_id' => $service_package_user_id,
            'des' => $des,
            'admin_id' => $admin_id,
            'time' => strtotime($time),
            'type' => 2,
        );

        $insert_id = $this->service_package_maintenance_model->create($data);
        if ($insert_id) {
            $data2 = array(
                'admin_id' => $admin_id,
                'name' => $des,
                'service_package_maintenance_id' => $insert_id
            );
//            echo pre($data2);
            $this->admin_mission_model->create($data2);

            $info_service_package_user = $this->admin_mission_model->get_info_user($insert_id);

            $message = '';
            if (!empty($info_service_package_user)) {
//                        $content_mail_username = $info_service_package_user->username;
                $content_mail_fullname = $info_service_package_user[0]->fullname;
                $content_mail_address = $info_service_package_user[0]->address;
                $content_mail_phone = $info_service_package_user[0]->phone;
                $message = "Giao việc<br/> $des <br/>Khách hàng: $content_mail_fullname<br/>  Địa chỉ: $content_mail_address <br/> SĐT: $content_mail_phone ";
            }
            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $cfg[0]->gmail_to,  $message, '');

            echo 'Thành công';
//            }
        } else {
            echo 'Thất bại';
        }
    }
}