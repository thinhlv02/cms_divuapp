<?php

Class General_customers extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('user_model');
        $this->load->model('user_temp_address_model');
        $this->load->model('general_customers_model');
        $this->load->model('service_package_user_model');
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

        $this->output->set_header("Last-Modified: " . gmdate("D, d M Y H:iConfused") . " GMT");
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Cache-Control: post-check=0, pre-check=0", false);
        $this->output->set_header("Pragma: no-cache");
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $userid = trim($this->input->post('userid'));
//            pre($userid);
            $username = trim($this->input->post('username'));
            $fullname = trim($this->input->post('fullname'));
            $phone = trim($this->input->post('phone'));
            $vn_city = $this->input->post('vn_city');
            $vn_district = $this->input->post('vn_district');
//            if ($userid != '' || $username != '' || $phone != '' || $fullname != '') {
            $general_customers = $this->general_customers_model->general_customers($vn_city,$vn_district,$userid, $username, $phone, $fullname);
            $general_customers_ = array();
            $stt = 0;
            foreach ($general_customers as $key => $value) {
//                $sv = $this->service_package_user_model->get_info($value->id);
                $stt++;
                $general_customers_[$stt] = new stdClass();
                $general_customers_[$stt]->id = $value->id;
                $general_customers_[$stt]->username = $value->username;
                $general_customers_[$stt]->fullname = $value->fullname;
                $general_customers_[$stt]->address = $value->address;
                $general_customers_[$stt]->phone = $value->phone;
                $general_customers_[$stt]->email = $value->email;
                $general_customers_[$stt]->created_at = $value->created_at;
                $general_customers_[$stt]->balance = $value->balance;
                $general_customers_[$stt]->service_package = $this->general_customers_model->general_customers2($value->id);
////                }
            }
//            pre($general_customers_);
//                pre($info_2);
//                lấy thông tin gói dv và thời gian đặt lịch
            $this->data['res'] = $general_customers_;
//            }
        }
//        pre($general_customers);
        $this->data['temp'] = 'admin/general_customers/list';
        $this->load->view('admin/layout', $this->data);
    }

    public function general_customers_details1($slug = '', $id = 0)
    {
//        pre($slug.'-----'.$id);
        $detail_1 = $this->general_customers_model->general_customers2($id);
//        pre($detail_1);
//        $news2 = $this->general_customers_model->get_list(array('limit' => array(5, 0), 'order' => array('id', 'desc')));
        $general_customers_1 = array();
        $stt2 = 0;
        foreach ($detail_1 as $key => $value) {
//                $sv = $this->service_package_user_model->get_info($value->id);
            $stt2++;
            $general_customers_1[$stt2] = new stdClass();
            $general_customers_1[$stt2]->id = $value->id;
            $general_customers_1[$stt2]->user_id = $value->user_id;
            $general_customers_1[$stt2]->service_package_id = $value->service_package_id;
            $general_customers_1[$stt2]->name = $value->name;
            $general_customers_1[$stt2]->start_time = $value->start_time;
            $general_customers_1[$stt2]->end_time = $value->end_time;
            $general_customers_1[$stt2]->address = $value->address;
            $general_customers_1[$stt2]->latitude = $value->latitude;
            $general_customers_1[$stt2]->longitude = $value->longitude;
            $general_customers_1[$stt2]->appointment_time = $value->appointment_time;
//            $general_customers_1[$stt2]->service_package_maintenance = $this->service_package_maintenance_model->get_list(array('where' => array('id' => $value->id)));
            $general_customers_1[$stt2]->service_package_maintenance = $this->general_customers_model->get_list_details1($value->id);
////                }
        }
//        pre($general_customers_1);
//        if ($detail && $slug == create_slug($detail->id)) {
//            $this->data['news2'] = $news2;
        $this->data['detail'] = $general_customers_1;
        $this->data['temp'] = 'admin/general_customers/general_customers_details1';

//        }
//        else {
////            redirect(base_url());
//            $this->data['news2'] = $news2;
//            $this->data['temp'] = 'admin/general_customers/list';
//        }
        $this->load->view('admin/layout', $this->data);
    }

    public function general_customers_details2($slug = '', $id = 0)
    {
//        pre($slug.'-----'.$id);
        $detail_1 = $this->general_customers_model->general_customers3($id);
//        pre($detail_1);
//        $news2 = $this->general_customers_model->get_list(array('limit' => array(5, 0), 'order' => array('id', 'desc')));
        $general_customers_1 = array();
        $stt2 = 0;
//        foreach ($detail_1 as $key => $value) {
////                $sv = $this->service_package_user_model->get_info($value->id);
//            $stt2++;
//            $general_customers_1[$stt2] = new stdClass();
//            $general_customers_1[$stt2]->id = $value->id;
//            $general_customers_1[$stt2]->user_id = $value->user_id;
//            $general_customers_1[$stt2]->service_package_id = $value->service_package_id;
//            $general_customers_1[$stt2]->name = $value->name;
//            $general_customers_1[$stt2]->start_time = $value->start_time;
//            $general_customers_1[$stt2]->end_time = $value->end_time;
//            $general_customers_1[$stt2]->address = $value->address;
//            $general_customers_1[$stt2]->latitude = $value->latitude;
//            $general_customers_1[$stt2]->longitude = $value->longitude;
//            $general_customers_1[$stt2]->appointment_time = $value->appointment_time;
//            $general_customers_1[$stt2]->service_package_maintenance = $this->service_package_maintenance_model->get_list(array('where' => array('id' => $value->id)));
//////                }
//        }
//        pre($general_customers_1);
//        if ($detail && $slug == create_slug($detail->id)) {
//            $this->data['news2'] = $news2;
        $this->data['detail'] = $detail_1;
        $this->data['temp'] = 'admin/general_customers/general_customers_details2';

//        }
//        else {
////            redirect(base_url());
//            $this->data['news2'] = $news2;
//            $this->data['temp'] = 'admin/general_customers/list';
//        }
        $this->load->view('admin/layout', $this->data);
    }
}