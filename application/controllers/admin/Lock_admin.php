<?php

Class Lock_admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('user_model');
        $this->load->model('user_temp_address_model');
        $this->load->model('admin_require_payment_model');
        $this->load->model('config_server_model');
        $this->load->model('admin_emergency_model');
        $this->load->model('service_package_user_model');
    }

    function index()
    {
        $id = $this->input->post('id');
        $level = $this->input->post('level');
        $status_content = $this->input->post('status_content');

//        echo $id . '->>>>>>>>>' . $status_content;
        $dataSubmit = array(
            'status' => $status_content
        );

        if ($this->admin_model->update($id, $dataSubmit)) {
//            $this->session->set_flashdata('message', 'Sửa thông tin tài sản thành công!');
//            int account_id = req.get("account_id").asInt();
//            int type_account_ben_nodeJs = req.get("type_account_ben_nodeJs").asInt();
            $postData = [
                'cmd' => 302,
                'account_id' => $id,
                'type_account_ben_nodeJs' => $level,
            ];
//        pre($postData);
            $result = post_curl($postData);
//            pre($result);

            echo 'cập nhật thành công';
//            $this->session->unset_userdata('asset_dcm');
//            redirect(base_url('admin/admin' . '?admin_id=' . $id . '#' . $id));
        } else {
//            $this->session->set_flashdata('message', 'Sửa thông tin tài sản thất bại!');
            echo 'thất bại';
//            redirect(base_url('admin/admin'));
        }
    }

    function update_admin_require_payment()
    {
//        echo '1111111';
        $id = $this->input->post('id');
        $admin_id = $this->input->post('admin_id');
        $status_content = $this->input->post('status_content');

//        echo $id . '->>>>>>>>>' . $status_content;
        $dataSubmit = array(
            'status' => $status_content
        );

        if ($this->admin_require_payment_model->update($id, $dataSubmit)) {
//            $this->session->set_flashdata('message', 'Sửa thông tin tài sản thành công!');
            if ($status_content == 4) {
//                add money to admin,ktv
                $info = $this->admin_model->get_info($admin_id);
                $info2 = $this->admin_require_payment_model->get_info($id);
//                pre($info);
                $data_update = array();
                $data_update['balance'] = $info->balance + $info2->balance_wait_payment;
                $data_update['balance_wait_payment'] = $info->balance_wait_payment + $info2->balance_wait_payment;
                $data_update['bonus'] = $info->bonus + $info2->bonus_wait_payment;
                $data_update['bonus_wait_payment'] = $info->bonus_wait_payment + $info2->bonus_wait_payment;
                $data_update['bonus_introduce_customer'] = $info->bonus_introduce_customer + $info2->bonus_introduce_customer_wait_payment;
                $data_update['bonus_introduce_customer_wait_payment'] = $info->bonus_introduce_customer_wait_payment + $info2->bonus_introduce_customer_wait_payment;

//                pre($data_update);
//                die();
//                if ($this->admin_model->update($admin_id, $data_update)) {
                $this->admin_model->update($admin_id, $data_update);
//                    $this->cms_add_money_logs_model->create($data_log);
//                    $this->session->set_flashdata('message', 'Cập nhật thành công');
//                    redirect(base_url('admin/add_money'));
//                redirect(base_url('admin/add_money' . '?id=' . $id . '#' . $id));
//                } else {
//                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
//                }
            }
            echo 'cập nhật thành công';
//            redirect(base_url('admin/admin' . '?admin_id=' . $id . '#' . $id));
        } else {
//            $this->session->set_flashdata('message', 'Sửa thông tin tài sản thất bại!');
            echo 'thất bại';
//            redirect(base_url('admin/admin'));
        }
    }

    function update_config_server()
    {
//        echo '1111111';
        $id = $this->input->post('id');
        $money_register_account = $this->input->post('money_register_account');
        $money_thuong_nhap_ma_gioi_thieu = $this->input->post('money_thuong_nhap_ma_gioi_thieu');

//        echo $id . '->>>>>>>>>' . $status_content;
        $dataSubmit = array(
            'money_register_account' => $money_register_account,
            'money_thuong_nhap_ma_gioi_thieu' => $money_thuong_nhap_ma_gioi_thieu,
        );

        if ($this->config_server_model->update($id, $dataSubmit)) {
//            $this->session->set_flashdata('message', 'Sửa thông tin tài sản thành công!');
            echo 'cập nhật thành công';
//            redirect(base_url('admin/admin' . '?admin_id=' . $id . '#' . $id));
        } else {
//            $this->session->set_flashdata('message', 'Sửa thông tin tài sản thất bại!');
            echo 'thất bại';
//            redirect(base_url('admin/admin'));
        }
    }

    function update_address()
    {
        $this->load->model('user_temp_address_model');
        $tid = $this->input->post('tid');
        $user_id = $this->input->post('user_id');
        $province = $this->input->post('province');
        $district = $this->input->post('district');
        $ward = $this->input->post('ward');
        $address = $this->input->post('address');
        $province_id = $this->input->post('province_id');
        $district_id = $this->input->post('district_id');
        $ward_id = $this->input->post('ward_id');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');
        $dataSubmit = array(
            'province' => $province,
            'district' => $district,
            'ward' => $ward,
            'address' => $address,
            'province_id' => $province_id,
            'district_id' => $district_id,
            'ward_id' => $ward_id,
        );

        if ($this->user_model->update($user_id, $dataSubmit)) {
//            update step 2 to table service_package_user
//            $this->service_package_user_model->update_rule($input, $data);
            $check = $this->user_temp_address_model->change_service_package($user_id, $address, $latitude, $longitude);
//            pre($check);
            $this->user_temp_address_model->delete($tid);
            echo 'cập nhật thành công';
        } else {
            echo 'thất bại';
        }
    }
}