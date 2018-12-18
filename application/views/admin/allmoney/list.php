<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Tổng tiền trên server</h3></div>
    <div class="title_right">
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
        <!--            <a href="-->
        <?php //echo admin_url('admin/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--            <a href="-->
        <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        <!--        </div>-->
    </div>
</div>

<div class="x_panel">
    <!--        <form method="post">-->
    <div class="x_content">
        <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
              enctype="multipart/form-data">
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

<!--                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">KH/KTV<span-->
<!--                            class="required"></span></label>-->
<!--                <div class="col-md-2 col-sm-2 col-xs-12">-->
<!--                    <select class="form-control">-->
<!--                        <option value="all">All</option>-->
<!--                        <option value="1">Khách hàng</option>-->
<!--                        <option value="2">Kỹ thuật viên</option>-->
<!--                    </select>-->
<!--                </div>-->
            </div>
            <!--                <div class="ln_solid"></div>-->

            <!--                            <div class="ln_solid"></div>-->
            <div class="form-group">
                <div class="col-xs-1 col-xs-1">
                    <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                </div>
            </div>
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
    </div>
</div>

<!--    TQ-->
<!--    TQ-->
<!--    Thật-->
<!--    Thật-->

    <h1 class="text-center">Khách hàng</h1>
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Tiền vào</h2>
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
            <table id="datatable-productx" class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <!--                <th>STT</th>-->
                    <th class="bg-success">Tiền vào</th>
                    <th>KH nạp qua ktv</th>
<!--                    <th>Thưởng từ KH</th>-->
<!--                    <th>Tiền giới thiệu</th>-->
                    <th>Nạp qua Ngân hàng</th>
                    <th>Admin cộng</th>
                    <th>Server cộng</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                <?php if (isset($res)) foreach ($res as $row) {
                    $i++;
                    ?>
                    <tr>
                        <!--                    <td>--><?php //echo $i ?><!--</td>-->
                        <td class="bg-success"><?php echo number_format($row->money_in_kh) ?></td>
                        <td><?php echo number_format($row->kh_nap_qua_ktv) ?></td>
<!--                        <td>--><?php //echo number_format($row->bonus_ktv) ?><!--</td>-->
<!--                        <td>--><?php //echo number_format($row->money_intro) ?><!--</td>-->
                        <td><?php echo number_format($row->nap_bank) ?></td>
                        <td><?php echo number_format($row->admin_add_kh) ?></td>
                        <td><?php echo number_format($row->server_add_kh) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Tiền ra</h2>
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
            <table id="datatable-productx" class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <th class="bg-success">Tiền ra</th>
<!--                    <th>Mua gói DV</th>-->
                    <?php if (isset($res)) foreach ($res as $row1) {
                        foreach ($row1->money_dv_details as $key1){
                            echo '<th>'.$key1->name.'</th>';
                        }
                        ?>
                        <th>Mua vật tư</th>
                        <th>Thưởng cho KTV</th>
                        <th class="bg-success">Tiền còn</th>
                    <?php } ?>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                <?php if (isset($res)) foreach ($res as $row) {
                    $i++;
                    ?>
                    <tr>
                        <td class="bg-success"><?php echo number_format($row->money_out_kh) ?></td>
<!--                        <td>--><?php //echo number_format($row->mua_goi_dv) ?><!--</td>-->
                        <?php
                        foreach ($row->money_dv_details as $key2){
                            echo '<td>'.number_format($key2->money_dv).'</td>';
                        }
                        ?>
                        <td><?php echo number_format($row->money_vat_tu_user) ?></td>
                        <td><?php echo number_format($row->bonus_ktv) ?></td>
                        <td class="bg-success"><?php echo number_format($row->money_end_kh) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div style="clear: both"></div>
<h1 class="text-center">Kỹ thuật viên</h1>
<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Tiền vào
            </h2>
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
            <table id="datatable-product1" class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <th class="bg-danger">Tiền vào</th>
                    <th>Thưởng từ KH</th>
                    <th>Thưởng từ mã giới thiệu</th>
                    <th>Admin cộng</th>
                    <th>Server cộng</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                <?php if (isset($res)) foreach ($res as $row) {
                    $i++;
                    ?>
                    <tr>
                        <td class="bg  bg-danger"><?php echo number_format($row->money_in_ktv) ?></td>
                        <td><?php echo number_format($row->bonus_ktv) ?></td>
                        <td><?php echo number_format($row->mua_goi_dv) ?></td>
                        <td><?php echo number_format($row->admin_add_ktv) ?></td>
                        <td><?php echo number_format($row->server_add_ktv) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-6 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Tiền ra
            </h2>
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
            <table id="datatable-product1" class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <th class="bg bg-danger">Tiền ra</th>
                    <th> mua vật tư(yêu cầu vật tư)</th>
                    <th> ktv rút tiền</th>
                    <th>ktv nạp tiền cho khách hàng</th>
                    <th class="bg bg-danger">Tiền còn</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                <?php if (isset($res)) foreach ($res as $row) {
                    $i++;
                    ?>
                    <tr>
                        <td class="bg  bg-danger"><?php echo number_format($row->money_out_ktv) ?></td>
                        <td><?php echo number_format($row->money_vat_tu_ad) ?></td>
                        <td><?php echo number_format($row->total_money_payment) ?></td>
                        <td><?php echo number_format($row->kh_nap_qua_ktv) ?></td>
                        <td class="bg-danger"><?php echo number_format($row->money_end_ktv) ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--</div>-->
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    function confirmDel(id) {
        if (confirm('Bạn có chắc chắn muốn xóa??')) {
//            console.log('delll');
            window.location.href = '<?php echo base_url('admin/city/del/')?>' + id;
        }
    }
</script>