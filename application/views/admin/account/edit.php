<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa tên đăng nhập, avatar</h3></div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <!--			<a href="-->
            <?php //echo admin_url('account/add')?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--			<a href="-->
            <?php //echo admin_url('account')?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
        </div>
    </div>
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên đăng nhập<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtName" name="txtName" value="<?php echo $account[0]->UserName ?>"
                       required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên nhân sự<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input disabled type="text" id="txtName" name="txtName" value="<?php echo $account[0]->employee_name ?>"
                       required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>


        <!--        <div class="form-group">-->
        <!--            <p style='display: none'>click để tùy chọn thay đổi mật khẩu</p>-->
        <!---->
        <!---->
        <!--            <button id="show" value = '1'>Để mật khẩu cũ</button>-->
        <!--            <button id="hide" value = '2'>Chọn mật khẩu mới</button>-->
        <!---->
        <!--            <div class="form-group" id="pw_1" style="display: none">-->
        <!--                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mật khẩu <span-->
        <!--                            class="required">*</span></label>-->
        <!--                <div class="col-md-4 col-sm-4 col-xs-12">-->
        <!--                    <input type="password" id="txtPassword" name="txtPassword" value="" required="required"-->
        <!--                           class="form-control col-md-7 col-xs-12">-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!--            <div class="form-group" id="pw_2" style="display: none">-->
        <!--                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mật khẩu mới</label>-->
        <!--                <div class="col-md-4 col-sm-4 col-xs-12">-->
        <!--                    <input type="password" id="txtNewPassword" name="txtNewPassword"-->
        <!--                           class="form-control col-md-7 col-xs-12">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="form-group" id="pw_3" style="display: none">-->
        <!--                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Nhập lại mật khẩu</label>-->
        <!--                <div class="col-md-4 col-sm-4 col-xs-12">-->
        <!--                    <input type="password" id="txtConfirmPassword" name="txtConfirmPassword"-->
        <!--                           class="form-control col-md-7 col-xs-12">-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->

        <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Ảnh avatar <span class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <?php if ($account[0]->img != '') { ?>
<!--                    <img src="--><?php //echo base_url('upload/') . $account[0]->img ?><!--" width="80px">-->
                    <img src="<?php echo base_url() ?>public/images/employee/<?php echo $account[0]->img ?>" width="80px">
                <?php } else { ?>
                    <img src="<?php echo base_url('public/') . 'icon-user-default.png' ?>" width="80px">
                <?php } ?>
                <!--              <img id="img_account" src="-->
                <?php //echo base_url('upload/'.$account->img) ?><!--" height="150px"><br>-->
                <input type="radio" name="changeImg" value="2" checked> Để ảnh cũ<br>
                <input type="radio" name="changeImg" value="1"> Chọn ảnh mới<br>
                <div id="imgChange"></div>
                <img id="pre_img" style="max-width: 150px; max-height: 150px"/>
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateaccount" name="btnUpdateaccount" required="required"
                       class="btn btn-success" value="Cập nhật">
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1">
                <!--            <a href="-->
                <?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <a href="<?php echo admin_url('account') ?>" class="btn btn-success">Quay lại</a>
            </div>
        </div>
    </form>
</div>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type=radio][name=changeImg]').change(function () {
            if (this.value == 1) {
                $("#imgChange").html('<input type="file" id="imageaccount" name="imageaccount" value="" required="required" style="padding: 5px;" accept="image/*">');
                $('#pre_img').show();
                $("#img_account").hide();
            }
            else if (this.value == 2) {
                $("#img_account").show();
                $("#imgChange").html('');
                $('#pre_img').hide();
            }
            $("#imageaccount").change(function () {
                readURL(this);
            });
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pre_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $("#hide").click(function(){-->
<!--            // $("p").show();-->
<!--            $("#pw_1").show();-->
<!--            $("#pw_2").show();-->
<!--            $("#pw_3").show();-->
<!--            console.log(this.value);-->
<!--            // alert(this.value);-->
<!--        });-->
<!--        $("#show").click(function(){-->
<!--            $("#pw_1").hide();-->
<!--            $("#pw_2").hide();-->
<!--            $("#pw_3").hide();-->
<!--            // $("p").hide();-->
<!--            // alert(this.value);-->
<!--            console.log(this.value);-->
<!--        });-->
<!--    });-->
<!--</script>-->

