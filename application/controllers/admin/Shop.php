<?php

Class Shop extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('shop_model');
        $this->load->model('area_model');
        $shop = $this->area_model->get_list();
        $this->data['area'] = $shop;
//        pre($shop);
        $this->load->model('vn_city_model');
        $city = $this->vn_city_model->get_list(array('order' => array('id', 'asc')));
        $this->data['city'] = $city;
//        pre($shop);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

        $shop = $this->shop_model->get_shop_info();
//        pre($shop);
        $this->data['res'] = $shop;
//        pre($shop);
        $this->data['temp'] = 'admin/shop/list';
//        $this->data['view'] = 'admin/shop/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $city_id = $this->input->post('city_id');
            $city_id_ = explode('|', $city_id);
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'name' => $name,
                'address' => $address,
                'city' => $city_id_[0]
            );
            if ($this->shop_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/shop'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/shop/add';
//        $this->data['view'] = 'admin/shop/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $shop = $this->shop_model->get_info($id);
        if (!$shop) {
            redirect(base_url('admin/shop'));
        }

        if ($this->input->post('btnEdit')) {
            $city_id = $this->input->post('city_id');
            $city_id_ = explode('|', $city_id);
            $data = array(
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'city' => $city_id_[0]
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->shop_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/shop'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $shop;
        $this->data['temp'] = 'admin/shop/edit';
//        $this->data['view'] = 'admin/shop/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $shop = $this->shop_model->get_info($id);
        if ($shop) {
            $this->shop_model->delete($id);
            unlink('./public/images/shop/' . $shop->img);
        }
        redirect(base_url('admin/shop'));
    }
}