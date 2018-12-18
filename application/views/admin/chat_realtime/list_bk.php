<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Đang test nhé anh chị em,đừng có vào phần này(<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
    </div>
    <div class="title_right">
        <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
        </div>
    </div>
</div>
<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="x_title">
            <form method="post">
                <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Từ ngày<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtFrom" name="date1" required
                               value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                               class="form-control col-md-7 col-xs-12"/>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtTo" name="date2" required
                               value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                               class="form-control col-md-7 col-xs-12">
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">KTV/KH</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="form-control" name="type">
                            <option value="all">All</option>
                            <option value="1" <?php if (isset($_POST['type']) && $_POST['type'] == 1) echo 'selected' ?>>
                                Admin/KTV
                            </option>
                            <option value="2" <?php if ($_POST['type'] && $_POST['type'] == 2) echo 'selected' ?>>Khách
                                hàng
                            </option>
                        </select>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Loại tiền</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="form-control" name="sub">
                            <option value="all">All</option>
                            <option value="1" <?php if ($_POST['sub'] == 1) echo 'selected' ?>>Cộng</option>
                            <option value="2" <?php if ($_POST['sub'] == 2) echo 'selected' ?>>Trừ</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12">Luồng tiền</label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="form-control" name="money_id">
                            <option value="all">All</option>
                            <?php
                            $_SESSION['money_id'] = '';
                            if (isset($_POST['money_id'])) {
                                $_SESSION['money_id'] = $_POST['money_id'];
                            }
                            ?>
                            <?php foreach ($money_id as $key => $value) { ?>
                                <option value="<?php echo $value->id ?>" <?php if ($_SESSION['money_id'] == $value->id) echo 'selected' ?>><?php echo $value->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!--                <div class="ln_solid"></div>-->
                <div class="form-group">
                    <div class="col-md-1 col-sm-1 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>
                    </div>
                    <div class="col-xs-1 col-xs-1">
                        <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                    </div>
                </div>

                <!--                <div class="col-xs-1 col-xs-1">-->
                <!--                    --><?php //if (isset($res) && count($res) > 0) { ?>
                <!--                        <input type="submit" id="" name="btn_excel" required-->
                <!--                               class="btn btn-primary btn-sm" value="Xuất excel">-->
                <!--                    --><?php //} ?>
                <!--                </div>-->
            </form>

            <div class="col-md-3 col-sm-3 col-xs-12 pull-left">
                <!--            <a href="-->
                <?php //echo admin_url('asset') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
            </div>
            <!--        <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"-->
            <!--              enctype="multipart/form-data">-->

            <div class="x_content">
                <div class="table-responsive">
                    <!--        --><?php //echo $ban; ?>
                    <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                        <!--        <table id="" class="table table-striped table-bordered bulk_action">-->
                        <thead>
                        <tr>
                            <!--                            <th><input type='checkbox' id='select_all_invoices' onclick="selectAll()">All</th>-->
                            <th>STT</th>
                            <th>Loại</th>
                            <th>UserID</th>
                            <th>Ghi chú</th>
                            <th>Loại tiền</th>
                            <th>Số tiền</th>
                            <th>Cộng/trừ</th>
                            <th>Thực hiện bởi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = $total = 0 ?>
                        <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <?php $i++;
                            if ($value->type == 1) {
                                $typename = 'Admin/KTV';
                            } else {
                                $typename = 'Khách hàng';
                            }
                            if ($value->sub == 1) {
                                $subname = 'Cộng';
                            } else {
                                $subname = 'Trừ';
                            }
                            $total += $value->money;

//                            $total = $value->pay_cards + $value->bank + $value->ktv;
                            ?>
                            <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                            <tr id="<?php ?>"
                                class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <!--                                <td class="center"><input class='check_invoice' type="checkbox" name="asset_excel[]"-->
                                <!--                                                          value="-->
                                <?php //echo $value->id ?><!--">-->
                                <!--                                </td>-->
                                <td><?php echo $i ?></td>
                                <td class="text-nowrap"><?php echo $typename ?></td>
                                <td class="text-nowrap"><?php echo $value->userid ?></td>
                                <td class="text-nowrap"><?php echo $value->note ?></td>
                                <td class="text-nowrap"><?php echo $value->money_name ?></td>
                                <td class="text-nowrap"><?php echo $value->money ?></td>
                                <td class="text-nowrap"><?php echo $subname ?></td>
                                <td class="text-nowrap"><?php echo $value->admin_name ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                        <tfoot>
                        <tr class="bg bg-info">
                            <td colspan="5">Tổng</td>
                            <td colspan=""><?php echo number_format($total) ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
    </form>
</div>

<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }

    .pull-right a {
        float: right;
    }

    .pull-right {
        padding-right: 0px !important;
    }

    .disabled {
        pointer-events: none;
        cursor: default;
        opacity: 0.6;
    }
</style>

<script type="text/javascript">
    function confirm_del_event(admin_id, id) {
        var r = confirm("Bạn có chắc chắn muốn xóa ?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin_mission/del/')?>" + admin_id + "/" + id;
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
<script type="text/javascript">

    /*
    REPLACE THE IO HTTP URL BELLOW, TO YOUR OWN SERVER EX: LOCALHOST OR HTTP://YOURSERVER.COM
     */
    // var socket_connect = function (room) {
    //     // return io('http://chat.local:3000', {
    //     // return io('http://localhost:3000', {
    //     // return io('http://localhost:3000', {
    //     return io('http://115.84.178.148:3000', {
    //         query: 'r_var=' + room
    //     });
    // }

    // socket connect: var is the room id
    // THE ROOM ID IS UP TO YOUR APP OR SESSION
    // var socket = socket_connect(1);
    // var socket = io('http://localhost:3000');
    var socket = io('http://115.84.178.148:3000');

    socket.on('JoinServer', function () {
        console.log('JoinServerSuccessxxx');
        socket.emit('JoinServer', {
            typeAccount: 5,//5: CSKH, 2: KTV, 1: KH
            accountId: 6,//id CSKH
            device: 3//3 web
        });
    });

    socket.on('AdminSendChatResult', function (data) {
        $("#showChat").append('status: ' + data.status + ' ' + data.content + "<br>");
    });

    socket.on("UserChatAdmin", function (data) {
        let typeAccountChatAdmin = data.typeAccountChatAdmin;
        let userId = data.userId;
        let content = data.content;
        console.log('UserId: ' + userId + " content: " + content);
        CSKHChat(typeAccountChatAdmin, userId, "Xin chào tôi là Thịnh");


    });

    socket.on('AdminSendChatResult', function (data) {
        let status = data.status;
        let content = data.content;
        console.log(content + " - status: " + (status == 1 ? 'client da nhan' : 'client chua nhan'))
    });

    function CSKHChat(typeAccountChatAdmin, userIdChat, content) {
        socket.emit('AdminChat', {
            typeAccountChatAdmin: typeAccountChatAdmin,
            userIdChat: userIdChat,
            content: content
        });

        // save content chat
        // type_account (CSKH là 5),account_id (id CSKH), account_id_chat (id khách hàng),
        // content (nội dung chat), id_cskh, is_read (bằng: 1)
        //$.ajax({
        //    type: "POST",
        //    url: <?php //echo base_url('admin/chat_realtime') ?>//,
        //    //url: '<?php ////echo base_url('admin/get_department')?>////',
        //    data: {typeAccountChatAdmin: typeAccountChatAdmin,
        //        userIdChat: userIdChat,
        //        content: content
        //    },
        //    success: function(result) {
        //        window.console.log('Successful');
        //    }
        //});
        // var type_account = '5',
        $.ajax({
            url: '<?php echo base_url('admin/chat_realtime_process')?>',
            type: 'POST',
            data: {
                'typeAccountChatAdmin': typeAccountChatAdmin,
                'userIdChat': userIdChat,
                'content': content,
            },
            success: function (response) {
                // alert(response);
                // console.log('ABC')
                console.log(response)
                // console.log(typeAccountChatAdmin)
                // $('#employee_new').html(response);
                //Do something here...
            }
        });


    }

    // $(function () {
    //     socket.on('chat message', function (msg) {
    //         getChat();
    //     });
    // });

    // function runChat(event) {
    //     if (event.which == 13 || event.keyCode == 13) {
    //         saveChat();
    //         return false;
    //     }
    //     return true;
    // };

    // function saveChat() {
    //     var chatMsg = $("#msginput").val();
    //     if (chatMsg != '') {
    //         $.ajax({
    //             type: "POST",
    //             url: "server/saveData.php",
    //             dataType: "json",
    //             data: {chatMsg: chatMsg}
    //         })
    //             .done(function (data) {
    //                 socket.emit('chat message', chatMsg);
    //                 //mount(data);
    //                 $("#msginput").val("");
    //             });
    //     }
    // }

    // function getChat() {
    //     $.ajax({
    //         type: "POST",
    //         url: "server/getData.php",
    //         dataType: "json",
    //         data: {room: 1}
    //     })
    //         .done(function (data) {
    //             mount(data.data);
    //             $('#msgbox').scrollTop($('#msgbox')[0].scrollHeight);
    //         });
    //
    // }

    // function mount(data) {
    //     var html = "";
    //     var cssclass = "brown-color";
    //     var img = '';
    //     $.each(data, function (index, chat) {
    //         html += '<div>' + chat.user + ' Dummy Guy <i>' + chat.sent_at + '</i>:</span> ' + chat.message + '</div>';
    //     });
    //
    //     $("#msgbox").html(html);
    // }

    // $(function () {
    //     getChat();
    //     $('#msgbox').scrollTop($('#msgbox')[0].scrollHeight);
    //     $('#msginput').focus();
    // });

    // function updateChat() {
    //     getChat();
    //     return false;
    // }
</script>