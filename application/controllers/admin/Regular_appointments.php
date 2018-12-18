<?php

Class Regular_appointments extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('area_model');
        $this->load->model('admin_mission_model');
        $this->load->model('service_package_maintenance_model');
        $this->load->model('config_server_model');
        $this->load->model('tbl_gcm_api_key_model');
        $this->load->model('emergency_model');
//        pre($api_key);
//        require_once(APPPATH.'controllers/admin/firebase_sending.php'); //include controller
//        $aObj = new firebase_sending();  //create object
//        $aObj->index(1,2,3,4); //call function

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
        $area = $this->area_model->get_list();
//        $list_emp = $this->asset_model->get_list();
        $this->data['list_emp'] = $list_emp;
        $this->data['area'] = $area;

//        $month = monthyears();
        $this->data['monthyears'] = monthyears();
//        pre($month);
    }

    function index()
    {
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $status = 'all';
        $search = '1';
        $area_id = 'all';
        if (isset($_GET['date1'])) {
            $date1 = $_GET['date1'];
//            pre($date1. '-----'.$date2);
            if ($date1 != '') {
                $asset = $this->admin_mission_model->regular_appointments_list($search, $date1, $status, $area_id);
                $this->data['res'] = $asset;
            }
        }
        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $area_id = $this->input->post('area_id');
            $date1 = date('Y-m-d', strtotime(date('d-') . $this->input->post('date1')));
//            pre($date1);
            $status = $this->input->post('status');
            $asset = $this->admin_mission_model->regular_appointments_list($search, $date1, $status, $area_id);
//            pre($asset_arr);
//            $ban = $this->input->post('ban');
//            $asset = $this->input->post('asset');
//            if ($asset != 'all') {
//                $input['where']['id'] = $asset;
//            }
//            $input['where']['ban'] = $ban;
//            $asset = $this->asset_model->get_list();
//            $this->data['res'] = $asset;
//            $this->data['ban'] = $ban;
//            $this->session->set_userdata('asset', $asset);
////            pre($asset);
//        } //        $asset = $this->asset_model->get_list();
//        else {
//            $asset = $this->admin_mission_model->regular_appointments_list($search, $date1, $date2, $status, $area_id);
//        }
//        pre($asset);
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);

//        pre($asset);
        }
        if (isset($asset)) {
            $asset_arr = array();
            $index = 0;
            foreach ($asset as $k => $v) {
                $index++;
                $asset_arr[$index] = new stdClass();
                $asset_arr[$index]->id = $v->id;
                $asset_arr[$index]->date1 = $date1;
                $input2 = array('where' => array('service_package_user_id' => $v->id, 'DATE_FORMAT(FROM_UNIXTIME(`time`), "%Y-%m") = ' => "" . date("Y-m", strtotime($date1)) . "", 'type' => 2));
//                pre($input2);
                $asset_arr[$index]->admin_arr = $this->service_package_maintenance_model->get_list($input2);
                $asset_arr[$index]->admin_mission = $this->service_package_maintenance_model->get_list(array('where' => array('service_package_user_id' => $v->id, 'type' => 1)));
                $asset_arr[$index]->admin_emergency = $this->emergency_model->get_list(array('where' => array('service_package_user_id' => $v->id, 'DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(`time`,1,10)), "%Y-%m") = ' => "" . date("Y-m", strtotime($date1)) . "")));
                $asset_arr[$index]->district_id = $v->district_id;
                $asset_arr[$index]->name_district = $v->name_district;
                $asset_arr[$index]->user_id = $v->user_id;
                $asset_arr[$index]->fullname = $v->fullname;
                $asset_arr[$index]->address = $v->address;
                $asset_arr[$index]->service_package_id = $v->service_package_id;
            }
            $this->data['res'] = $asset_arr;
//        pre($asset_arr);
        }
        $this->data['temp'] = 'admin/regular_appointments/list';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $cfg = $this->config_server_model->get_list();
        $admin_id = $this->uri->segment(5);
        $id = $this->uri->segment(4);
        $service_package_user_id = $this->uri->segment(6);
        $date1 = $this->uri->segment(7);
//        pre($date1. '----'.$date2);
//        die();
        $info_ad_mission = $this->service_package_maintenance_model->get_info($id);
//        die();
        $where = array(
            'service_package_maintenance_id' => $id
        );
//        pre($dataUpdate);
        $this->admin_mission_model->del_rule($where);

//        get email admin
        $email_ktv = $this->admin_model->get_info($admin_id);
        $mail_to = '';
        if (isset($email_ktv)) {
            $mail_to = $email_ktv->email;
            $fcm_token = $email_ktv->fcm_token;
        }
        // get email admin
//                    get info service_package_user
        $info_service_package_user = $this->admin_mission_model->get_info_user($info_ad_mission->id);
//                    pre($info_service_package_user[0]->fullname);
        $message = '';
        if (!empty($info_service_package_user)) {
//                        $content_mail_username = $info_service_package_user->username;
            $content_mail_fullname = $info_service_package_user[0]->fullname;
            $content_mail_address = $info_service_package_user[0]->address;
            $content_mail_phone = $info_service_package_user[0]->phone;
            $message = "Hủy việc<br/> $info_ad_mission->des <br/>Khách hàng: $content_mail_fullname<br/>  Địa chỉ: $content_mail_address <br/> SĐT: $content_mail_phone ";
        }

        $tbl_gcm_api_key = $this->tbl_gcm_api_key_model->get_info(1);
        $api_key = $tbl_gcm_api_key->api_key;
        $this->load->library('../controllers/admin/firebase_sending');
        //                    get info service_package_user
//                    pre($message);
        if ($this->service_package_maintenance_model->delete($id)) {
            $this->session->set_flashdata('message', 'Cập nhật thành công!');
            $this->firebase_sending->index($api_key, $fcm_token, $title = 'Divuapp', str_replace('<br/>', ';', $message));
            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $mail_to . ',' . $cfg[0]->gmail_to, $message, $attach = '');
//            firebase_sending/index(1,2,3,4,5);
//            redirect(base_url('admin/regular_appointments?date1=$date1 . \'&date2=\' . $date2.\'&asset_id=\'.$id.\'#\'.$id'));
            redirect(base_url('admin/regular_appointments?date1=' . $date1 . '&asset_id=' . $service_package_user_id . '#' . $service_package_user_id));
        } else {
            $this->session->set_flashdata('message', 'Thất bại!');
            redirect(base_url('admin/regular_appointments'));
        }
    }
}