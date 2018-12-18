<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/ckfinder/ckfinder.js"></script>

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
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="type" id="type">
                    <!--                    <option value="all">Chọn một loại</option>-->
                    <option value="1">Tang DIV</option>
                    <option value="2">Tang goi dich vu</option>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">div<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input id="id_div" type="number" name="div" class="form-control" placeholder="Default Input" min="1"
                       value="1"
                       required>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Gói DV<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="service_package_id" id="id_service_package_id">
                    <?php foreach ($service_package as $k => $v) { ?>
                        <option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Đại lý<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="agent">
                    <?php foreach ($agency as $k => $v) { ?>
                        <option value="<?php echo $v->id ?>"><?php echo $v->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Hạn dùng<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtTo4" name="expire_date" required
                       value="<?php if (isset($_POST['expire_date'])) echo date('d-m-Y', strtotime($_POST['expire_date'])) ?>"
                       class="form-control col-md-7 col-xs-12"/>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tỉnh thành<span
                        class="required">*</span></label>

            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control-custom" name="vn_city" id="mySelect"
                        onchange="myFunction()">
                    <option value="all">Tất cả</option>
                    <?php
                    $_SESSION['vn_city'] = $_POST['vn_city'];
                    foreach ($vn_city as $value) { ?>
                        <option value="<?php echo $value->id ?>"
                            <?php if ($_SESSION['vn_city'] == $value->id) echo 'selected'; ?>>
                            <?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Quận/huyện<span
                        class="required">*</span></label>

            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control-custom" name="vn_district" id="vn_district_new">
                    <!--                        <option value="all">Tất cả</option>-->
                    <?php
                    $str_district = $this->session->userdata('str_district');
                    if (isset($str_district)) {
                        echo $str_district;
                    } else { ?>
                        <option value="all">Tất cả</option>
                    <?php } ?>
                    <!--                        <option value="1">1</option>-->
                    <!--                        <option value="2">2</option>-->
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Phường/xã<span
                        class="required">*</span></label>

            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control-custom" name="vn_ward" id="vn_ward_new">
                    <!--                        <option value="all">Tất cả</option>-->
                    <?php
                    $str_vn_ward = $this->session->userdata('str_vn_ward');
                    if (isset($str_vn_ward)) {
                        echo $str_vn_ward;
                    } else { ?>
                        <option value="all">Tất cả</option>
                    <?php } ?>
                    <!--                        <option value="1">1</option>-->
                    <!--                        <option value="2">2</option>-->
                </select>
            </div>
            <!--            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại cộng, trừ<span-->
            <!--                        class="required"></span></label>-->
            <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--                <select class="select2_group form-control" name="sub">-->
            <!--                    --><?php //foreach ($service_package as $k => $v) { ?>
            <!--                        <option value="--><?php //echo $v->id ?><!--">-->
            <?php //echo $v->name ?><!--</option>-->
            <!--                    --><?php //} ?>
            <!---->
            <!--                    <option value="1">Cộng</option>-->
            <!--                    <option value="2">Trừ</option>-->
            <!--                </select>-->
            <!--            </div>-->
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Số lượng code<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="number" name="number_code" class="form-control" placeholder="Default Input" min="1"
                       value="1"
                       required>
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

    $(function () {
        $('#id_service_package_id').hide();
        $("#id_service_package_id").prop("disabled", true);
        $('#type').change(function () {
            console.log($('#type').val());
            if ($('#type').val() == 2) {
                //goi dv
                $('#id_service_package_id').show();
                $("#id_service_package_id").prop("disabled", false);
                $('#id_div').hide();
                $("#id_div").prop("disabled", true);
            } else if (($('#type').val() == 1)) {
                //div
                $('#id_service_package_id').hide();
                $('#id_div').show();
                $("#id_service_package_id").prop("disabled", true);
                $("#id_div").prop("disabled", false);
            }
        });
    });

    function myFunction() {
        var vn_city = document.getElementById("mySelect").value;
        if (vn_city === 'all') {
            $('#vn_ward_new').replaceWith('<select  class="select2_group form-control-custom" name="vn_ward" id="vn_ward_new">' +
                '<option value="all">Tất cả</option>' +
                '</select>');
        }
        console.log('vn_city: ' + vn_city);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/get_department/get_vn_district')?>',
            data: {
                'vn_city': vn_city
            },
            success: function (msg) {
                // console.log('fuck');
                $('#vn_district_new').html(msg);
            },
            error: function (xhr, status, error) {
                console.log(status);
                console.log(xhr.responseText);
                // alert(status);
                // alert(xhr.responseText);
            }
        });
    }

    // $(function () {
    $('#vn_district_new').change(function () {
        var vn_district_new = $('#vn_district_new').val();
        console.log('vn_district_new : ' + vn_district_new);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/get_department/get_vn_ward')?>',
            data: {
                'district_id': vn_district_new
            },
            success: function (msg) {
                // console.log('fuck');
                $('#vn_ward_new').html(msg);
            },
            error: function (xhr, status, error) {
                console.log(status);
                console.log(xhr.responseText);
                // alert(status);
                // alert(xhr.responseText);
            }
        });
    })
    // })
</script>
