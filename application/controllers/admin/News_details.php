<?php

Class News extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('id', 'desc');

        $news = $this->news_model->get_list($input);
        $this->data['news'] = $news;
//        pre($news);
        $this->data['temp'] = 'admin/news/list';
//        $this->data['view'] = 'admin/news/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $title = $this->input->post('txtName');

            $intro = $this->input->post('intro');
            $content = $this->input->post('txtContent');
            $link = $this->input->post('link');
            $created = new DateTime();
            $created = $created->getTimestamp();

            $config['upload_path'] = './public/images/news';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_news')) {
                $file_data = $this->upload->data();
//                pre($file_data);
                $data = array(
                    'title' => $title,
                    'intro' => $intro,
                    'content' => $content,
                    'link' => $link,
                    'created' => $created,
                    'img' => $file_data['file_name']
                );
                if ($this->news_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm tin tức thành công');
                    redirect(base_url('admin/news'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            } else {
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
                $data = array(
                    'title' => $title,
                    'intro' => $intro,
                    'content' => $content,
                    'link' => $link,
                    'created' => $created
                );
                if ($this->news_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm tin tức thành công');
                    redirect(base_url('admin/news'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/news/add';
//        $this->data['view'] = 'admin/news/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $news = $this->news_model->get_info($id);
        if (!$news) {
            redirect(base_url('admin/news'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'title' => $this->input->post('txtName'),
                'intro' => $this->input->post('intro'),
                'content' => $this->input->post('txtContent'),
                'link' => $this->input->post('link'),
                'created' => $created->getTimestamp()
            );
//            pre($data);

            $config['upload_path'] = './public/images/news';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_news')) {
                $file_data = $this->upload->data();
                $data['img'] = $file_data['file_name'];
                unlink('./public/images/news/' . $news->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->news_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật tin tức thành công');
                redirect(base_url('admin/news'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['news'] = $news;
        $this->data['temp'] = 'admin/news/edit';
//        $this->data['view'] = 'admin/news/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $news = $this->news_model->get_info($id);
        if ($news) {
            $this->news_model->delete($id);
            unlink('./public/images/news/' . $news->img);
        }
        redirect(base_url('admin/news'));
    }

    public function news_details($slug = '', $id = 0){
        $detail = $this->news_model->get_info($id);
        if($detail && $slug == create_slug($detail->title)){

        }
        else{
            redirect(base_url());
        }
        $news = $this->news_model->get_list(array('limit'=>array(5 ,0)));
        $this->data['detail'] = $detail;
        $this->data['news'] = $news;
        $this->data['temp'] = 'admin/news/news_details';
        $this->load->view('site/layout/layout', $this->data);
    }
}