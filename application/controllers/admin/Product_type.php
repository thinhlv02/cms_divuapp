<?php

Class Product_type extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_type_model');
        $this->load->model('area_model');
        $product_type = $this->area_model->get_list();
        $this->data['area'] = $product_type;
//        pre($product_type);
        $this->load->model('city_model');
        $city = $this->city_model->get_list();
        $this->data['city'] = $city;
//        pre($product_type);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

        $product_type = $this->product_type_model->get_list();
        $this->data['res'] = $product_type;
//        pre($product_type);
        $this->data['temp'] = 'admin/product_type/list';
//        $this->data['view'] = 'admin/product_type/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $name = $this->input->post('txtname');


//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'name' => $name
            );
            if ($this->product_type_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/product_type'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/product_type/add';
//        $this->data['view'] = 'admin/product_type/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $product_type = $this->product_type_model->get_info($id);
        if (!$product_type) {
            redirect(base_url('admin/product_type'));
        }

        if ($this->input->post('btnEdit')) {
            $data = array(
                'name' => $this->input->post('txtname')
            );
//            pre($data);
//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            if ($this->product_type_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/product_type'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $product_type;
        $this->data['temp'] = 'admin/product_type/edit';
//        $this->data['view'] = 'admin/product_type/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $product_type = $this->product_type_model->get_info($id);
        if ($product_type) {
            $this->product_type_model->delete($id);
            unlink('./public/images/product_type/' . $product_type->img);
        }
        redirect(base_url('admin/product_type'));
    }
}