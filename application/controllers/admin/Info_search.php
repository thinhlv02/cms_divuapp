<?php

Class Info_search extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('user_model');
        $this->load->model('user_temp_address_model');
        $this->load->model('info_search_model');
        $this->load->model('service_package_user_model');
        $this->load->model('appliance_model');
////        pre($deparment);
        $input_e = array();
        $input_e['where']['level'] = 4;
//        $input_e['where']['role'] = 1;
//        $input_e['where']['id > '] = 115;
        $list_emp = $this->admin_model->get_list($input_e);
//        $list_emp = $this->asset_model->get_list();
        $this->data['list_emp'] = $list_emp;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        if (isset($_GET['id'])) {
////            echo 'idxxxxxxxxxxx' . $_GET['id'];
//            $input = array();
//            $input['where']['id'] = $_GET['id'];
//            $asset = $this->user_model->get_list($input);
//
//
//            $info_2 = $this->info_search_model->get_info_search2($_GET['id']);
////            pre($info_2);
//            $info_2_arr = $info_3 = array();
//            $index2 = 0;
//            foreach ($info_2 as $key2 => $value2) {
//                $index2++;
//                $info_2_arr[$index2] = new stdClass();
//                $info_2_arr[$index2]->id = $value2->id;
//                $info_2_arr[$index2]->name = $value2->name;
//                $info_2_arr[$index2]->start_time = $value2->start_time;
//                $info_2_arr[$index2]->end_time = $value2->end_time;
//                $info_2_arr[$index2]->address = $value2->address;
//                $info_3 = $this->info_search_model->get_info_search3($value2->id);
//            }
//
//            $this->data['res'] = $asset;
//            $this->data['type_cart'] = 1;
//            $this->data['info_2'] = $info_2;
//            $this->data['info_3'] = $info_3;
//        }
        $user_temp_address = $this->user_temp_address_model->edit_address($user_id = '');
        $this->data['user_temp_address'] = $user_temp_address;

        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $userid = trim($this->input->post('userid'));
            $username = trim($this->input->post('username'));
            $fullname = trim($this->input->post('fullname'));
            $phone = $this->input->post('phone');
            $type_cart = $this->input->post('type_cart');
            if ($userid != '' || $username != '' || $phone != '' || $fullname != '') {
//                if ($type_cart == 1) {
//                    $on1 = 'user_id';
//                } else {
//                    $on1 = 'admin_id';
//                }
                $asset = $this->info_search_model->get_info_search($type_cart, $userid, $username, $phone, $fullname);
////            pre($asset);
//        } //        $asset = $this->asset_model->get_list();
//        else {
//            $asset = $this->info_search_model->get_info_search($search, $date1, $date2, $status,$type_cart);
//        }
//        pre($asset);
                $asset_ = array();
                $stt = 0;
                foreach ($asset as $key => $value) {
//                $sv = $this->service_package_user_model->get_info($value->id);
                    $stt++;
                    $asset_[$stt] = new stdClass();
                    $asset_[$stt]->id = $value->id;
                    $asset_[$stt]->username = $value->username;
                    $asset_[$stt]->fullname = $value->fullname;
                    $asset_[$stt]->address = $value->address;
                    $asset_[$stt]->phone = $value->phone;
                    $asset_[$stt]->email = $value->email;
                    $asset_[$stt]->balance = $value->balance;
                    if (isset($value->dia_chi_ktv_xac_nhan)) {
                        $asset_[$stt]->dia_chi_ktv_xac_nhan = $value->dia_chi_ktv_xac_nhan;
                    }
////                }
                }
//            pre($asset_);
//                lấy thông tin gói dv và thời gian đặt lịch
//                $info_2 = $this->info_search_model->get_info_search2($userid);
                $info_2 = $this->info_search_model->get_info_search2($type_cart, $userid, $username, $phone, $fullname);
                $info_2_arr = $info_3 = array();
                $index2 = 0;
                foreach ($info_2 as $key2 => $value2) {
                    $index2++;
                    $info_2_arr[$index2] = new stdClass();
                    $info_2_arr[$index2]->name = $value2->name;
                    $info_2_arr[$index2]->id = $value2->id;
                    $info_2_arr[$index2]->user_id = $value2->user_id;
                    $info_2_arr[$index2]->start_time = $value2->start_time;
                    $info_2_arr[$index2]->end_time = $value2->end_time;
                    $info_2_arr[$index2]->address = $value2->address;
                    $info_2_arr[$index2]->fullname = $value2->fullname;
                    $info_2_arr[$index2]->list_appliance = $this->appliance_model->get_list(array('where' => array('service_package_user_id' => $value2->id)));
                    $info_3 = $this->info_search_model->get_info_search3($value2->id);
                }
//                pre($info_2_arr);
//                pre($info_3);
//                lấy thông tin gói dv và thời gian đặt lịch
                $this->data['res'] = $asset_;
                $this->data['info_2'] = $info_2_arr;
                $this->data['info_3'] = $info_3;
                $this->data['type_cart'] = $type_cart;
            }
        }
//        pre($asset);
        $this->data['temp'] = 'admin/info_search/list';
        $this->load->view('admin/layout', $this->data);
    }
}