<?php

Class Admin_emergency extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('admin_emergency_model');
        $this->load->model('emergency_model');
        $this->load->model('config_server_model');
        $this->load->model('tbl_gcm_api_key_model');
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
        $status = 'all';
        $search = 'all';
        $area_id = 'all';
        if (isset($_GET['date1']) && $_GET['date2']) {
            $date1 = $_GET['date1'];
            $date2 = $_GET['date2'];
//            pre($date1. '-----'.$date2);
            if ($date1 != '' && $date2 != '') {
                $asset = $this->admin_emergency_model->get_info_logs($search, $date1, $date2, $status, $area_id);
                $this->data['res'] = $asset;
            }
        }
        if ($this->input->post('search')) {
            $search = 1;
//            pre('fuck');
            $area_id = $this->input->post('area_id');
            $date1 = date('Y-m-d',strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d',strtotime($this->input->post('date2')));
//            pre($date1);
            $status = $this->input->post('status');
            $asset = $this->admin_emergency_model->get_info_logs($search, $date1, $date2, $status, $area_id);

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
//            $asset = $this->admin_emergency_model->get_info_logs($search, $date1, $date2, $status, $area_id);
//        }
//        pre($asset);
//        pre($arr_asset);
//        $this->session->set_userdata('Asset', $arr_asset);
            $this->data['res'] = $asset;
        }
//        pre($asset);
        $this->data['temp'] = 'admin/admin_emergency/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add($id, $district_id, $province_id, $date1, $date2)
    {
        $cfg = $this->config_server_model->get_list();
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $info = $this->emergency_model->get_info($id);
        $this->data['info'] = $info;

        $input_e2 = array();
//        $input_e2['where']['district_work_id'] = $district_id;
        $input_e2['where']['city_work_id'] = $province_id;
        $list_emp_child = $this->admin_model->get_list($input_e2);
        $this->data['list_emp_child'] = $list_emp_child;
//        pre($info->des);
        if ($this->input->post('btnAddadmin_emergency')) {
            $emp = $this->input->post('emp');
            $dataSubmit = array(
                'admin_id' => $emp,
                'emergency_id' => $info->id
            );
//            prev($dataSubmit);
            $list_id_employee = $this->emergency_model->get_info($id);
            $tags2 = array();
            if ($list_id_employee->partner_id != '') {
                $tags = explode(',', $list_id_employee->partner_id);
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
//                redirect(base_url('admin/admin_emergency/'));
                redirect(base_url('admin/admin_emergency?date1=' . $date1 . '&date2=' . $date2 . '&asset_id=' . $id . '#' . $id));
            }
//            if (strpos($list_id_employee->partner_id, $emp) !== false) {
//                $this->session->set_flashdata('message', 'KTV này đã thêm rồi, kiểm tra lại');
//                redirect(base_url('admin/admin_emergency/'));
//            }
            else {
                //                nếu không trùng lịch các địa điểm khác
                $insert_id = $this->admin_emergency_model->create($dataSubmit);
                $day_db = '';
                if ($insert_id >= 0) {
//                pre($insert_id);
                    $where = array(
                        'id' => $id
                    );
//                $list_id_employee = $this->emergency_model->get_info($id);
//                pre($list_id_employee->partner_id);
                    if ($list_id_employee->partner_id == NULL) {
                        $data = array(
                            'partner_id' => $emp
                        );
                    } else {
                        $data = array(
                            'partner_id' => $list_id_employee->partner_id . ',' . $emp
                        );
                    }
//                    pre($day_db);
                    $this->emergency_model->update_rule($where, $data);
                    //                    get email admin
                    $email_ktv = $this->admin_model->get_info($emp);
                    $mail_to = '';
                    if (isset($email_ktv)) {
                        $mail_to = $email_ktv->email;
                        $fcm_token = $email_ktv->fcm_token;
                    }
                    // get email admin
//                    get info service_package_user
                    $info_service_package_user = $this->admin_emergency_model->get_info_user($info->id);
//                    pre($info_service_package_user[0]->fullname);
                    $message = '';
                    if (!empty($info_service_package_user)) {
//                        $content_mail_username = $info_service_package_user->username;
                        $content_mail_fullname = $info_service_package_user[0]->fullname;
                        $content_mail_address = $info_service_package_user[0]->address;
                        $content_mail_phone = $info_service_package_user[0]->phone;
                        $attach = $info_service_package_user[0]->images;
                        $message = "Cứu hộ khẩn cấp: $info->des <br/>Khách hàng: $content_mail_fullname<br/>  Địa chỉ: $content_mail_address <br/> SĐT: $content_mail_phone ";
                    }
//                    pre('abccccccccccccc '.$message);
                    //                    get info service_package_user
                    $this->session->set_flashdata('message', 'Thêm thành công');
                    $tbl_gcm_api_key = $this->tbl_gcm_api_key_model->get_info(1);
                    $api_key = $tbl_gcm_api_key->api_key;
                    $this->load->library('../controllers/admin/firebase_sending');
//                    $this->firebase_sending->index($api_key, $fcm_token, $title = 'Divuapp',$message);
                    $this->firebase_sending->index($api_key, $fcm_token, $title = 'Divuapp', str_replace('<br/>', ';', $message));

                    email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $mail_to, $message, $attach);
                    redirect(base_url('admin/admin_emergency?date1=' . $date1 . '&date2=' . $date2 . '&asset_id=' . $id . '#' . $id));

//                    $this->session->set_userdata($emp);
//                    $this->session->set_userdata('user_id_emergency', $emp);
//                    $user_id_emergency = $this->session->userdata('user_id_emergency');
//                    redirect(base_url('admin/admin_emergency/'));
//                    pre($user_id_emergency);

                    ?>
                    <!--                    <script src="--><?php //echo admin_theme() ?><!--vendors/jquery/dist/jquery.min.js"></script>-->
                    <!--                    <script>-->
                    <!--                        $.ajax({-->
                    <!--                            url: '--><?php //echo base_url('admin/firebase_push')?><!--',-->
                    <!--                            type: 'POST',-->
                    <!--                            data: {-->
                    <!--                                'user_id': --><?php //echo $user_id_emergency ?>
                    <!--                            },-->
                    <!--                            success: function (response) {-->
                    <!--                                alert(response);-->
                    <!--                                console.log('ttttttttt');-->
                    <!--                            }-->
                    <!--                        });-->
                    <!--                    </script>-->
                    <?php
                } else {
                    $this->session->set_flashdata('message', 'Thêm thất bại!');
                    redirect(base_url('admin/admin_emergency/'));
                }
            }
        }
        $this->data['temp'] = 'admin/admin_emergency/add';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $cfg = $this->config_server_model->get_list();
        $admin_id = $this->uri->segment(4);
        $id = $this->uri->segment(5);
        $date1 = $this->uri->segment(6);
        $date2 = $this->uri->segment(7);

        $info_ad_mission = $this->emergency_model->get_info($id);
        $new_admin_id = $info_ad_mission->partner_id;
//        $arr_id_teach = explode(',', $new_admin_id);
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
//        if (strpos($new_admin_id, ',') > 0) {
//            $new_admin_id = str_replace($admin_id . ',', '', $new_admin_id);
//            $new_admin_id = str_replace(',' . $admin_id, '', $new_admin_id);
////            $new_admin_id = str_replace( ',,',',', $new_admin_id);
//        } else {
//            $new_admin_id = '';
//        }
//        pre($admin_id);
//        pre($new_admin_id);
        $dataUpdate = array(
            'partner_id' => $new_admin_id
        );
        $where = array(
            'admin_id' => $admin_id,
            'emergency_id' => $id
        );
//        pre($dataUpdate);
        $this->admin_emergency_model->del_rule($where);

        //                    get email admin
        $email_ktv = $this->admin_model->get_info($admin_id);
        $mail_to = '';
        if (isset($email_ktv)) {
            $mail_to = $email_ktv->email;
            $fcm_token = $email_ktv->fcm_token;
        }
        // get email admin
//                    get info service_package_user
        $info_service_package_user = $this->admin_emergency_model->get_info_user($info_ad_mission->id);
//                    pre($info_service_package_user[0]->fullname);
        $message = '';
        if (!empty($info_service_package_user)) {
//                        $content_mail_username = $info_service_package_user->username;
            $content_mail_fullname = $info_service_package_user[0]->fullname;
            $content_mail_address = $info_service_package_user[0]->address;
            $content_mail_phone = $info_service_package_user[0]->phone;
            $attach = $info_service_package_user[0]->images;
            $message = "Hủy việc Cứu hộ khẩn cấp: $info_ad_mission->des <br/>Khách hàng: $content_mail_fullname<br/>  Địa chỉ: $content_mail_address <br/> SĐT: $content_mail_phone ";
        }
//                    pre('abccccccccccccc '.$message);

        if ($this->emergency_model->update($id, $dataUpdate)) {
            $this->session->set_flashdata('message', 'Cập nhật thành công!');
//            redirect(base_url('admin/admin_emergency/'));
            $tbl_gcm_api_key = $this->tbl_gcm_api_key_model->get_info(1);
            $api_key = $tbl_gcm_api_key->api_key;
            $this->load->library('../controllers/admin/firebase_sending');
            $this->firebase_sending->index($api_key, $fcm_token, $title = 'Divuapp', str_replace('<br/>', ';', $message));

            email_sending($this, $cfg[0]->gmail_send, $cfg[0]->gmail_password, $mail_to, $message, $attach);
            redirect(base_url('admin/admin_emergency?date1=' . $date1 . '&date2=' . $date2 . '&asset_id=' . $id . '#' . $id));
        } else {
            $this->session->set_flashdata('message', 'Thất bại!');
            redirect(base_url('admin/admin_emergency'));
        }
    }
}