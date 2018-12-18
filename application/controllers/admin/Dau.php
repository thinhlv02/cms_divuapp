<?php

Class Dau extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('dau_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
//        $date1 = $date2 = '';
        $date1 = $date2 = date('Y-m-d');
        $go = 0;
        if ($this->input->post('search')) {
//            $from = $this->input->post('btnAdd');
            $date1 = date('Y-m-d', strtotime($this->input->post('date1')));
            $date2 = date('Y-m-d', strtotime($this->input->post('date2')));
            $date1x = date_create(" " . $date1 . " ");
            $date2x = date_create(" " . $date2 . " ");
            $diff = date_diff($date1x, $date2x);
            $go = $diff->format("%a");
            $dau = $this->dau_model->getlist_cutoff_dau2($date1,$date2,$go);
        }else {
            $dau = $this->dau_model->getlist_cutoff_dau2($date1,$date2,$go);
//            pre($dau);
        }
//        pre($dau);
//        $input = array();
//        $input['where']['type'] = 1;
//        $input['order'] = array('id', 'desc');

//        $dau = $this->dau_model->function_getlist_cutoff_dau2($input);
//        $this->data['res'] = $dau;
//        pre($dau);
        $this->data['temp'] = 'admin/dau/list';
        $this->data['dau'] = $dau;
        $this->data['go'] = $go;
        $this->load->view('admin/layout', $this->data);
    }
}