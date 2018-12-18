<?php
function public_url($url = '')
{
    return base_url('public/' . $url);
}

function admin_url($url = '')
{
    return base_url('admin/' . $url);
}

function admin_theme($url = '')
{
    return base_url('public/admin_temp/' . $url);
}

function link_icon()
{
    return 'http://products.dieuhoa247.org/';
//    return 'http://115.84.178.148:86/';
}

function link_banner()
{
//    return 'http://115.84.178.148:97/';
    return 'http://banner.dieuhoa247.org/';
}

function link_ktvavatars()
{
//    return 'http://115.84.178.148:97/';
    return 'http://ktvavatars.dieuhoa247.org/';
}


function link_icon_service()
{
//    return 'http://115.84.178.148:84/';
    return 'http://serviceinfo.dieuhoa247.org/';
}

function link_notifications()
{
//    return 'http://115.84.178.148:94/';
    return 'http://infomation.dieuhoa247.org/';
}

//function link_service_package() {
//    return 'http://115.84.178.148:96/';
//}

function pre($list, $exit = true)
{
    echo "<pre>";
    print_r($list);

    if ($exit) {
        die();
    }
}

function create_slug($string)
{
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array('a', 'e', 'i', 'o', 'u', 'y', 'd', 'A', 'E', 'I', 'O', 'U', 'Y', 'D', '-',);
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '-', $string);
    $string = strtolower($string);
    return $string;
}

function post_curl($postData)
{
    //    pre($_SESSION["login"]);
    $url = 'http://dvapp.dieuhoa247.org:9000/cms';

    $ch = curl_init();
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json'
    ];

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
//    var_dump($result);
    return $result;
}

function email_sending($this_new, $smtp_user, $smtp_pass, $to, $message, $attach)
{
    $admin = $this_new->session->userdata('admin');
//    $this->data['admin'] = $this->session->userdata('admin');
    if (isset($to)) {
        if (isset($admin->UserName)) {
            $admin = $this_new->session->userdata('admin');
            $message .= ' <br/> Account CMS: ' . $admin->UserName . ' ';
        }
//            echo $to;
//            die();
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
//                'smtp_user' => 'test@gmail.com',
            'smtp_user' => $smtp_user,
            'smtp_pass' => $smtp_pass,
            'mailtype' => 'html',
            'charset' => 'utf-8',  //'iso-8859-1'
        );
//        $this=$this_new;
        $this_new->load->library('email', $config);
        $this_new->email->set_newline("\r\n");
//        $this_new->email->from('test@gmail.com', 'Your Name');
        $this_new->email->from($smtp_user, 'Divu App');
//        $this_new->email->to('test@gmail.com');
//            $this_new->email->to('test@gmail.com');
        $this_new->email->to($to);
        $this_new->email->subject('Thông báo giao việc');
        $this_new->email->attach($attach);
//        $this_new->email->cc($cc);
//            $this_new->email->message('Nội dung : test content');
        $this_new->email->message($message);
        if (!$this_new->email->send()) {
            show_error($this_new->email->print_debugger());
        } else {
//            echo 'Your e-mail has been sent to ' . $to . ' at ' . date('d-m-Y H:i:s');
        }
    }
}

function convert_name_day($day)
{
    switch ($day) {
        case "Mon":
            echo 'Thứ 2';
            break;
        case "Tue":
            echo "Thứ 3";
            break;
        case "Wed":
            echo "Thứ 4";
            break;
        case "Thu":
            echo "Thứ 5";
            break;
        case "Fri":
            echo "Thứ 6";
            break;
        case "Sat":
            echo "Thứ 7";
            break;
        default:
            echo 'CN';
    }
}

function monthyears()
{
    $start = date_create_from_format("m/Y", "1/2018")->modify("first day of this month");
    $end = date_create_from_format("m/Y", "10/2019")->modify("first day of this month");
    $timespan = date_interval_create_from_date_string("1 month");
    $months = [];
//    $years = [];

    while ($start <= $end) {
        $months[] = $start->format("m") . '-' . $start->format("Y");
//        $years[] = $start->format("Y");
        $start = $start->add($timespan);
    }
    return $months;

//    print_r([ $months, $years ]);
}