<?php

Class Reward_point extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('reward_point_model');
        $this->load->model('config_server_model');
        $this->load->model('area_model');
        $area = $this->area_model->get_list();
        $this->data['area'] = $area;
//        pre($reward_point);
        $this->load->model('city_model');
        $city = $this->city_model->get_list();
        $this->data['city'] = $city;
//        pre($reward_point);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

        $reward_point = $this->reward_point_model->get_reward_point_info();
        $config_server = $this->config_server_model->get_list();
//        pre($reward_point);
        $this->data['res'] = $reward_point;
        $this->data['config_server'] = $config_server;
//        pre($config_server);
        $this->data['temp'] = 'admin/reward_point/list';
//        $this->data['view'] = 'admin/reward_point/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $action = $this->input->post('action');
            $unit = $this->input->post('unit');
            $point = $this->input->post('point');
            $city_id = $this->input->post('city_id');
            $city_id_ = explode('|', $city_id);
//            pre($created);
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'action' => $action,
                'unit' => $unit,
                'point' => $point,
                'city' => $city_id_[0]
            );
            if ($this->reward_point_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/reward_point'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/reward_point/add';
//        $this->data['view'] = 'admin/reward_point/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $reward_point = $this->reward_point_model->get_info($id);
        if (!$reward_point) {
            redirect(base_url('admin/reward_point'));
        }

        if ($this->input->post('btnEdit')) {
            $city_id = $this->input->post('city_id');
            $city_id_ = explode('|', $city_id);
            $data = array(
                'action' => $this->input->post('action'),
                'unit' => $this->input->post('unit'),
                'point' => $this->input->post('point'),
                'city' => $city_id_[0]
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->reward_point_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/reward_point'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $reward_point;
        $this->data['temp'] = 'admin/reward_point/edit';
//        $this->data['view'] = 'admin/reward_point/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $reward_point = $this->reward_point_model->get_info($id);
        if ($reward_point) {
            $this->reward_point_model->delete($id);
            unlink('./public/images/reward_point/' . $reward_point->img);
        }
        redirect(base_url('admin/reward_point'));
    }
}