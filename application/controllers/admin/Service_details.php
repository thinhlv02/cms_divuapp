<?php

Class Service_details extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('service_details_model');

        //        pre($agency);
        $this->load->model('service_package_model');
        $service_package = $this->service_package_model->get_list();
        $this->data['service_package'] = $service_package;
//        pre($agency);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('id', 'desc');

//        $service_details = $this->service_details_model->get_list($input);
        $service_details = $this->service_details_model->get_service_type();
        $this->data['res'] = $service_details;
//        pre($service_details);
        $this->data['temp'] = 'admin/service_details/list';
//        $this->data['view'] = 'admin/service_details/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $name = $this->input->post('txtName');
            $service_package_id = $this->input->post('service_package_id');
            $descriptions = $this->input->post('txtContent');


            $config['upload_path'] = './public/images/service_info';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_service_details')) {
                $file_data = $this->upload->data();
//                pre($file_data);
                $data = array(
                    'name' => $name,
                    'service_package_id' => $service_package_id,
                    'des' => $descriptions,
//                    'img' => $file_data['file_name']
                    'link_icon' => link_icon_service('/'). $file_data['file_name']
                );
//                pre($data);
                if ($this->service_details_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/service_details'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            } else {
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
                $data = array(
                    'name' => $name,
                    'service_package_id' => $service_package_id,
                    'des' => $descriptions
                );
                if ($this->service_details_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/service_details'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/service_details/add';
//        $this->data['view'] = 'admin/service_details/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $service_details = $this->service_details_model->get_info($id);
//        pre($service_details);
        if (!$service_details) {
            redirect(base_url('admin/service_details'));
        }
        if ($this->input->post('btnEdit')) {
            $data = array(
                'name' => $this->input->post('txtName'),
                'service_package_id' => $this->input->post('service_package_id'),
                'des' =>$this->input->post('txtContent')
            );
//            pre($data);

            $config['upload_path'] = './public/images/service_info';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_service_details')) {
                $file_data = $this->upload->data();
//                $data['img'] = $file_data['file_name'];
                $data['link_icon'] = link_icon_service('/'). $file_data['file_name'];
//                'link_icon' => link_icon('/'). $file_data['file_name']
//                unlink('./public/images/service_details/' . $service_details->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->service_details_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/service_details'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $service_details;
        $this->data['temp'] = 'admin/service_details/edit';
//        $this->data['view'] = 'admin/service_details/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $service_details = $this->service_details_model->get_info($id);
        if ($service_details) {
            $this->service_details_model->delete($id);
            unlink('./public/images/service_info/' . $service_details->img);
        }
        redirect(base_url('admin/service_details'));
    }
}