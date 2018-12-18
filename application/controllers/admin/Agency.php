<?php

Class Agency extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('agency_model');
        $this->load->model('area_model');
        $agency = $this->area_model->get_list();
        $this->data['area'] = $agency;
//        pre($agency);
        $this->load->model('vn_city_model');
        $city = $this->vn_city_model->get_list(array('order' => array('id', 'asc')));
        $this->data['city'] = $city;
//        pre($city);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

        $agency = $this->agency_model->get_area();
        $this->data['res'] = $agency;
        //pre($agency);
        $this->data['temp'] = 'admin/agency/list';
//        $this->data['view'] = 'admin/agency/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $agency_name = $this->input->post('agency_name');
            $phone = $this->input->post('phone');
            $city_id = $this->input->post('city_id');
            $city_id_ = explode('|', $city_id);
            $created = new DateTime();
            $created = $created->getTimestamp();
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'name' => $agency_name,
                'phone' => $phone,
                'city' => $city_id_[0],
                'area' => $city_id_[1],
                'created' => $created
            );
            if ($this->agency_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/agency'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/agency/add';
//        $this->data['view'] = 'admin/agency/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $agency = $this->agency_model->get_info($id);
        if (!$agency) {
            redirect(base_url('admin/agency'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $city_id = $this->input->post('city_id');
            $city_id_ = explode('|', $city_id);
            $data = array(
                'name' => $this->input->post('agency_name'),
                'phone' => $this->input->post('phone'),
                'city' => $city_id_[0],
                'area' => $city_id_[1],
                'created' => $created->getTimestamp()
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->agency_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/agency'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $agency;
        $this->data['temp'] = 'admin/agency/edit';
//        $this->data['view'] = 'admin/agency/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $agency = $this->agency_model->get_info($id);
        if ($agency) {
            $this->agency_model->delete($id);
            unlink('./public/images/agency/' . $agency->img);
        }
        redirect(base_url('admin/agency'));
    }
}