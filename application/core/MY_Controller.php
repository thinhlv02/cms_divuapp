<?php

Class MY_Controller extends CI_Controller
{
    public $data = array();

    function __construct()
    {
        parent::__construct();
        $new_url = $this->uri->segment(1);
//        pre ($new_url);
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $this->load->model('area_model');
        $this->load->model('vn_city_model');
        $this->load->model('config_payment_money_model');
        $this->load->model('admin_emergency_model');

        $input = array();
        $input['order'] = array('id', 'asc');
        $area = $this->area_model->get_list($input);
//        $area = $this->area_model->get_list(array('order' => array('id','asc')));
//        pre($area);
        $this->data['area'] = $area;
        $vn_city = $this->vn_city_model->get_list($input);
        $this->data['vn_city'] = $vn_city;
        $money_id = $this->config_payment_money_model->get_list($input);
        $this->data['money_id'] = $money_id;
        $dropdown_menu = $this->admin_emergency_model->dropdown_menu_list();
        $this->data['dropdown_menu'] = $dropdown_menu;

        switch ($new_url) {
            case 'admin' :
                {
                    $this->load->model('menu_model');
                    $this->load->model('menu_access_model');
//                    $this->load->model('employee_model');
                    $this->_check_login();
                    $admin = $this->session->userdata('admin');
                    $this->data['admin'] = $this->session->userdata('admin');
                    if (isset($admin)) {
                        /*lưu session menu_access*/
                        $input = array();
                        $input['where'] = array(
                            'employee_id' => $admin->id
                        );
                        $input['order'] = array('id', 'asc');
                        $menu_access = $this->menu_access_model->get_list($input);
                        $menu_access_ad = $this->menu_model->get_list(array('order' => array('id','asc')));
                        $access = array();
                        foreach ($menu_access as $value) {
//                            $access[$value->menu_id] = $value->access;
                            $access[$value->menu_id] = $value->access . ',' . $value->access2 . ',' . $value->access3;
                        }

                        $access_ad = array();
                        foreach ($menu_access_ad as $value2) {
                            $access_ad[$value2->id] = $value2->access . ',' . $value2->access2 . ',' . $value2->access3;
                        }
//                $this->data['menu_access'] = $admin;

                        if ($admin->UserName == 'admin'){
                            $access = $access_ad;
                        }
                        $this->session->set_userdata('menu_access', $access);
//                $access = $this->session->userdata('menu_access');
//                pre($access[1]);
                        /*lưu session menu_access*/
                    }
                    break;
                }

            default:
                {
                }
        }
    }

    private function _check_login()
    {
        $controller = $this->uri->rsegment('1');
        $controller = strtolower($controller);

        $login = $this->session->userdata('login');
        //neu ma chua dang nhap,ma truy cap 1 controller khac login
        if (!$login && $controller != 'login') {
            redirect(base_url('admin/login'));
        }
        //neu ma admin da dang nhap thi khong cho phep vao trang login nua.
        if ($login && $controller == 'login') {
            redirect(base_url('admin/ccu'));
        }
    }
}