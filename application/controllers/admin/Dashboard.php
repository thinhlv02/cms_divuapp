<?php

Class Dashboard extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('notice_model');
        $this->load->model('document_model');
        $this->load->model('company_model');
        $this->load->model('department_model');
        $this->load->model('news_model');
        $this->load->model('news2_model');
        $this->load->model('employee_model');
        $input = array();
        $input['order'] = array('ID', 'DESC');
        $input['limit'] = array('5', '0');
//        $notice = $this->notice_model->get_list($input);
//        $this->data['res'] = $notice;

        $input_n = array();
        $input_n['order'] = array('id', 'desc');
        $input_n['limit'] = array('1', '0');
        $news = $this->news_model->get_list($input_n);
//        pre($notice);
        $this->data['news'] = $news;
//        pre($news);

//        bảng tin
        $news2 = $this->news2_model->get_list(array('order' => array('id', 'desc'), 'limit' => array('5', '0')));
//        pre($notice);
        $this->data['news2'] = $news2;
//        pre($news2);
//        bảng tin


        $month_now = date('m');
//        pre($month_now);

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
                $department_info = $this->department_model->get_info($value->department_id);
                $arr_birthday[$index]->name = $employee_info->name;
                $arr_birthday[$index]->birthday = $employee_info->birthday;
                $arr_birthday[$index]->position = $employee_info->position;
                $arr_birthday[$index]->department = $department_info->name;
                $arr_birthday[$index]->day = date('d', $employee_info->birthday);
                $arr_birthday[$index]->img =  $employee_info->img;
                $index++;
            }
        }

        function cmp($a, $b)
        {
            return strcmp($a->day, $b->day);
        }

        usort($arr_birthday, "cmp");
        $this->data['birthday'] = $arr_birthday;
//        pre($arr_birthday);

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
//                pre($date_sub7 . '--- '.$day_now);
//        pre($employee_lis/t);

        foreach ($employee_list as $key => $value) {
//            $month = date('d', $value->ngay_bd);
//            if (in_array($value->ngay_bd, range($day_now, $date_sub7))) {
            if ($value->ngay_bd <= $day_now && $value->ngay_bd >= $date_sub7) {
//                $employee_news[] = $value->id;
//                echo $value->ngay_bd . '<br />';
                $arr_news_users[$index] = new stdClass();
                $employee_info = $this->employee_model->get_info($value->id);
                $department_info = $this->department_model->get_info($value->department_id);
                $arr_news_users[$index]->name = $employee_info->name;
                $arr_news_users[$index]->position = $employee_info->position;
                $arr_news_users[$index]->department = $department_info->name;
                $arr_news_users[$index]->ngay_bd = $employee_info->ngay_bd;
                $arr_news_users[$index]->img =  $employee_info->img;
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
//        if ($this->input->post('btnSearch')) {
//            $ban = $this->input->post('ban');
//            $notice = $this->input->post('notice');
//            if ($notice != 'all') {
//                $input['where']['id'] = $notice;
//            }
//            $input['where']['ban'] = $ban;
//            $notice = $this->notice_model->get_list($input);
//            $this->data['res'] = $notice;
//            $this->data['ban'] = $ban;
//            $this->session->set_userdata('notice', $notice);
////            pre($notice);
//        }
        $ban = 0;
        $notice = $this->notice_model->get_list($input);
        $document = $this->document_model->get_list($input);

        //        pre($document);
        $index = 0;
        $document_arr = array();
        foreach ($document as $key => $value) {
//            echo $value->id . '<br />';
            $company_name = $this->company_model->get_info($value->company_id)->name;
            $department_name = $this->department_model->get_info($value->department_id)->name;
//            pre($company_name);
            $document_arr[$index] = new stdClass();
            $document_arr[$index]->id = $value->id;
            $document_arr[$index]->code = $value->code;
            $document_arr[$index]->title = $value->title;
            $document_arr[$index]->intro = $value->intro;
            $document_arr[$index]->date = $value->date;
            $document_arr[$index]->company_name = $company_name;
            $document_arr[$index]->department_name = $department_name;
            $document_arr[$index]->img = $value->img;
            $index++;
        }
//        $this->data['document'] = $document_arr;
//        pre($document_arr);
//        pre($notice);
        $this->data['res'] = $notice;
        $this->data['dcm'] = $document_arr;
        $this->data['ban'] = $ban;
//        pre($input);
        $this->data['temp'] = 'admin/dashboard/dashboard';
        $this->load->view('admin/layout', $this->data);
    }
}