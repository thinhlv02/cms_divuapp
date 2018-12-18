<?php $menu_access = $this->session->userdata('menu_access');
//pre($admin);
?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>

<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        /*font-family: tahoma, sans-serif;*/
        box-sizing: border-box;
    }

    body {
        /*background: #1ddced;*/
    }

    .chatbox {
        /*width: 500px;*/
        /*min-width: 390px;*/
        /*height: 600px;*/
        /*background: #fff;*/
        padding: 25px;
        margin: 20px auto;
        box-shadow: 0 3px #ccc;
    }

    .chatlogs {
        padding: 10px;
        width: 100%;
        height: 300px;
        overflow-x: hidden;
        overflow-y: scroll;
    }

    .chatlogs::-webkit-scrollbar {
        width: 10px;
    }

    .chatlogs::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background: rgba(0, 0, 0, .1);
    }

    .chat {
        display: flex;
        flex-flow: row wrap;
        align-items: flex-start;
        margin-bottom: 10px;
    }

    /*.chat .user-photo {*/
        /*width: 60px;*/
        /*height: 60px;*/
        /*background: #ccc;*/
        /*border-radius: 50%;*/
    /*}*/

    .chat .chat-message {
        width: 80%;
        padding: 15px;
        margin: 5px 10px 0;
        border-radius: 10px;
        color: #fff;
        /*font-size: 20px;*/
    }

    .friend .chat-message {
        background: #1adda4;
    }

    .self .chat-message {
        background: #1ddced;
        order: -1;
    }

    .chat-form {
        margin-top: 20px;
        display: flex;
        align-items: flex-start;
    }

    .chat-form textarea {
        background: #fbfbfb;
        width: 75%;
        height: 50px;
        border: 2px solid #eee;
        border-radius: 3px;
        resize: none;
        padding: 10px;
        font-size: 18px;
        color: #333;
    }

    .chat-form textarea:focus {
        background: #fff;
    }

    .chat-form button {
        background: #1ddced;
        padding: 5px 15px;
        font-size: 30px;
        color: #fff;
        border: none;
        margin: 0 10px;
        border-radius: 3px;
        box-shadow: 0 3px 0 #0eb2c1;
        cursor: pointer;

        -webkit-transaction: background .2s ease;
        -moz-transaction: backgroud .2s ease;
        -o-transaction: backgroud .2s ease;
    }

    .chat-form button:hover {
        background: #13c8d9;
    }
</style>
<?php $this->load->view('admin/chat_realtime/process.php') ?>
<div class="row">
    <div class="col-md-3">
        <h2>Tin nhắn chưa đọc</h2>
        <ul class="list-group">
            <?php foreach ($list_wait as $key => $value) { ?>
                <li class="list-group-item show_box" user_id = '<?php echo $value->account_id_chat ?>' type_account ='<?php echo $value->type_account ?>' ><?php echo $value->fullname ?></li>
            <?php } ?>
            <li class="list-group-item show_box">First item</li>
        </ul>
    </div>
    <div class="col-md-9 bg bg-info" id="list_content"></div>
</div>

<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<style>
    .clicked {
        background-color: wheat;
    }
</style>
<script>
    $('.show_box').click(function () {
        var user_id = $(this).attr("user_id");
        console.log('userid: '+ user_id);
        $( "li" ).removeClass( "clicked" );
        $(this).toggleClass('clicked');
        $.ajax({
            url: '<?php echo base_url('admin/chat_realtime/test')?>',
            type: 'POST',
            data: {
                'user_id': user_id
            },
            success: function (response) {
                // alert(response);
                // console.log('ttttttttt'+user_id)
                console.log('log ajax: '+response)
                // console.log(typeAccountChatAdmin)
                $('#list_content').html(response);
                //Do something here...
            }
        });
        $('.chatbox').show();
    })
</script>