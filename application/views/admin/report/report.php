<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
      enctype="multipart/form-data">
    <div class="page-title">
        <div class="title_left">
            <h3>Báo cáo tài sản (<?php if (isset($res) && $res > 0) echo count($res) ?>)</h3>
        </div>
        <div class="title_right">
            <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
                <?php if ($menu_access[14] > 1) { ?>
                    <div class="form-group">
                        <!--                    <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2" style="">-->
                        <!--                        <a href="-->
                        <?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                        <!--                    </div>-->
                        <!--                    <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2" style="">-->
                        <!--                        <input type="submit" id="" name="btnExportData" required-->
                        <!--                               class="btn btn-primary btn-sm" value="In danh sách">-->
                        <!--                    </div>-->
                    </div>
                    <input type="submit" id="" name="btnExportData" required
                           class="btn btn-primary btn-sm" value="Xuất excel" style="float: right !important;">
                    <!--                    <a href="" class="btn btn-primary btn-sm">In danh sách</a>-->
                    <!--                    <a href="" class="btn btn-primary btn-sm">Thanh lý</a>-->
                    <!--                <input type="submit" id="" name="btn_liquidated" required-->
                    <!--                       class="btn btn-primary btn-sm" style="float: right !important;" value="Thanh lý">-->
                    <!--                    <a href="" class="btn btn-primary btn-sm">Sửa chữa</a>-->
                    <!--                <input type="submit" id="" name="btn_repair" required-->
                    <!--                       class="btn btn-primary btn-sm" style="float: right !important;" value="Sửa chữa">-->
                    <!--                    <a href="" class="btn btn-primary btn-sm">Điều chuyển</a>-->
                    <!--                    <a href="" class="btn btn-primary btn-sm">Cấp phát</a>-->
                    <!--                <input type="submit" id="" name="btn_box_asset" required-->
                    <!--                       class="btn btn-primary btn-sm" style="float: right !important;" value="Điều chuyển">-->
                    <!--                    <a href="--><?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <?php } ?>
                <!--            <a href="-->
                <?php //echo admin_url('employee') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
            </div>
        </div>
    </div>
    <div class="x_panel">
        <!--    <div class="x_title">-->
        <!--        <h2>Danh sách (--><?php //if (isset($res) && $res > 0) echo count($res) ?><!--)</h2>-->
        <!--        --><?php //if (isset($res) && count($res) > 0) { ?>
        <!--            <form method="post">-->
        <!--                <div class="col-md-3 col-sm-3 col-xs-12 pull-left">-->
        <!--                    --><?php //if ($menu_access[1] == 2) { ?>
        <!--                        <a href="-->
        <?php //echo admin_url('asset/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--                    --><?php //} ?>
        <!--                    <input type="submit" name="btnExportData" class="btn btn-primary btn-sm"-->
        <!--                           value="Xuất excel">-->
        <!--                    <!--            <a href="-->
        <!--                    -->
        <?php ////echo admin_url('asset') ?><!--<!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        <!--<!--                    <h4 id="new-search-area"></h4>-->
        <!--                </div>-->
        <!--                <div class="col-md-6 col-sm-6 col-xs-12 pull-left" id="new-search-area"></div>-->
        <!--            </form>-->
        <!--        --><?php //} ?>
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right" id="new-search-area">-->
        <!---->
        <!--        </div>-->

        <form method="post">
            <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
            <div class="col-xs-1 col-xs-1-5 col-xs-12">
                <select class="select2_group form-control-custom" name="company_id">
                    <option value="all">[Cty/C.nhánh]</option>
                    <?php
                    $_SESSION['company_id'] = $_POST['company_id'];
                    foreach ($company as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($_SESSION['company_id'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
            <div class="col-xs-1 col-xs-1-5 col-xs-12">
                <select class="select2_group form-control-custom" name="department_id">
                    <option value="all">[Phòng ban]</option>
                    <?php
                    $_SESSION['department_id'] = $_POST['department_id'];
                    foreach ($deparment as $value) { ?>
                        <option value="<?php echo $value->id ?>" <?php if ($_SESSION['department_id'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <!--        <div class="col-xs-1 col-xs-1-5">-->
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control-custom" name="employee_id">
                    <option value="all">[Người sử dung/ Q.Lý]</option>
                    <?php
                    $_SESSION['employee_id'] = $_POST['employee_id'];
                    foreach ($employee as $value) { ?>
                        <option value="<?php echo $value->id ?>"<?php if ($_SESSION['employee_id'] == $value->id) echo 'selected'; ?>><?php echo $value->name. ' ['. $value->maso. ']' ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-12">
                <select class="select2_group form-control-custom" name="status">
                    <option value="0" <?php if (isset($_POST['status']) && $_POST['status'] == 0) echo 'selected' ?>>Cá
                        nhân/Chung
                    </option>
                    <option value="1" <?php if (isset($_POST['status']) && $_POST['status'] == 1) echo 'selected' ?>>Tài
                        sản cá nhân
                    </option>
                    <option value="2" <?php if (isset($_POST['status']) && $_POST['status'] == 2) echo 'selected' ?>>Tài
                        sản chung
                    </option>
                </select>
            </div>
            <div class="col-xs-1 col-xs-1-5 col-xs-12">
                <select class="select2_group form-control-custom" name="assettype_id">
                    <option value="all">[Loại tài sản]</option>
                    <?php
                    $_SESSION['assettype_id'] = $_POST['assettype_id'];
                    foreach ($assettype as $value) { ?>
                        <option value="<?php echo $value->id ?>"<?php if ($_SESSION['assettype_id'] == $value->id) echo 'selected'; ?>><?php echo $value->assettype_name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-xs-1 col-xs-1-5">
                <select class="select2_group form-control-custom" name="asset_status_id">
                    <option value="all">[Trạng thái]</option>
                    <?php
                    $_SESSION['asset_status_id'] = $_POST['asset_status_id'];
                    foreach ($asset_status as $value) { ?>
                        <option value="<?php echo $value->id ?>"<?php if ($_SESSION['asset_status_id'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>
            </div>

            <div class="col-xs-1 col-xs-1">
                <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
            </div>
        </form>
        <!--    </div>-->
        <!--    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"-->
        <!--          enctype="multipart/form-data">-->
        <div class="x_content">
            <div class="table-responsive">
                <!--        --><?php //echo $ban; ?>
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                    <!--        <table id="" class="table table-striped table-bordered bulk_action">-->
                    <thead>
                    <tr>
<!--                        <th><input type='checkbox' id='select_all_invoices' onclick="selectAll()">All</th>-->
                        <th>STT</th>
                        <th>Mã tài sản</th>
                        <!--                <th>Ngày kiểm kê</th>-->
                        <th>Tên tài sản/ Model tài sản</th>
                        <th>Serial/ S.N/ Code/ Imei</th>
                        <th>ĐVT</th>
                        <th>SL</th>
                        <!--                <th>Ngày mua</th>-->
                        <th>BH đến</th>
                        <th>C.ty/C.nhánh</th>
                        <th>Phòng ban</th>
                        <th>Người sử dung/ Q.Lý</th>
                        <!--                        <th>Cá nhân / Chung</th>-->
                        <th>Trạng thái</th>
                        <!--                <th>Loại tài sản</th>-->
                        <!--                <th>Bộ phận sử dụng</th>-->
                        <th>Ghi chú</th>
                        <th>Hành động</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i = 0 ?>
                    <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                        <?php $i++; ?>
                        <tr id="<?php echo $value->id; ?>"
                            class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
<!--                            <td class="center"><input class='check_invoice' type="checkbox" name="asset_box[]"-->
<!--                                                      value="--><?php //echo $value->id ?><!--">-->
<!--                            </td>-->
                            <td><?php echo $i ?></td>
                            <td><?php echo $value->asset_code ?></td>
                            <!--                    <td>-->
                            <?php //echo date('d/m/Y', $value->ngay_kiemke) ?><!--</td>-->
                            <td><?php echo $value->asset_name ?></td>
                            <td><?php echo $value->seri ?></td>
                            <td><?php echo $value->unit_name ?></td>
                            <td><?php echo $value->amount ?></td>
                            <!--                    <td>--><?php //echo date('d/m/Y', $value->ngaymua) ?><!--</td>-->
                            <td><?php if ($value->baohanh_den == 0) {
                                    echo '<span class="label label-danger">Không bảo hành</span> ';
                                } elseif ($value->baohanh_den == 1) {
                                    echo ' <span class="label label-warning">Hết bảo hành</span>';
                                } else {
                                    echo '<span class="label label-success">' . date('d-m-Y', $value->baohanh_den) . '</span>';
                                } ?></td>
                            <td><?php echo $value->company_name ?></td>
                            <td><?php echo $value->department_name ?></td>
                            <td><?php echo $value->employee_name ?></td>
                            <!--                            <td>--><?php //echo $value->status ?><!--</td>-->
                            <td><?php echo $value->asset_status_name ?></td>
                            <!--                    <td>--><?php //echo $value->assettype_name ?><!--</td>-->
                            <!--                    <td>--><?php //echo $deparment_info->name ?><!--</td>-->
                            <!--                    <td>--><?php //echo $value->department_id ?><!--</td>-->
                            <td><?php echo $value->asset_note ?></td>
                            <?php if ($menu_access[1] == 2) { ?>
                                <td>
                                    <a href="<?php echo admin_url('asset/details/') . $value->id ?>"
                                       class="btn btn-primary btn-xs">Chi tiêt</a>
                                </td>
                            <?php } else { ?>
                                <td></td>
                            <?php } ?>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--        <div class="form-group">-->
        <!--            <div class="col-md-6 col-sm-6 col-xs-12 pull-left" style="">-->
        <!--                <input type="submit" id="" name="btn_box_asset" required-->
        <!--                       class="btn btn-success btn-sm" value="Click để sang trang nghiệp vụ">-->
        <!--            </div>-->
    </div>
</form>


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


</style>
<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa tài sản này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('asset/del/')?>" + id;
        }
    }
</script>