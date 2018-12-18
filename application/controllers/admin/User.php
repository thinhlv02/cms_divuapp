<?php

Class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('admin_model');
        $this->load->model('area_model');
        $this->load->model('vn_city_model');
        $this->load->model('app_info_model');
        $this->load->model('log_enter_introduction_code_model');
        $agency = $this->area_model->get_list();
        $this->data['area'] = $agency;

        $app_info = $this->app_info_model->get_list();
        $this->data['app_info'] = $app_info;
//        pre($vn_city);
        $recipient_id_arr = $this->log_enter_introduction_code_model->get_list(array('group_by' => array('recipient_id', 'recipient_type')));
        $code_intro = array();
        $dem = 0;
        foreach ($recipient_id_arr as $value) {
            $dem++;
            $code_intro[$dem] = new stdClass();
            if ($value->recipient_type == 1) {
                $code_name = 'C' . $value->recipient_id;
            } else {
                $code_name = 'P' . $value->recipient_id;
            }
            $code_intro[$dem]->recipient_id = $value->recipient_id;
            $code_intro[$dem]->recipient_type = $value->recipient_type;
            $code_intro[$dem]->code_name = $code_name;
        }
//        pre($recipient_id_arr);
        $this->data['list_phone_intro'] = $code_intro;
//        pre($code_intro);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where'][' date(created_at) = '] = date('Y-m-d');

//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');
        if ($this->input->post('search')) {
            $dcm_tr = 'all';
            $province_id = $this->input->post('vn_city');
            $vn_district = $this->input->post('vn_district');
            $recipient_id_post = $this->input->post('recipient_id');

            $input = array();
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
            $input['where'][' date(created_at) >= '] = $date1;
            $input['where'][' date(created_at) <= '] = $date2;
            if ($province_id != 'all') {
                $input['where']['province_id'] = $province_id;
            }
            if ($vn_district != 'all') {
                $input['where']['district_id'] = $vn_district;
            }
            if ($this->input->post('device') != 'all') {
                $input['where']['device'] = $this->input->post('device');
                $device = $this->input->post('device');
            }
            if ($this->input->post('area') != 'all') {
                $input2 = array();
                $input2['where']['area'] = $this->input->post('area');
//                $vn_city_arr = $this->vn_city_model->get_list(array(['where']['area'] => $this->input->post('area')));
//                $vn_city_arr = $this->vn_city_model->get_list($input2);
                $vn_city_arr = $this->vn_city_model->get_list($input2);
                $i = 0;
                $dcm = array();
                foreach ($vn_city_arr as $value) {
                    $i++;
                    $dcm[] = $value->id;
                }
                $dcm_tr = implode(',', $dcm);
//                pre($vn_city_arr);
//                $abc =
//                pre($dcm_tr);
                $input['where_in'] = array('province_id', $dcm);
//                pre($input);
            }
//            pre($input);

//            $user = $this->user_model->get_list($input);
            $user = $this->user_model->get_list_user($date1, $date2, $province_id, $vn_district, $dcm_tr, $recipient_id_post);
            $user_ = array();
            $index = 0;

            foreach ($user as $key => $value) {
                $index++;
                $code_intro_name = '';
                if ($value->recipient_type == 1) { // userid
                    $code_intro_name = 'C' . $value->recipient_id;
                }
                if ($value->recipient_type == 2) { // admin_id
                    $code_intro_name = 'P' . $value->recipient_id;
                }
                $user_[$index]['id'] = $value->id;
                $user_[$index]['username'] = $value->username;
                $user_[$index]['fullname'] = $value->fullname;
                $user_[$index]['phone'] = $value->phone;
                $user_[$index]['email'] = $value->email;
                $user_[$index]['address'] = $value->address;
                $user_[$index]['created_at'] = $value->created_at;
                $user_[$index]['province'] = $value->province;
                $user_[$index]['province_id'] = $value->province_id;
                $user_[$index]['district'] = $value->district;
                $user_[$index]['ward'] = $value->ward;
                $user_[$index]['recipient_id'] = $value->recipient_id;
                $user_[$index]['recipient_type'] = $value->recipient_type;
                $user_[$index]['code_intro_name'] = $code_intro_name;
            }
//            pre($user_);
            $user_tq = $this->user_model->user_tq($date1, $date2, $province_id, $vn_district, $dcm_tr);
//            pre($user_tq);

//            user thực
            $stt = 0;
            $total_thuc1 = $total_J2mexx = $total_Androidxx = $total_IOSxx = $total_Web = 0;
            $a = date("Y-m-d", strtotime("-1 day", strtotime($date1)));
            $b = date("Y-m-d", strtotime("-1 day", strtotime($date2)));
            $userthuc_arr = array();
            while (strtotime($a) <= strtotime($b)) {
                $stt++;
//            echo "$bd\n";
                $a = date("Y-m-d", strtotime("+1 day", strtotime($a)));
                $user_thuc = $this->user_model->user_thuc($date1, $date2, $province_id, $vn_district, $dcm_tr, $a);
//                pre($user_thuc);
                if ($user_thuc) foreach ($user_thuc as $key => $value) {
                    if ($value->device == 1) {
                        $total_Androidxx += $value->user_thuc;
                    }
                    if ($value->device == 2) {
                        $total_IOSxx += $value->user_thuc;
                    }
                    if ($value->device == 3) {
                        $total_Web += $value->user_thuc;
                    }
                    $total_thuc1 += $value->user_thuc;
                    $userthuc_arr[$stt] = new stdClass();
                    $userthuc_arr[$stt]->device = $value->device;
                    $userthuc_arr[$stt]->device_name = $value->device_name;
                    $userthuc_arr[$stt]->user_thuc = $value->user_thuc;
                    $userthuc_arr[$stt]->thoigian = $value->thoigian;
                }
            }
//            pre($userthuc_arr);
//            user thực
            $this->data['res'] = $user_;
            $this->data['user_tq'] = $user_tq;
            $this->data['userthuc_arr'] = $userthuc_arr;
        }
//        pre($input);

//        pre($user);
        $this->data['temp'] = 'admin/user/list';
//        $this->data['view'] = 'admin/user/list';
        $this->load->view('admin/layout', $this->data);
    }
}