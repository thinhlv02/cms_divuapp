<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('cms_add_money_logs_model');
        $this->load->model('user_model');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->data['temp'] = 'admin/welcome_divu';
//        $this->data['view'] = 'admin/add_money/add';
        $this->load->view('admin/layout', $this->data);
//		$this->load->view('welcome_message');
	}
}
