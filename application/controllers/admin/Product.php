<?php

Class Product extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');

        //        pre($agency);
        $this->load->model('shop_model');
        $shop = $this->shop_model->get_list();
        $this->data['shop'] = $shop;
//        pre($agency);

        $this->load->model('product_type_model');
        $product_type = $this->product_type_model->get_list();
        $this->data['product_type'] = $product_type;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('id', 'desc');

//        $product = $this->product_model->get_list($input);
        $product = $this->product_model->get_product_type('all', 'all','all','all');
        $this->data['res'] = $product;
//        pre($product);
        $this->data['temp'] = 'admin/product/list';
//        $this->data['view'] = 'admin/product/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $name = $this->input->post('txtName');
            $shop_id = $this->input->post('shop_id');
            $descriptions = $this->input->post('txtContent');
            $price = $this->input->post('price');
            $type = $this->input->post('type');
            $number = $this->input->post('number');
            $unit = $this->input->post('unit');
            $sale = $this->input->post('sale')/100;
            $created = new DateTime();
            $created = $created->getTimestamp();

            $config['upload_path'] = './public/images/product';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_product')) {
                $file_data = $this->upload->data();
//                pre($file_data);
                $data = array(
                    'name' => $name,
                    'shop' => $shop_id,
                    'type' => $type,
                    'price' => $price,
                    'descriptions' => $descriptions,
                    'number' => $number,
                    'unit' => $unit,
                    'sale' => $sale,
                    'created' => $created,
//                    'img' => $file_data['file_name']
                    'link_icon' => link_icon('/'). $file_data['file_name']
                );
                if ($this->product_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/product'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            } else {
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
                $data = array(
                    'name' => $name,
                    'shop' => $shop_id,
                    'type' => $type,
                    'price' => $price,
                    'number' => $number,
                    'unit' => $unit,
                    'sale' => $sale,
                    'descriptions' => $descriptions,
                    'created' => $created
                );
                if ($this->product_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/product'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/product/add';
//        $this->data['view'] = 'admin/product/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $product = $this->product_model->get_info($id);
//        pre($product);
        if (!$product) {
            redirect(base_url('admin/product'));
        }
        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'name' => $this->input->post('txtName'),
                'shop' => $this->input->post('shop_id'),
                'type' => $this->input->post('type'),
                'number' => $this->input->post('number'),
                'unit' => $this->input->post('unit'),
                'sale' => $this->input->post('sale')/100,
                'descriptions' =>$this->input->post('txtContent'),
                'price' => $this->input->post('price'),
                'created' => $created->getTimestamp()
            );
//            pre($data);

            $config['upload_path'] = './public/images/product';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_product')) {
                $file_data = $this->upload->data();
//                $data['img'] = $file_data['file_name'];
                $data['link_icon'] = link_icon('/'). $file_data['file_name'];
//                'link_icon' => link_icon('/'). $file_data['file_name']
//                unlink('./public/images/product/' . $product->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->product_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/product'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $product;
        $this->data['temp'] = 'admin/product/edit';
//        $this->data['view'] = 'admin/product/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $product = $this->product_model->get_info($id);
        if ($product) {
            $this->product_model->delete($id);
            unlink('./public/images/product/' . $product->img);
        }
        redirect(base_url('admin/product'));
    }
}