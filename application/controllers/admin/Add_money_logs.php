<?php

Class Add_money_logs extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('cms_add_money_logs_model');
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
        $type = 'all';
        $sub = 'all';
        $money_id = 'all';
        $userid = '';
        $asset_status = 'all';
        $date1 = 'all';
        $date2 = 'all';
        $status = 'all';
        $search = 'all';
        $admin_id = 'all';
        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $type = $this->input->post('type');
            $sub = $this->input->post('sub');
            $money_id = $this->input->post('money_id');
            $userid = $this->input->post('userid');
            $asset_status = $this->input->post('asset_status_id');
            $admin_id = $this->input->post('admin_id');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
//            pre($userid);
            $asset = $this->cms_add_money_logs_model->get_add_money_logs($search, $date1, $date2,$type,$sub,$money_id,$userid);

//            $ban = $this->input->post('ban');
//            $asset = $this->input->post('asset');
//            if ($asset != 'all') {
//                $input['where']['id'] = $asset;
//            }
//            $input['where']['ban'] = $ban;
//            $asset = $this->asset_model->get_list();
//            $this->data['res'] = $asset;
//            $this->data['ban'] = $ban;
//            $this->session->set_userdata('asset', $asset);
////            pre($asset);
        } //        $asset = $this->asset_model->get_list();
        else {
            $asset = $this->cms_add_money_logs_model->get_add_money_logs($search, $date1, $date2,$type,$sub,$money_id,$userid);
        }
//        pre($asset);
        
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);
        $this->data['res'] = $asset;
//        pre($asset);

        $this->data['temp'] = 'admin/add_money_logs/list';
        $this->load->view('admin/layout', $this->data);
    }
}