<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Thống kê(<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
    </div>
    <div class="title_right">
        <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
            <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
<!--                <a href="--><?php //echo admin_url('doanhthu_contract/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
                <!--                    <a href="-->
                <!--        --><?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
            </div>
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
                               class="form-control col-md-7 col-xs-12"/>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtTo" name="date2" required
                               value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                               class="form-control col-md-7 col-xs-12">
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
                <div class="table-responsive">
                    <!--        --><?php //echo $ban; ?>
                    <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                        <!--        <table id="" class="table table-striped table-bordered bulk_action">-->
                        <thead>
                        <tr>
                            <!--                            <th><input type='checkbox' id='select_all_invoices' onclick="selectAll()">All</th>-->
                            <th>STT</th>
                            <th>Mã KH</th>
                            <th>Tên KH</th>
                            <th>Số tiền</th>
                            <th>Mã thẻ</th>
                            <th>Nhà mạng</th>
                            <th>Thời gian nạp</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        <?php $total = 0; if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <?php $i++;
//                            $total = $value->pay_cards + $value->bank + $value->ktv;
                        $total += $value->price;
                            ?>
                            <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                            <tr id="<?php ?>" class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <td><?php echo $i ?></td>
                                <td class="text-nowrap"><?php echo $value->user_id ?></td>
                                <td class="text-nowrap"><?php echo $value->fullname ?></td>
                                <td class="text-nowrap"><?php echo number_format($value->price) ?></td>
                                <td class="text-nowrap"><?php echo $value->card_code ?></td>
                                <td class="text-nowrap"><?php echo $value->card_code ?></td>
                                <td class="text-nowrap"><?php echo date('d-m-Y', strtotime($value->created_at)) ?></td>
<!--                                <td class="text-nowrap">--><?php //echo date('d-m-Y', strtotime($value->created_at)) ?><!--</td>-->
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                        <tfoot>
                        <tr class="bg bg-info">
                            <td colspan="3">Tổng</td>
                            <td><?php echo number_format($total) ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
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