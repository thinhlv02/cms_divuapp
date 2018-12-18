<?php

Class Login extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
//        $admin = $this->session->userdata('admin');
        $this->load->library('form_validation');
        $this->load->helper('form');
        if ($this->input->post()) {
            $this->form_validation->set_rules('login', 'login', 'callback_check_login');
            if ($this->form_validation->run()) {
                $this->session->set_userdata('login', true);
//                $this->load->view('admin/chat_realtime/process.php');
//                redirect(base_url('admin/user_active'));
                redirect(base_url('admin/welcome'));
            }
        }
        $this->load->view('admin/login');
    }
    /*
     * Kiem tra username va password co chinh xac khong
     */
    function check_login()
    {
//        $message = $this->session->flashdata('message');
//        $this->data['message'] = $message;
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $password = md5($password);

        $this->load->model('admin_model');
        $this->load->model('menu_access_model');
        $where = array('username' => $username, 'password' => $password, 'level'=>5);
//        $where = array('username' => $username, 'password' => $password);
//        pre($where);
        if ($this->admin_model->check_exists($where)) {
            $this->load->model('admin_model');
            $this->load->model('config_server_model');
            $input = array();
            //(ví dụ $input['order'] = array('id','DESC'))
//            $input['order']['USERID'] = array('USERID', 'DESC');
            $input['where']['username'] = $username;
            $admin = $this->admin_model->get_list($input);
            $cfg = $this->config_server_model->get_list();
            /*thêm */
            $admin_arr = new  stdClass();
            $admin_arr->id = $admin[0]->id;
            $admin_arr->level = $admin[0]->level;
            $admin_arr->UserName = $admin[0]->username;
            $admin_arr->status = $admin[0]->status;
            $admin_arr->link_avatar = $admin[0]->link_avatar;
            $admin_arr->link_port_3000 = $cfg[0]->link_port_3000;
            /*thêm */
//            $this->session->set_userdata('admin', $admin[0]);
            $this->session->set_userdata('admin', $admin_arr);
//            pre($admin_arr);
            return true;
        }
        $this->form_validation->set_message(__FUNCTION__, 'Sai Username hoặc Password !!!');
        return false;
    }
}