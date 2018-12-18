<?php

Class news2 extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('news2_model');
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('id', 'desc');

        $news2 = $this->news2_model->get_list($input);
        $this->data['news2'] = $news2;
//        pre($news2);
        $this->data['temp'] = 'admin/news2/list';
//        $this->data['view'] = 'admin/news2/list';
        $this->load->view('admin/layout', $this->data);
    }

//    function add()
//    {
//        $message = $this->session->flashdata('message');
//        $this->data['message'] = $message;
//        if ($this->input->post('btnAdd')) {
//            $title = $this->input->post('txtName');
//            $intro = $this->input->post('intro');
//            $content = $this->input->post('txtContent');
//            $link = $this->input->post('link');
//            $created = new DateTime();
//            $created = $created->getTimestamp();
////            pre($created);
//            $config['upload_path'] = './public/images/news';
//            $config['allowed_types'] = 'jpg|png|jpeg|JPEG';
//            $this->load->library("upload", $config);
//
//            if ($this->upload->do_upload('img_news2')) {
//                $file_data = $this->upload->data();
////                pre($file_data);
//                $data = array(
//                    'title' => $title,
//                    'intro' => $intro,
//                    'content' => $content,
//                    'link' => $link,
//                    'created' => $created,
//                    'img' => $file_data['file_name']
//                );
//                if ($this->news2_model->create($data)) {
//                    $this->session->set_flashdata('message', 'Thêm bảng tin thành công');
//                    redirect(base_url('admin/news2'));
//                } else {
//                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
//                }
//            } else {
////                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                $data = array(
//                    'title' => $title,
//                    'intro' => $intro,
//                    'content' => $content,
//                    'link' => $link,
//                    'created' => $created
//                );
//                if ($this->news2_model->create($data)) {
//                    $this->session->set_flashdata('message', 'Thêm bảng tin thành công');
//                    redirect(base_url('admin/news2'));
//                } else {
//                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
//                }
//            }
//        }
//        $this->data['temp'] = 'admin/news2/add';
////        $this->data['view'] = 'admin/news2/add';
//        $this->load->view('admin/layout', $this->data);
//    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $created = new DateTime();
            $data = array(
                'title' => $this->input->post('txtName'),
                'intro' => $this->input->post('intro'),
                'content' => $this->input->post('txtContent'),
//                'link' => $this->input->post('link'),
                'created' => $created->getTimestamp()
            );

//            pre($created);
            $config['upload_path'] = './public/images/news';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|pdf';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_news2')) {
                $file_data = $this->upload->data();
                $data['img'] = $file_data['file_name'];
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
            if ($this->news2_model->create($data)) {
                $this->session->set_flashdata('message', 'Thêm bảng tin thành công');
                redirect(base_url('admin/news2'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }
        $this->data['temp'] = 'admin/news2/add';
//        $this->data['view'] = 'admin/news2/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $news2 = $this->news2_model->get_info($id);
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
            if ($this->news2_model->update($id, $data)) {
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
        $news2 = $this->news2_model->get_info($id);
        if ($news2) {
            $this->news2_model->delete($id);
            unlink('./public/images/news2/' . $news2->img);
        }
        redirect(base_url('admin/news2'));
    }

    public function news2_details($slug = '', $id = 0)
    {
//        pre($slug);
        $detail = $this->news2_model->get_info($id);
        $news2 = $this->news2_model->get_list(array('limit' => array(5, 0), 'order' => array('id', 'desc')));

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