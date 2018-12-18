<?php

Class Document extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('document_model');
        $this->load->model('company_model');
        $this->load->model('department_model');

        $company = $this->company_model->get_list();
        $this->data['company'] = $company;
        $deparment = $this->department_model->get_list();
        $this->data['deparment'] = $deparment;
    }

    function index()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $input = array();
        $input['order'] = array('id', 'desc');

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
        $this->data['document'] = $document_arr;
//        pre($document_arr);

        $this->data['temp'] = 'admin/document/list';
//        $this->data['view'] = 'admin/document/list';
        $this->load->view('admin/layout', $this->data);
    }

    function add()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        if ($this->input->post('btnAdd')) {
            $date = $this->input->post('date');
            $date = new DateTime($date);
            $date = $date->getTimestamp();
            $code = $this->input->post('code');
            $title = $this->input->post('txtName');
            $intro = $this->input->post('intro');
            $company_id = $this->input->post('company_id');
            $department_id = $this->input->post('department_id');

            $created = new DateTime();
            $created = $created->getTimestamp();

            $config['upload_path'] = './public/images/document';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|pdf';
            $this->load->library("upload", $config);

            if ($this->upload->do_upload('img_document')) {
                $file_data = $this->upload->data();
//                pre($file_data);
                $data = array(
                    'code' => $code,
                    'title' => $title,
                    'intro' => $intro,
                    'date' => $date,
                    'company_id' => $company_id,
                    'department_id' => $department_id,
                    'created' => $created,
                    'img' => $file_data['file_name']
                );
                if ($this->document_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm văn bản thành công');
                    redirect(base_url('admin/document'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            } else {
//                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
                $data = array(
                    'code' => $this->input->post('code'),
                    'title' => $this->input->post('txtName'),
                    'intro' => $this->input->post('intro'),
                    'date' => $date,
                    'company_id' => $company_id,
                    'department_id' => $department_id,
                    'created' => $created
                );
                if ($this->document_model->create($data)) {
                    $this->session->set_flashdata('message', 'Thêm văn bản thành công');
                    redirect(base_url('admin/document'));
                } else {
                    $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
                }
            }
        }
        $this->data['temp'] = 'admin/document/add';
//        $this->data['view'] = 'admin/document/add';
        $this->load->view('admin/layout', $this->data);
    }

    function edit()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $id = $this->uri->segment(4);
        $document = $this->document_model->get_info($id);
        $date = $this->input->post('date');
        $date = new DateTime($date);
        $date = $date->getTimestamp();
        if (!$document) {
            redirect(base_url('admin/document'));
        }

        if ($this->input->post('btnEdit')) {
            $created = new DateTime();
            $data = array(
                'code' => $this->input->post('code'),
                'title' => $this->input->post('txtName'),
                'intro' => $this->input->post('intro'),
                'date' => $date,
                'company_id' => $this->input->post('company_id'),
                'department_id' => $this->input->post('department_id'),
                'created' => $created->getTimestamp()
            );
//            pre($data);

            $config['upload_path'] = './public/images/document';
            $config['allowed_types'] = 'jpg|png|jpeg|JPEG|pdf';
            $this->load->library("upload", $config);
            if ($this->upload->do_upload('img_document')) {
                $file_data = $this->upload->data();
                $data['img'] = $file_data['file_name'];
                unlink('./public/images/document/' . $document->img);
            } else {
                $this->session->set_flashdata('message', $this->upload->display_errors('', ''));
//                return;
            }
//            pre($data);
            if ($this->document_model->update($id, $data)) {
                $this->session->set_flashdata('message', 'Cập nhật văn bản thành công');
                redirect(base_url('admin/document'));
            } else {
                $this->session->set_flashdata('message', 'Lỗi thao tác cơ sở dữ liệu');
            }
        }

        $this->data['document'] = $document;
        $this->data['temp'] = 'admin/document/edit';
//        $this->data['view'] = 'admin/document/edit';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $id = $this->uri->segment(4);
        $document = $this->document_model->get_info($id);
        if ($document) {
            $this->document_model->delete($id);
            unlink('./public/images/document/' . $document->img);
        }
        redirect(base_url('admin/document'));
    }

    public function document_details($slug = '', $id = 0)
    {
//        pre($slug);
        $detail = $this->document_model->get_info($id);
        $document = $this->document_model->get_list(array('limit' => array(5, 0), 'order' => array('id', 'desc')));

//        pre($detail);
        if ($detail && $slug == create_slug($detail->title)) {
            $this->data['document'] = $document;
            $this->data['detail'] = $detail;
            $this->data['temp'] = 'admin/document/document_details';

        } else {
//            redirect(base_url());
            $this->data['document'] = $document;
            $this->data['temp'] = 'admin/document/document_list';
        }
        $this->load->view('admin/layout', $this->data);
    }
}