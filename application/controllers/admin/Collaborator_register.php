<?php

Class Collaborator_register extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('collaborator_register_model');
        $this->load->model('area_model');
        $this->load->model('vn_city_model');
        $agency = $this->area_model->get_list();
        $this->data['area'] = $agency;
//        pre($agency);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');
        if ($this->input->post('search')) {
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
            $input['where'][' date(created_at) >= ' ] = $date1;
            $input['where'][' date(created_at) <= ' ] = $date2;
            if ($this->input->post('status') != 'all'){
                $input['where']['status' ] = $this->input->post('status');
            }
        }
        $user = $this->collaborator_register_model->get_list($input);
        $user_ = array();
        $index = 0;
        foreach ($user as $key => $value) {
            $index++;
//            1: gửi yêu cầu, 2: đồng ý, 3: không đồng ý
            switch ($value->status) {
                case "1":
                    $status =  "gửi yêu cầu";
                    break;
                case "2":
                    $status =  "đồng ý";
                    break;
                case "3":
                    $status =  "không đồng ý";
                    break;
                default:
                    echo "Your favorite color is neither red, blue, nor green!";
            }

            $user_[$index] = new stdClass();
            $user_[$index] ->id = $value->id;
            $user_[$index] ->user_id  = $value->user_id;
            $user_[$index] ->fullname  = $value->fullname;
            $user_[$index] ->address  = $value->address;
            $user_[$index] ->created_at  = $value->created_at;
            $user_[$index] ->phone  = $value->phone;
            $user_[$index] ->status  = $status;
        }
//        pre($user_);
        $this->data['res'] = $user_;
//        pre($user);
        $this->data['temp'] = 'admin/collaborator_register/list';
//        $this->data['view'] = 'admin/collaborator_register/list';
        $this->load->view('admin/layout', $this->data);
    }
}