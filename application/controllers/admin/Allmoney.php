<?php

Class Allmoney extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('allmoney_model');
//        pre($vn_city);
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
            $province_id = $district_id = $dcm_tr = 'all';
            $input = array();
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));

            $date11 = $this->input->post('date1') . ' 00:00:00';
//            pre($date1);
            $date11 = new DateTime($date11);
            $date11 = $date11->getTimestamp() * 1000;
            $date22 = $this->input->post('date2') . ' 23:59:59';
            $date22 = new DateTime($date22);
            $date22 = $date22->getTimestamp() * 1000;

            $input['where'][' date(created_at) >= '] = $date1;
            $input['where'][' date(created_at) <= '] = $date2;
//            pre($input);

//            $user = $this->allmoney_model->get_list($input);
            $money_server = $this->allmoney_model->money_server($date1, $date2, $date11, $date22);
//            $goidv_details = $this->allmoney_model->goidv_details($date1, $date2, $date11, $date22);
//            pre($goidv_details);
            $money_arr = array();
            $i = $money_in_kh = $money_out_kh=$money_in_ktv=$money_out_ktv = 0;
            foreach ($money_server as $key => $value) {
                $i++;
                $money_arr[$i] = new stdClass();
                $money_arr[$i]->kh_nap_qua_ktv = $value->kh_nap_qua_ktv;
                $money_arr[$i]->bonus_ktv_emergency = $value->bonus_ktv_emergency;
                $money_arr[$i]->bonus_ktv_maintenance = $value->bonus_ktv_maintenance;
                $money_arr[$i]->bonus_ktv = $value->bonus_ktv_emergency + $value->bonus_ktv_maintenance;
                $money_arr[$i]->money_intro = $value->money_intro;
                $money_arr[$i]->nap_bank = $value->nap_bank;
                $money_arr[$i]->admin_add_kh = $value->admin_add_kh;
                $money_arr[$i]->admin_add_ktv = $value->admin_add_ktv;
                $money_arr[$i]->server_add_kh = $value->server_add_kh;
                $money_arr[$i]->server_add_ktv = $value->server_add_ktv;
                $money_arr[$i]->mua_goi_dv = $value->mua_goi_dv;
                $money_arr[$i]->total_money_payment = $value->total_money_payment;
                $goidv_details = $this->allmoney_model->goidv_details($date1, $date2, $date11, $date22);
                $money_arr[$i]->money_dv_details = $goidv_details;

                $money_in_kh += $value->kh_nap_qua_ktv + $value->nap_bank + $value->admin_add_kh + $value->server_add_kh;
                $money_in_ktv += $value->bonus_ktv_emergency + $value->bonus_ktv_maintenance+ $value->money_intro
                    + $value->admin_add_ktv + $value->server_add_ktv;
                $money_arr[$i]->money_in_kh = $money_in_kh;
                $money_arr[$i]->money_in_ktv = $money_in_ktv;
            }
            $money_cart_user = $this->allmoney_model->money_cart_user($date1, $date2);
//            pre($money_arr);
            $money_vat_tu_user = $stt = 0;
            foreach ($money_cart_user as $key2 => $value2) {
                $pieces = explode(',', $value2->product_id_detail);
                foreach ($pieces as $element) {
                    $product_id_ = explode(':', $element);
                    $product_id_[1];
                    $stt++;
                    $asset_[$stt] = new stdClass();
                    $asset_[$stt]->price = $value2->price;
                    $asset_[$stt]->number = $product_id_[1];
                    $asset_[$stt]->money = $value2->price * $product_id_[1];
                    $money_vat_tu_user += $value2->price * $product_id_[1];
                }
            }

            $money_cart_admin = $this->allmoney_model->money_cart_admin($date1, $date2);
//            pre($money_arr);
            $money_vat_tu_ad = $stt = 0;
            foreach ($money_cart_admin as $key2 => $value3) {
                $pieces = explode(',', $value3->product_id_detail);
                foreach ($pieces as $element) {
                    $product_id_ = explode(':', $element);
                    $product_id_[1];
                    $stt++;
                    $asset_[$stt] = new stdClass();
                    $asset_[$stt]->price = $value3->price;
                    $asset_[$stt]->number = $product_id_[1];
                    $asset_[$stt]->money = $value3->price * $product_id_[1];
                    $money_vat_tu_ad += $value3->price * $product_id_[1];
                }
            }

            $money_out_kh += $value->mua_goi_dv + $money_vat_tu_user + $value->bonus_ktv_emergency + $value->bonus_ktv_maintenance;
            $money_out_ktv += $money_vat_tu_ad + $value->total_money_payment + $value->kh_nap_qua_ktv;
//            pre($money);
            $money_arr[$i]->money_vat_tu_user = $money_vat_tu_user;
            $money_arr[$i]->money_vat_tu_ad = $money_vat_tu_ad;
//            $money_out += $money_vat_tu_user;
            $money_arr[$i]->money_out_kh = $money_out_kh;
            $money_arr[$i]->money_out_ktv = $money_out_ktv;
            $money_arr[$i]->money_end_kh = $money_in_kh - $money_out_kh;
            $money_arr[$i]->money_end_ktv = $money_in_ktv - $money_out_ktv;
//            pre($money_arr);
//            pre($userthuc_arr);
//            user thực
            $this->data['res'] = $money_arr;
        }

//        pre($user_);
//        pre($user);
        $this->data['temp'] = 'admin/allmoney/list';
//        $this->data['view'] = 'admin/user/list';
        $this->load->view('admin/layout', $this->data);
    }
}