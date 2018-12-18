<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Công việc khách hàng đánh giá(<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
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
                               class="form-control col-md-7 col-xs-12"/>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtTo" name="date2" required
                               value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                               class="form-control col-md-7 col-xs-12">
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">KTV<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="admin_id">
                            <!--                            <option value="all">All</option>-->
                            <?php $_SESSION['admin_id'] = $_POST['admin_id'];
                            foreach ($list_emp as $value) { ?>
                                <option value="<?php echo $value->id ?>"
                                    <?php if ($_SESSION['admin_id'] == $value->id) echo 'selected'; ?>><?php echo $value->username ?></option>
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
                        <!--                            <th><input type='checkbox' id='select_all_invoices' onclick="selectAll()">All</th>-->
                        <th>STT</th>
                        <th>dịch vụ</th>
                        <th>công việc</th>
                        <th>tg khách hẹn</th>
                        <th>Tên khách hàng</th>
                        <th>Địa chỉ khách hàng</th>
                        <th>SĐT</th>
                        <th class="">đánh giá về thời gian</th>
                        <th class="">đánh giá về thái độ phục vụ</th>
                        <th class="">đánh giá về chuyên môn</th>
                        <th class="">trung bình cộng</th>
                        <th>Mô tả đánh giá</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = $star_end = $sao_end = 0; ?>
                    <?php if (!empty($res) && count($res) != 0)
                        foreach ($res as $key => $value): ?>
                            <?php $i++;
                            ?>
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <td><?php echo $i ?></td>
                                <td class=""><?php echo $value->name_package ?></td>
                                <td class=""><?php echo $value->name ?></td>
                                <td class=""><?php echo date('d-m-Y H:i:s', $value->time) ?></td>
                                <td class=""><?php echo $value->fullname ?></td>
                                <td class=""><?php echo $value->address ?></td>
                                <td class=""><?php
                                    foreach (explode(',', $value->phone) as $k_) {
                                        echo '"' . $k_ . '"<br/>';
                                    } ?>
                                </td>
                                <?php
                                $sao_0 = $sao_1 = $sao_2 = '';
                                if ($value->so_sao != NULL) {
                                    $tags = explode(',', $value->so_sao);
                                    if (isset($tags[0])) {
                                        $sao_0 = $tags[0];
                                    }
                                    if (isset($tags[1])) {
                                        $sao_1 = $tags[1];
                                    }
                                    if (isset($tags[2])) {
                                        $sao_2 = $tags[2];
                                    }
//                                $sao_tb_ = $sao_tb/sizeof($tags);
//                                echo $sao_tb_;
                                }
                                ?>
                                <td class="text-nowrap"><?php echo $sao_0 ?></td>
                                <td class="text-nowrap"><?php echo $sao_1 ?></td>
                                <td class="text-nowrap"><?php echo $sao_2 ?></td>
                                <!--                                <td class="text-nowrap">-->
                                <?php //echo 'xxxxxx'.$value->so_sao ?><!--</td>-->
                                <?php
                                $sao_dcm2 = 0;
                                if ($value->so_sao != NULL) {
//                                    echo 'sosao: ' . $value->so_sao;
                                    $tags = explode(',', $value->so_sao);
                                    $sao_tb = 0;
                                    foreach ($tags as $key12 => $value12) {
//                                        echo 'vl12: ' . $value12 . '<br/>';
//                                        echo $key12. $value12;
                                        $sao_tb += $value12;
//                                    echo $key. '--'.$value. '--'.sizeof($tags) .'<br/>';
                                    }
                                    $sao_dcm2 = $sao_tb / sizeof($tags);
//                                $sao_tb_ = $sao_tb/sizeof($tags);
//                                echo $sao_tb_;
                                }
                                $star_end += $sao_dcm2;
                                ?>
                                <td class=""><?php if ($sao_dcm2 != '') echo number_format($sao_dcm2, 1, ',', '') ?></td>
                                <td class=""><?php echo $value->khach_hang_danh_gia ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    <?php if (!empty($res)) { ?>
                        <tfoot class="bg-success">
                        <tr>
                            <?php $sao_end = $star_end / sizeof($res); ?>
                            <td>KTV</td>
                            <td colspan="2"><?php echo $value->fullname_admin ?></td>
                            <td colspan="7">xếp loại chung</td>
                            <td><?php echo number_format($sao_end, 1, ',', '') ?></td>
                            <td>
                                <?php
                                if ($sao_end <= 2) {
                                    echo 'YẾU';
                                }
                                if ($sao_end > 2 and $sao_end <= 3) {
                                    echo "KÉM";
                                }
                                if ($sao_end > 3 and $sao_end <= 4) {
                                    echo "ĐẠT";
                                }
                                if ($sao_end > 5) {
                                    echo "TỐT";
                                }
                                ?>
                            </td>
                        </tr>
                        </tfoot>
                    <?php } ?>

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