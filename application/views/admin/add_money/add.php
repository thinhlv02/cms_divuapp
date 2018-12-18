<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<?php //$this->load->view('admin/chat_realtime/process.php') ;
if (isset($_GET['userid'])) {
    echo $_GET['userid'];
    $this->load->view('admin/chat_realtime/process.php');
    ?>
    <script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // $('#btnSun').click(myFunction);
            CSKHChat(1, 1, 'conga1411 test cộng tiền');
        });
    </script>
    <?php

}
?>
<div class="page-title">
    <div class="title_left"><h3>Thêm</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
    <!--            <!--            <a href="-->
    <!--            -->
    <?php ////echo admin_url('config_payment/add') ?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('config_payment') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
    <!--        </div>-->
    <!--    </div>-->
</div>
<?php //  pre($unit); ?>
<div class="x_panel">
    <?php if ($message) {
        $this->load->view('admin/message', $this->data);
    } ?>
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại quyền<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="type" id="type">
                    <option value="1">Admin/KTV</option>
                    <option value="2">Khách hàng</option>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">UserID<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" name="userid" class="form-control" placeholder="Default Input" min="0" required>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Lý do<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <textarea name="note" class="form-control" rows="1" placeholder="" required>test</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại tiền<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="money_id">
                    <?php
                    foreach ($money_id as $value) { ?>
                        <option <?php if($value->id == 3) echo 'id= "row_dim" ' ?> value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Số tiền<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" name="money" class="form-control" value="0" placeholder="Default Input" min="0"
                       required>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại cộng, trừ<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="sub">
                    <option value="1">Cộng</option>
                    <option value="2">Trừ</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="submit" id="btnAddEvent" name="btnAdd" required="required" class="btn btn-success"
                       value="Thực hiện">
            </div>
            <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--            <a href="-->
            <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--                <a href="-->
            <?php //echo admin_url('config_payment') ?><!--" class="btn btn-success">Quay lại danh sách</a>-->
            <!--            </div>-->
        </div>
    </form>
</div>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    $(function () {
        $('#row_dim').show();
        $('#type').change(function () {
            console.log($('#type').val());
            if ($('#type').val() == '2') {
                $('#row_dim').hide();
            } else {
                $('#row_dim').show();
            }
        });
    });
</script>
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

<script>
    $(function () {
        $('#colorselector').change(function () {
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function () {
        $('#ngaymua_selector').change(function () {
            $('.ngaymuas').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>
