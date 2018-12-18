<?php

Class Notifications extends MY_Controller
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
        $input =$input2= array();
        $input['where']['type'] = 1;
        $input2['where']['type'] = 8;
        $input['order'] = array('id', 'desc');
        $input2['order'] = array('id', 'desc');

        $notifications = $this->information_model->get_list($input);
        $notifications2 = $this->information_model->get_list($input2);
        $this->data['res'] = $notifications;
        $this->data['res2'] = $notifications2;
//        pre($notifications);
        $this->data['temp'] = 'admin/notifications/list';
//        $this->data['view'] = 'admin/notifications/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $type = $this->input->post('type');
            $title = $this->input->post('txtName');
            $intro = $this->input->post('intro');
            $content = $this->input->post('txtContent');
            $created = new DateTime();
            $created = $created->getTimestamp();
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'title' => $title,
                'intro' => $intro,
                'content' => $content,
                'created' => $created,
                'type' => $type
            );
            $config['upload_path'] = './public/images/information';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_product')) {
                $file_data = $this->upload->data();
                $data['img'] = link_notifications('/'). $file_data['file_name'];
            }
            if ($this->information_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/notifications'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/notifications/add';
//        $this->data['view'] = 'admin/notifications/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $notifications = $this->information_model->get_info($id);
//        pre($notifications);
        if (!$notifications) {
            redirect(base_url('admin/notifications'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'title' => $this->input->post('txtName'),
                'intro' => $this->input->post('intro'),
                'content' => $this->input->post('txtContent'),
                'created' => $created->getTimestamp()
            );

            $config['upload_path'] = './public/images/information';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_product')) {
                $file_data = $this->upload->data();
//                $data['img'] = $file_data['file_name'];
                $data['img'] = link_notifications('/'). $file_data['file_name'];
//                'link_icon' => link_icon('/'). $file_data['file_name']
//                unlink('./public/images/product/' . $product->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
//            pre($data);

//            $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;

            if ($this->information_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/notifications'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $notifications;
        $this->data['temp'] = 'admin/notifications/edit';
//        $this->data['view'] = 'admin/notifications/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $notifications = $this->information_model->get_info($id);
        if ($notifications) {
            $this->information_model->delete($id);
            unlink('./public/images/notifications/' . $notifications->img);
        }
        redirect(base_url('admin/notifications'));
    }
}