<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Tài khoản khách hàng (<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
    </div>
    <div class="title_right">
        <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
        </div>
    </div>
</div>
<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="x_title">
            <form method="post">
                <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">UserID<span
                                class=""></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="number" name="userid" value="<?php if (isset($_POST['userid'])) echo $_POST['userid'] ?>" class="form-control" placeholder="Input" min="0" >
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">username<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" name="username" class="form-control" placeholder="Input" min="0">
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tên đầy đủ<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" name="fullname" class="form-control" placeholder="Input" min="0">
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">SĐT<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" name="phone" class="form-control" placeholder="Input" min="0">
                    </div>
<!--                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Trạng thái<span class="required">*</span></label>-->
<!---->
<!--                    <div class="col-md-2 col-sm-2 col-xs-12">-->
<!--                        <select class="select2_group form-control-custom" name="status">-->
<!--                            --><?php //if (isset($_POST['status'])){
//                                $_SESSION['status'] = $_POST['status'];
//                            } ?>
<!--                            <option value="all">All</option>-->
<!--                            --><?php //foreach ($status_cart as $key => $value) { ?>
<!--                                <option value="--><?php //echo $key ?><!--" --><?php //if (isset($_SESSION['status']) && $_SESSION['status'] == $key) echo 'selected'; ?><!-- >--><?php //echo $value ?><!--</option>-->
<!--                            --><?php //} ?>
<!---->
<!--                        </select>-->
<!--                    </div>-->
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tỉnh thành<span
                                class="required">*</span></label>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control-custom" name="vn_city" id="mySelect"
                                onchange="myFunction()">
                            <option value="all">Tất cả</option>
                            <?php
                            $_SESSION['vn_city'] = $_POST['vn_city'];
                            foreach ($vn_city as $value) { ?>
                                <option value="<?php echo $value->id ?>" <?php if ($_SESSION['vn_city'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
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








                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>
                    </div>
                    <div class="col-xs-1 col-xs-1">
                        <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                    </div>
                </div>
                <!--                <div class="ln_solid"></div>-->
                <div class="form-group">
<!--                    <div class="col-md-2 col-sm-2 col-xs-12">-->
<!--                        <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>-->
<!--                    </div>-->
<!--                    <div class="col-xs-1 col-xs-1">-->
<!--                        <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>-->
<!--                    </div>-->
                </div>

                <!--                <div class="col-xs-1 col-xs-1">-->
                <!--                    --><?php //if (isset($res) && count($res) > 0) { ?>
                <!--                        <input type="submit" id="" name="btn_excel" required-->
                <!--                               class="btn btn-primary btn-sm" value="Xuất excel">-->
                <!--                    --><?php //} ?>
                <!--                </div>-->
            </form>

            <div class="col-md-3 col-sm-3 col-xs-12 pull-left">
                <!--            <a href="-->
                <?php //echo admin_url('asset') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
            </div>
            <!--        <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"-->
            <!--              enctype="multipart/form-data">-->
            <div class="x_content">
<!--                <div class="table-responsive">-->
                    <!--        --><?php //echo $ban; ?>
                    <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                        <!--        <table id="" class="table table-striped table-bordered bulk_action">-->
                        <thead>
                        <tr>
                            <!--                            <th><input type='checkbox' id='select_all_invoices' onclick="selectAll()">All</th>-->
<!--                            <th>STT</th>-->
                            <th>ID</th>
                            <th>username</th>
                            <th>display name</th>
                            <th>sđt</th>
                            <th>email</th>
                            <th>Địa chỉ</th>
                            <th>Ngày tạo tài khoản</th>
                            <th>Tiền hiện tại</th>
                            <th>Gói dịch vụ đang sử dụng</th>
                            <th>Chi tiết</th>
<!--                            --><?php //if (isset($type_cart) && $type_cart == 1) { ?>
<!--                                <th>Địa chỉ KTV xác nhận</th>-->
<!--                                <th>Thao tác</th>-->
<!--                            --><?php //} ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <?php $i++;
                            ?>
                            <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
<!--                                <td>--><?php //echo $i ?><!--</td>-->
                                <td><?php echo $value->id ?></td>
                                <td class=""><?php echo $value->username ?></td>
                                <td class=""><?php echo $value->fullname ?></td>
                                <td class=""><?php echo $value->phone ?></td>
                                <td class=""><?php echo $value->email ?></td>
                                <td class=""><?php echo $value->address ?></td>
                                <td class=""><?php echo $value->created_at ?></td>
                                <td class=""><?php echo number_format($value->balance) ?></td>
                                <td class=""><?php
                                    foreach ($value->service_package as $key22 => $value22)
                                    echo '--->)'. $value22->name.'</br>' ?>
                                </td>
                                <td>
                                    <a class="text-primary" target="_blank" href="<?php echo admin_url('general_customers/general_customers_details1/' . create_slug($value->username) . '-' . $value->id . '.html') ?>">
                                        Chi tiết</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
<!--                </div>-->
            </div>
    </form>
</div>

<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }

    .pull-right a {
        float: right;
    }

    .pull-right {
        padding-right: 0px !important;
    }

    .disabled {
        pointer-events: none;
        cursor: default;
        opacity: 0.6;
    }
</style>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    function confirm_del_event(admin_id, id) {
        var r = confirm("Bạn có chắc chắn muốn xóa ?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin_mission/del/')?>" + admin_id + "/" + id;
        }
    }
    $('.yes').click(function () {
        var self = this;
        var tid = $(this).attr('tid');
        var user_id = $(this).attr('user_id');
        var province = $(this).attr('province');
        var district = $(this).attr('district');
        var ward = $(this).attr('ward');
        var address = $(this).attr('address');
        var province_id = $(this).attr('province_id');
        var district_id = $(this).attr('district_id');
        var ward_id = $(this).attr('ward_id');
        // console.log(user_id);
        if (confirm('Bạn có đồng ý thay đổi ??')) {
            $.ajax({
                url: '<?php echo base_url('admin/lock_admin/update_address')?>',
                type: 'POST',
                data: {
                    'tid': tid,
                    'user_id': user_id,
                    'province': province,
                    'district': district,
                    'ward': ward,
                    'address': address,
                    'province_id': province_id,
                    'district_id': district_id,
                    'ward_id': ward_id,
                },
                success: function (response) {
                    //Do something here...
                    alert(response);
                    // console.log(response.indexOf('Hủy thành công'));
                    if (response.indexOf('cập nhật thành công') != -1) {
                        $(self).parent().parent().find(".yes").hide();
                        // $(self).parent().parent().find(".no").hide();
                        // $(self).hide();
                    }
                }
            });
        }
    });


    function myFunction() {
        var vn_city = document.getElementById("mySelect").value;
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
</script>