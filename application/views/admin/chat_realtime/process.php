<?php
/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 6/18/2018
 * Time: 11:17 AM
 */
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
<script type="text/javascript">
    // var socket = io('http://localhost:3000');
    var socket = io('<?php echo $admin->link_port_3000 ?>');
    socket.on('JoinServer', function () {
        console.log('JoinServerSucces at -> ' + new Date());
        socket.emit('JoinServer', {
            typeAccount: 5,//5: CSKH, 2: KTV, 1: KH
            // accountId: 6,//id CSKH
            accountId: <?php echo $admin->id ?>,//id CSKH
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
        console.log('UserId: ' + userId + " content: " + content + " typeAccountChatAdmin -->>" + typeAccountChatAdmin);
        // CSKHChat(typeAccountChatAdmin, userId, "Xin chào tôi là Thịnh");

        $('.chatlogs').append(`<div class="chat self">` +
            `<div class="user-photo">Admin</div>` +
            `<p class="chat-message">${content}</p>` +
            `<br/>` +
            `<small class='text text-primary'><?php echo date('H:i:s d-m-Y') ?></small>` +
            `</div>`);
        var scrolled_val = $(document).scrollTop().valueOf();
        $('#number_noti').html('Có tin nhắn chat: ' + content);
        $('#menu1').prepend(`<li style="background: wheat;">` +
            `<a href="<?php echo base_url('admin/chat_realtime') ?>">` +
            `<span class="message">tin nhắn chat: -> ` + content + ` </span>` +
            `</a>` +
            `</li>`);
        // console.log('scrolled_val+ ' + scrolled_val);
        if (scrolled_val != '') {
            $('.chatlogs').scrollTop($('.chatlogs')[0].scrollHeight)
        }
    });

    // socket.on('AdminSendChatResult', function (data) {
    //     let status = data.status;
    //     let content = data.content;
    //     console.log(content + " - status: " + (status == 1 ? 'client da nhan' : 'client chua nhan'))
    // });

    socket.on('NewEmergency', function (data) {
        let id = data;
        console.log('NewEmergency -> ' + id);
        $.ajax({
            // Dropdown_menu
            url: '<?php echo base_url('admin/process/process_socket')?>',
            type: 'POST',
            data: {
                'id': id,
                'action': 'NewEmergency',
            },
            // console.log('id - '+ data),
            success: function (response) {
                // email_sending
                var markers = JSON.parse(response);
                // console.log(response);
                console.log(markers);
                markers.forEach(function (element) {
                    // var time1 = moment(markers.time).format('MM-DD-YYYY');
                    // console.log('time:' + time1);
                    $('#number_noti').html('Cứu hộ khẩn cấp: ' + element.des);
                    $('#menu1').prepend(`<li style="background: wheat;">` +
                        `<a href="` + element.link + `">` +
                        `<span>` + element.fullname + `</span>` +
                        `<span class="time">` + moment(markers.time).format('MM-DD-YYYY H:mm:ss') + `</span>` +
                        `<span class="message">Cứu hộ khẩn cấp: ->  ` + element.des + `</span>` +
                        `</a>` +
                        `</li>`);
                });
            }
        });
    });

    socket.on('CancelCallEmergency', function (data) {
        let id = data;
        console.log('CancelCallEmergency -> ' + id);
        $.ajax({
            // Dropdown_menu
            url: '<?php echo base_url('admin/process/process_socket')?>',
            type: 'POST',
            data: {
                'id': id,
                'action': 'CancelCallEmergency',
            },
            success: function (response) {
                var markers = JSON.parse(response);
                // console.log(response);
                console.log(markers);
                markers.forEach(function (element) {
                    // var time1 = moment(markers.time).format('MM-DD-YYYY');
                    // console.log('time:' + time1);
                    $('#number_noti').html('Hủy cứu hộ khẩn cấp: ' + element.des);
                    $('#menu1').prepend(`<li style="background: wheat;">` +
                        `<a href="` + element.link + `">` +
                        `<span>` + element.fullname + `</span>` +
                        `<span class="time">` + moment(markers.time).format('MM-DD-YYYY H:mm:ss') + `</span>` +
                        `<span class="message">Lý do hủy cứu hộ:` + element.des_cancel + `</span>` +
                        `</a>` +
                        `</li>`);
                });
            }
        });
    });

    socket.on('NewMaintenance', function (data) {
        let id = data;
        console.log('NewMaintenance -> ' + id);
        $.ajax({
            // Dropdown_menu
            url: '<?php echo base_url('admin/process/process_socket')?>',
            type: 'POST',
            data: {
                'id': id,
                'action': 'NewMaintenance',
            },
            success: function (response) {
                var markers = JSON.parse(response);
                // console.log(response);
                console.log(markers);
                markers.forEach(function (element) {
                    var time1 = moment(markers.time).format('MM-DD-YYYY');
                    console.log('time:' + time1);
                    $('#number_noti').html('Bảo dưỡng: ' + element.des);
                    $('#menu1').prepend(`<li style="background: wheat;">` +
                        `<a href="` + element.link + `">` +
                        `<span>` + element.fullname + `</span>` +
                        `<span class="time">` + moment(markers.time).format('MM-DD-YYYY H:mm:ss') + `</span>` +
                        `<span class="message">` + element.des + `</span>` +
                        `</a>` +
                        `</li>`);
                });
            }
        });
    });

    socket.on('ChangeMaintenance', function (data) {
        let id = data;
        console.log('ChangeMaintenance -> ' + id);
        $.ajax({
            // Dropdown_menu
            //url: '<?php //echo base_url('admin/lock_admin/ChangeMaintenance')?>//',
            url: '<?php echo base_url('admin/process/process_socket')?>',
            type: 'POST',
            data: {
                'id': id,
                'action': 'ChangeMaintenance',
            },
            success: function (response) {
                var markers = JSON.parse(response);
                // console.log(response);
                console.log(markers);
                markers.forEach(function (element) {
                    var time1 = moment(markers.time).format('MM-DD-YYYY');
                    // console.log('time:' + time1);
                    $('#number_noti').html('Đổi lịch: ' + element.des);
                    $('#menu1').prepend(`<li style="background: wheat;">` +
                        `<a href="` + element.link + `">` +
                        `<span>` + element.fullname + `</span>` +
                        `<span class="time">` + moment(markers.time).format('MM-DD-YYYY H:mm:ss') + `</span>` +
                        `<span class="message">` + element.des + `</span>` +
                        `</a>` +
                        `</li>`);
                });
            }
        });
    });

    socket.on('UserUpdateAddress', function (data) {
        let user_id = data.user_id;
        let userTempAddress_id = data.userTempAddress_id;
        console.log('user_id -> ' + user_id + ' && userTempAddress_id -> ' + userTempAddress_id);
        $.ajax({
            // Dropdown_menu
            //url: '<?php //echo base_url('admin/lock_admin/ChangeMaintenance')?>//',
            url: '<?php echo base_url('admin/process/process_socket')?>',
            type: 'POST',
            data: {
                'id': user_id,
                'action': 'UserUpdateAddress',
            },
            success: function (response) {
                var markers = JSON.parse(response);
                // console.log(response);
                console.log(markers);
                markers.forEach(function (element) {
                    // var time1 = moment(markers.time).format('MM-DD-YYYY');
                    // console.log('time:' + time1);
                    $('#number_noti').html('Cập nhật địa chỉ: ' + element.fullname);
                    $('#menu1').prepend(`<li style="background: wheat;">` +
                        `<a href="` + element.link + `">` +
                        `<span>` + element.fullname + `</span>` +
                        `<span class="time">` + moment(markers.time).format('MM-DD-YYYY H:mm:ss') + `</span>` +
                        `<span class="message"> Cập nhật địa chỉ: ` + element.address + `</span>` +
                        `</a>` +
                        `</li>`);
                });
            }
        });
    });

    // - emit('UserPaymentOrder', {user_id, logPaymentCartUser_id})
    // - emit('PartnerPaymentOrder', {user_id, logPaymentCartAdmin_id})

    socket.on('UserPaymentOrder', function (data) {
        let user_id = data.user_id;
        let logPaymentCartUser_id = data.logPaymentCartUser_id;
        console.log('user_id -> ' + user_id + ' && logPaymentCartUser_id -> ' + logPaymentCartUser_id);
        $.ajax({
            // Dropdown_menu
            //url: '<?php //echo base_url('admin/lock_admin/ChangeMaintenance')?>//',
            url: '<?php echo base_url('admin/process/process_socket')?>',
            type: 'POST',
            data: {
                'id': user_id,
                'action': 'UserPaymentOrder',
            },
            success: function (response) {
                var markers = JSON.parse(response);
                // console.log(response);
                console.log(markers);
                markers.forEach(function (element) {
                    // var time1 = moment(markers.time).format('MM-DD-YYYY');
                    // console.log('time:' + time1);
                    $('#number_noti').html('Khách hàng Yêu cầu mua đơn hàng: ' + element.username);
                    $('#menu1').prepend(`<li style="background: wheat;">` +
                        `<a href="` + element.link + `">` +
                        `<span>` + element.username + `</span>` +
                        `<span class="time">` + moment(markers.time).format('MM-DD-YYYY H:mm:ss') + `</span>` +
                        `<span class="message">Khách hàng Yêu cầu mua đơn hàng: ` + element.detail_cart + `</span>` +
                        `</a>` +
                        `</li>`);
                });
            }
        });
    });

    socket.on('PartnerPaymentOrder', function (data) {
        let user_id = data.user_id;
        let PartnerPaymentOrder = data.PartnerPaymentOrder;
        console.log('user_id -> ' + user_id + ' && PartnerPaymentOrder -> ' + PartnerPaymentOrder);

        $.ajax({
            // Dropdown_menu
            //url: '<?php //echo base_url('admin/lock_admin/ChangeMaintenance')?>//',
            url: '<?php echo base_url('admin/process/process_socket')?>',
            type: 'POST',
            data: {
                'id': user_id,
                'action': 'PartnerPaymentOrder',
            },
            success: function (response) {
                var markers = JSON.parse(response);
                // console.log(response);
                console.log(markers);
                markers.forEach(function (element) {
                    // var time1 = moment(markers.time).format('MM-DD-YYYY');
                    // console.log('time:' + time1);
                    $('#number_noti').html('KTV Yêu cầu mua đơn hàng: ' + element.username);
                    $('#menu1').prepend(`<li style="background: wheat;">` +
                        `<a href="` + element.link + `">` +
                        `<span>` + element.username + `</span>` +
                        `<span class="time">` + moment(markers.time).format('MM-DD-YYYY H:mm:ss') + `</span>` +
                        `<span class="message">KTV Yêu cầu mua đơn hàng: ` + element.detail_cart + `</span>` +
                        `</a>` +
                        `</li>`);
                });
            }
        });
    });

    function CSKHChat(typeAccountChatAdmin, userIdChat, content12) {
        if (!content12) {
            alert('Nội dung nhập bị trống');
        } else {
            // let status;
            socket.emit('AdminChat', {
                typeAccountChatAdmin: typeAccountChatAdmin,
                userIdChat: userIdChat,
                content: content12
            });
            socket.on('AdminSendChatResult', function (data) {
                let status = data.status;
                let content = data.content;
                console.log(content + " - status: " + (status == 1 ? 'client da nhan' : 'client chua nhan'))

                // socket.emit('AdminChat', {
                //     typeAccountChatAdmin: typeAccountChatAdmin,
                //     userIdChat: userIdChat,
                //     content: content12,
                //     read: status
                // });



                $("textarea").val("");

                $('.chatlogs').append(`<div class="chat friend">` +
                    `<div class="user-photo">Adminxx</div>` +
                    `<p class="chat-message">${content12}</p>` +
                    `<br/>` +
                    `<small class='text text-primary'><?php echo date('H:i:s d-m-Y') ?></small>` +
                    `</div>`);
                $('.chatlogs').scrollTop($('.chatlogs')[0].scrollHeight);

                // save content chat
                // var type_account = '5',
                $.ajax({
                    url: '<?php echo base_url('admin/chat_realtime_process')?>',
                    type: 'POST',
                    data: {
                        'typeAccountChatAdmin': typeAccountChatAdmin,
                        'userIdChat': userIdChat,
                        'content': content12,
                        'is_read': status,
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

            });
            console.log('status -> ' + status);
            // $("input[type=text]").val("");

        }
    }
</script>