<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('kinhdoanh/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('kinhdoanh') ?>"
               class="btn btn-info btn-sm">Danh sách</a>
        </div>
    </div>
</div>

<div class="x_panel">
    <?php if (isset($message)) {
        $this->load->view('admin/message', $this->data);
    } ?>
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Ngày<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">

                <input type="text" id="txtFrom" name="date1" required
                       value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])); else echo date('d-m-Y', strtotime($res->date)) ?>"
                       class="form-control col-md-7 col-xs-12" />
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tổng doanh thu<span class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="" name="total" required="required" value="<?php echo $res->total ?>"
                       class="form-control col-md-7 col-xs-12" placeholder="">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">CP quảng cáo<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="" name="cp_quangcao" value="<?php echo $res->cp_quangcao ?>"
                       class="form-control col-md-7 col-xs-12" placeholder="">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Giá vốn<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="" name="gia_von" value="<?php echo $res->gia_von ?>"
                       class="form-control col-md-7 col-xs-12" placeholder="">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cp văn phòng<span class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="" name="cp_vanphong" required="required" value="<?php echo $res->cp_vanphong ?>"
                       class="form-control col-md-7 col-xs-12" placeholder="">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Lương<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="" name="luong" value="<?php echo $res->luong ?>"
                       class="form-control col-md-7 col-xs-12" placeholder="">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">CP khác<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="" name="cp_khac" value="<?php echo $res->cp_khac ?>"
                       class="form-control col-md-7 col-xs-12" placeholder="">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">LN thuần<span class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" id="" name="ln_thuan" required="required" value="<?php echo $res->ln_thuan ?>"
                       class="form-control col-md-7 col-xs-12" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1" style="">
                <input type="submit" id="btnAddEvent" name="btnEdit" required
                       class="btn btn-success"
                       value="Cập nhật">
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
