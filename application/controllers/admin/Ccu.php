<?php

Class Ccu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ccu_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

//        $ccu = $this->ccu_model->get_list($input);
//        $this->data['res'] = $ccu;
//        pre($ccu);
        $date1 = $date2 = '';
        if ($this->input->post('search')) {
//            $from = $this->input->post('btnAdd');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
            $ccu = $this->ccu_model->function_getlist_ccu($date1, $date2);


        }
//        else {
        $ccu = $this->ccu_model->function_getlist_ccu($date1, $date2);
        $ccu_arr = array();
        $i = 0;
//        [TIME] => 15:00:20
//            [ccutong] => 1
//            [android] => 1
//            [ios] => 1
//            [ccu_webb] => 0
//            [ccu_users] => 1
//            [ccu_ktv] => 0
//        1: map, 2: cứu hộ, 3: gói dịch vụ, 4: vật tư, 5: tìm thợ,6: đăng ký cộng tác viên, 7: nạp tiền, 8: khuyến mãi, 9: other
        foreach ($ccu as $key => $value) {
            $action = explode(',', $value->action_user);
            $i++;
            $ccu_arr[$i] = new stdClass();
            $ccu_arr[$i]->TIME = $value->TIME;
            $ccu_arr[$i]->ccutong = $value->ccutong;
//            $ccu_arr[$i]->android = $value->android;
//            $ccu_arr[$i]->ios = $value->ios;
//            $ccu_arr[$i]->ccu_web = $value->ccu_web;
            $ccu_arr[$i]->ccu_users = $value->ccu_users;
            $ccu_arr[$i]->ccu_ktv = $value->ccu_ktv;
            $ccu_arr[$i]->map = explode(':', $action[0])[1];
            $ccu_arr[$i]->cuuho = explode(':', $action[1])[1];
            $ccu_arr[$i]->goidichvu = explode(':', $action[2])[1];
            $ccu_arr[$i]->vattu = explode(':', $action[3])[1];
            $ccu_arr[$i]->timtho = explode(':', $action[4])[1];
            $ccu_arr[$i]->dkctv = explode(':', $action[5])[1];
            $ccu_arr[$i]->naptien = explode(':', $action[6])[1];
            $ccu_arr[$i]->km = explode(':', $action[7])[1];
            $ccu_arr[$i]->other = explode(':', $action[8])[1];
            $tags = explode(',', $value->ccu_info);
            $ccu_arr[$i]->xxx = $tags;
            $ccu_arr[$i]->android = '';
            $ccu_arr[$i]->ios = '';
            $ccu_arr[$i]->ccu_web = '';

            foreach ($tags as $key2 => $value2) {
                if (isset($value2[0]) && $value2[0] != '') {
                    $ccu_arr[$i]->android = explode(':', $value2[0])[0];
//                        $ccu_arr[$i]->android = explode(':', $value2[0])[1];
                }
                if (isset($value2[1]) && $value2[1] != '') {
                    $ccu_arr[$i]->ios = explode(':', $value2[1])[0];
                }
                if (isset($value2[2]) && $value2[2] != '') {
                    $ccu_arr[$i]->ccu_web = explode(':', $value2[2])[0];
                }
            }
        }
//        pre($ccu_arr);
        $input = array();
        $input['order'] = array('id', 'desc');
        $input['limit'] = array('1', '0');
        $ccu_device = $this->ccu_model->get_list($input);
//            pre($input);
//            pre($ccu_device);

//            pre($ccu);
//        }
        $this->data['temp'] = 'admin/ccu/list';
        $this->data['ccu'] = $ccu_arr;
        $this->data['ccu_device'] = $ccu_device;
//        $this->data['view'] = 'admin/ccu/list';
        $this->load->view('admin/layout', $this->data);
    }
}