<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>quản lý yêu cầu mua đơn hàng (<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
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
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Từ ngày<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtFrom" name="date1" required
                               value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                               class="form-control col-md-7 col-xs-12" />
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtTo" name="date2" required
                               value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                               class="form-control col-md-7 col-xs-12">
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">KH/KTV<span class="required">*</span></label>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control-custom" name="type_cart">
                            <option value="1" <?php if (isset($_POST['type_cart']) && $_POST['type_cart'] == 1) echo 'selected' ?>>Khách hàng mua</option>
                            <option value="2" <?php if (isset($_POST['type_cart']) && $_POST['type_cart'] == 2) echo 'selected' ?>>KTV mua</option>
                        </select>
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Trạng thái<span class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control-custom" name="status">
                            <?php if (isset($_POST['status'])){
                                $_SESSION['status'] = $_POST['status'];
                            } ?>
                            <option value="all">All</option>
                            <?php foreach ($status_cart as $key => $value) { ?>
                                <option value="<?php echo $key ?>" <?php if (isset($_SESSION['status']) && $_SESSION['status'] == $key) echo 'selected'; ?> ><?php echo $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <!--                <div class="ln_solid"></div>-->
                <div class="form-group">
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>
                    </div>
                    <div class="col-xs-1 col-xs-1">
                        <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                    </div>
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
                            <th>STT</th>
                            <th>user_id</th>
                            <th>username</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th>TG.Yêu cầu</th>
<!--                            <th>Thời gian</th>-->
                            <th>Tên sp</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Cửa hàng</th>
                            <th>Trạng thái</th>
<!--                            <th>Thao tác</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <?php $i++;
                            $strStart = '2013-06-19 18:25';
                            $strEnd   = '06/19/13 21:47';
                            $dteStart = new DateTime($strStart);
                            $dteEnd   = new DateTime($strEnd);
                            $dteDiff  = $dteStart->diff($dteEnd);
                            ?>
                            <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <!--                                <td class="center"><input class='check_invoice' type="checkbox" name="asset_excel[]"-->
                                <!--                                                          value="-->
                                <?php //echo $value->id ?><!--">-->
                                <!--                                </td>-->
                                                                <td><?php echo $i ?></td>
                                <td class="text-nowrap"><?php echo $value->user_id ?></td>
                                <td class="text-nowrap"><?php echo $value->username ?></td>
                                <td class="text-nowrap"><?php echo $value->phone ?></td>
                                <td class="text-nowrap"><?php echo $value->address ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($value->created)) ?></td>
<!--                                <td>--><?php //echo date('h:i:s:a', $value->time) ?><!--</td>-->
                                <td><?php echo  $value->product_name ?></td>
                                <td><?php echo  $value->number ?></td>
                                <td><?php echo  number_format($value->number*$value->price) ?></td>
                                <td><?php echo  $value->shop_name ?></td>
                                <td><?php echo  $value->status ?></td>
<!--                                <td>--><?php //echo $value->admin_id ?><!--</td>-->
<!--                                <td style="padding-top: 2%;width:10%">-->
<!--                                        <a href="--><?php //echo base_url('admin/admin_mission/edit/'.$value->id) ?><!--" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a></br>-->
<!--                                </td>-->
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

<script type="text/javascript">
    function confirm_del_event(admin_id, id) {
        var r = confirm("Bạn có chắc chắn muốn xóa ?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin_mission/del/')?>" + admin_id + "/" + id;
        }
    }
</script>