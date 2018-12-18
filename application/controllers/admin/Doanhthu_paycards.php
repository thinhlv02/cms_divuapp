<?php

Class Doanhthu_paycards extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('doanhthu_paycards_model');
        $this->load->model('service_package_maintenance_model');
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
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $date1 = 'all';
        $date2 = 'all';
        $search = 'all';
        $admin_id = 'all';
        if ($this->input->post('search')) {
            $search = 1;
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
//            pre($date1);
            $asset = $this->doanhthu_paycards_model->get_doanhthu_paycards($search, $date1, $date2);
////            pre($asset);
        } //        $asset = $this->asset_model->get_list();
        else {
            $asset = $this->doanhthu_paycards_model->get_doanhthu_paycards($search, $date1, $date2, $admin_id);
        }
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);
        $this->data['res'] = $asset;
//        pre($asset);

        $this->data['temp'] = 'admin/doanhthu_paycards/list';
        $this->load->view('admin/layout', $this->data);
    }
}