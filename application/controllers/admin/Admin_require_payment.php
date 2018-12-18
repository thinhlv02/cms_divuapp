<?php

Class Admin_require_payment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_require_payment_model');
        $this->load->model('cms_admin_level_model');
        $cms_admin_level_model = $this->cms_admin_level_model->get_list();
        $this->data['cms_admin_level_model'] = $cms_admin_level_model;
//        pre($cms_admin_level_model);
    }

    function index()
    {
//        1: gửi yêu cầu, 2: đang thanh toán, 3: Đã thanh toán, 4: hủy thanh toán
        $status = array(
            '1' => 'gửi yêu cầu',
            '2' => 'đang thanh toán',
            '3' => 'Đã thanh toán',
            '4' => 'hủy thanh toán',
        );
        $this->data['status'] = $status;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $input = array();
//        $input['where_in'] = array('level', array('4', '6'));
//        $this->db->where_in('id', array('20','15','22','42','86'));

//        $input['order'] = array('id', 'desc');
//        pre($input);

//        $list = $this->admin_require_payment_model->get_list($input);

        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
            $status = $this->input->post('status');
            $type_cart = $this->input->post('type_cart');

            $list = $this->admin_require_payment_model->get_admin_require($search, $date1, $date2, $status);

//            $asset = $this->transaction_history_model->get_info_transaction_history($search, $date1, $date2, $status, $type_cart);
////            pre($asset);
            $this->data['res'] = $list;
        }
//        $list = $this->admin_require_payment_model->get_admin_require();
//        $this->data['user_active'] = $list;
//        pre($news2);
        $this->data['temp'] = 'admin/admin_require_payment/list';
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
            $check_account = $this->admin_require_payment_model->get_list($input);
//            pre($check_account[0]->UserName);
            if (!$check_account) {
//                $insert_id = $this->admin_require_payment_model->create($dataSubmit);
                $insert_id = $this->admin_require_payment_model->create($dataSubmit);

                if ($insert_id >= 0) {
                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thành công!');
                    redirect(base_url('admin/user_active'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm tài khoản login hệ thống thất bại!');
                    redirect(base_url('admin/user_active'));
                }
            } else {
                $this->session->set_flashdata('message', 'Tài khoản này đã tồn tại với tên hiển thị: = ' . $check_account[0]->username . ', vui lòng kiểm tra lại!');
                redirect(base_url('admin/admin_require_payment/add'));
            }
            /* Check tài khoản đã tạo chưa */
        }
        $this->data['temp'] = 'admin/admin_require_payment/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $news2 = $this->user_active_model->get_info($id);
        if (!$news2) {
            redirect(base_url('admin/news2'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'title' => $this->input->post('txtName'),
                'intro' => $this->input->post('intro'),
                'content' => $this->input->post('txtContent'),
//                'link' => $this->input->post('link'),
                'created' => $created->getTimestamp()
            );
//            pre($data);

            $config['upload_path'] = './public/images/news';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG|pdf';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_news2')) {
                $file_data = $this->upload->data();
                $data['img'] = $file_data['file_name'];
                unlink('./public/images/news2/' . $news2->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->user_active_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật bảng tin thành công');
                redirect(base_url('admin/news2'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['news2'] = $news2;
        $this->data['temp'] = 'admin/news2/edit';
//        $this->data['view'] = 'admin/news2/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $news2 = $this->user_active_model->get_info($id);
        if ($news2) {
            $this->user_active_model->delete($id);
            unlink('./public/images/news2/' . $news2->img);
        }
        redirect(base_url('admin/news2'));
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