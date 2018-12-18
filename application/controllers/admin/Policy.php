<?php

Class Policy extends MY_Controller
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
        $input2 = array();
        $input['where']['type'] = 4;
        $input2['where']['type'] = 6;
        $input['order'] = array('id', 'desc');

        $policy = $this->information_model->get_list($input);
        $policy_ktv = $this->information_model->get_list($input2);
        $dk_apdung = $this->information_model->get_list(array('where' => array('type' => 9)));
        $cach_tinh_phi = $this->information_model->get_list(array('where' => array('type' => 10)));
//        pre($policy_ktv);
        $this->data['res'] = $policy;
        $this->data['res2'] = $policy_ktv;
        $this->data['dk_apdung'] = $dk_apdung;
        $this->data['cach_tinh_phi'] = $cach_tinh_phi;
//        pre($policy);
        $this->data['temp'] = 'admin/policy/list';
//        $this->data['view'] = 'admin/policy/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $content = $this->input->post('txtContent');
            $type = $this->input->post('type');
            $created = new DateTime();
            $created = $created->getTimestamp();
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'content' => $content,
                'created' => $created,
                'type' => $type
            );
            if ($this->information_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/policy'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/policy/add';
//        $this->data['view'] = 'admin/policy/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $policy = $this->information_model->get_info($id);
        if (!$policy) {
            redirect(base_url('admin/policy'));
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
                redirect(base_url('admin/policy?asset_id=' . $id . '#' . $id));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $policy;
        $this->data['temp'] = 'admin/policy/edit';
//        $this->data['view'] = 'admin/policy/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $policy = $this->information_model->get_info($id);
        if ($policy) {
            $this->information_model->delete($id);
            unlink('./public/images/policy/' . $policy->img);
        }
        redirect(base_url('admin/policy'));
    }
}