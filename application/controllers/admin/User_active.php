<?php

Class User_active extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('cms_admin_level_model');
        $this->load->model('vn_city_model');
        $this->load->model('vn_district_model');
        $input = array();
        $input['where_in'] = array('id', array('4','6'));

        $cms_admin_level_model = $this->cms_admin_level_model->get_list($input);
        $this->data['cms_admin_level_model'] = $cms_admin_level_model;
//        pre($cms_admin_level_model);

        $input_d = array();
        $input_d['where']['city_id'] = 01;

        $vn_district = $this->vn_district_model->get_list($input_d);
        $this->data['vn_district'] = $vn_district;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['where_in'] = array('level', array('4', '6'));
//        $this->db->where_in('id', array('20','15','22','42','86'));

        $input['order'] = array('id', 'desc');
//        pre($input);

        $list = $this->admin_model->get_list($input);
//        pre($list);
        $index = 0;
        $admin_arr = array();
        foreach ($list as $key => $value) {
            $index++;
            $city_work_id = $this->vn_city_model->get_info($value->city_work_id);
            $district_work_id = $this->vn_district_model->get_info($value->district_work_id);
            if ($city_work_id) {
                $city_work_id_ = $city_work_id->name;
            } else {
                $city_work_id_ = 'Admin chưa thêm';
            }
            $district_work_id_ ='KTV chưa cập nhật';
            if ($district_work_id) {
                $district_work_id_ = $district_work_id->name;
            }
            $admin_arr[$index] = new stdClass();
            $admin_arr[$index]->id = $value->id;
            $admin_arr[$index]->username = $value->username;
            $admin_arr[$index]->fullname = $value->fullname;
            $admin_arr[$index]->phone = $value->phone;
            $admin_arr[$index]->address = $value->address;
            $admin_arr[$index]->email = $value->email;
            $admin_arr[$index]->rank = $value->rank;
            $admin_arr[$index]->link_avatar = $value->link_avatar;
            $admin_arr[$index]->status = $value->status;
            $admin_arr[$index]->is_active = $value->is_active;
            $admin_arr[$index]->city_work_id_ = $city_work_id_;
            $admin_arr[$index]->district_work_id_ = $district_work_id_;
        }
//        pre($admin_arr);
        $this->data['user_active'] = $admin_arr;
//        pre($news2);
        $this->data['temp'] = 'admin/user_active/list';
//        $this->data['view'] = 'admin/news2/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddadmin')) {
            $txtName = $this->input->post('txtName');
            $password = $this->input->post('txtPassword');
            $level = $this->input->post('level');
            $phone = $this->input->post('phone');
            $fullname = $this->input->post('fullname');
            $address = $this->input->post('address');
            $email = $this->input->post('email');

//            $admin = $this->data['admin'];
//            $dataUpdate = array('Password' => $password);
//            $dataUpdate['Password'] = md5($password);
            $dataSubmit = array(
                'UserName' => $txtName,
                'Password' => md5($password),
                'level' => $level,
                'phone' => $phone,
                'fullname' => $fullname,
                'address' => $address,
                'email' => $email,
            );
//            pre($dataSubmit);
//            die();
            /* Check tài khoản đã tạo chưa */
            $input = array();
            $input['where'] = array(
                'username' => $txtName
            );
            $input['where_not_in'] = array('level', array(5));
//            $input['where_in'] = array('level', array('4', '6'));
//            $input['or_where'] = array('phone', $phone);
            $input['or_where_not_in'] = array('phone', array($phone));
//            pre($input);

//            $this->db->where('name !=', $name);
//            $this->db->or_where('id >', $id);  // Produces: WHERE name != 'Joe' OR id > 50
//            pre($input);

            $check_account = $this->admin_model->check_ktv($txtName,$phone);
//            $check_account = $this->admin_model->get_list($input);
//            pre($check_account[0]->UserName);
            if (!$check_account) {
//                $insert_id = $this->admin_model->create($dataSubmit);
                $insert_id = $this->admin_model->create($dataSubmit);

                if ($insert_id >= 0) {
                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thành công!');
                    redirect(base_url('admin/user_active'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thất bại!');
                    redirect(base_url('admin/user_active'));
                }
            } else {
//                $this->session->set_flashdata('message', 'Tài khoản này đã tồn tại với tên hiển thị: = ' . $check_account[0]->username . ', SĐT:  vui lòng kiểm tra lại!');
                $this->session->set_flashdata('message', 'Bị trùng Tên đăng nhập hoặc SĐT, Vui lòng kiểm tra lại!');
                redirect(base_url('admin/user_active/add'));
            }
            /* Check tài khoản đã tạo chưa */
        }
        $this->data['temp'] = 'admin/user_active/add';
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
//            $employee_id = $this->input->post('employee_id');
//            if ($employee_id == 123456) {
//                $employee_id = $user->employee_id;
//            }
            $txtName = $this->input->post('txtName');
            $district_work_id = $this->input->post('vn_district');
            $city_work_id = $this->input->post('city_work_id');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $password = $this->input->post('txtPassword');
//            $company_id = $this->input->post('company_id');

//            $admin = $this->data['admin'];
//            $dataUpdate = array('Password' => $password);
//            $dataUpdate['Password'] = md5($password);
            $dataSubmit = array(
                'UserName' => $txtName,
                'district_work_id' => $district_work_id,
                'city_work_id' => $city_work_id,
                'phone' => $phone,
                'email' => $email,
//                'Password' => md5($password),
//                'company_id' => $company_id
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

//            $name = $this->input->post('txtName');
//            $dataSubmit = array(
//                'UserName' => $name
//            );
            if ($this->admin_model->update($user_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thành công!');
                redirect(base_url('admin/user_active'));
            } else {
                $this->session->set_flashdata('message', 'Sửa thất bại!');
                redirect(base_url('admin/user_active'));
            }
        }

        $this->data['temp'] = 'admin/user_active/edit';
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
            if ($this->admin_model->delete($admin_id)) {
                /* nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/
                $input = array();
                $input['where'] = array(
                    'employee_id' => $admin->employee_id
                );
                $menu_access = $this->menu_access_model->get_list($input);
                foreach ($menu_access as $value) {
                    $this->menu_access_model->delete($value->id);
                }
                /* End nếu xóa tài khoản thì xóa luôn quyền trong menu-access*/
                $this->session->set_flashdata('message', 'Xóa tài khoản login hệ thống thành công!');
                redirect(base_url('admin/user_active'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/user_active'));
            }
        }
    }

    public function news2_details($slug = '', $id = 0)
    {
//        pre($slug);
        $detail = $this->user_active_model->get_info($id);
        $news2 = $this->user_active_model->get_list(array('limit' => array(5, 0), 'order' => array('id', 'desc')));

//        pre($detail);
        if ($detail && $slug == create_slug($detail->title)) {
            $this->data['news2'] = $news2;
            $this->data['detail'] = $detail;
            $this->data['temp'] = 'admin/news2/news2_details';

        } else {
//            redirect(base_url());
            $this->data['news2'] = $news2;
            $this->data['temp'] = 'admin/news2/news2_list';
        }
        $this->load->view('admin/layout', $this->data);
    }
}