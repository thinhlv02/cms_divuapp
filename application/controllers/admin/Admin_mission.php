<?php

Class Admin_mission extends MY_Controller
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
    }

    function index()
    {
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $status = 'all';
        $search = 'all';
        $area_id = 'all';
        if (isset($_GET['date1']) && $_GET['date2']) {
            $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];
//            pre($date1. '-----'.$date2);
            if ($date1 != '' && $date2 != '') {
                $asset = $this->admin_mission_model->get_info_logs($search, $date1, $date2, $status, $area_id);
                $this->data['res'] = $asset;
            }
        }
        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $area_id = $this->input->post('area_id');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
//            pre($date2);
            $status = $this->input->post('status');
            $asset = $this->admin_mission_model->get_info_logs($search, $date1, $date2, $status, $area_id);

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
//            $asset = $this->admin_mission_model->get_info_logs($search, $date1, $date2, $status, $area_id);
//        }
//        pre($asset);
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);
            $this->data['res'] = $asset;
//        pre($asset);
        }
        $this->data['temp'] = 'admin/admin_mission/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add($id, $district_id, $city_work_id, $date1, $date2)
    {
        $cfg = $this->config_server_model->get_list();
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $info = $this->service_package_maintenance_model->get_info($id);
        $this->data['info'] = $info;
        $input_e2 = array();
//        $input_e2['where']['district_work_id'] = $district_id;
        $input_e2['where']['city_work_id'] = $city_work_id;
        $input_e2['where_in'] = array('level', array('4', '6'));
        $list_emp_child = $this->admin_model->get_list($input_e2);
        $this->data['list_emp_child'] = $list_emp_child;
//        pre($input_e2);
//        pre($list_emp_child);
//        pre($info->des);
        if ($this->input->post('btnAddadmin_mission')) {
            $emp = $this->input->post('emp');
            $dataSubmit = array(
                'admin_id' => $emp,
                'name' => $info->des,
                'service_package_maintenance_id' => $info->id
            );
//            prev($dataSubmit);
            $list_id_employee = $this->service_package_maintenance_model->get_info($id);
//            pre($list_id_employee);
            $tags2 = array();
            if ($list_id_employee->admin_id != '') {
                $tags = explode(',', $list_id_employee->admin_id);
                foreach ($tags as $key => $value_new) {
//                    echo $key.'----'. $value_new.'<br>';
//                    pre('abc');
                    $tags2[] = $value_new;
                }
//                pre($tags2);
            }
            if (in_array($emp, $tags2)) {
//                   pre($emp);
                $this->session->set_flashdata('message', 'KTV này đã thêm rồi, kiểm tra lại');
//                redirect(base_url('admin/admin_mission/'));
                redirect(base_url('admin/admin_mission?date1=' . $date1 . '&date2=' . $date2 . '&asset_id=' . $id . '#' . $id));
            }
//            if (strpos($list_id_employee->admin_id, $emp) !== false) {
//                $this->session->set_flashdata('message', 'KTV này đã thêm rồi, kiểm tra lại');
//                redirect(base_url('admin/admin_mission/'));
//            }

            else {
                //                nếu không trùng lịch các địa điểm khác
                $insert_id = $this->admin_mission_model->create($dataSubmit);
                $day_db = '';
                if ($insert_id >= 0) {
//                pre($insert_id);
                    $where = array(
                        'id' => $id
                    );
//                $list_id_employee = $this->service_package_maintenance_model->get_info($id);
//                pre($list_id_employee->admin_id);
                    if ($list_id_employee->admin_id == NULL) {
                        $data = array(
                            'admin_id' => $emp
                        );
                    } else {
                        $data = array(
                            'admin_id' => $list_id_employee->admin_id . ',' . $emp
                        );
                    }
//                    pre($day_db);
                    $this->service_package_maintenance_model->update_rule($where, $data);
//            if ($this->teach_model->demo($emp, $branch, $start, $end)) {
//                    get email admin
                    $email_ktv = $this->admin_model->get_info($emp);
                    $mail_to = '';
                    if (isset($email_ktv)) {
                        $mail_to = $email_ktv->email;
                        $fcm_token = $email_ktv->fcm_token;
                    }
                    // get email admin
//                    get info service_package_user
                    $info_service_package_user = $this->admin_mission_model->get_info_user($info->id);
//                    pre($info_service_package_user[0]->fullname);
                    $message = '';
                    if (!empty($info_service_package_user)) {
//                        $content_mail_username = $info_service_package_user->username;
                        $content_mail_fullname = $info_service_package_user[0]->fullname;
                        $content_mail_address = $info_service_package_user[0]->address;
                        $content_mail_phone = $info_service_package_user[0]->phone;
                        $message = "Bạn được giao công việc<br/> $info->des <br/>Khách hàng: $content_mail_fullname<br/>  Địa chỉ: $content_mail_address <br/> SĐT: $content_mail_phone ";
                    }
                    //                    get info service_package_user
//                    pre($message);
                    $this->session->set_flashdata('message', 'Thêm thành công');
//                    pre($info->des);
                    $tbl_gcm_api_key = $this->tbl_gcm_api_key_model->get_info(1);
                    $api_key = $tbl_gcm_api_key->api_key;
                    $this->load->library('../controllers/admin/firebase_sending');
//                    $this->firebase_sending->index($api_key,$fcm_token, $title = 'Divuapp', $message);
                    $this->firebase_sending->index($api_key, $fcm_token, $title = 'Divuapp', str_replace('<br/>', ';', $message));

                    email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $mail_to, $message, $attach = '');
                    redirect(base_url('admin/admin_mission?date1=' . $date1 . '&date2=' . $date2 . '&asset_id=' . $id . '#' . $id));
//                    redirect(base_url('admin/admin_mission/'));
                } else {
                    $this->session->set_flashdata('message', 'Thêm thất bại!');
                    redirect(base_url('admin/admin_mission/'));
                }
            }
        }
        $this->data['temp'] = 'admin/admin_mission/add';
        $this->load->view('admin/layout', $this->data);
    }

//    function edit($id, $week)
//    {
//        $admin_id = $this->uri->segment(4);
//        $id = $this->uri->segment(5);
//
//        $info_ad_mission = $this->service_package_maintenance_model->get_info($id);
//        $this->data['info'] = $info_ad_mission;
//        $this->data['admin_id'] = $admin_id;
//        $new_admin_id = $info_ad_mission->admin_id;
////        $arr_id_teach = explode(',', $new_admin_id);
//        if ($this->input->post('btnAddadmin_mission')) {
//            if (strpos($new_admin_id, ',') > 0) {
//                $new_admin_id = str_replace($admin_id . ',', '', $new_admin_id);
//                $new_admin_id = str_replace(',' . $admin_id, '', $new_admin_id);
////            $new_admin_id = str_replace( ',,',',', $new_admin_id);
//            } else {
//                $new_admin_id = '';
//            }
////        pre($admin_id);
////        pre($new_admin_id);
//            $dataUpdate = array(
//                'admin_id' => $new_admin_id
//            );
//            $where = array(
//                'admin_id' => $admin_id,
//                'service_package_maintenance_id' => $id
//            );
////        pre($dataUpdate);
//            $this->admin_mission_model->del_rule($where);
//            if ($this->service_package_maintenance_model->update($id, $dataUpdate)) {
//                $this->session->set_flashdata('message', 'Cập nhật thành công!');
//                redirect(base_url('admin/admin_mission/'));
//            } else {
//                $this->session->set_flashdata('message', 'Thất bại!');
//                redirect(base_url('admin/admin_mission'));
//            }
//        }
//
//        $this->data['temp'] = 'admin/admin_mission/edit';
//        $this->load->view('admin/layout', $this->data);
//    }

    function del()
    {
        $cfg = $this->config_server_model->get_list();
        $admin_id = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $date1 = $this->uri->segment(6);
        $date2 = $this->uri->segment(7);
//        pre($date1. '----'.$date2);
//        die();
        $info_ad_mission = $this->service_package_maintenance_model->get_info($id);
        $new_admin_id = $info_ad_mission->admin_id;
//        pre($new_admin_id);
        if ($new_admin_id != '') {
            $tags = explode(',', $new_admin_id);
            foreach ($tags as $key => $value_new) {
                if ($value_new != $admin_id) {
                    $tags2[] = $value_new;
                }
            }
            $new_admin_id = implode(',', $tags2);
//            pre($new_admin_id);
        }
//        $arr_id_teach = explode(',', $new_admin_id);
//        if (strpos($new_admin_id, ',') > 0) {
////        if (strpos('17,1,7', ',') > 0) {
//            $new_admin_id = str_replace($admin_id . ',', '', $new_admin_id);
//            $new_admin_id = str_replace(',' . $admin_id, '', $new_admin_id);
////            $new_admin_id = str_replace( ',,',',', $new_admin_id);
//        }
//
//        else {
//            $new_admin_id = '';
//        }
//        pre($admin_id);
//        pre($new_admin_id);
//        die();
        $dataUpdate = array(
            'admin_id' => $new_admin_id
        );
        $where = array(
            'admin_id' => $admin_id,
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
        if ($this->service_package_maintenance_model->update($id, $dataUpdate)) {
            $this->session->set_flashdata('message', 'Cập nhật thành công!');
            $this->firebase_sending->index($api_key, $fcm_token, $title = 'Divuapp', str_replace('<br/>', ';', $message));
            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $mail_to, $message, $attach = '');
//            firebase_sending/index(1,2,3,4,5);
//            redirect(base_url('admin/admin_mission?date1=$date1 . \'&date2=\' . $date2.\'&asset_id=\'.$id.\'#\'.$id'));
            redirect(base_url('admin/admin_mission?date1=' . $date1 . '&date2=' . $date2 . '&asset_id=' . $id . '#' . $id));
        } else {
            $this->session->set_flashdata('message', 'Thất bại!');
            redirect(base_url('admin/admin_mission'));
        }
    }
}