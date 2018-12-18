
<!--    <div class="col-md-9 bg bg-orange">-->
        <div class="chatbox">
            <div class="chatlogs">
                <!--                <div class="chat friend">-->
                <!--                    <div class="user-photo"></div>-->
                <!--                    <p class="chat-message">What's up, Brother ..!!</p>-->
                <!--                </div>-->
                <!---->
                <!--                <div class="chat self">-->
                <!--                    <div class="user-photo"></div>-->
                <!--                    <p class="chat-message">What's up ..!!</p>-->
                <!--                </div>-->

                <?php
//                $res = $this->session->userdata('logs_chat');
//                pre($res);

                foreach ($res as $key => $value) { ?>
                    <?php if (in_array($value->type_account, array('5'))) { ?>
                        <div class="chat friend">
                            <div class="user-photo"><?php echo 'Bạn'; ?></div>
                            <p class="chat-message">
                                <?php echo $value->content ?>
                                <br/>
                                <small style="float: right"><?php echo date('H:i:s d-m-Y', strtotime($value->created_time)) ?></small>
                            </p>
                        </div>
                    <?php } ?>
                <?php if ($value->type_account !=5  && $value->content != '') { ?>
                    <div class="chat self">
                        <div class="user-photo">Khách</div>
                        <p class="chat-message"><?php echo $value->content ?>
                            <br/>
                            <small style="float: right"><?php echo date('H:i:s d-m-Y', strtotime($value->created_time)) ?></small>
                        </p>
                    </div>
                <?php } ?>
                <?php } ?>

            </div>
            <div class="chat-form">
                <textarea id="content" name="content" required></textarea>
                <input type="submit" id="btnAddEvent" name="btnAdd" required="required" class="btn btn-success"
                       value="Gửi">
            </div>
        </div>
<!--    </div>-->

<script>
    $('.chatlogs').scrollTop($('.chatlogs')[0].scrollHeight);
    $('#content').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            // alert('You pressed a "enter" key in textbox');
            // console.log(keycode);
            var content = $("#content").val();
            var account_id_chat = <?php echo $account_id_chat?>;
            CSKHChat(1, account_id_chat, content);
            // console.log(content);
            // $("textarea").val("");
        }
        // event.stopPropagation();
    });
    $('#btnAddEvent').click(function () {
        var content = $("#content").val();
        var account_id_chat = <?php echo $account_id_chat?>;
        console.log('account_id_chat: '+account_id_chat)
        CSKHChat(1, account_id_chat, content);
    })
</script>

