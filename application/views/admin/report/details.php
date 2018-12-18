<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left"><h3>Chi tiết thông tin tài sản</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">-->
    <!--<!--            <a href="-->
    <?php ////echo admin_url('asset/add') ?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="-->
    <?php //echo admin_url('asset') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
    <!--        </div>-->
    <!--    </div>-->
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Mã Tài sản<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="asset_code" disabled
                       value="<?php echo $asset->asset_code ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Ngày kiểm kê<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input disabled type="text" id="" name="ngay_kiemke"
                       value="<?php echo date('d-m-Y', $asset->ngay_kiemke) ?>"
                       required class="form-control col-md-7 col-xs-12">
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">Tên tài sản<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input disabled type="text" name="asset_name" value='<?php echo $asset->asset_name ?>'
                       required class="form-control col-md-7 col-xs-12">
            </div>

        </div>
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Serial<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input disabled type="text" id="txtName" name="seri"
                       value="<?php echo $asset->seri ?>"
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">ĐVT<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select disabled class="select2_group form-control" name="unit_id">
                    <?php
                    foreach ($unit as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($asset->unit_id == $value->id) echo 'selected' ?>><?php echo $value->unit_name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Số Lượng<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input disabled type="number" name="amount"
                       value="<?php echo $asset->amount ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Ngày mua<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input disabled type="text" id="" name="ngaymua" value="<?php if ($asset->ngaymua == 0) {
                    echo 'Trống';
                } else {
                    echo date('d-m-Y', $asset->ngaymua);
                } ?>" required class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Bảo hành đến<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input disabled type="text" id="" name="baohanh_den" value="<?php if ($asset->baohanh_den == 0) {
                    echo 'Không bảo hành';
                } elseif ($asset->baohanh_den == 1) {
                    echo 'Hết bảo hành';
                } else {
                    echo date('d-m-Y', $asset->baohanh_den);
                } ?>" required class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">Người sử dụng<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <!--                <textarea name="employee_id" class="form-control" rows="1" value="-->
                <?php //echo $asset->employee_id ?><!--" placeholder="Nhập thông tin">-->
                <?php //echo $asset->employee_id ?><!--</textarea>-->
                <select disabled class="select2_group form-control" name="employee_id">
                    <?php
                    foreach ($employee as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $asset->employee_id) echo 'selected' ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <input disabled type="checkbox" name="status" value="2" <?php if ($asset->status == 2) echo 'checked'?>>TS Chung<br>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Loại tài sản<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select disabled class="select2_group form-control" name="assettype_id">
                    <?php
                    foreach ($assettype as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $asset->assettype_id) echo 'selected' ?>><?php echo $value->assettype_name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Trạng thái<span
                        class="required"></span></label>
            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select disabled class="select2_group form-control" name="tinhtrang">
                    <?php
                    foreach ($asset_status as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $asset->asset_status_id) echo 'selected' ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">Bộ phận sử dụng<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select disabled class="select2_group form-control" name="department_id">
                    <?php
                    foreach ($deparment as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $asset->department_id) echo 'selected' ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Ghi chú<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <textarea disabled name="asset_note" class="form-control"
                          rows="1"><?php echo $asset->asset_note ?></textarea>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Nhà cung cấp<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select disabled class="select2_group form-control" name="supplier_id">
                    <?php
                    foreach ($supplier as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $asset->supplier_id) echo 'selected' ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">Cty/C.nhánh<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <select disabled class="select2_group form-control" name="company_id">
                    <?php
                    foreach ($company as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($value->id == $asset->company_id) echo 'selected' ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
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

