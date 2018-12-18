<?php

Class Makers extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('makers_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $data_map = $this->makers_model->get_info_map();
        $this->data['data_map'] = $data_map;
        $this->data['temp'] = 'admin/markers/show_map';
        $this->load->view('admin/layout', $this->data);
    }
}