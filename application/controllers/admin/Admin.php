<?php

Class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('vn_district_model');
        $this->load->model('vn_city_model');
//        $this->load->model('employee_model');
        $this->load->model('menu_model');
        $this->load->model('menu_access_model');
//        $this->load->model('company_model');
        $input_e = array();
        $input_e['where']['ban'] = 0;
        $input_e['where']['role'] = 1;
        $input_e['where']['id > '] = 116;
//        $employee = $this->employee_model->get_list($input_e);
//        $this->data['emp'] = $employee;
        $input_priority = array();
        $input_priority['order'] = array('priority', 'asc');

        $ad_list = $this->admin_model->get_list();
        $this->data['ad_list'] = $ad_list;
        $input_d = array();
        $input_d['where']['city_id'] = 01;

        $vn_district = $this->vn_district_model->get_list($input_d);
        $this->data['vn_district'] = $vn_district;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $company_id = 'all';
//        if ($this->input->post('search')) {
//            $company_id = $this->input->post('company_id');
//            $admin = $this->admin_model->function_getlist($company_id);
//        } else {
        $input = array();
        $input['where_in'] = array('level', array('5'));
            $admin = $this->admin_model->get_list($input);
//            $admin = $this->admin_model->function_getlist($company_id);
//        }
        $this->data['res'] = $admin;
//        pre($admin);
        $this->data['temp'] = 'admin/admin/admin';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddadmin')) {
//            $employee_id = $this->input->post('employee_id');
            $txtName = $this->input->post('txtName');
            $password = $this->input->post('txtPassword');
//            $company_id = $this->input->post('company_id');

//            $admin = $this->data['admin'];
//            $dataUpdate = array('Password' => $password);
//            $dataUpdate['Password'] = md5($password);
            $dataSubmit = array(
                'username' => $txtName,
                'password' => md5($password),
                'level' => 5,
//                'employee_id' => $employee_id,
//                'company_id' => $company_id
            );
//            pre($dataSubmit);
//            die();
            /* Check tài khoản đã tạo chưa */
//            $input = array();
//            $input['where'] = array(
//                'employee_id' => $employee_id
//            );
//            $check_account = $this->admin_model->get_list($input);
//            pre($check_account[0]->UserName);
//            if (!$check_account) {
//                $insert_id = $this->admin_model->create($dataSubmit);
                $insert_id = $this->admin_model->create($dataSubmit);
//                update lại trường employee_id
//                if ($employee_id == 123456) {
//                    $employee_id = $insert_id . $employee_id;
//                    $this->admin_model->update($insert_id, array('employee_id' => $employee_id));
//                }
//                update lại trường employee_id
                if ($insert_id >= 0) {
                    /* thêm quyền vào bảng menu_access*/
                    $menu = $this->menu_model->get_list(array('order' => array('id','asc')));
//                pre($menu);

                    foreach ($menu as $key => $value) {
                        $dataSubmit1 = array(
                            'employee_id' => $insert_id,
                            'menu_id' => $value->id,
                            'access' => 0
                        );
                        $this->menu_access_model->create($dataSubmit1);
                    }
                    /* End thêm quyền vào bảng menu_access*/

                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thành công!');
                    redirect(base_url('admin/admin'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thất bại!');
                    redirect(base_url('admin/admin'));
                }
//            }
//            else {
//                $this->session->set_flashdata('message', 'Tài khoản này đã tồn tại với tên hiển thị: = ' . $check_account[0]->UserName . ', vui lòng kiểm tra lại!');
//                redirect(base_url('admin/admin/add'));
//            }
            /* Check tài khoản đã tạo chưa */
        }
        $this->data['temp'] = 'admin/admin/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $user_id = $this->uri->segment(4);
        $user_id = intval($user_id);
        //pre($admin_id);
        $user = $this->admin_model->get_info($user_id);
        if ($user == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản!');
            redirect(base_url('admin/admin'));
        } else {
            $this->data['user'] = $user;
        }
//        pre($user);

        if ($this->input->post('btnUpdateadmin')) {
            $txtName = $this->input->post('txtName');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $dataSubmit = array(
                'UserName' => $txtName,
                'phone' => $phone,
                'email' => $email
            );

            $config['upload_path'] = './public/images/ktv_avatars';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_banner')) {
                $file_data = $this->upload->data();
//                $data['img'] = $file_data['file_name'];
                $dataSubmit['link_avatar'] = link_ktvavatars('/') . $file_data['file_name'];
//                unlink('./public/images/banner/' . $banner->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->admin_model->update($user_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thành công!');
                redirect(base_url('admin/admin'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(base_url('admin/admin'));
            }
        }
        $this->data['temp'] = 'admin/admin/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function access()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $menu_access = $this->menu_access_model->get_list();
//        $this->data['menu_access'] = $menu_access;
        $menu_access_id = intval($this->uri->segment(4));
//        pre($menu_access_id);
        $access_info = new stdClass();
        $displayName = $this->admin_model->get_info_rule(array('id' => $menu_access_id))->username;
        $UserName = $this->admin_model->get_info_rule(array('id' => $menu_access_id))->username;
        $access_info->displayName = $displayName;
        $access_info->UserName = $UserName;
//        pre($access_info);

        $input = array();
        $input['where'] = array(
            'employee_id' => $menu_access_id
        );
        //(ví dụ $input['order'] = array('id','DESC'))

        $input['order'] = array('menu_id', 'ASC');
        $menu_access = $this->menu_access_model->get_list($input);
//        pre($menu_access);
        if ($menu_access == null) {
            $this->session->set_flashdata('message', 'Không tồn tại quyền nv!');
            redirect(base_url('admin/access'));
        } else {
            $index = 0;
            foreach ($menu_access as $value_end) {
                $index++;
                $menu_id_end[$index] = $value_end->menu_id;
            }
            $abc = implode(',',$menu_id_end);
//        pre($abc);
//        get menuid_new
            $menu_new = $this->menu_model->get_list_new($abc);
//            pre($menu_new);
            $this->data['menu_access'] = $menu_access;
            $this->data['menu_new'] = $menu_new;
        }
//        pre($menu_new);


        if ($this->input->post('btnUpdateemployee')) {
//            $access1 = $access2 = array();
//            var_dump($access1);
            $access = $this->input->post('access');// quyền xem
            $access2 = $this->input->post('access2'); // thêm sửa
            $access3 = $this->input->post('access3'); // x
//            pre($access.'-'.$access2.'-'.$access3);
//            pre($access);
//            pre($access2);
            $i = 0;
//            pre($menu_access);
            foreach ($menu_access as $row) {
//                if ($access2 && in_array($row->id, $access2)) {
//                    $this->menu_access_model->update($row->id, array('access' => 2));
//                    $i++;
//                } else if ($access1 && in_array($row->id, $access1)) {
//                    $this->menu_access_model->update($row->id, array('access' => 1));
//                    $i++;
//                } else {
//                    $this->menu_access_model->update($row->id, array('access' => 0));
//                    $i++;
//                }
                if ($access && in_array($row->id, $access)) {
                    $this->menu_access_model->update($row->id, array('access' => 1));
                    $i++;
                }
                else{
                    $this->menu_access_model->update($row->id, array('access' => 0));
                    $i++;
                }

                if ($access2 && in_array($row->id, $access2)) {
                    $this->menu_access_model->update($row->id, array('access2' => 1));
                    $i++;
                }
                else{
                    $this->menu_access_model->update($row->id, array('access2' => 0));
                    $i++;
                }

                if ($access3 && in_array($row->id, $access3)) {
                    $this->menu_access_model->update($row->id, array('access3' => 1));
                    $i++;
                }
                else{
                    $this->menu_access_model->update($row->id, array('access3' => 0));
                    $i++;
                }
            }
            if (count($i) > 0) {
                $this->session->set_flashdata('message', 'Cập nhật xong!');
                redirect(base_url('admin/admin/access/' . $menu_access_id));
            }
//            if (is_array($access1)) {
//                foreach ($access1 as $value) {
////                    if(in_array($value, $access2)){
////                        $this->employee_model->update($employee_id, array('access'=>2));
////                    }
////                    else{
////                        $this->employee_model->update($employee_id, array('access'=>1));
////                    }
//                }
//            }

//            if ($this->employee_model->update($employee_id, $dataSubmit)) {
//                $this->session->set_flashdata('message', 'Sửa quyền nhân sự thành công!');
//                redirect(base_url('admin/access' / $employee_id));
//            } else {
//                $this->session->set_flashdata('message', 'Sửa quyền nhân sự thất bại!');
//                redirect(base_url('admin/access' / $employee_id));
//            }
        }
        $this->data['access_info'] = $access_info;
        $this->data['temp'] = 'admin/admin/access';
        $this->load->view('admin/layout', $this->data);
    }

    function info()
    {
        $admin_id = $this->uri->segment(4);
        $admin_id = intval($admin_id);
//        $admin = $this->admin_model->get_info($admin_id);
//        pre($admin_id);
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        if ($this->input->post('btnUpdateInfo')) {
            $password = $this->input->post('txtPassword');

//            $admin = $this->data['admin'];
//            $dataUpdate = array('Password' => $password);
            $dataUpdate['Password'] = md5($password);

//pre($dataUpdate);
            if ($this->admin_model->update($admin_id, $dataUpdate)) {
                $this->session->set_flashdata('message', 'Cập nhật thông tin thành công!');
//                $admin = $this->admin_model->get_info($admin->id);
//                $this->session->set_userdata('admin', $admin);
                // pre($this->session->userdata('admin'));
                redirect(base_url('admin/admin'));
            } else {
                $this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
                redirect(base_url('admin/admin'));
            }
        }

        $this->data['admin_id'] = $admin_id;
//        pre($admin_id);
        $this->data['temp'] = 'admin/admin/reset_password';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $admin_id = $this->uri->segment(4);
        $admin_id = intval($admin_id);
        $admin = $this->admin_model->get_info($admin_id);

        if ($admin == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản login hệ thống!');
            redirect(base_url('admin/admin'));
        } else {
            $input = array();
            $input['where'] = array(
                'employee_id' => $admin->id
            );
            $menu_access = $this->menu_access_model->get_list($input);
//            pre($menu_access);
//            die();

            if ($this->admin_model->delete($admin_id)) {
                /* nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/

                foreach ($menu_access as $value) {
                    $this->menu_access_model->delete($value->id);
                }
                /* End nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/
                $this->session->set_flashdata('message', 'Xóa tài khoản login hệ thống thành công!');
                redirect(base_url('admin/admin'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/admin'));
            }
        }
    }
}