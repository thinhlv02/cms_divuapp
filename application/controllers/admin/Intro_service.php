<?php

Class Intro_service extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('information_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = $input2 = array();
        $input['where']['type'] = 2;
        $input['order'] = array('id', 'desc');

        $intro_service = $this->information_model->get_list($input);
        $this->data['res'] = $intro_service;


//        pre($intro_service);
        $this->data['temp'] = 'admin/intro_service/list';
//        $this->data['view'] = 'admin/intro_service/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $content = $this->input->post('txtContent');
            $created = new DateTime();
            $created = $created->getTimestamp();
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'content' => $content,
                'created' => $created,
                'type' => 2
            );
            if ($this->information_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/intro_service'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/intro_service/add';
//        $this->data['view'] = 'admin/intro_service/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $intro_service = $this->information_model->get_info($id);
        if (!$intro_service) {
            redirect(base_url('admin/intro_service'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'content' => $this->input->post('txtContent'),
                'created' => $created->getTimestamp()
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->information_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/intro_service'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $intro_service;
        $this->data['temp'] = 'admin/intro_service/edit';
//        $this->data['view'] = 'admin/intro_service/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $intro_service = $this->information_model->get_info($id);
        if ($intro_service) {
            $this->information_model->delete($id);
            unlink('./public/images/intro_service/' . $intro_service->img);
        }
        redirect(base_url('admin/intro_service'));
    }
}