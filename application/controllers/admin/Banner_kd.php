<?php

Class Banner_kd extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('banner_kd_model');
        $this->load->model('product_model');
        $product_list = $this->product_model->get_list();
        $this->data['product_list'] = $product_list;

        $this->load->model('service_package_model');
        $service_list = $this->service_package_model->get_list();
        $this->data['service_list'] = $service_list;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['order'] = array('id', 'desc');

//        $banner = $this->banner_kd_model->get_list($input);
//        $banner = $this->banner_kd_model->get_banner_type('all', 'all','all','all');
//        pre('abc');
        $banner = $this->banner_kd_model->get_list();
//        pre($banner);
        $banner_r = array();
        $index = 0;
        foreach ($banner as $key => $value) {
            $index++;
            if ($value->type == 1) {
                $type = 'Vật Tư';
            } else {
                $type = 'Gói DV';
            }
            $product = $service_package_id = '';
            if ($value->product_id != '' && $value->type == 1) {
                $product = $this->product_model->get_info($value->product_id)->name;
            }

            if ($value->service_package_id != 0 && $value->type == 2) {
                $service_package_id = $this->service_package_model->get_info($value->service_package_id)->name;
            }
            $banner_r[$index] = new stdClass();
            $banner_r[$index]->id = $value->id;
            $banner_r[$index]->type = $type;
            $banner_r[$index]->title = $value->title;
            $banner_r[$index]->description = $value->description;
            $banner_r[$index]->link_icon = $value->link_icon;
            $banner_r[$index]->time_event_start = $value->time_event_start;
            $banner_r[$index]->time_event_stop = $value->time_event_stop;
            $banner_r[$index]->number_day_use = $value->number_day_use;
            $banner_r[$index]->product_id = $product;
            $banner_r[$index]->number = $value->number;
            $banner_r[$index]->service_package_id = $service_package_id;
        }
//        pre($banner_r);
        $this->data['res'] = $banner_r;
//        pre($banner);
        $this->data['temp'] = 'admin/banner_kd/list';
//        $this->data['view'] = 'admin/banner_kd/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $type = $this->input->post('type');
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $product_id = $this->input->post('product_id');
            $number = $this->input->post('number');
            $service_package_id = $this->input->post('service_package_id');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));

            $config['upload_path'] = './public/images/banner';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_banner')) {
                $file_data = $this->upload->data();
//                pre($file_data);
                $data = array(
                    'type' => $type,
                    'title' => $title,
                    'description' => $description,
                    'link_icon' => link_banner('/') . $file_data['file_name'],
                    'time_event_start' => $date1,
                    'time_event_stop' => $date2,
                    'product_id' => $product_id,
                    'number' => $number,
                    'service_package_id' => $service_package_id,
                );
                if ($this->banner_kd_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/banner_kd'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            } else {
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
                $data = array(
                    'type' => $type,
                    'title' => $title,
                    'description' => $description,
                    'time_event_start' => $date1,
                    'time_event_stop' => $date2,
                    'product_id' => $product_id,
                    'number' => $number,
                    'service_package_id' => $service_package_id,
                );
                if ($this->banner_kd_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/banner_kd'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/banner_kd/add';
//        $this->data['view'] = 'admin/banner_kd/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $banner = $this->banner_kd_model->get_info($id);
//        pre($banner);
        if (!$banner) {
            redirect(base_url('admin/banner_kd'));
        }
        if ($this->input->post('btnEdit')) {
//            $type = $this->input->post('type');
            $title = $this->input->post('title');
            $description = $this->input->post('description');
            $product_id = $this->input->post('product_id');
//            $number = $this->input->post('number');
            $service_package_id = $this->input->post('service_package_id');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));

            $data = array(
//                'type' => $type,
                'title' => $title,
                'description' => $description,
                'time_event_start' => $date1,
                'time_event_stop' => $date2,
//                'product_id' => $product_id,
//                'number' => $number,
//                'service_package_id' => $service_package_id,
            );
//            pre($data);

            $config['upload_path'] = './public/images/banner';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_banner')) {
                $file_data = $this->upload->data();
//                $data['img'] = $file_data['file_name'];
                $data['link_icon'] = link_banner('/') . $file_data['file_name'];
//                'link_icon' => link_icon('/'). $file_data['file_name']
//                unlink('./public/images/banner/' . $banner->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->banner_kd_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/banner_kd'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $banner;
        $this->data['temp'] = 'admin/banner_kd/edit';
//        $this->data['view'] = 'admin/banner_kd/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $banner = $this->banner_kd_model->get_info($id);
        if ($banner) {
            $this->banner_kd_model->delete($id);
            unlink('./public/images/banner/' . $banner->img);
        }
        redirect(base_url('admin/banner_kd'));
    }
}