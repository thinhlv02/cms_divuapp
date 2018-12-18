<?php

Class Config_payment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('config_payment_model');
        $this->load->model('config_payment_money_model');
        $this->load->model('city_model');
        $city = $this->city_model->get_list();
        $this->data['city'] = $city;
        $money_id = $this->config_payment_money_model->get_list();
        $this->data['money_id'] = $money_id;
//        pre($shop);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');
        $id_money = $area_id = '';
        $shop = $this->config_payment_model->get_payment_info($id_money, $area_id);
//        pre($shop);
        $this->data['res'] = $shop;
//        pre($shop);
        $this->data['temp'] = 'admin/config_payment/list';
//        $this->data['view'] = 'admin/config_payment/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $id_money = $this->input->post('id_money');
            $area_id = $this->input->post('area_id');
            $time = $this->input->post('time');
            $limit = $this->input->post('limit');
            $tyle = $this->input->post('tyle') / 100;
//            pre($created);
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'id_money' => $id_money,
                'area_id' => $area_id,
                'time' => $time,
                'limit' => $limit,
                'tyle' => $tyle
            );

            $check = $this->config_payment_model->get_payment_info($id_money, $area_id);
//            pre($check);
            if (empty($check)) {
                if ($this->config_payment_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/config_payment'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            } else {
                $this->session->set_flashdata('message', 'Luồng tiền: ' . $check[0]->name_money . ' ở khu vực: ' . $check[0]->name_area . ' đã cấu hình, vui lòng kiểm tra lại');
                redirect(base_url('admin/config_payment?id=' . $check[0]->id));
            }
        }
        $this->data['temp'] = 'admin/config_payment/add';
//        $this->data['view'] = 'admin/config_payment/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $shop = $this->config_payment_model->get_info($id);
        if (!$shop) {
            redirect(base_url('admin/config_payment'));
        }

        if ($this->input->post('btnEdit')) {
            $time = $this->input->post('time');
            $data = array(
                'id_money' => $this->input->post('id_money'),
                'area_id' => $this->input->post('area_id'),
                'limit' => $this->input->post('limit'),
                'tyle' => $this->input->post('tyle') / 100,
                'time' => $time,
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            if ($this->config_payment_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/config_payment?id=' . $id));
//                redirect(base_url('admin/config_payment' . '?id=' . $id . '#' . $id));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $shop;
        $this->data['temp'] = 'admin/config_payment/edit';
//        $this->data['view'] = 'admin/config_payment/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $shop = $this->config_payment_model->get_info($id);
        if ($shop) {
            $this->config_payment_model->delete($id);
            unlink('./public/images/shop/' . $shop->img);
        }
        redirect(base_url('admin/config_payment'));
    }
}