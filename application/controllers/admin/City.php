<?php

Class City extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('city_model');
        $this->load->model('area_model');
        $agency = $this->area_model->get_list();
        $this->data['area'] = $agency;
//        pre($agency);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

        $city = $this->city_model->get_list_city();
        $this->data['res'] = $city;
//        pre($city);
        $this->data['temp'] = 'admin/city/list';
//        $this->data['view'] = 'admin/city/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $name = $this->input->post('city_name');
            $area = $this->input->post('area_id');
            $created = new DateTime();
            $created = $created->getTimestamp();
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'name' => $name,
                'area' => $area,
                'created' => $created
            );
            if ($this->city_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/city'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/city/add';
//        $this->data['view'] = 'admin/city/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $city = $this->city_model->get_info($id);
        if (!$city) {
            redirect(base_url('admin/city'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'name' => $this->input->post('city_name'),
                'area' => $this->input->post('area_id'),
                'created' => $created->getTimestamp()
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->city_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/city'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $city;
        $this->data['temp'] = 'admin/city/edit';
//        $this->data['view'] = 'admin/city/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $city = $this->city_model->get_info($id);
        if ($city) {
            $this->city_model->delete($id);
            unlink('./public/images/city/' . $city->img);
        }
        redirect(base_url('admin/city'));
    }
}