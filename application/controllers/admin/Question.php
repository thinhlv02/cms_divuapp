<?php

Class Question extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('question_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = $input2 = array();
        $input['order'] = array('id', 'desc');
        $input2['where']['parent_id'] = 0;

//        $banner = $this->question_model->get_list($input);
//        $banner = $this->question_model->get_banner_type('all', 'all','all','all');
        $banner = $this->question_model->get_list();
//        pre($banner_packgage);
        $this->data['res'] = $banner;
//        pre($banner);
        $this->data['temp'] = 'admin/question/list';
//        $this->data['view'] = 'admin/question/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $question = $this->input->post('question');
            $answer = trim($this->input->post('answer'));
            $data = array(
                'question' => $question,
                'answer' => $answer
            );
            if ($this->question_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/question'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }
        $this->data['temp'] = 'admin/question/add';
//        $this->data['view'] = 'admin/question/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $banner = $this->question_model->get_info($id);
//        pre($banner);
        if (!$banner) {
            redirect(base_url('admin/question'));
        }
        if ($this->input->post('btnEdit')) {
            $data = array(
                'question' => $this->input->post('question'),
                'answer' => trim($this->input->post('answer')),
            );
//            pre($data);

            if ($this->question_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/question'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $banner;
        $this->data['temp'] = 'admin/question/edit';
//        $this->data['view'] = 'admin/question/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $banner = $this->question_model->get_info($id);
        if ($banner) {
            $this->question_model->delete($id);
            unlink('./public/images/banner/' . $banner->img);
        }
        redirect(base_url('admin/question'));
    }
}