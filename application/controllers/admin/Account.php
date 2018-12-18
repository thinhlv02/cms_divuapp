<?php

Class Account extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('employee_model');
    }

    function index()
    {
        $admin = $this->data['admin'];
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['where']['employee_id'] = $admin->employee_id;

        $account = $this->admin_model->get_list($input);
        $account_arr = array();
        foreach ($account as $key => $value) {
//            pre($value->employee_id);
            $employee_name_ = $this->employee_model->get_info($value->employee_id);

            if ($employee_name_ == '') {
                $employee_name = 'No name';
                $img = $value->img;
            } else {
                $employee_name = $employee_name_->name;
                $img = $employee_name_->img;
            }
            $account_arr[0] = new stdClass();
            $account_arr[0]->id = $value->id;
            $account_arr[0]->UserName = $value->UserName;
            $account_arr[0]->employee_id = $value->employee_id;
            $account_arr[0]->img = $img;
            $account_arr[0]->employee_name = $employee_name;
        }
        $this->data['account'] = $account_arr;
//        pre($account_arr);

        $this->data['temp'] = 'admin/account/account';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $account_id_full = $this->uri->segment(4);
        $account_id = intval($account_id_full);
        $account = $this->admin_model->get_info($account_id);
//        $employee_name = $this->employee_model->get_info($account->employee_id);
        $employee_name_ = $this->employee_model->get_info($account->employee_id);

//                pre($employee_name);
        $id_employee = '';
        if ($employee_name_ == '') {
            $employee_name = 'No name';
            $img = $account->img;
        } else {
            $employee_name = $employee_name_->name;
            $img = $employee_name_->img;
            $id_employee = $employee_name_->id;
        }
//        pre($id_employee);
        $account_arr[0] = new stdClass();
        $account_arr[0]->id = $account->id;
        $account_arr[0]->UserName = $account->UserName;
        $account_arr[0]->employee_id = $account->employee_id;
        $account_arr[0]->img = $img;
        $account_arr[0]->employee_name = $employee_name;
//        pre($account_arr);
//        $account = $this->admin_model->get_info($account_id);
//        pre($account);
        if ($account == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài khoản!');
            redirect(base_url('admin/account'));
        } else {
            if (stripos($account_id_full, "pw") !== false) {
//                echo "pw";
                if ($this->input->post('btnUpdateInfo')) {
                    $password = $this->input->post('txtPassword');
                    $newPassword = $this->input->post('txtNewPassword');
                    $confirmPassword = $this->input->post('txtConfirmPassword');
                    if (md5($password) != $this->session->userdata('admin')->Password) {
                        $this->session->set_flashdata('message', 'Mật khẩu hiện tại không đúng!');
//                pre(md5($password));
                        redirect(base_url('admin/account/edit/' . $account_id_full));
                    } else {
                        $admin = $this->data['admin'];
                        if ($newPassword != '' && $newPassword != null) {
                            if ($newPassword != $confirmPassword) {
                                $this->session->set_flashdata('message', 'Xác nhận mật khẩu không khớp!');
                                redirect(base_url('admin/account/edit/' . $account_id_full));
                            } else {
                                $dataUpdate['Password'] = md5($newPassword);
                            }
                        }
//pre($dataUpdate);
                        if ($this->admin_model->update($admin->id, $dataUpdate)) {
                            $this->session->set_flashdata('message', 'Cập nhật thông tin thành công!');
                            $admin = $this->admin_model->get_info($admin->id);
                            $this->session->set_userdata('admin', $admin);
                            // pre($this->session->userdata('admin'));
                            redirect(base_url('admin/account'));
                        } else {
                            $this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
                            redirect(base_url('admin/account'));
                        }
                    }
                }
                $this->data['account'] = $account_arr;
                $this->data['temp'] = 'admin/info';
                $this->load->view('admin/layout', $this->data);
            } else {
//                echo 'edit';
                if ($this->input->post('btnUpdateaccount')) {
                    $UserName = $this->input->post('txtName');

                    $changeImg = $this->input->post('changeImg');
                    if ($changeImg == 1) {
//                        $config['upload_path'] = './upload';
                        $config['upload_path'] = './public/images/employee';
                        $config['allowed_types'] = 'gif|jpg|png';

                        $this->load->library("upload", $config);
                        if ($this->upload->do_upload('imageaccount')) {
                            $old_img = './upload/' . $account->img;
                            unlink($old_img);
                            $img_data = $this->upload->data();
                            $img = $img_data['file_name'];
//                            pre($img);

                            $dataSubmit = array(
                                'UserName' => $UserName,
                                'img' => $img
                            );
//                            pre($dataSubmit);
                            if ($this->admin_model->update($account_id, $dataSubmit)) {
//                                update field img from table employee
                                if ($id_employee != '') {
                                    $this->employee_model->update($id_employee, array('img' => $img));
                                }
//                                update field img from table employee

                                $this->session->set_flashdata('message', 'Sửa thành công!');
                                redirect(base_url('admin/account'));
                            } else {
                                $this->session->set_flashdata('message', 'Sửa thất bại!');
                                redirect(base_url('admin/account'));
                            }
                        } else {
                            $this->session->set_flashdata('message', $this->upload->display_errors());
                            redirect(base_url('admin/account/edit/' . $account_id));
                        }
                    }
                    if ($changeImg == 2) {
                        $dataSubmit = array(
                            'UserName' => $UserName
                        );
                        if ($this->admin_model->update($account_id, $dataSubmit)) {
                            $this->session->set_flashdata('message', 'Sửa thành công!');
                            redirect(base_url('admin/account'));
                        } else {
                            $this->session->set_flashdata('message', 'Sửa thất bại!');
                            redirect(base_url('admin/account'));
                        }
                    }
                }
                $this->data['account'] = $account_arr;
                $this->data['temp'] = 'admin/account/edit';
                $this->load->view('admin/layout', $this->data);
            }
        }
    }

//    function pw()
//    {
//        $id_pw = $this->uri->segment(4);
//        $message = $this->session->flashdata('message');
//        $this->data['message'] = $message;
//
//        if ($this->input->post('btnUpdateInfo')) {
//            $fullname = $this->input->post('txtName');
//            $password = $this->input->post('txtPassword');
//            $newPassword = $this->input->post('txtNewPassword');
//            $confirmPassword = $this->input->post('txtConfirmPassword');
//            if ($fullname == '' || $fullname == null) {
//                $this->session->set_flashdata('message', 'Tên không được để trống!');
//                redirect(base_url('admin/account'));
//            } else if (md5($password) != $this->session->userdata('admin')->Password) {
//                $this->session->set_flashdata('message', 'Mật khẩu không đúng!');
////                pre(md5($password));
//                redirect(base_url('admin/account/pw/'.$id_pw));
//            } else {
//                $admin = $this->data['admin'];
//                $dataUpdate = array('UserName' => $fullname);
//                if ($newPassword != '' && $newPassword != null) {
//                    if ($newPassword != $confirmPassword) {
//                        $this->session->set_flashdata('message', 'Xác nhận mật khẩu không khớp!');
//                        redirect(base_url('admin/account/pw/'.$id_pw));
//                    } else {
//                        $dataUpdate['Password'] = md5($newPassword);
//                    }
//                }
////pre($dataUpdate);
//                if ($this->admin_model->update($admin->id, $dataUpdate)) {
//                    $this->session->set_flashdata('message', 'Cập nhật thông tin thành công!');
//                    $admin = $this->admin_model->get_info($admin->id);
//                    $this->session->set_userdata('admin', $admin);
//                    // pre($this->session->userdata('admin'));
//                    redirect(base_url('admin/account'));
//                } else {
//                    $this->session->set_flashdata('message', 'Cập nhật thông tin thất bại!');
//                    redirect(base_url('admin/account'));
//                }
//
//            }
//        }
//
//        $this->data['temp'] = 'admin/info';
//        $this->load->view('admin/layout', $this->data);
//    }

}