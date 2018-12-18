<?php

Class Get_department extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('vn_district_model');
        $this->load->model('vn_ward_model');
    }

    function index()
    {

    }

    function get_vn_district()
    {
        $vn_district = $this->input->post('vn_city');
        $input = array();
        $input['where']['city_id'] = $vn_district;
//        $input_e['where']['role'] = 1;
//        $input_e['where']['id >'] = 116;
//        $input_e['where']['company_id'] = $company_id;
//        $input_e['group_by'] = 'employee_id';
//        pre($input_e);

        $employee = $this->vn_district_model->get_list($input);
//        pre($employee);
//        $this->data['employee'] = $employee;
        $str_district = "<option value= 'all' >Tất cả</option>";
        foreach ($employee as $key => $value) {
//            $employee_name = $this->employee_model->get_info($value->employee_id)->name;
            $str_district = $str_district . "<option value= '" . $value->id . "' >" . $value->name . "</option>";
        }
//          pre($employee);
        $this->session->set_userdata('str_district', $str_district);
//        $vn_district_session = $this->session->userdata('vn_district');
        echo $str_district;
    }

    function get_vn_ward()
    {
        $vn_ward = $this->input->post('district_id');
        $input = array();
        $input['where']['district_id'] = $vn_ward;
//        $input_e['where']['role'] = 1;
//        $input_e['where']['id >'] = 116;
//        $input_e['where']['company_id'] = $company_id;
//        $input_e['group_by'] = 'employee_id';
//        pre($input_e);

        $employee = $this->vn_ward_model->get_list($input);
//        pre($employee);
//        $this->data['employee'] = $employee;
        $str_vn_ward = "<option value= 'all' >Tất cả</option>";
        foreach ($employee as $key => $value) {
//            $employee_name = $this->employee_model->get_info($value->employee_id)->name;
            $str_vn_ward = $str_vn_ward . "<option value= '" . $value->id . "' >" . $value->name . "</option>";
        }
//          pre($employee);
        $this->session->set_userdata('str_vn_ward', $str_vn_ward);
//        $vn_ward_session = $this->session->userdata('vn_ward');
        echo $str_vn_ward;
    }

    function get_vn_district2()
    {
        $vn_district = $this->input->post('vn_city');
        $input = array();
        $input['where']['city_id'] = $vn_district;

        $employee = $this->vn_district_model->get_list($input);
//        pre($employee);
//        $this->data['employee'] = $employee;
//        $str_district = "<option value= 'all' >Tất cả</option>";
        $str_district = '';
        foreach ($employee as $key => $value) {
            $str_district = $str_district . "<option value= '" . $value->id . "' >" . $value->name . "</option>";
        }
//          pre($employee);
        echo $str_district;
    }

    function index_bk()
    {
        $company_id = $this->input->post('x');
        $input_e = array();
//        $input_e['where']['ban'] = 0;
//        $input_e['where']['role'] = 1;
//        $input_e['where']['id >'] = 116;
        $input_e['where']['company_id'] = $company_id;
        $input_e['group_by'] = 'employee_id';
//        pre($input_e);

        $employee = $this->asset_model->get_list($input_e);
//        pre($employee);
        $this->data['employee'] = $employee;
        $str_district = "<option value= 'all' >[Người sử dung/ Q.Lý]</option>";
//        <option value="all">[Người sử dung/ Q.Lý]</option>
        foreach ($employee as $key => $value) {
            $employee_name = $this->employee_model->get_info($value->employee_id)->name;
            $str_district = $str_district . "<option value= '" . $value->employee_id . "' >" . $employee_name . "</option>";
        }
//          pre($employee);
        echo $str_district;
    }

//    function get_vn_district()
    function test()
    {
//        echo 2;
        $city_id = $this->input->post('x');
//        echo 'fuck: '.$city_id;
//        $test = "<option value= 'all' >All</option>";
//        echo $test;
    }
}