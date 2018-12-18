<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm mới</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
    <!--            <!--            <a href="-->
    <!--            --><?php ////echo admin_url('shop/add') ?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('shop') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
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
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tên cửa hàng<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <textarea name="name" class="form-control" rows="1"
                          placeholder="Tên cửa hàng"></textarea>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Địa chỉ<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <textarea name="address" class="form-control" rows="1"
                          placeholder="address"></textarea>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Thành phố<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="city_id">
                    <?php
                    foreach ($city as $value) { ?>
                        <option value="<?php echo $value->id. '|'.$value->area ?>"><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="submit" id="btnAddEvent" name="btnAdd" required="required" class="btn btn-success"
                       value="Thêm">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--            <a href="-->
                <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <a href="<?php echo admin_url('shop') ?>" class="btn btn-success">Quay lại</a>
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
