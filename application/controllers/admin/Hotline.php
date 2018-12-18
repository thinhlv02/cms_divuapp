<?php

Class Hotline extends MY_Controller
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
        $input = array();
        $input['where']['type'] = 5;
        $input['order'] = array('id', 'desc');

        $hotline = $this->information_model->get_list($input);
        $this->data['res'] = $hotline;
//        pre($hotline);
        $this->data['temp'] = 'admin/hotline/list';
//        $this->data['view'] = 'admin/hotline/list';
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
                'content' => trim($content),
                'created' => $created,
                'type' => 5
            );
            if ($this->information_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/hotline'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/hotline/add';
//        $this->data['view'] = 'admin/hotline/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $hotline = $this->information_model->get_info($id);
        if (!$hotline) {
            redirect(base_url('admin/hotline'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'content' => trim($this->input->post('txtContent')),
                'created' => $created->getTimestamp()
            );
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->information_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/hotline'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $hotline;
        $this->data['temp'] = 'admin/hotline/edit';
//        $this->data['view'] = 'admin/hotline/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $hotline = $this->information_model->get_info($id);
        if ($hotline) {
            $this->information_model->delete($id);
            unlink('./public/images/hotline/' . $hotline->img);
        }
        redirect(base_url('admin/hotline'));
    }
}