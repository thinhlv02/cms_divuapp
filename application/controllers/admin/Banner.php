<?php

Class Banner extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('banner_model');
        $this->load->model('service_package_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = $input2 = array();
        $input['order'] = array('id', 'desc');
        $input2['where']['parent_id'] = 0;

//        $banner = $this->banner_model->get_list($input);
//        $banner = $this->banner_model->get_banner_type('all', 'all','all','all');
        $banner = $this->banner_model->get_list();
        $banner_packgage = $this->service_package_model->get_list($input2);
//        pre($banner_packgage);
        $this->data['res'] = $banner;
        $this->data['res2'] = $banner_packgage;
//        pre($banner);
        $this->data['temp'] = 'admin/banner/list';
//        $this->data['view'] = 'admin/banner/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $route = $this->input->post('route');
            $name = $this->input->post('name');
            $descriptions = $this->input->post('descriptions');

            $config['upload_path'] = './public/images/banner';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_banner')) {
                $file_data = $this->upload->data();
//                pre($file_data);
                $data = array(
                    'route' => $route,
                    'name' => $name,
                    'description' => $descriptions,
                    'img' => link_banner('/'). $file_data['file_name']
                );
                if ($this->banner_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/banner'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            } else {
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
                $data = array(
                    'route' => $route,
                    'name' => $name,
                    'description' => $descriptions,
                );
                if ($this->banner_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/banner'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/banner/add';
//        $this->data['view'] = 'admin/banner/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $banner = $this->banner_model->get_info($id);
//        pre($banner);
        if (!$banner) {
            redirect(base_url('admin/banner'));
        }
        if ($this->input->post('btnEdit')) {
            $data = array(
                'name' => $this->input->post('name'),
                'route' => $this->input->post('route'),
                'description' =>$this->input->post('descriptions')
            );
//            pre($data);

            $config['upload_path'] = './public/images/banner';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_banner')) {
                $file_data = $this->upload->data();
//                $data['img'] = $file_data['file_name'];
                $data['img'] = link_banner('/'). $file_data['file_name'];
//                'link_banner' => link_banner('/'). $file_data['file_name']
//                unlink('./public/images/banner/' . $banner->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->banner_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/banner'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $banner;
        $this->data['temp'] = 'admin/banner/edit';
//        $this->data['view'] = 'admin/banner/edit';
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
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->service_package_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/banner'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $banner;
        $this->data['temp'] = 'admin/banner/edit_package';
//        $this->data['view'] = 'admin/banner/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $banner = $this->banner_model->get_info($id);
        if ($banner) {
            $this->banner_model->delete($id);
            unlink('./public/images/banner/' . $banner->img);
        }
        redirect(base_url('admin/banner'));
    }
}