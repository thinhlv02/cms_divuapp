<?php

Class Firebase_push extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('tbl_gcm_api_key_model');
        $this->load->model('user_model');
        $this->load->model('admin_model');
//        pre($agency);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $tbl_gcm_api_key = $this->tbl_gcm_api_key_model->get_info(1);
//        $this->data['api_key'] = $tbl_gcm_api_key->api_key;
//        if ($this->input->post('update_key')) {
//            pre('abc');
            $api_key = $this->input->post('user_id');
            echo $api_key;
//            pre($api_key);
//            if ($this->tbl_gcm_api_key_model->update(1, array('api_key' => $api_key))) {
//                $this->session->set_flashdata('message', 'Cập nhật thành công');
//                redirect(base_url('admin/firebase'));
//            } else {
//                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
//            }
//        }
    }
}