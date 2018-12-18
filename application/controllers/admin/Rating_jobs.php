<?php

Class Rating_jobs extends MY_Controller
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
//            pre('fuck');
            $admin_id = $this->input->post('admin_id');
            $date1 = $this->input->post('date1');
//            pre($date1);
            $date1 = new DateTime($date1 . '00:00:00');
            $date1 = $date1->getTimestamp();
            $date2 = $this->input->post('date2');
            $date2 = new DateTime($date2 . '23:59:59');
            $date2 = $date2->getTimestamp();
            $asset = $this->technician_jobs_model->get_info_mission($search, $date1, $date2, $admin_id, 'all');
////            pre($asset);
        } //        $asset = $this->asset_model->get_list();
        else {
            $asset = $this->technician_jobs_model->get_info_mission($search, $date1, $date2, $admin_id, 'all');
        }
        $asset_arr = array();
        $index = 0;
        foreach ($asset as $key => $value) {
            $index++;
            $report_name = '';
            if (strpos($value->name, 'Bảo dưỡng') !== false) {
//                echo 'true';
                $report = $this->admin_mission_report_model->get_list(array('where' => array('admin_mission_id' => $value->id)));
                if ($report) {
                    $report_name = explode('***', $report[0]->content);
                    $report_name = $report_name[1];
                }
            } else {
                $report = $this->admin_emergency_report_model->get_list(array('where' => array('admin_emergency_id' => $value->id)));
                if ($report) {
                    $report_name = $report[0]->content;
                }
            }
            $district_work_name = '';
            $district_work = $this->vn_district_model->get_info($value->district_work_id);
            if ($district_work) {
                $district_work_name = $district_work->name;
            }
//            $time_start_job_ = $time_end_ = '';
            $count = '';
//                            echo round(abs($to_time - $from_time) / 60,2);
            if ($value->time_start_job && $value->time_end) {
                $time_start_job_ = date('Y-m-d H:i:s', substr($value->time_start_job, 0, 10));
                $time_start_job_2 = strtotime($time_start_job_);

                $time_end_ = date('Y-m-d H:i:s', substr($value->time_end, 0, 10));
                $time_end_2 = strtotime($time_end_);
                $count = round(abs($time_end_2 - $time_start_job_2) / 60, 2);
            }
            $asset_arr[$index] = new stdClass();
            $asset_arr[$index]->id = $value->id;
            $asset_arr[$index]->admin_id = $value->admin_id;
            $asset_arr[$index]->fullname_admin = $value->fullname_admin;
            $asset_arr[$index]->name_package = $value->name_package;
            $asset_arr[$index]->district_work_id = $value->district_work_id;
            $asset_arr[$index]->name = $value->name;
            $asset_arr[$index]->status = $value->status;
            $asset_arr[$index]->name_status = $value->name_status;
            $asset_arr[$index]->position_start = $value->position_start;
            $asset_arr[$index]->fullname = $value->fullname;
            $asset_arr[$index]->address = $value->address;
            $asset_arr[$index]->phone = $value->phone;
            $asset_arr[$index]->time = $value->time;
            $asset_arr[$index]->time_start_job = $value->time_start_job;
            $asset_arr[$index]->time_end = $value->time_end;
            $asset_arr[$index]->khach_hang_danh_gia = $value->khach_hang_danh_gia;
            $asset_arr[$index]->bonus_ktv = $value->bonus_ktv;
            $asset_arr[$index]->so_sao = $value->so_sao;
            $asset_arr[$index]->so_sao = $value->so_sao;
            $asset_arr[$index]->report_name = $report_name;
            $asset_arr[$index]->district_work_name = $district_work_name;
            $asset_arr[$index]->count = $count;
        }
//        pre($asset_arr);
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);
        $this->data['res'] = $asset_arr;
//        }
//        pre($asset);
        $this->data['temp'] = 'admin/rating_jobs/list';
        $this->load->view('admin/layout', $this->data);
    }
}