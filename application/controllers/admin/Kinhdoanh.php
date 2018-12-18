<?php

Class Kinhdoanh extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('kinhdoanh_model');
        $this->load->model('service_package_maintenance_model');
//        $input_priority = array();
//        $input_priority['order'] = array('priority', 'asc');
//        $deparment = $this->department_model->get_list($input_priority);
//        $this->data['deparment'] = $deparment;
////        pre($deparment);
        $input_e = array();
        $input_e['where']['level'] = 4;
//        $input_e['where']['role'] = 1;
//        $input_e['where']['id > '] = 115;
        $list_emp = $this->admin_model->get_list($input_e);
//        $list_emp = $this->asset_model->get_list();
        $this->data['list_emp'] = $list_emp;
    }

    function index()
    {
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $date1 = 'all';
        $date2 = 'all';
        $search = 'all';
        $admin_id = 'all';
        if ($this->input->post('search')) {
            $search = 1;
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
//            pre($date1);
            $asset = $this->kinhdoanh_model->kinhdoanh_money($search, $date1, $date2);
////            pre($asset);
        } //        $asset = $this->asset_model->get_list();
        else {
            $asset = $this->kinhdoanh_model->kinhdoanh_money($search, $date1, $date2, $admin_id);
        }
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);
        $this->data['res'] = $asset;
//        pre($asset);

        $this->data['temp'] = 'admin/kinhdoanh/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $total = $this->input->post('total');
            $cp_quangcao = $this->input->post('cp_quangcao');
            $gia_von = $this->input->post('gia_von');
            $cp_vanphong = $this->input->post('cp_vanphong');
            $luong = $this->input->post('luong');
            $cp_khac = $this->input->post('cp_khac');
            $ln_thuan = $this->input->post('ln_thuan');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
//                pre($file_data);
                $data = array(
                    'total' => $total,
                    'date' => $date1,
                    'cp_quangcao' => $cp_quangcao,
                    'gia_von' => $gia_von,
                    'cp_vanphong' => $cp_vanphong,
                    'luong' => $luong,
                    'cp_khac' => $cp_khac,
                    'ln_thuan' => $ln_thuan,
                );
                if ($this->kinhdoanh_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    redirect(base_url('admin/kinhdoanh'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }

        }
        $this->data['temp'] = 'admin/kinhdoanh/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $product = $this->kinhdoanh_model->get_info($id);
//        pre($product);
        if (!$product) {
            redirect(base_url('admin/kinhdoanh'));
        }
        if ($this->input->post('btnEdit')) {
            $total = $this->input->post('total');
            $cp_quangcao = $this->input->post('cp_quangcao');
            $gia_von = $this->input->post('gia_von');
            $cp_vanphong = $this->input->post('cp_vanphong');
            $luong = $this->input->post('luong');
            $cp_khac = $this->input->post('cp_khac');
            $ln_thuan = $this->input->post('ln_thuan');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $data = array(
                'total' => $total,
                'date' => $date1,
                'cp_quangcao' => $cp_quangcao,
                'gia_von' => $gia_von,
                'cp_vanphong' => $cp_vanphong,
                'luong' => $luong,
                'cp_khac' => $cp_khac,
                'ln_thuan' => $ln_thuan,
            );
//            pre($data);
            if ($this->kinhdoanh_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật thành công');
                redirect(base_url('admin/kinhdoanh'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['res'] = $product;
        $this->data['temp'] = 'admin/kinhdoanh/edit';
//        $this->data['view'] = 'admin/kinhdoanh/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $product = $this->kinhdoanh_model->get_info($id);
        if ($product) {
            $this->kinhdoanh_model->delete($id);
        }
        redirect(base_url('admin/kinhdoanh'));
    }
}