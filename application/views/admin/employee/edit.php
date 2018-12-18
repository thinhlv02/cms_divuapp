<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chỉnh sửa thông tin nhân sự</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">-->
    <!--            <a href="-->
    <?php //echo admin_url('employee/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('employee') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
    <!--        </div>-->
    <!--    </div>-->
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="x_panel">
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Mã NS<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="maso" value="<?php echo $employee->maso ?>" required
                       placeholder="BD + số, vd: BD05"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Họ Tên<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="txtName" name="txtName" value="<?php echo $employee->name ?>" required
                       placeholder="Họ Tên"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Giới tính<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="sex">
                    <option value="0" <?php if ($employee->sex == 0) echo 'selected' ?>>Nam</option>
                    <option value="1" <?php if ($employee->sex == 1) echo 'selected' ?>>Nữ</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ngày Sinh<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtTo3" name="birthday" required
                       value="<?php echo date('d-m-Y', $employee->birthday) ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nơi Sinh<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="" name="noisinh" value="<?php echo $employee->name ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <?php $identity = explode('|', $employee->identity_card) ?>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Số CMND<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="" name="cmtnd" placeholder="Số cmtnd" value="<?php echo $identity[0] ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ngày cấp<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="txtTo4" name="ngaycap" value="<?php echo date('d-m-Y', $identity[1]) ?>"
                       required class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nơi cấp<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="" name="captai" value="<?php echo $identity[2] ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">HKTT<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="" name="address" required placeholder="Hộ khẩu thường trú"
                       value="<?php echo $employee->address ?>"
                       class="form-control col-md-6 col-xs-11">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Chỗ ở H.tại<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" placeholder="Chỗ ở hiện tại" value="<?php echo $employee->ohientai ?>"
                       name="ohientai" class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">SĐT cá nhân<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" id="" name="phone" value="<?php echo $employee->phone ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">EMail C.nhân<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="email" placeholder="MAIL CÁ NHÂN"
                       value="<?php echo $employee->email ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">SĐT Hotline<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id="" name="hotline" placeholder="" value="<?php echo $employee->hotline ?>"
                       class="form-control col-md-6 col-xs-11">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">EMail C.ty<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="email_cty" placeholder="Mail công ty"
                       value="<?php echo $employee->email_cty ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">TK Skype<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="skype" placeholder="Tài khoản skype" value="<?php echo $employee->skype ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Chức vụ<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="position" placeholder="chức vụ" value="<?php echo $employee->position ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tên giao dịch<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" name="transaction_name" placeholder="Tên giao dịch"
                       value="<?php echo $employee->transaction_name ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Cty/C.nhánh<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="company_id">
                    <?php
                    foreach ($company as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $employee->company_id) echo 'selected' ?>><?php echo $value->name ?></option>
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
                        <option value="<?php echo $value->id ?>"
                            <?php if ($employee->department_id == $value->id) echo 'selected' ?>>
                            <?php echo $value->name ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nơi làm việc<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <input type="text" value="<?php echo $employee->noi_lamviec ?>" name="noi_lamviec"
                       placeholder="Nơi làm việc"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ngày BDVL<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtFrom" name="ngay_bd" value="<?php echo date('d-m-Y', $employee->ngay_bd) ?>"
                       required placeholder="NGÀY BẮT ĐẦU VÀO LÀM"
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
                       value="<?php echo date('d-m-Y', $employee->qdct) ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">HĐLĐ<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtTo2" name="hdld" required
                       value="<?php echo date('d-m-Y', $employee->hdld) ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">QĐNV<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="qdnv" placeholder="QĐNV" value="<?php echo $employee->name ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ảnh<span
                        class="required"></span></label>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <?php if (isset($employee->img)) { ?>
                        <td><img src="<?php echo base_url() ?>public/images/employee/<?php echo $employee->img ?>" alt="..."
                                 class="" style="height: 50px;"></td>
                    <?php } ?>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="file" class="form-control" name="img_news2" id="img_news2">
                </div>
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
                <input type="submit" id="btnUpdateEvent" name="btnUpdateemployee" required
                       class="btn btn-success" value="Cập nhật">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--            <a href="-->
                <?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <!--                <a href="-->
                <?php //echo admin_url('employee') ?><!--" class="btn btn-success">Quay lại danh sách</a>-->
                <input type="submit" id="btnUpdateEvent" name="btnback" required
                       class="btn btn-success" value="Quay lại danh sách">
            </div>
        </div>
    </form>
</div>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type=radio][name=changeImg]').change(function () {
            if (this.value == 1) {
                $("#imgChange").html('<input type="file" id="imageEvent" name="imageEvent" value="" required="required" style="padding: 5px;" accept="image/*">');
                $('#pre_img').show();
                $("#img_event").hide();
            }
            else if (this.value == 2) {
                $("#img_event").show();
                $("#imgChange").html('');
                $('#pre_img').hide();
            }
            $("#imageEvent").change(function () {
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

