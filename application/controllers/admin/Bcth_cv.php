<?php

Class Bcth_cv extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('technician_jobs_model');
        $this->load->model('admin_mission_report_model');
        $this->load->model('admin_emergency_report_model');
        $this->load->model('service_package_maintenance_model');
        $this->load->model('service_package_maintenance_status_model');
        $this->load->model('vn_district_model');
        $service_package_maintenance_status = $this->service_package_maintenance_status_model->get_list();
        $this->data['service_package_maintenance_status'] = $service_package_maintenance_status;
//        pre($service_package_maintenance_status);
        $input_e = array();
//        $input_e['where']['level'] = 4;
        $input_e['where_in'] = array('level', array('4', '6'));
//        $input_e['where']['role'] = 1;
//        $input_e['where']['id > '] = 115;
        $list_emp = $this->admin_model->get_list($input_e);
//        $list_emp = $this->asset_model->get_list();
        $this->data['list_emp'] = $list_emp;
//        pre($list_emp);
    }

    function index()
    {
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('search')) {
//            pre('fuck');
            $admin_id = $this->input->post('admin_id');
            $input_e2 = array();
            $input_e2['where_in'] = array('level', array('4', '6'));
            if ($admin_id != 'all') {
                $input_e2['where']['id'] = $admin_id;

            }
            $list_emp2 = $this->admin_model->get_list($input_e2);
            $month = date('m', strtotime($this->input->post('date1')));
            $year = date('Y', strtotime($this->input->post('date1')));
            $day_arr = array();
            for ($d = 1; $d <= 31; $d++) {
                $time = mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time) == $month)
//                    $day_arr[] = date('Y-m-d-D', $time);
                    $day_arr[] = date('d-m-Y', $time);
            }
            $this->data['day_arr'] = $day_arr;
            $this->data['list_emp2'] = $list_emp2;
//        $this->data['kq'] = $kq;
        }
//        pre($asset);
        $this->data['temp'] = 'admin/bcth_cv/list';
        $this->load->view('admin/layout', $this->data);
    }
}