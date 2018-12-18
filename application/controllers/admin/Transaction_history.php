<?php

Class Transaction_history extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('transaction_history_model');
        $this->load->model('product_model');

//        $input_priority = array();
//        $input_priority['order'] = array('priority', 'asc');
//        $deparment = $this->department_model->get_list($input_priority);
//        $this->data['deparment'] = $deparment;
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
        $status_transaction_history = array(
            '1' => 'thành công',
            '2' => 'thất bại'
        );
//        1 -> 10: nạp tiền(1: nhận thưởng từ khách hàng, 2: nạp tiền từ card), >=11: trừ tiền (11: mua gói dịch vụ,
//        12: log mua vật phẩm, 13: thưởng tiền cho KTV)

        $type_transaction_history = array(
            '1' => 'nhận thưởng từ khách hàng',
            '2' => 'nạp tiền từ card',
            '3' => 'nạp tiền',
            '4' => 'nạp tiền',
            '5' => 'nạp tiền',
            '6' => 'nạp tiền',
            '7' => 'nạp tiền',
            '8' => 'nạp tiền',
            '9' => 'nạp tiền',
            '10' => 'nạp tiền',
            '11' => 'trừ tiền mua gói dịch vụ',
            '12' => 'trừ tiền log mua vật phẩm',
            '13' => 'thưởng tiền cho KTV',
            '14' => 'trừ tiền',
            '15' => 'trừ tiền',
        );
        $this->data['status_cart'] = $status_transaction_history;
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $date1 = 'all';
        $date2 = 'all';
//        $status = 'all';
        $search = 'all';
//        $type_cart = '1';
        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
            $status = $this->input->post('status');
            $userid = $this->input->post('userid');
            $username = $this->input->post('username');
            $type_cart = $this->input->post('type_cart');
            if ($type_cart == 1) {
                $on1 = 'user_id';
            } else {
                $on1 = 'admin_id';
            }

            $asset = $this->transaction_history_model->get_info_transaction_history($search, $date1, $date2, $status, $type_cart,$userid,$username);
////            pre($asset);
//        } //        $asset = $this->asset_model->get_list();
//        else {
//            $asset = $this->transaction_history_model->get_info_transaction_history($search, $date1, $date2, $status,$type_cart);
//        }
//        pre($asset);
            $asset_ = array();
            $stt = 0;
            foreach ($asset as $key => $value) {
                foreach ($status_transaction_history as $key1 => $value1) {
                    if ($key1 == $value->status) {
                        $status = $value1;
                    }
                }

                foreach ($type_transaction_history as $key2 => $value2) {
                    if ($key2 == $value->type) {
                        $type = $value2;
                    }
                }
                $stt++;
                $asset_[$stt] = new stdClass();
                $asset_[$stt]->id = $value->id;
                $asset_[$stt]->user_id = $value->$on1;
                $asset_[$stt]->username = $value->username;
                $asset_[$stt]->transaction_id = $value->transaction_id;
                $asset_[$stt]->price = $value->price;
                $asset_[$stt]->type = $type;
                $asset_[$stt]->descriptions = $value->descriptions;
                $asset_[$stt]->status = $status;
                $asset_[$stt]->created_time = $value->created_time;
                $asset_[$stt]->fullname = $value->fullname;
                $asset_[$stt]->address = $value->address;
//                }
            }
//            pre($asset_);
            $this->data['res'] = $asset_;
        }
//        pre($asset);
        $this->data['temp'] = 'admin/transaction_history/list';
        $this->load->view('admin/layout', $this->data);
    }
}