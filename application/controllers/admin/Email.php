<?php

class Email extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
//        $this->load->library('email');
//        $this->load->library('parser');
        $this->load->model('config_server_model');
    }

    public function index()
    {
        $config_list = $this->config_server_model->get_list();
//        pre($config_list[0]->gmail_send);
        $mail_to = $this->input->post('mail_to');
        $mail_content = $this->input->post('mail_content');
        if (isset($mail_to)) {
//            echo $mail_to;
//            die();
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
//                'smtp_user' => 'test@gmail.com',
                'smtp_user' => $config_list[0]->gmail_send,
                'smtp_pass' => $config_list[0]->gmail_password,
                'mailtype' => 'html',
                'charset' => 'utf-8',  //'iso-8859-1'
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
//        $this->email->from('test@gmail.com', 'Your Name');
            $this->email->from($config_list[0]->gmail_send, 'Divu App');
//        $this->email->to('test@gmail.com');
//            $this->email->to('test@gmail.com');
            $this->email->to($mail_to);
            $this->email->subject('Thông báo giao việc');
//            $this->email->message('Nội dung : test content');
            $this->email->message($mail_content);
            if (!$this->email->send()) {
                show_error($this->email->print_debugger());
            } else {
                echo 'Your e-mail has been sent to ' . $mail_to . ' at ' . date('d-m-Y H:i:s');
            }
        }
        ?>
        <script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
        <script>
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('admin/email')?>',
                data: {
                    // 'mail_to': 'test@gmail.com'
                    'mail_to': '<?php echo $mail_to ?>',
                    'mail_content': '<?php echo $mail_content_full ?>'
                },
                beforeSend: function () {
                    // alert('Dữ liệu đang xử lý, vui lòng không load lại trang cho đến khi trang tự load');
                    $("#product_id").html('<option> Loading ...</option>');
                    // $("#btnAddEvent").prop('disabled', true); // disable button
                    console.log('fuckxxxxxxxxx');
                },
                // alert(data),
                // console.log();
                success: function (msg) {
                    console.log('fuck' + msg);
                    // $('#vn_district_new').html(msg);
                    window.location.replace('<?php echo base_url('admin/admin_emergency?date1=' . $date1 . '&date2=' . $date2 . '&asset_id=' . $id . '#' . $id) ?>');
                    // redirect(base_url('admin/asset' . '?asset_id=' . $asset_id . '#' . $asset_id));
                },
                error: function (xhr, status, error) {
                    console.log(status);
                    console.log(xhr.responseText);
                    // alert(status);
                    // alert(xhr.responseText);
                }
            });
        </script>

        <?php
    }


}