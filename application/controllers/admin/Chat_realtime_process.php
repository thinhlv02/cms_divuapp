<?php

Class Chat_realtime_process extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('chat_info_model');
    }

//    function index()
//    {
//        //type_account (CSKH là 5), account_id (id CSKH), account_id_chat (id khách hàng), content (nội dung chat), id_cskh, is_read (bằng: 1)
//        $admin = $this->session->userdata('admin');
////        pre($admin);
//        $data = $this->input->post('typeAccountChatAdmin');
//        $typeAccountChatAdmin = $this->input->post('typeAccountChatAdmin');
//        $userIdChat = $this->input->post('userIdChat');
//        $content = $this->input->post('content');
//        $data_content = array(
//            'type_account' => 5, // LEVEL
//            'account_id' => $admin->id, // ID TRONG ADMIN
//            'type_account_chat' => $typeAccountChatAdmin, // ID TRONG ADMIN
//            'account_id_chat' => $userIdChat, // ID TRONG ADMIN
//            'content' => $content .'-'. date('Y-m-d H:i:s'), // ID TRONG ADMIN
//            'id_cskh' => $admin->id, // ID TRONG ADMIN
//            'is_read' => 1, // ID TRONG ADMIN
//        );
//        $this->chat_info_model->create($data_content);
//    }

    function index()
    {
        //type_account (CSKH là 5), account_id (id CSKH), account_id_chat (id khách hàng), content (nội dung chat), id_cskh, is_read (bằng: 1)
        $admin = $this->session->userdata('admin');
//        pre($admin);
        $typeAccountChatAdmin = $this->input->post('typeAccountChatAdmin');
        $userIdChat = $this->input->post('userIdChat');
        $content = $this->input->post('content');
        $is_read = $this->input->post('is_read');
        $data_content = array(
            'type_account' => 5, // LEVEL
            'account_id' => $admin->id, // ID TRONG ADMIN
            'type_account_chat' => $typeAccountChatAdmin, // ID TRONG ADMIN
            'account_id_chat' => $userIdChat, // ID TRONG ADMIN
            'content' => $content , // ID TRONG ADMIN
            'id_cskh' => $admin->id, // ID TRONG ADMIN
            'is_read' => $is_read, // ID TRONG ADMIN
        );
        $this->chat_info_model->create($data_content);
        echo '$is_read'.$is_read;
    }
}