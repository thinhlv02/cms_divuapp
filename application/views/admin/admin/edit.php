<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <!--    <div class="title_left"><h3>User: <span-->
    <!--                    style="color: red">-->
    <?php //echo $this->employee_model->get_info($user->employee_id)->name ?><!--</span>-->
    <!--        </h3>-->
    <!--    </div>-->
    <div class="title_left"><h3>Sửa tài khoản</span></h3>
    </div>
<!--    <div class="title_right">-->
<!--        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">-->
<!--            <a href="--><?php //echo admin_url('admin/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
<!--            <a href="--><?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
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
            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên đăng nhập<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" id="txtName" name="txtName"
                       value="<?php echo $user->username ?>" required
                       class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">SĐT<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" value="<?php echo $user->phone ?>" name="phone" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
            </div>

            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">Email<span
                        class="required"></span></label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" name="email" value="<?php echo $user->email ?>" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Avatar<span
                        class="required">*</span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <?php if (isset($user->link_avatar)) { ?>
                    <td><img src="<?php echo $user->link_avatar ?>" style="max-width: 200px"> </td>
                <?php } ?>
                <input type="file" class="form-control" name="img_banner" id="img_banner">
            </div>


        </div>

<!--        <div class="form-group">-->
<!--            <label class="control-label col-md-2 col-sm-2 col-xs-12 text-nowrap" for="first-name">Quận/ Huyện<span-->
<!--                        class="required"></span></label>-->
<!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
<!--                <select class="select2_group form-control" name="district_work_id">-->
<!--                    --><?php
//                    foreach ($vn_district as $value) { ?>
<!--                        <option value="--><?php //echo $value->id ?><!--" --><?php //if ($value->id == $user->district_work_id) echo 'selected' ?><!-->
<!---->
<!--                            --><?php //echo $value->name ?><!--</option>-->
<!--                    --><?php //} ?>
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->


<!--        <div class="form-group">-->
<!--            <label class="control-label col-md-2 col-sm-2 col-xs-2" for="first-name">Nhân sự<span-->
<!--                        class="required">*</span></label>-->
<!--            <!--            <span style="float: left;margin-top: 7px">Số</span>-->
<!--            <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                <select class="select2_group form-control" name="employee_id">-->
<!--                    --><?php //foreach ($emp as $value): ?>
<!--                        <option value="--><?php //echo $value->id ?><!--" --><?php //if ($value->id == $user->employee_id) echo 'selected' ?><!-->
<!--                            --><?php //echo $value->name ?><!--</option>-->
<!--                    --><?php //endforeach; ?>
<!--                    <option value="123456">No Name</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-1" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdateadmin" required
                       class="btn btn-success" value="Lưu">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <!--            <a href="-->
                <?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <a href="<?php echo admin_url('admin') ?>" class="btn btn-success">Quay lại</a>
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

    function myFunction() {
        var vn_city = document.getElementById("mySelect").value;
        console.log('vn_city: ' + vn_city);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/get_department/get_vn_district2')?>',
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
</script>

