<?php

Class Log_payment_cart_user extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('log_payment_cart_user_model');
        $this->load->model('product_model');
        $this->load->model('shop_model');
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
//        1: đã nhận đơn hàng, 2: đang xử lý đơn hàng, 3: đang lấy hàng, 4: đang vận chuyển, 5: giao hàng thành công, 6: hủy đơn hàng
    }

    function index()
    {
        $status_cart = array(
            '1' => 'đã nhận đơn hàng',
            '2' => 'đang xử lý đơn hàng',
            '3' => 'đang lấy hàng',
            '4' => 'đang vận chuyển',
            '5' => 'giao hàng thành công',
            '6' => 'hủy đơn hàng',
        );
        $this->data['status_cart'] = $status_cart;
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
            $type_cart = $this->input->post('type_cart');
            if ($type_cart == 1) {
                $on1 = 'user_id';
            } else {
                $on1 = 'admin_id';
            }
            $asset = $this->log_payment_cart_user_model->get_info_cart_user($search, $date1, $date2, $status, $type_cart,$id='');
////            pre($asset);
//        } //        $asset = $this->asset_model->get_list();
//        else {
//            $asset = $this->log_payment_cart_user_model->get_info_cart_user($search, $date1, $date2, $status,$type_cart);
//        }
//        pre($asset);
            $asset_ = array();
            $stt = 0;
            foreach ($asset as $key => $value) {
                foreach ($status_cart as $key1 => $value1) {
                    if ($key1 == $value->status) {
                        $status = $value1;
                    }
                }
                $pieces = explode(',', $value->product_id_detail);

                foreach ($pieces as $element) {
//                    echo $element.”<br/>”;
                    $product_id_ = explode(':', $element);
                    $product_name = $this->product_model->get_info($product_id_[0]);
                    $stt++;
                    $asset_[$stt] = new stdClass();
                    $asset_[$stt]->id = $value->id;
                    $asset_[$stt]->user_id = $value->$on1;
                    $asset_[$stt]->price = $value->price;
                    $asset_[$stt]->product_id_detail = $value->product_id_detail;
                    $asset_[$stt]->element = $element;
//                $asset_[$stt]->product_id = $product_id_[0];
                    if ($product_name) {
                        $asset_[$stt]->product_name = $product_name->name;
                    } else {
                        $asset_[$stt]->product_name = '';
                    }
                    $asset_[$stt]->number = $product_id_[1];
                    $asset_[$stt]->shop_id = $product_id_[2];
                    $shop_name = $this->shop_model->get_info($product_id_[2]);
                    if ($shop_name) {
                        $asset_[$stt]->shop_name = $shop_name->name;
                    } else {
                        $asset_[$stt]->shop_name = '';
                    }

//            $asset_[$stt]->xx = $xx;
//            $asset_[$stt]->detail_cart = $value->detail_cart;
                    $asset_[$stt]->status = $status;
                    $asset_[$stt]->nguoi_giao = $value->nguoi_giao;
                    $asset_[$stt]->detail_step = $value->detail_step;
                    $asset_[$stt]->created = $value->created;
                    $asset_[$stt]->username = $value->username;
                    $asset_[$stt]->phone = $value->phone;
                    $asset_[$stt]->address = $value->address;
                }
            }
//            pre($asset_);
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);
            $this->data['res'] = $asset_;
        }
//        pre($asset);
        $this->data['temp'] = 'admin/log_payment_cart_user/list';
        $this->load->view('admin/layout', $this->data);
    }
}