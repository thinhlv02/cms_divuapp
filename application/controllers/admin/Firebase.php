<?php

Class Firebase extends MY_Controller
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
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');
//        if ($this->input->post('send_one')) {
//            $regId = $this->input->post('regId');
//            pre($regId);
//        }

        $tbl_gcm_api_key = $this->tbl_gcm_api_key_model->get_info(1);
        $this->data['api_key'] = $tbl_gcm_api_key->api_key;
        if ($this->input->post('update_key')) {
//            pre('abc');
            $api_key = $this->input->post('api_key_new');
//            pre($api_key);
            if ($this->tbl_gcm_api_key_model->update(1, array('api_key' => $api_key))) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/firebase'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }
//        pre($tbl_gcm_api_key);
        $this->data['temp'] = 'admin/fcm/list';
//        $this->data['view'] = 'admin/city/list';
        $this->load->view('admin/layout', $this->data);
    }
}