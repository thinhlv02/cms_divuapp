<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm nhân sự mới</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
    <!--            <!--            <a href="-->
    <!--            -->
    <?php ////echo admin_url('employee/add') ?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('employee') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
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
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Mã NS<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="maso" value="" required placeholder="BD + số, vd: BD05"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Họ Tên<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="txtName" name="txtName" value="" required placeholder="Họ Tên"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Giới tính<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="sex">
                    <option value="0" <?php if (isset($_POST['sex']) && $_POST['sex'] == 0) echo 'selected' ?>>Nam
                    </option>
                    <option value="1" <?php if (isset($_POST['sex']) && $_POST['sex'] == 1) echo 'selected' ?>>Nữ
                    </option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ngày Sinh<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--                <span style="float: left;margin-top: 7px">Từ ngày: </span>-->
                <!--                <div class="col-md-6 col-sm-6 col-xs-12">-->
                <input type="text" id="txtTo3" name="birthday" required
                       class="form-control col-md-7 col-xs-12">
                <!--                </div>-->
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nơi Sinh<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="" name="noisinh" placeholder="Nơi Sinh"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Số CMND<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="" name="cmtnd" placeholder="Số cmtnd"
                       class="form-control col-md-7 col-xs-12">
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ngày cấp<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtTo4" name="ngaycap" required class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nơi cấp<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="" name="captai" placeholder="Nơi cấp"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">HKTT<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="" name="address" required placeholder="Hộ khẩu thường trú"
                       class="form-control col-md-6 col-xs-11">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Chỗ ở H.tại<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" placeholder="Chỗ ở hiện tại" name="ohientai" class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">SĐT cá nhân<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="" name="phone" placeholder="SĐT cá nhân"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">EMail C.nhân<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="email" placeholder="EMail cá nhân"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">SĐT Hotline<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="" name="hotline" placeholder="SĐT Hotline"
                       class="form-control col-md-6 col-xs-11">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">EMail C.ty<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="email_cty" placeholder="EMail công ty"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">TK Skype<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="skype" placeholder="Tài khoản skype"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Chức vụ<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="position" placeholder="chức vụ"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tên giao dịch<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="transaction_name" placeholder="Tên giao dịch"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Cty/C.nhánh<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control" name="company_id">
                        <?php
                        foreach ($company as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Phòng ban<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select class="select2_group form-control" name="department">
                    <?php foreach ($deparment as $value): ?>
                        <option value="<?php echo $value->id ?>">
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nơi làm việc<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="noi_lamviec" placeholder="Nơi làm việc"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ngày BĐVL<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="ngay_bd" required placeholder="NGÀY BẮT ĐẦU VÀO LÀM"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">HĐTV<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="hdtv" placeholder="HĐTV"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">QĐCT<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="txtTo" name="qdct" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">HĐLĐ<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtTo2" name="hdld" required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">QĐNV<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="qdnv" placeholder="QĐNV"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Ảnh<span
                        class="required">*</span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="file" class="form-control" name="img_news2" id="img_news2">
            </div>
        </div>
        <!--        <div class="form-group">-->
        <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
        <!--                <input type="text" id="txtName" name="PROCESS_CODE" value="" required-->
        <!--                       class="form-control col-md-7 col-xs-12">-->
        <!--            </div>-->
        <!--        </div>-->

        <!--        <div class="form-group">-->
        <!--            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nick<span-->
        <!--                        class="required"></span></label>-->
        <!--            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
        <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
        <!--                <input type="text" name="displayName" required-->
        <!--                       placeholder="displayName"-->
        <!--                       class="form-control col-md-7 col-xs-12">-->
        <!--            </div>-->
        <!--        </div>-->

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="submit" id="btnAddEvent" name="btnAddemployee" required="required" class="btn btn-success"
                       value="Thêm">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--            <a href="-->
                <?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <a href="<?php echo admin_url('employee') ?>" class="btn btn-success">Quay lại danh sách</a>
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
