<?php

Class Config_service extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('config_service_model');
        $this->load->model('config_service_type_model');
        $this->load->model('city_model');
        $config_list = $this->config_service_type_model->get_list();
        $this->data['config_list'] = $config_list;
        //        pre($agency);
        $this->load->model('city_model');
        $city = $this->city_model->get_list();
        $this->data['city'] = $city;
//        pre($agency);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('id', 'desc');

//        $config_service = $this->config_service_model->get_list($input);
        $config_service = $this->config_service_model->get_config_service_type();
        $this->data['res'] = $config_service;
//        pre($config_service);
        $this->data['temp'] = 'admin/config_service/list';
//        $this->data['view'] = 'admin/config_service/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $name = $this->input->post('txtName');
            $type = $this->input->post('type');
            $time = $this->input->post('time');
            $employee = $this->input->post('employee');
            $city_id = $this->input->post('city_id');
            $money = $this->input->post('money');
            $created = new DateTime();
            $created = $created->getTimestamp();
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
                $data = array(
                    'name' => $name,
                    'type' => $type,
                    'time' => $time,
                    'employee' => $employee,
                    'city' => $city_id,
                    'money' => $money,
                    'created' => $created
                );
                if ($this->config_service_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/config_service'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }

        }
        $this->data['temp'] = 'admin/config_service/add';
//        $this->data['view'] = 'admin/config_service/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $config_service = $this->config_service_model->get_info($id);
        if (!$config_service) {
            redirect(base_url('admin/config_service'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'name' => $this->input->post('txtName'),
                'type' => $this->input->post('type'),
                'time' => $this->input->post('time'),
                'employee' => $this->input->post('employee'),
                'city' => $this->input->post('city_id'),
                'money' => $this->input->post('money'),
                'created' => $created->getTimestamp(),
            );
//            pre($data);

            if ($this->config_service_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/config_service'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $config_service;
        $this->data['temp'] = 'admin/config_service/edit';
//        $this->data['view'] = 'admin/config_service/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $config_service = $this->config_service_model->get_info($id);
        if ($config_service) {
            $this->config_service_model->delete($id);
            unlink('./public/images/config_service/' . $config_service->img);
        }
        redirect(base_url('admin/config_service'));
    }
}