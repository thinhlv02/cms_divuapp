<?php
include("config/dbconnect.php");
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html"/>
    <meta name="author" content="SDC-Media"/>
    <title>Untitled 2</title>
</head>

<body>
<!--    tesst bstrap-->
<!--<div class="container">-->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <button type="button" class="btn btn-default text-uppercase"><b>Reset bàn chơi</b></button>
        <form method="post" action="" id="demo-form2" data-parsley-validate=""
              class="form-horizontal form-label-left x_panel"
              novalidate="">
            <!--                <input type="hidden" name="action" value="-->
            <?php //echo $_POST['action'] ?><!--"/>-->
            <div class="form-group">
                <div class="col-md-2 col-sm-2 col-xs-6">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">game<span
                            class="required"></span></label>
                    <select name="game" class="form-control" id="sel1">
                        <?php
                        $_SESSION['game'] == $_POST['game'];
                        $q1 = mysql_query("select * from gameinfo") or die (mysql_error());
                        if (mysql_num_rows($q1) > 0) {
                            while ($row = mysql_fetch_array($q1)) { ?>
                                <option
                                    value=<?php echo $row['gameid'] ?><?php if (isset($_SESSION['game']) && $_SESSION['game'] == $row['gameid']) echo 'selected'; ?>>
                                    <?php echo $row['gamename'] ?></option>
                                <?php
                            }
                        } ?>
                    </select>
                </div>

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Bàn
                        chơi<span
                            class="required"></span></label>
                    <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"
                           name="table" value="<?php echo isset($_POST['table']) ? $_POST['table'] : '' ?>">
                </div>

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name"><span
                            class="required"></span></label><br/>
                    <input type="submit" name="submit" value="Xác nhận" class="alt_btn"/>
                    <input type="reset" value="Reset" class="alt_btn"/>
                </div>
            </div>
            <!--            <div class="ln_solid"></div>-->
            <!--            <div class="form-group">-->
            <!--                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-0">-->
            <!--                    <input type="submit" name="submit" value="Xác nhận" class="alt_btn"/>-->
            <!--                    <input type="reset" value="Reset" class="alt_btn"/>-->
            <!--                </div>-->
            <!--            </div>-->
        </form>
    </div>
</div>
<!--</div>-->
<!--    tesst bstrap-->
<?php
$p = mysql_query("SELECT * FROM `hub68club_account`.`restserver` ") or die("error p: " . mysql_error());
$r_p = mysql_fetch_array($p);
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <button type="button" class="btn btn-default text-uppercase"><b>Cấu hình cổng nạp SSG</b></button>
        <form method="post" action="" id="demo-form2" data-parsley-validate=""
              class="form-horizontal form-label-left x_panel"
              novalidate="">
            <!--                <input type="hidden" name="action" value="-->
            <?php //echo $_POST['action'] ?><!--"/>-->
            <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-6">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Trạng
                        thái<span
                            class="required"></span></label>
                    <select name="status" class="form-control" id="sel1">
                        <option value="1" <?php if ($r_p['status'] == 1) echo 'selected' ?>>ON</option>
                        <option value="0" <?php if ($r_p['status'] == 0) echo 'selected' ?>>OFF</option>
                    </select>
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">nhà mạng<span
                            class="required"></span></label><br/>
                    <input type="checkbox" name="provider_code[]" value="VTT"> VTT
                    <input type="checkbox" name="provider_code[]" value="VNP"> VNP
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name"><span
                            class="required"></span></label><br/>
                    <input type="submit" name="submit_ssg" value="Xác nhận" class="alt_btn"
                           onclick="return confirm('Bạn có đồng ý thay đổi');"/>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h4>đang chạy: <b class="text-danger" id="provider_code"> <?php echo $r_p['provider_code'] ?></b>
                    </h4>
                </div>
            </div>
            <!--            <div class="ln_solid"></div>-->
            <!--            <div class="form-group">-->
            <!--                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-0">-->
            <!--                    <input type="submit" name="submit_ssg" value="Xác nhận" class="alt_btn"-->
            <!--                           onclick="return confirm('Bạn có đồng ý thay đổi');"/>-->
            <!--                    <input type="reset" value="Reset" class="alt_btn"/>-->
            <!--                </div>-->
            <!--            </div>-->
        </form>
    </div>
</div>

</body>
</html>
<?php
if (isset($_POST['submit'])) {
    $game = $_POST['game'];
//    $room = $_POST['room'];
    if ($_POST['table'] == NULL) {
        echo "<span style='color:red'>Nhập ID bàn chơi muốn reset</span>";
    } else {
        $table = $_POST['table'];
//        $room = $_POST['room'];
//        $submit_text = $game . ":" . $room . ":" . $table;
        $submit_text = $game . ":1:" . $table;
        echo $submit_text;
//        die();
        $querry = mysql_query("UPDATE `" . $_SESSION['db_hub'] . "`.gameconfig SET reset_table='" . $submit_text . "'") or die("error resset" . mysql_error());
        if (!$querry) echo(mysql_error());
        else {
            echo "<script type='text/javascript'>alert('Reset bàn chơi thành công: (" . $submit_text . ")')</script>";
            $reload_db = mysql_query("UPDATE `" . $_SESSION['db_hub'] . "`.sg_admin SET status='s' where command='reload' ") or die("error reload " . mysql_error());
        }
    }
}

if (isset($_POST['submit_ssg'])) {
    $arr = array();
    foreach ($_POST['provider_code'] as $provider_code) {
        $arr[] = "'". $provider_code. "'";
    }

//    var_dump($arr);
    if (empty($arr)) {
        echo "<script type='text/javascript'>alert('Phải chọn 1 loại nhà mạng')</script>";
    } else {
//        $employee = implode(',', $arr);
        $employee = '"'. implode(',', $arr). '"';
//        echo $employee. '<br/>';
//        die();
        $fuck = "UPDATE 
  `hub68club_account`.`restserver` 
SET
  `provider_code` =  " . $employee . ",
  `status` = '" . $_POST['status'] . "' ";
//        echo $fuck;
//        die();
        $querry = mysql_query("$fuck") or die("error resset" . mysql_error());
        if (!$querry) echo(mysql_error());
        else {
            echo "<script type='text/javascript'>
//        alert('thành công)
        $('#provider_code').text();
        </script>";
        }
    }
}
?>

<style>
    input[type=checkbox], input[type=radio] {
        zoom: 1.9;
    }
</style>

<!--############################-->

<?php
/*chú ý
 * ở đây có 3 phần kết nối đến Database, nếu
 * sửa lại thông tin thì vui lòng sửa cả ở 3 dòng: $conn,$conn1,$conn2
 * */
$timezone = +7;
//include("config/dbconnect_acc.php");
//include("config/dbconnect_log.php");
//include("config/dbconnect.php");

$conn1 = mysql_connect('35.240.178.53:3306', 'slot', 'sloT@2017') or die(mysql_error());
mysql_select_db('hub68club_logs', $conn1) or die(mysql_error());
mysql_query("SET charactor_set_results=utf8", $conn1);
mysql_query("SET NAMES 'utf8'");
//
$conn = mysql_connect('35.240.178.53:3306', 'slot', 'sloT@2017') or die(mysql_error());
mysql_select_db('hub68club_account', $conn) or die(mysql_error());
mysql_query("SET charactor_set_results=utf8", $conn);
mysql_query("SET NAMES 'utf8'");

//        connect
$conn2 = mysql_connect('35.240.178.53:3306', 'slot', 'sloT@2017') or die(mysql_error());
mysql_select_db('hub68club', $conn2) or die(mysql_error());
mysql_query("SET charactor_set_results=utf8", $conn2);
mysql_query("SET NAMES 'utf8'");


$p = mysql_query("SELECT * FROM `hub68club_account`.`restserver` ") or die("error p: " . mysql_error());
$r_p = mysql_fetch_array($p);
//        connect
###############################################################
$dcm = "SELECT a.`id`,a.`user_id`,b.`username`, a.`response`,a.`provider_code`,a.`card_code`,a.`card_seri`,
a.`card_value`,c.conversion_price,a.requested_at
FROM `hub68club_logs`.`pay_cards` a 
JOIN hub68club_account.`users` b ON a.`user_id` = b.`id`  
JOIN (SELECT `price`,`conversion_price` FROM `hub68club_account`.`scratch_cards` GROUP BY price) c ON a.`card_value` = c.price
  WHERE a.provider_code IN ('" . $r_p['provider_code'] . "') AND a.response = 'Pending' and
   DATE(a.`requested_at`) >= DATE_SUB(DATE(NOW()), INTERVAL 3 DAY) 
  ORDER BY a.id DESC";
echo $dcm;
$sql = mysql_query("$dcm") or die("error: " . mysql_error());

while ($r = mysql_fetch_array($sql)) {
    $id = $r['id'];
    $user_id = $r['user_id'];
    $username = $r['username'];
    $provider_code = strtolower($r['provider_code']);
    if ($provider_code == 'vtt') {
        $provider_code = 'viettel';
    }
    $card_code = $r['card_code'];
    $card_seri = $r['card_seri'];
    $card_value = $r['card_value'];
    $conversion_price = $r['conversion_price'];
    echo $id . '-' . $username . '-' . $provider_code . '-' . $card_code . '-' . $card_seri . '-' . $card_value . '-' . $conversion_price . '-' . $r['response'] . '-' . $r['requested_at'] . '<br/>';
//    $result = restserver($id, $user_id, $card_seri, $card_code, $provider_code, $username, $card_value, $conversion_price);
}
//$r= mysql_fetch_array($sql);
//echo $r['sl'];
//die();
function restserver($id, $user_id, $card_seri, $card_code, $provider_code, $username, $card_value, $conversion_price)
{
    $PartnerCode = 'ssg';
    $partnerKey = '57f4131362d461f560b31739d042fd14';
    $CardSerial = $card_seri;
    $CardCode = $card_code;
    $CardType = $provider_code;
    $AccountName = $username;
    $AppCode = $CardType . '_port_ssg';
    $AmountUser = $card_value;

    $RefCode_ = 'RefCode_' . strtotime(date('Y-m-d H:i:s'));
    $RequestContent = '{"CardSerial":"' . $CardSerial . '","CardCode":"' . $CardCode . '","CardType":"' . $CardType . '","AccountName":"' . $AccountName . '","AppCode":"' . $AppCode . '","RefCode":"' . $RefCode_ . '","AmountUser":"' . $AmountUser . '"}';
//pre($RequestContent);
//die();
    $data = array(
        'PartnerCode' => $PartnerCode,
        'ServiceCode' => 'cardtelco',
        'CommandCode' => 'usecard',
        'RequestContent' => $RequestContent,
        'Signature' => md5($PartnerCode . 'cardtelco' . 'usecard' . $RequestContent . $partnerKey),
    );
    $data_string = json_encode($data);
//var_dump($data_string);
//echo $data_string;
//echo '<hr/>';
    $curl = curl_init('https://apicard.bb2d.com/VPGJsonService.ashx');

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string))
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

// Send the request
    $result = curl_exec($curl);

// Free up the resources $curl is using
    curl_close($curl);

//    echo $result . '<br/>';

//$result = '{"ResponseCode":1,"Description":"Transaction is successful","ResponseContent":"10000","Signature":"111e47abb77cb85d3fa6ed5e4bf2ddf2"}';

    $result_arr = json_decode($result, true);
    var_dump($result_arr) . '<br/>';
//    echo '<br/>';
    echo 'ResponseCode: ' . $result_arr['ResponseCode'] . '<br/>';
    echo 'ResponseContent: ' . $result_arr['ResponseContent'] . '<br/>';
    //process
    if (isset($result_arr['ResponseCode'])) {
        $response = '';
        if ($result_arr['ResponseCode'] == '1') {
            $response = 'Nạp thẻ thành công';
        }
        if ($result_arr['ResponseCode'] != '1') {
            $response = 'Thẻ không hợp lệ';
            $card_value = $conversion_price = 0;
        }
        $fuck = "UPDATE `hub68club_logs`.`pay_cards` SET `price` = '" . $card_value . "',`response` = '" . $response . "', 
        `description` = '" . $result_arr['Description'] . "',
        `admin` = '" . $AppCode . "',`status` = '" . $result_arr['ResponseCode'] . "' WHERE `id` = '" . $id . "' ";
//    echo $fuck;
//    die();
//    echo $_POST['tid']. '-----'. $_POST['admin'];
        $update = mysql_query("$fuck") or die('error update: ' . mysql_error());
        if ($update && $card_value > 0) {
            $string = "INSERT INTO hub68club.admin_add(user_id,money, sub,note,admin)
					VALUES ('" . $user_id . "','" . $conversion_price . "','0','Cộng tiền nạp card','" . $AppCode . "')";
            $querry = mysql_query("$string") or die ("error add money " . mysql_error());
//        echo $string;
//        die();
            if (!$querry) echo(mysql_error());
            else {
                echo "cộng tiền Thành công";
            }
        }
    }
}
//}
//response success:
//{"ResponseCode":1,"Description":"Transaction is successful","ResponseContent":"10000","Signature":"111e47abb77cb85d3fa6ed5e4bf2ddf2"}