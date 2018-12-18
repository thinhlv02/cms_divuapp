<?php

Class Contract extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('area_model');
        $this->load->model('user_model');
        $this->load->model('contract_model');
        $this->load->model('service_package_user_model');
        $this->load->model('service_package_maintenance_model');
        $this->load->model('product_gift_model');
        $this->load->model('vn_city_model');
        $agency = $this->area_model->get_list();
        $this->data['area'] = $agency;
//        pre($agency);
//        $input_priority = array();
//        $input_priority['order'] = array('priority', 'asc');
//        $deparment = $this->department_model->get_list($input_priority);
//        $this->data['deparment'] = $deparment;
////        pre($deparment);
        $input_e = array();
        $input_e['where']['level'] = 4;
//        $input_e['where']['role'] = 1;
//        $input_e['where']['id > '] = 115;
        $list_search = $this->contract_model->list_search();
        $this->data['list_search'] = $list_search;
//        pre($list_search);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post('search')) {
            $search = 1;
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));

            $date11 = new DateTime($date1 . '00:00:00');
            $date11 = $date11->getTimestamp();
            $date12 = new DateTime($date2 . '23:59:59');
            $date12 = $date12->getTimestamp();
            $parent_id = $this->input->post('parent_id');
            $time_id = $this->input->post('time_id');

            $input2 = array();
            $input2['where']['area'] = $this->input->post('area');
            $vn_city_arr = $this->vn_city_model->get_list($input2);
            $i = 0;
            $dcm = array();
            foreach ($vn_city_arr as $value) {
                $i++;
                $dcm[] = $value->id;
            }
            $dcm_tr = implode(',', $dcm);
//                pre($vn_city_arr);
//                $abc =
//                pre($dcm_tr);
//            $input['where_in'] = array('province_id', $dcm);

//            if ($userid != '' || $username != '' || $phone != '' || $fullname != '') {
            $contract = $this->contract_model->contract_arr($date11, $date12, $dcm_tr, $parent_id, $time_id);
//             pre($contract);
            $contract_ = array();
            $stt = 0;
            foreach ($contract as $key => $value) {
//                $sv = $this->service_package_user_model->get_info($value->id);
                $stt++;
                $promotion_name = '';
                $promotion = $this->product_gift_model->get_list(array('where' => array('service_package_id' => $value->service_package_id)));
                if ($promotion) {
                    $promotion_name = $promotion[0]->title;
                }
                $contract_[$stt] = new stdClass();
                $contract_[$stt]->id = $value->id;
                $contract_[$stt]->name = $value->name;
                $contract_[$stt]->user_id = $value->user_id;
                $contract_[$stt]->fullname = $value->fullname;
                $contract_[$stt]->address = $value->address;
                $contract_[$stt]->email = $value->email;
                $contract_[$stt]->phone = $value->phone;
                $contract_[$stt]->start_time = $value->start_time;
                $contract_[$stt]->end_time = $value->end_time;
                $contract_[$stt]->price = $value->price;
                $contract_[$stt]->limit_time = $value->limit_time;
                $contract_[$stt]->promotion_name = $promotion_name;
////                }
            }
//            pre($contract_);
//                pre($info_2);
//                lấy thông tin gói dv và thời gian đặt lịch
            $this->data['res'] = $contract_;
//            }
        }
//        pre($contract);
        $this->data['temp'] = 'admin/contract/list';
        $this->load->view('admin/layout', $this->data);
    }
}