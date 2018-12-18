<?php

Class Info_service extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('banner_model');
        $this->load->model('information_model');
        $this->load->model('service_package_model');
        $input2 = array();
        $input2['where']['parent_id'] = 0;

//        $banner = $this->banner_model->get_list($input);
//        $banner = $this->banner_model->get_banner_type('all', 'all','all','all');
        $banner_packgage = $this->service_package_model->get_list($input2);
        $this->data['banner_packgage'] = $banner_packgage;
//        pre($banner_packgage);
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input =$input2= array();
        $input['where']['type'] = 3;
        $input['order'] = array('id', 'desc');
        $input2['where']['parent_id'] = 0;


        $banner_packgage = $this->service_package_model->get_list($input2);
        $this->data['res2'] = $banner_packgage;

//        $info_service = $this->information_model->get_list($input);
        $info_service = $this->information_model->get_info3($input);
        $this->data['info_service'] = $info_service;
//        pre($info_service);
        $this->data['temp'] = 'admin/info_service/list';
//        $this->data['view'] = 'admin/info_service/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $content = $this->input->post('txtContent');
            $service_package_id = $this->input->post('service_package_id');
            $created = new DateTime();
            $created = $created->getTimestamp();
//            pre($created);

//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
            $data = array(
                'content' => $content,
                'created' => $created,
                'service_package_id' => $service_package_id,
                'type' => 3
            );
            if ($this->information_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm thành công');
                redirect(base_url('admin/info_service'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }

        }
        $this->data['temp'] = 'admin/info_service/add';
//        $this->data['view'] = 'admin/info_service/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $info_service = $this->information_model->get_info($id);
        if (!$info_service) {
            redirect(base_url('admin/info_service'));
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
                redirect(base_url('admin/info_service'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['info_service'] = $info_service;
        $this->data['temp'] = 'admin/info_service/edit';
//        $this->data['view'] = 'admin/info_service/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function edit_package()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $banner = $this->service_package_model->get_info($id);
//        pre($banner);
        if (!$banner) {
            redirect(base_url('admin/banner'));
        }
        if ($this->input->post('btnEdit')) {
            $data = array(
                'name' => $this->input->post('name'),
                'des' =>$this->input->post('descriptions')
            );
//            pre($data);

            $config['upload_path'] = './public/images/banner';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_banner')) {
                $file_data = $this->upload->data();
//                $data['img'] = $file_data['file_name'];
                $data['icon'] = link_banner('/'). $file_data['file_name'];
//                'link_banner' => link_banner('/'). $file_data['file_name']
//                unlink('./public/images/banner/' . $banner->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->service_package_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/info_service'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $banner;
        $this->data['temp'] = 'admin/info_service/edit_package';
//        $this->data['view'] = 'admin/banner/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $info_service = $this->information_model->get_info($id);
        if ($info_service) {
            $this->information_model->delete($id);
            unlink('./public/images/info_service/' . $info_service->img);
        }
        redirect(base_url('admin/info_service'));
    }
}