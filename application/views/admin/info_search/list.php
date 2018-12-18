<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Thông tin tìm kiếm (<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
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
                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">KH/KTV-CTV<span
                                class="required">*</span></label>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control-custom" name="type_cart">
                            <option value="1" <?php if (isset($_POST['type_cart']) && $_POST['type_cart'] == 1) echo 'selected' ?>>
                                Khách hàng
                            </option>
                            <option value="2" <?php if (isset($_POST['type_cart']) && $_POST['type_cart'] == 2) echo 'selected' ?>>
                                KTV-CTV
                            </option>
                        </select>
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">UserID<span
                                class=""></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="number" name="userid"
                               value="<?php if (isset($_POST['userid'])) echo $_POST['userid'] ?>" class="form-control"
                               placeholder="Input" min="0">
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">username<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" name="username"
                               value="<?php if (isset($_POST['username'])) echo $_POST['username'] ?>"
                               class="form-control" placeholder="Input" min="0">
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tên đầy
                        đủ<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" name="fullname"
                               value="<?php if (isset($_POST['fullname'])) echo $_POST['fullname'] ?>"
                               class="form-control" placeholder="Input" min="0">
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
                    <!--                                <option value="--><?php //echo $key ?><!--" -->
                    <?php //if (isset($_SESSION['status']) && $_SESSION['status'] == $key) echo 'selected'; ?><!-- >-->
                    <?php //echo $value ?><!--</option>-->
                    <!--                            --><?php //} ?>
                    <!---->
                    <!--                        </select>-->
                    <!--                    </div>-->
                </div>
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">SĐT<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" name="phone" class="form-control" placeholder="Input" min="0">
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
                        <th>STT</th>
                        <th>UserID</th>
                        <th>username</th>
                        <th>Tên đầy đủ</th>
                        <th>Địa chỉ</th>
                        <th>SĐT</th>
                        <th>email</th>
                        <th>Tiền</th>
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
                            <td><?php echo $i ?></td>
                            <td><?php echo $value->id ?></td>
                            <td class="text-nowrap"><?php echo $value->username ?></td>
                            <td class="text-nowrap"><?php echo $value->fullname ?></td>
                            <td class="text-nowrap"><?php echo $value->address ?></td>
                            <td class="text-nowrap"><?php echo $value->phone ?></td>
                            <td class="text-nowrap"><?php echo $value->email ?></td>
                            <td class="text-nowrap"><?php echo number_format($value->balance) ?></td>
                            <!--                                --><?php //if ($type_cart == 1) { ?>
                            <!--                                <td class="text-nowrap">-->
                            <?php //if (isset($value->dia_chi_ktv_xac_nhan)) echo $value->dia_chi_ktv_xac_nhan ?><!--</td>-->
                            <!--                                    <td style="padding-top: 2%;width:10%">-->
                            <!--                                        <a href="-->
                            <?php //echo base_url('admin/info_search/edit/'.$value->id) ?><!--" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a></br>-->
                            <!--                                    </td>-->
                            <!--                                --><?php //} ?>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
                <!--                </div>-->
            </div>
    </form>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="text text-danger">Gói dịch vụ đang sử dụng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <!--                <table class="table table-striped jambo_table bulk_action">-->
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">

                    <thead>
                    <tr class="">
                        <th class="">STT</th>
                        <th class="">UserID/Tên</th>
                        <th class="">ID gói -> Tên gói</th>
                        <th class="">Thời gian bắt đầu</th>
                        <th class="">Thời gian kết thúc</th>
                        <th class="">Địa chỉ</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i = 0 ?>
                    <?php if (isset($info_2) && count($info_2) > 0 && $type_cart == 1) foreach ($info_2 as $key2 => $value2): ?>
                        <?php $i++; ?>
                        <!--                <tr id="--><?php //echo $value2->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                        <tr id="<?php ?>"
                            class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value2->id) echo 'bg_thanhly'; ?>">
                            <td class=""><?php echo $i ?></td>
                            <td class=""><?php echo $value2->user_id . ' -> ' . $value2->fullname ?></td>
                            <td class=""><?php echo $value2->id. ' ->'. $value2->name ?></td>
                            <td class=""><?php echo date('d-m-Y H:i:s', $value2->start_time) ?></td>
                            <td class=""><?php echo date('d-m-Y H:i:s', $value2->end_time) ?></td>
                            <td class=""><?php echo $value2->address ?></td>
                        </tr>

                    <?php endforeach ?>
                    <tr>
                        <td>Bổ sung thiết bị</td>
                        <td>chọn gói (ID gói -> Tên gói)
                            <select class="" id="mySelect">
                                <?php if (isset($info_2) && count($info_2) > 0 && $type_cart == 1) foreach ($info_2 as $key33 => $value33): ?>
                                    <option value="<?php echo $value33->id ?>"><?php echo $value33->id.' -> '. $value33->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </td>
                        <td>
                            <!--                            thiết bị đã thêm:-->
                            <!--                            --><?Php //foreach ($value33->list_appliance as $k => $v) {
                            //                                echo $k . ')' . $v->name . '<br/>';
                            //                            } ?>

                            tên thiết bị


                            <input type="text" id="name_" placeholder="" required/></td>
                        <td>Số lượng<input type="number" id="quantity_" placeholder="" min="1"/></td>
                        <td>nhà sản xuất<input type="text" id="manufacturer_" placeholder="" required/></td>
                        <td><input type="button" class="appliance" value="thêm"/></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="text text-danger">Danh sách thiết bị đi kèm gói DV</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <!--                <table class="table table-striped jambo_table bulk_action">-->
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">

                    <thead>
                    <tr class="">
                        <th class="">STT</th>
                        <th class="">Gói dịch vụ</th>
                        <th class="">Tên thiết bị</th>
                        <th class="">Số lượng</th>
                        <th class="">Nhà sản xuất</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i = 0 ?>
                    <?php if (isset($info_2) && count($info_2) > 0 && $type_cart == 1) foreach ($info_2 as $key2 => $value2): ?>
                        <?php $i++; ?>
                        <!--                <tr id="--><?php //echo $value2->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                        <tr id="<?php ?>"
                            class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value2->id) echo 'bg_thanhly'; ?>">
                            <td class=""><?php echo $i ?></td>
                            <td class=""><?php echo $value2->id.' -> '. $value2->name ?></td>

                            <td class=""><?php foreach ($value2->list_appliance as $k_ap => $v_app) {
                                $dem = $k_ap + 1;
//                                    if ($v_app->quantity > 0) {
                                        echo $dem. ' ) '. $v_app->name . '<hr/>';
//                                    }
                                } ?></td>

                            <td class=""><?php foreach ($value2->list_appliance as $v_app) {
//                                    if ($v_app->quantity > 0) {
                                        echo $v_app->quantity . '<hr/>';
//                                    }
                                } ?></td>

                            <td class=""><?php foreach ($value2->list_appliance as $v_app) {
//                                    if ($v_app->quantity > 0) {
                                        if ($v_app->manufacturer == '') echo 'Trống<hr>';
                                        else echo $v_app->manufacturer . '<hr/>';
//                                    }
                                } ?></td>
                        </tr>

                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="text text-danger">Thời gian hẹn</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <div class="table-responsive">
                <!--                <table class="table table-striped jambo_table bulk_action">-->
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">

                    <thead>
                    <tr class="">
                        <th class="">STT</th>
                        <th class="">ID</th>
                        <th class="">Mô tả</th>
                        <th class="">Thời gian</th>
                        <th class="">Trạng thái</th>
                        <th class="">Nhân sự</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i = 0;

                    ?>
                    <?php if (isset($info_3) && count($info_3) > 0 && $type_cart == 1) foreach ($info_3 as $key3 => $value3): ?>
                        <?php $i++;
                        $itemMonId = $value3->admin_id;
                        ?>
                        <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                        <tr id="<?php echo $value3->id; ?>"
                            class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value3->id) echo 'bg_thanhly'; ?>">
                            <td class="text-nowrap"><?php echo $i ?></td>
                            <td class="text-nowrap"><?php echo $value3->id ?></td>
                            <td class="text-nowrap"><?php echo $value3->des ?></td>
                            <td class="text-nowrap"><?php echo date('d-m-Y', $value3->time) ?></td>
                            <td class="text-nowrap"><?php echo $value3->name ?></td>
                            <td id="<?php echo $value->id . '_mon' ?>"
                                class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_mon') echo 'bg_thanhly'; ?>">
                                <?php if ($itemMonId) { ?>
                                    <?php
                                    $tags = explode(',', $itemMonId);
                                    foreach ($tags as $row) {
//                                           echo 'id teach: ' . $row .'---'. $value->status. '<br>';
                                        $itemMon = $this->admin_model->get_info($row);
                                        if (!empty($itemMon)) { ?>
                                            <div id="<?php echo $row; ?>"
                                                 class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'bg_thanhly'; ?>">
                                                <p class="text-nowrap text-info"> <?php echo $itemMon->fullname ?></p>
                                            </div>
                                            <hr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--duyệt  thông tin địa chỉ KH-->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="text text-danger">Duyệt thông tin địa chỉ khách hàng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                                class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
            <!--            <div class="table-responsive">-->
            <!--                <table class="table table-striped jambo_table bulk_action">-->
            <table id="datatable-product" class="table table-striped table-bordered bulk_action">

                <thead>
                <tr class="">
                    <th class="">STT</th>
                    <th class="">user_id</th>
                    <th class="">username</th>
                    <th class="">fullname</th>
                    <th class="">province</th>
                    <th class="">district</th>
                    <th class="">ward</th>
                    <th class="">address</th>
                    <th class="">province_id</th>
                    <th class="">district_id</th>
                    <th class="">ward_id</th>
                    <th class="">Confirm</th>
                </tr>
                </thead>

                <tbody>
                <?php $i = 0;

                ?>
                <?php if (isset($user_temp_address) && count($user_temp_address) > 0) foreach ($user_temp_address as $key4 => $value4): ?>
                    <?php $i++;
                    ?>
                    <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                    <tr id="<?php echo $value4->id; ?>"
                        class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value4->id) echo 'bg_thanhly'; ?>">
                        <td class="text-nowrap"><?php echo $i ?></td>
                        <td class=""><?php echo $value4->user_id ?></td>
                        <td class=""><?php echo $value4->username ?></td>
                        <td class=""><?php echo $value4->fullname ?></td>
                        <td class=""><?php echo $value4->province ?></td>
                        <td class=""><?php echo $value4->district ?></td>
                        <td class=""><?php echo $value4->ward ?></td>
                        <td class=""><?php echo $value4->address ?></td>
                        <td class=""><?php echo $value4->province_id ?></td>
                        <td class=""><?php echo $value4->district_id ?></td>
                        <td class=""><?php echo $value4->ward_id ?></td>
                        <td class=""><input type="button" class="yes"
                                            tid="<?php echo $value4->id ?>"
                                            user_id="<?php echo $value4->user_id ?>"
                                            province="<?php echo $value4->province ?>"
                                            district="<?php echo $value4->district ?>"
                                            ward="<?php echo $value4->ward ?>"
                                            address="<?php echo $value4->address ?>"
                                            province_id="<?php echo $value4->province_id ?>"
                                            district_id="<?php echo $value4->district_id ?>"
                                            ward_id="<?php echo $value4->ward_id ?>"
                                            latitude="<?php echo $value4->latitude ?>"
                                            longitude="<?php echo $value4->longitude ?>"
                                            value="OK"/></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            <!--            </div>-->
        </div>
    </div>
</div>
<!--duyệt  thông tin địa chỉ KH-->
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

    // $(document).ready(function(){
    //    console.log('out side ready');
    //    $('.yes').click(function(){
    //        console.log('ready when click class yes');
    //    })
    // });

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
        var latitude = $(this).attr('latitude');
        var longitude = $(this).attr('longitude');

        if (confirm('Bạn có đồng ý thay đổi ??')) {
            $.ajax({
                url: '<?php echo admin_url('lock_admin/update_address')?>',
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
                    'latitude': latitude,
                    'longitude': longitude,
                },
                success: function (response) {
                    console.log('ready: ' + response);
                    // console.log('url: ' + url);
                    //Do something here...
                    alert(response);
                    // console.log(response.indexOf('Hủy thành công'));
                    if (response.indexOf('cập nhật thành công') != -1) {
                        $(self).parent().parent().find(".yes").hide();
                        // $(self).parent().parent().find(".no").hide();
                        // $(self).hide();
                    }
                },
                error: function (xhr, textStatus, error) {
                    console.log(xhr.responseText);
                    console.log(xhr.statusText);
                    console.log(textStatus);
                    console.log(error);
                }
            });
        }
    });
    $('.appliance').click(function () {
        var self = this;
        var mySelect = $('#mySelect').val();
        var name_ = $('#name_').val();
        var quantity_ = $('#quantity_').val();
        var manufacturer_ = $('#manufacturer_').val();
        console.log(mySelect, name_, quantity_, manufacturer_);
        if (confirm('Bạn có đồng ý thêm thiết bị???')) {
            if (name_ == '' || quantity_ == '' || manufacturer_ == '') {
                alert('không được để trống các trường');
            } else {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/process/add_appliance') ?>",
                    cache: false,
                    data: {
                        'service_package_user_id': mySelect,
                        'name_': name_,
                        'quantity_': quantity_,
                        'manufacturer_': manufacturer_,
                    },
                    success: function (kq) {
                        console.log('kt' + kq);
                        alert(kq)
                        // $("#results").append(html);
                    }
                });
            }
        }
    });
</script>