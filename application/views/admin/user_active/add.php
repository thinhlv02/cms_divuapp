<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm tài khoản KTV</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
    <!--<!--            <a href="-->
    <?php ////echo admin_url('admin/add') ?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
    <!--        </div>-->
    <!--    </div>-->
</div>

<div class="x_panel">
    <?php if ($message) {
        $this->load->view('admin/message', $this->data);
    } ?>
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên đăng nhập<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="txtName" required placeholder="nhập tên đăng nhập"
                       value="<?php if (isset($_POST['txtName'])) echo $_POST['txtName'] ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Mật khẩu <span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input id="password-field" type="password" class="form-control" name="txtPassword" value="123456">
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Vị trí<span
                        class="required">*</span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="level">
                    <?php foreach ($cms_admin_level_model as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">SĐT <span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input id="password-field" type="text" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'] ?>"
                       class="form-control" name="phone" placeholder="nhập sđt" required>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên đầy đủ <span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input id="password-field" type="text" class="form-control" name="fullname"
                       value="<?php if (isset($_POST['fullname'])) echo $_POST['fullname'] ?>"
                       placeholder="nhập fullname" required>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Địa chỉ <span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input id="password-field" type="text" class="form-control" name="address"
                       value="<?php if (isset($_POST['address'])) echo $_POST['address'] ?>"
                       placeholder="nhập address" required>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">email <span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input id="password-field" type="text" class="form-control" name="email"
                       value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>"
                       placeholder="nhập email" required>
            </div>
        </div>

        <div class="form-group">

        </div>
        <!--        <div class="form-group">-->
        <!--        <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">Cty/C.nhánh<span-->
        <!--                    class="required"></span></label>-->
        <!--        <div class="col-md-3 col-sm-3 col-xs-12">-->
        <!--            <select class="select2_group form-control" name="company_id">-->
        <!--                --><?php
        //                foreach ($company as $value) { ?>
        <!--                    <option value="--><?php //echo $value->id ?><!--">--><?php //echo $value->name ?><!--</option>-->
        <!--                --><?php //} ?>
        <!--            </select>-->
        <!--        </div>-->
        <!--        </div>-->


        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnAddEvent" name="btnAddadmin" required="required" class="btn btn-success"
                       value="Thêm">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--            <a href="-->
                <?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <a href="<?php echo admin_url('user_active') ?>" class="btn btn-success">Quay lại danh sách</a>
            </div>
        </div>
    </form>
</div>

<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $("#imageEvent").change(function () {
            readURL(this);
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
    });
</script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
		var editor = CKEDITOR.replace('txtContent', {
			height: '300px',
			filebrowserBrowseUrl : '<?php echo base_url() . "public/ckfinder/ckfinder.html"; ?>',
			filebrowserImageBrowseUrl : '<?php echo base_url() . "public/ckfinder/ckfinder.html?Type=Images"; ?>',
			filebrowserFlashBrowseUrl : '<?php echo base_url() . "public/ckfinder/ckfinder.html?Type=Flash" ?>',
			filebrowserUploadUrl : '<?php echo base_url() . "public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files" ?>',
			filebrowserImageUploadUrl : '<?php echo base_url() . "public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images"; ?>',
			filebrowserFlashUploadUrl : '<?php echo base_url() . "ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"; ?>',
			filebrowserWindowWidth : '800',
			filebrowserWindowHeight : '480'
		});
		CKFinder.setupCKEditor( editor, "<?php echo base_url() . 'public/ckfinder/' ?>" );
	});
</script> -->
