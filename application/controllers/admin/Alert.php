<?php

Class Alert extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('alert_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

        $alert = $this->alert_model->get_list();
        $this->data['res'] = $alert;
//        pre($alert);
        $this->data['temp'] = 'admin/alert/list';
//        $this->data['view'] = 'admin/alert/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $content = $this->input->post('txtContent');
//            $created = new DateTime();
//            $created = $created->getTimestamp();
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'message' => $content,
                'created_at' => date('Y-m-d'),
            );
            if ($this->alert_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/alert'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/alert/add';
//        $this->data['view'] = 'admin/alert/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $alert = $this->alert_model->get_info($id);
        if (!$alert) {
            redirect(base_url('admin/alert'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'message' => $this->input->post('txtContent'),
                'created_at' => date('Y-m-d')
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->alert_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/alert'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $alert;
        $this->data['temp'] = 'admin/alert/edit';
//        $this->data['view'] = 'admin/alert/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $alert = $this->alert_model->get_info($id);
        if ($alert) {
            $this->alert_model->delete($id);
            unlink('./public/images/alert/' . $alert->img);
        }
        redirect(base_url('admin/alert'));
    }
}