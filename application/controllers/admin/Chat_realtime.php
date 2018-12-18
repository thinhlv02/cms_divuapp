<?php

Class Chat_realtime extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('chat_info_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $logs_chat = $this->chat_info_model->get_list($input);
////        pre($logs_chat);
//        $this->data['res'] = $logs_chat;
//        if ($this->input->post('btnAdd')) {
//            $content = $this->input->post('content');
//            pre($content);
//        }
        $input2 = array();
//        $input2['where']['is_read'] = 0;
        $input2['group_by'] = 'account_id_chat';
        $input2['order'] = array('created_time','desc');

        $list_wait = $this->chat_info_model->get_list($input2);
//        pre($list_wait);
        $this->data['list_wait'] = $list_wait;
//        pre($logs_chat);
        $this->data['temp'] = 'admin/chat_realtime/list';
        $this->load->view('admin/layout', $this->data);
    }

    function test(){
        $account_id_chat = $this->input->post('user_id');

//        pre($account_id_chat);
        if ($account_id_chat) {
//            echo 'aaaaaaaa'.$account_id_chat;
            $input = array();
            $input['where']['account_id_chat'] = $account_id_chat;
            $input['order'] = array('id', 'asc');
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;
            $logs_chat = $this->chat_info_model->get_list($input);
            $this->data['res'] = $logs_chat;
//            pre($logs_chat);
//            pre('ab');
            $this->data['res'] = $logs_chat;
            $this->data['account_id_chat'] = $account_id_chat;
//            $this->session->set_userdata('logs_chat', $logs_chat);
            $this->load->view('admin/chat_realtime/content_chat', $this->data);
//            pre($logs_chat);
        }
    }
}