<?php

Class Menu extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('area_model');
        $menu = $this->area_model->get_list();
        $this->data['area'] = $menu;
//        pre($menu);
        $this->load->model('vn_city_model');
        $city = $this->vn_city_model->get_list(array('order' => array('id', 'asc')));
        $this->data['city'] = $city;
//        pre($menu);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

        $menu = $this->menu_model->get_list(array('order' => array('id', 'asc')));
//        pre($menu);
        $this->data['res'] = $menu;
//        pre($menu);
        $this->data['temp'] = 'admin/menu/list';
//        $this->data['view'] = 'admin/menu/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $name = $this->input->post('name');
//            pre($created);
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'name' => $name,
            );
            $insert = $this->menu_model->create($data);
            if ($insert > 0) {
//                thêm các menu vào menu_acces
                $menu_access = $this->menu_access_model->get_list(array('group_by' => array('employee_id')));
                foreach ($menu_access as $key => $value) {
                    $this->menu_access_model->create(array('employee_id' => $value->employee_id, 'menu_id' => $insert));
                }
//                pre($menu_access);
//                thêm các menu vào menu_acces
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/menu'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/menu/add';
//        $this->data['view'] = 'admin/menu/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $menu = $this->menu_model->get_info($id);
        if (!$menu) {
            redirect(base_url('admin/menu'));
        }

        if ($this->input->post('btnEdit')) {
            $data = array(
                'name' => $this->input->post('name')
            );
//            pre($data);
//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->menu_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/menu'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $menu;
        $this->data['temp'] = 'admin/menu/edit';
//        $this->data['view'] = 'admin/menu/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $menu = $this->menu_model->get_info($id);
        if ($menu) {
            $this->menu_model->delete($id);
            $this->menu_access_model->del_rule(array('menu_id' => $id));
        }
        redirect(base_url('admin/menu'));
    }
}