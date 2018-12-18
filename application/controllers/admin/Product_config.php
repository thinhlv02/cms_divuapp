<?php

Class Product_config extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('area_model');
        $this->load->model('city_model');

        //        pre($agency);
        $this->load->model('shop_model');
        $shop = $this->shop_model->get_list();
        $this->data['shop'] = $shop;
//        pre($agency);

        $this->load->model('product_type_model');
        $product_type = $this->product_type_model->get_list();
        $this->data['product_type'] = $product_type;

        $area = $this->area_model->get_list();
        $this->data['area'] = $area;

        $city = $this->city_model->get_list();
        $this->data['city'] = $city;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('id', 'desc');

        $product_type = 'all';
        $area = 'all';
        $city = 'all';
        $assettype = 'all';
        $asset_status = 'all';
        $search = 'all';

        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $product_type = $this->input->post('product_type');
            $area = $this->input->post('area');
            $city = $this->input->post('city');
//            pre($date1);

            $product = $this->product_model->get_product_type($search,$product_type,$area,$city);
////            pre($asset);
        } //        $asset = $this->asset_model->get_list();
        else {
            $product = $this->product_model->get_product_type($search,$product_type,$area,$city);
        }

//        $product = $this->product_model->get_list($input);
//        $product = $this->product_model->get_product_type();
        $this->data['res'] = $product;
//        pre($product);
        $this->data['temp'] = 'admin/product_config/list';
//        $this->data['view'] = 'admin/product_config/list';
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
                    'sale' => $sale,
                    'created' => $created,
//                    'img' => $file_data['file_name']
                    'link_icon' => link_icon('/'). $file_data['file_name']
                );
                if ($this->product_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/product_config'));
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
                    'sale' => $sale,
                    'descriptions' => $descriptions,
                    'created' => $created
                );
                if ($this->product_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/product_config'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/product_config/add';
//        $this->data['view'] = 'admin/product_config/add';
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
            redirect(base_url('admin/product_config'));
        }
        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'name' => $this->input->post('txtName'),
                'shop' => $this->input->post('shop_id'),
                'type' => $this->input->post('type'),
                'number' => $this->input->post('number'),
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
                redirect(base_url('admin/product_config'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $product;
        $this->data['temp'] = 'admin/product_config/edit';
//        $this->data['view'] = 'admin/product_config/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function details()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $product = $this->product_model->get_info($id);
//        pre($product);
        if (!$product) {
            redirect(base_url('admin/product_config'));
        }

        $this->data['res'] = $product;
        $this->data['temp'] = 'admin/product_config/details';
//        $this->data['view'] = 'admin/product_config/edit';
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
        redirect(base_url('admin/product_config'));
    }
}