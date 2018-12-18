<?php //include "../dbconnect.php" ?>
<html>
<head>
    <title>AndroidHive | Firebase Cloud Messaging</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="//www.gstatic.com/mobilesdk/160503_mobilesdk/logo/favicon.ico">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
<?php
// Enabling error reporting
error_reporting(-1);
ini_set('display_errors', 'On');

require_once __DIR__ . '/firebase1.php';
require_once __DIR__ . '/push.php';

$firebase = new Firebase1();
$push = new Push();
//if (isset($_GET['send_one'])) {
//    echo 'ahihi';
//}
// optional payload
$payload = array();
$payload['team'] = 'India';
$payload['score'] = '5.6';

// notification title
$title = isset($_GET['title']) ? $_GET['title'] : '';
$topic = isset($_GET['topic']) ? $_GET['topic'] : '';

// notification message
$message = isset($_GET['message']) ? $_GET['message'] : '';

// push type - single user / topic
$push_type = isset($_GET['push_type']) ? $_GET['push_type'] : '';

// whether to include to image or not
$include_image = isset($_GET['include_image']) ? TRUE : FALSE;


$push->setTitle($title);
$push->setMessage($message);
if ($include_image) {
    $push->setImage('http://api.androidhive.info/images/minion.jpg');
} else {
    $push->setImage('');
}
$push->setIsBackground(FALSE);
$push->setPayload($payload);


$json = '';
$response = '';

if ($push_type == 'topic') {
    $json = $push->getPush();
    $response = $firebase->sendToTopic($topic, $json,$api_key);
} else if ($push_type == 'individual') {
    $group = $_GET['group'];
//    echo 'gr: '.$group;

    $input = array();
    $input['where']['id'] = $_GET['regId'] ;
    if ($group == 1) {
        $array = $this->user_model->get_list($input);
    } else {
        $array = $this->admin_model->get_list($input);
    }
//            $array = $this->user_model->get_list($input);
//            pre($array);
    $json = $push->getPush();
//    $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
//    $regId = $row_array['id_register'];
    $regId = $array[0]->fcm_token;
//    echo $regId;
//    die();
    $response = $firebase->send($regId, $json, $api_key);
}
?>
<div class="container">
    <div class="fl_window">
<!--        <div><img src="http://api.androidhive.info/images/firebase_logo.png" width="200" alt="Firebase"/></div>-->
<!--        <br/>-->
        <?php if ($json != '') { ?>
            <label><b>Request:</b></label>
            <div class="json_preview">
                <pre><?php echo json_encode($json) ?></pre>
            </div>
        <?php } ?>
        <br/>
        <?php if ($response != '') { ?>
            <label><b>Response:</b></label>
            <div class="json_preview">
                <pre><?php echo json_encode($response) ?></pre>
            </div>
        <?php } ?>

    </div>

    <form class="form-horizontal form-label-left" method="get">
<!--        <input type="hidden" name="action" value="--><?php //echo $_GET['action'] ?><!--"/>-->
        <legend>Gửi cho một thiết bị</legend>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">UserID<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="number" name="regId" class="form-control" placeholder="" min="0" required>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Chọn Nhóm<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <select class="form-control" name="group">
                    <option value="1">Khách hàng</option>
                    <option value="2">KTV</option>
                </select>
            </div>
        </div>
<!--        <div class="clear"></div>-->

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tiêu đề<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <textarea name="title" class="form-control" rows="1" placeholder="" required></textarea>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nội dung<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <textarea name="message" class="form-control" rows="1" placeholder="" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="hidden" name="push_type" value="individual"/>
                <input type="submit" id="btnAddEvent" name="send_one" required="required" class="btn btn-success"
                       value="Gửi">
<!--                <button type="submit" class="pure-button pure-button-primary btn_send">Gửi</button>-->
            </div>
            <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--            <a href="-->
            <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--                <a href="--><?php //echo admin_url('config_payment') ?><!--" class="btn btn-success">Quay lại danh sách</a>-->
            <!--            </div>-->
        </div>
<!--        <fieldset>-->
<!--            <legend>Gửi cho một thiết bị</legend>-->
<!---->
<!--            <label for="redId">UserId người nhận</label>-->
<!--            <input type="text" id="redId" name="regId" value="20" class="pure-input-1-2"-->
<!--                   placeholder="Nhập userid của người nhận" required/>-->
<!--            <div class="clear"></div>-->
<!--            <label for="title">Tiêu đề tin</label>-->
<!--            <input type="text" id="title" value="hello baby" name="title" class="pure-input-1-2" placeholder="Nhập tiêu đề tin" required/>-->
<!--            <div class="clear"></div>-->
<!--            <label for="message">Nội dung</label>-->
<!--            <textarea class="pure-input-1-2" rows="5" name="message" id="message"-->
<!--                      placeholder="Nhập nội dung " required>wtf</textarea>-->
<!---->
<!--            <label for="include_image" class="pure-checkbox">-->
<!--                <!--                <input name="include_image" id="include_image" type="checkbox"> Gửi kèm ảnh-->
<!--            </label>-->
<!--            <input type="hidden" name="push_type" value="individual"/>-->
<!--            <input type="submit" name="send_one" value="Gửi"/>-->
<!--<!--            <button type="submit" class="pure-button pure-button-primary btn_send">Gửi</button>-->
<!--        </fieldset>-->
    </form>
    <br/>
    <div style="clear: both"></div>
    <form class="pure-form pure-form-stacked" method="get">
<!--        <input type="hidden" name="action" value="--><?php //echo $_GET['action'] ?><!--"/>-->
        <legend>Gửi cho tất cá các thiết bị</legend>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Chọn Nhóm<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="form-control" name="topic">
                    <option value="all_user">Khách hàng</option>
                    <option value="all_partner">KTV</option>
                </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tiêu đề<span
                        class="required">*</span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <textarea name="title" class="form-control" rows="1" placeholder="" required></textarea>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Nội dung<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <textarea name="message" class="form-control" rows="1" placeholder="" required></textarea>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="hidden" name="push_type" value="topic"/>
                <button type="submit" class="pure-button pure-button-primary btn_send">Gửi tất cả</button>
<!--                <input type="hidden" name="push_type" value="topic"/>-->
<!--                <button type="submit" class="pure-button pure-button-primary btn_send">Gửi tất cả</button>-->
            </div>
        </div>
<!--        <fieldset>-->
<!--            <legend>Gửi cho tất cá các thiết bị</legend>-->
<!--            <label for="title1">Chọn Nhóm</label>-->
<!--            <div class="col-md-6 col-sm-6 col-xs-12">-->
<!--                <select class="form-control" name="topic">-->
<!--                    <option value="all_user">Khách hàng</option>-->
<!--                    <option value="all_partner">KTV</option>-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="clear"></div>-->
<!---->
<!--            <label for="title1">Tiêu đề tin</label>-->
<!--            <input type="text" id="title1" name="title" class="pure-input-1-2" placeholder="Nhập tiêu đề" required/>-->
<!--            <div class="clear"></div>-->
<!--            <label for="message1">Nội dung</label>-->
<!--            <textarea class="pure-input-1-2" name="message" id="message1" rows="5"-->
<!--                      placeholder="Notification message!" required></textarea>-->
<!---->
<!--            <label for="include_image1" class="pure-checkbox">-->
<!--                <!--                <input id="include_image1" name="include_image" type="checkbox"> Gửi kèm ảnh-->
<!--            </label>-->
<!--            <input type="hidden" name="push_type" value="topic"/>-->
<!--            <button type="submit" class="pure-button pure-button-primary btn_send">Gửi tất cả</button>-->
<!--        </fieldset>-->
    </form>

    <legend>cập nhật key firebase</legend>
<!--    <form action="--><?php //echo base_url('admin/firebase')?><!--" method="post">-->
    <form action="" method="post">
        <div class="form-group">
            <label for="email">Server key OLD</label>
            <input type="text" class="form-control" id="" placeholder="Enter Server key" name="api_key" value="<?php if ($api_key) echo $api_key ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Server key</label>
            <input type="text" class="form-control" id="" value="<?php if (isset($_POST['api_key'])) echo $_POST['api_key'] ?>" placeholder="Enter Server key" name="api_key_new" required>
        </div>
<!--        <input type="submit" name="update_key" class="btn btn-default" value="Cập nhật">-->
        <input type="submit" id="btnAddProduct" name="update_key" required="required" class="btn btn-primary"
               value="Sửa">
    </form>
</div>
</body>
</html>