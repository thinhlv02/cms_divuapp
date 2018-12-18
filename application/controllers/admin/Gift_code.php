<?php

Class Gift_code extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('gift_code_model');
        $this->load->model('service_package_model');
        $this->load->model('service_package_user_model');
        $this->load->model('agency_model');
        $this->load->model('admin_model');
        $this->load->model('vn_city_model');
        $this->load->model('vn_district_model');
        $this->load->model('vn_ward_model');
        $this->load->model('admin_model');
        $this->load->model('user_model');

        $service_package = $this->service_package_model->get_list(array('where_in' => array('parent_id', array('1','2','3','4')),'order' => array('id', 'asc')));
        $agency = $this->agency_model->get_list(array('order' => array('id', 'asc')));
        $this->data['service_package'] = $service_package;
        $this->data['agency'] = $agency;

        $create_by = $this->admin_model->get_list(array('where_in' => array('level', array('5'))));
        $this->data['create_by'] = $create_by;

//        pre($service_package);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post('btnAdd')) {
            $type = $this->input->post('type');
            $service_package_id = $this->input->post('service_package_id');
            $agent = $this->input->post('agent');
            $create_by = $this->input->post('create_by');
            $code = $this->input->post('code');
            $use_by = $this->input->post('use_by');
            $input = array();
            if ($type != 'all') {
                $input['where']['type'] = $type;
            }
            if ($service_package_id != 'all') {
                $input['where']['service_package_id'] = $service_package_id;
            }
            if ($agent != 'all') {
                $input['where']['agent'] = $agent;
            }

            if ($create_by != 'all') {
                $input['where']['create_by'] = $create_by;
            }

            if ($code != '') {
                $input['where']['code'] = $code;
            }

            if ($use_by != 'all') {
                $null = null;
                if ($use_by == 1) {
                    $input['where']['use_by is not null'] = $null;
                } else {
                    $input['where']['use_by is null'] = $null;
                }
            }

//            pre($input);

            $res = $this->gift_code_model->get_list($input);
            $res_arr = array();
            $index = 0;
            foreach ($res as $key => $value) {
                $index++;
                if ($value->type == 1) {
                    $type = 'Cộng tiền DIV';
                } else {
                    $type = 'Gói Dịch vụ';
                }
                $sv_pk_name = '';
                if ($value->service_package_id != '') {
                    $sv_pk = $this->service_package_model->get_info($value->service_package_id);
                    $sv_pk_name = $sv_pk->name;
                }
                 $gift_code_address = '';
                if ($value->service_package_user_id != 0) {
                    $gift_code_address = $this->service_package_user_model->get_info($value->service_package_user_id);
                    $gift_code_address = $gift_code_address->address;
                }
                $area_name = '';
                if ($value->area_id != '') {
                    $area = explode('_', $value->area_id);
                    if (isset($area[0])) {
                        $vn_city = $this->vn_city_model->get_info($area[0]);
                        $area_name .= $vn_city->name;
                    }
                    if (isset($area[1])) {
                        $vn_district = $this->vn_district_model->get_info($area[1]);
                        $area_name .= '_' . $vn_district->name;
                    }
                    if (isset($area[2])) {
                        $vn_ward = $this->vn_ward_model->get_info($area[2]);
                        $area_name .= '_' . $vn_ward->name;
                    }
                }
                $use_by_name = '';
                $agency = $this->agency_model->get_info($value->agent);
                $ad = $this->admin_model->get_info($value->create_by);
                if ($value->use_by != '') {
                    $user = $this->user_model->get_info($value->use_by);
                    $use_by_name = $user->fullname;
                }
                $res_arr[$index] = new stdClass();
                $res_arr[$index]->id = $value->id;
                $res_arr[$index]->code = $value->code;
                $res_arr[$index]->type = $type;
                $res_arr[$index]->div = $value->div;
                $res_arr[$index]->service_package_user_id = $gift_code_address;
                $res_arr[$index]->service_package_id = $sv_pk_name;
                $res_arr[$index]->agent = $agency->name;
                $res_arr[$index]->expire_date = $value->expire_date;
                $res_arr[$index]->use_by = $use_by_name;
                $res_arr[$index]->create_time = $value->create_time;
                $res_arr[$index]->create_by = $ad->username;
                $res_arr[$index]->area_id = $area_name;
            }
       // pre($res_arr);
            $this->data['res'] = $res_arr;
            

        }

        $this->data['temp'] = 'admin/gift_code/list';
//        $this->data['view'] = 'admin/gift_code/add';
        $this->load->view('admin/layout', $this->data);

    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $number_code = $this->input->post('number_code');
            $div = $this->input->post('div');
            $type = $this->input->post('type');
            $agent = $this->input->post('agent');
            $service_package_id = $this->input->post('service_package_id');
            $expire_date = date('Y-m-d', strtotime($this->input->post('expire_date')));
            $vn_city = $this->input->post('vn_city');
            $vn_district = $this->input->post('vn_district');
            $vn_ward = $this->input->post('vn_ward');
            $area_id = '';
            if ($vn_city != 'all' && $vn_district == 'all' && $vn_ward == 'all') {
                $area_id = $vn_city;
            }
            if ($vn_city != 'all' && $vn_district != 'all' && $vn_ward == 'all') {
                $area_id = $vn_city . '_' . $vn_district;
            }

            if ($vn_city != 'all' && $vn_district != 'all' && $vn_ward != 'all') {
                $area_id = $vn_city . '_' . $vn_district . '_' . $vn_ward;
            }

            function generateRandomString($length = 7)
            {
                return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
            }

            $giftcode = array();
            $prefix = '';
            $prefix_check = $this->gift_code_model->get_list(array('order' => array('id', 'desc'), 'limit' => array('1', '0')));
            if ($prefix_check) {
                $prefix = $prefix_check[0]->id + 1;
            }
//            pre($prefix);
            for ($i = 0; $i < $number_code; $i++) {
                $giftcode[$i] = new stdClass();
                $giftcode[$i]->code = $prefix . generateRandomString();

//            echo generateRandomString() . '<br/>';  // OR: generateRandomString(24)
            }
            $admin = $this->session->userdata('admin');
            $data = array(
                'div ' => $div,
                'type' => $type,
                'service_package_id' => $service_package_id,
                'agent' => $agent,
                'expire_date' => $expire_date,
                'create_by' => $admin->id,
                'area_id' => $area_id,
            );
            foreach ($giftcode as $k => $v) {
                $data['code'] = $v->code;
                $this->gift_code_model->create($data);
            }
//            pre($giftcode);

//                pre($data_update);
//                if ($this->gift_code_model->create($data_log)) {
//                    $this->session->set_flashdata('message', 'Cập nhật thành công');
            //        $this->data['view'] = 'admin/gift_code/add';
            redirect(base_url('admin/gift_code'));
//                redirect(base_url('admin/gift_code' . '?id=' . $id . '#' . $id));
//                } else {
//                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
//                }
        }
        $this->data['temp'] = 'admin/gift_code/add';
//        $this->data['view'] = 'admin/gift_code/add';
        $this->load->view('admin/layout', $this->data);
    }
}