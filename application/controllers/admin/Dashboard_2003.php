<?php

Class Dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('notice_model');
        $this->load->model('news_model');
        $this->load->model('employee_model');
//        $this->load->model('department_model');
        $this->load->model('menu_model');
        $this->load->model('menu_access_model');
//        $this->load->model('contract_model');
        $this->load->model('contract_detail_model');
//        $deparment = $this->department_model->get_list();
//        $this->data['deparment'] = $deparment;
//        pre($deparment);
        $input = array();
        $input['order'] = array('ID', 'DESC');
        $input['limit'] = array('5', '0');
        $notice = $this->notice_model->get_list($input);
//        pre($notice);
        $this->data['res'] = $notice;

//        $contract = $this->contract_model->get_list();
//        $this->data['contract'] = $contract;
//        pre($contract);

        $input_n = array();
        $input_n['order'] = array('id', 'desc');
        $input_n['limit'] = array('5', '0');
        $news = $this->news_model->get_list($input_n);
//        pre($notice);
        $this->data['news'] = $news;
//        pre($news);

        $month_now = date('m');
//        pre($month_now);
//        $ngaymua = new DateTime($ngaymua);
//        $ngaymua = $ngaymua->getTimestamp();

//        $input_e['where']['ban'] = $ban;
        $input_e = array();
        $input_e['where']['id >'] = 116;
        $input_e['where']['ban'] = 0;
        $employee_list = $this->employee_model->get_list($input_e);
//        pre($employee_list);

        $index = 0;
        $arr_birthday = array();
        foreach ($employee_list as $key => $value) {
            $month = date('m', $value->birthday);
            if ($month_now == $month) {
//                $employee_birthday[] = $value->id;
//                echo $value->id. '<br />';
                $arr_birthday[$index] = new stdClass();
                $employee_info = $this->employee_model->get_info($value->id);
                $arr_birthday[$index]->name = $employee_info->name;
                $arr_birthday[$index]->birthday = $employee_info->birthday;
                $arr_birthday[$index]->position = $employee_info->position;
                $arr_birthday[$index]->day = date('d', $employee_info->birthday);
                $index++;
            }
        }

        function cmp($a, $b)
        {
            return strcmp($a->day, $b->day);
        }

        usort($arr_birthday, "cmp");
//        pre($birthday);
        $this->data['birthday'] = $arr_birthday;

//       NEW USERS
        $arr_news_users = array();
        $index = 0;
//        pre($employee_list);
        $day_now = date('d-m-Y');
//        pre($day_now);

        $date_sub7 = date_create(date('Y-m-d'));
        date_sub($date_sub7, date_interval_create_from_date_string('7 days'));
        $date_sub7 = date_format($date_sub7, 'd-m-Y');
//        pre($day_now. ' ---'. $date_sub7);

        $day_now = new DateTime($day_now);
        $day_now = $day_now->getTimestamp();

        $date_sub7 = new DateTime($date_sub7);
        $date_sub7 = $date_sub7->getTimestamp();

        foreach ($employee_list as $key => $value) {
//            $month = date('d', $value->ngay_bd);
            if (in_array($value->ngay_bd, range($day_now, $date_sub7))) {
//                $employee_news[] = $value->id;
//                echo $value->id . '<br />';
                $arr_news_users[$index] = new stdClass();
                $employee_info = $this->employee_model->get_info($value->id);
                $arr_news_users[$index]->name = $employee_info->name;
                $arr_news_users[$index]->position = $employee_info->position;
                $arr_news_users[$index]->ngay_bd = $employee_info->ngay_bd;
                $index++;
            }
        }
        function cmp2($a, $b)
        {
            return strcmp($a->ngay_bd, $b->ngay_bd);
        }

        usort($arr_news_users, "cmp2");
        $this->data['users_new'] = $arr_news_users;
//        pre($arr_news_users);
//       END NEW USERS
    }

    function index()
    {
        $input = array();
        $input['order'] = array('ID', 'DESC');
        $input['limit'] = array('5', '0');
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnSearch')) {
            $ban = $this->input->post('ban');
            $notice = $this->input->post('notice');
            if ($notice != 'all') {
                $input['where']['id'] = $notice;
            }
            $input['where']['ban'] = $ban;
            $notice = $this->notice_model->get_list($input);
            $this->data['res'] = $notice;
            $this->data['ban'] = $ban;
            $this->session->set_userdata('notice', $notice);
//            pre($notice);
        }
        $ban = 0;
        $notice = $this->notice_model->get_list($input);
//        pre($notice);
        $this->data['res'] = $notice;
        $this->data['ban'] = $ban;
//        pre($input);

        $this->data['temp'] = 'admin/dashboard/dashboard';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAddnotice')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $sex = $this->input->post('sex');
            $birthday = $this->input->post('birthday');
            $birthday = new DateTime($birthday);
            $birthday = $birthday->getTimestamp();

            $cmtnd = $this->input->post('cmtnd');
            $ngaycap = $this->input->post('ngaycap');
            $ngaycap = new DateTime($ngaycap);
            $ngaycap = $ngaycap->getTimestamp();
            $captai = $this->input->post('captai');
            $identity_card = $cmtnd . '|' . $ngaycap . '|' . $captai;
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $email = $this->input->post('email');
            $position = $this->input->post('position');
            $department = $this->input->post('department');

            // $time = $from.','.$to;
            //pre(date('d/m/Y', $from));
//            $content = $this->input->post('txtContent');
//            $now = new DateTime();
//            $now = $now->getTimestamp();
            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'birthday' => $birthday,
                'sex' => $sex,
                'identity_card' => $identity_card,
                'phone' => $phone,
                'address' => $address,
                'email' => $email,
                'position' => $position,
                'department_id' => $department,
                'role' => 1
            );
//            prev($dataSubmit);
//            die();
//            $insert_id = $this->notice_model->create($dataSubmit);

            if ($this->notice_model->create($dataSubmit)) {
//                thêm vào bảng menu_access
//                $menu = $this->menu_model->get_list();
//
//                foreach ($menu as $value) {
//                    $dataSubmit1 = array(
//                        'notice_id' => $insert_id,
//                        'menu_id' => $value->id,
//                        'access' => 0
//                    );
//                    $this->menu_access_model->create($dataSubmit1);
//                }

                $this->session->set_flashdata('message', 'Thêm nhân sự thành công!');
                redirect(base_url('admin/notice'));
            } else {
                $this->session->set_flashdata('message', 'Thêm nhân sự thất bại!');
                redirect(base_url('admin/notice'));
            }
        }
        $this->data['temp'] = 'admin/notice/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $notice_id = $this->uri->segment(4);
        $notice_id = intval($notice_id);
        //pre($notice_id);
        $notice = $this->notice_model->get_info($notice_id);
//        prev($notice);

//        lấy ngày bắt đầu ở contract_detail
        $date = $contract_id = '';
        $start_date_contract = $this->contract_detail_model->contract_start($notice_id);
//                pre($start_date_contract[0]->start_contract_date);
        if ($start_date_contract) {
            $date = $start_date_contract[0]->start_contract_date;
            $contract_id = $start_date_contract[0]->contract_id;
        }
//        lấy ngày bắt đầu ở contract_detail

        if ($notice == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/notice'));
        } else {
            $this->data['notice'] = $notice;
            $this->data['date'] = $date;
            $this->data['contract_id'] = $contract_id;
        }

        if ($this->input->post('btnUpdatenotice')) {
            $name = $this->input->post('txtName');
            $displayName = $this->input->post('displayName');
            $sex = $this->input->post('sex');
            $birthday = $this->input->post('birthday');
            $birthday = new DateTime($birthday);
            $birthday = $birthday->getTimestamp();
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $email = $this->input->post('email');
            $position = $this->input->post('position');
            $department = $this->input->post('department');
            $cmtnd = $this->input->post('cmtnd');
            $ngaycap = $this->input->post('ngaycap');
            $ngaycap = new DateTime($ngaycap);
            $ngaycap = $ngaycap->getTimestamp();
            $ngaybatdau = $this->input->post('ngaybatdau');
            $contract = $this->input->post('contract');
            if ($ngaybatdau != 'Chưa có thông tin') {
                $ngaybatdau = new DateTime($ngaybatdau);
                $ngaybatdau = $ngaybatdau->getTimestamp();
//                pre($ngaybatdau);
                $this->contract_detail_model->contract_start_update($notice_id, $ngaybatdau, $contract);
            }
            $captai = $this->input->post('captai');
            $identity_card = $cmtnd . '|' . $ngaycap . '|' . $captai;

            $dataSubmit = array(
                'name' => $name,
                'displayName' => $displayName,
                'birthday' => $birthday,
                'sex' => $sex,
                'phone' => $phone,
                'address' => $address,
                'email' => $email,
                'position' => $position,
                'department_id' => $department,
                'identity_card' => $identity_card
            );
            if ($this->notice_model->update($notice_id, $dataSubmit)) {
                $this->session->set_flashdata('message', 'Sửa thông tin nhân sự thành công!');
                redirect(base_url('admin/notice' . '?notice_id=' . $notice_id . '#' . $notice_id));
            } else {
                $this->session->set_flashdata('message', 'Sửa thông tin nhân sự thất bại!');
                redirect(base_url('admin/notice'));
            }
        }

        $this->data['temp'] = 'admin/notice/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $notice_id = $this->uri->segment(4);
        $notice_id = intval($notice_id);
        $notice = $this->notice_model->get_info($notice_id);

        if ($notice == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin nhân sự!');
            redirect(base_url('admin/notice'));
        } else {
//            if ($this->notice_model->delete($notice_id)) {
            $dataSubmit = array(
                'ban' => 1
            );
            if ($this->notice_model->update($notice_id, $dataSubmit)) {
//                $img = './upload/' . $notice->img;
//                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa nhân sự thành công!');
                redirect(base_url('admin/notice'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/notice'));
            }
        }
    }
}