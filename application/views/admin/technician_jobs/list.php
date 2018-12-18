<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Công việc KTV(<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
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
                            <option value="all">All</option>
                            <?php  $_SESSION['admin_id'] = $_POST['admin_id'];
                            foreach ($list_emp as $value) { ?>
                                <option value="<?php echo $value->id ?>"
                                    <?php if ($_SESSION['admin_id'] == $value->id) echo 'selected'; ?>><?php echo $value->username ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">trạng thái CV<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="service_package_maintenance_status">
                            <option value="all">All</option>
                            <?php  $_SESSION['service_package_maintenance_status'] = $_POST['service_package_maintenance_status'];

                            foreach ($service_package_maintenance_status as $value) { ?>
                                <option value="<?php echo $value->id ?>"
                                    <?php if ($_SESSION['service_package_maintenance_status'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
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
<!--                            <th>STT</th>-->
                            <th>id ktv</th>
                            <th>Tên KTV</th>
                            <th>Khu vực hoạt động</th>
                            <th>Tên công việc</th>
                            <th>báo cáo ktv</th>
                            <th>Trạng thái CV</th>
                            <th>Vị trí xuất phát</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ khách hàng</th>
                            <th>SĐT</th>
                            <th>tg khách hẹn</th>
                            <th>thời gian ktv đến</th>
                            <th>thời gian ktv hoàn thành cv</th>
                            <th>thời gian ktv phục vụ</th>
<!--                            <th>Tên gói</th>-->
                            <th>KH đánh giá</th>
                            <th>Mô tả đánh giá</th>
                            <th>Khách hàng thưởng</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <?php $i++;
                            ?>
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <td><?php echo $value->admin_id ?></td>
                                <td class=""><?php echo $value->fullname_admin ?></td>
                                <td class=""><?php echo $value->district_work_name ?></td>
                                <td class=""><?php echo $value->name ?></td>
                                <td class=""><?php echo $value->report_name ?></td>
<!--                                <td class="">--><?php //echo 'báo cáo' ?><!--</td>-->
                                <td class=""><?php echo $value->name_status.'('.$value->status.')' ?></td>
                                <?php $position_start = explode('*', $value->position_start) ?>
                                <td class=""><?php echo $value->position_start ?></td>
                                <td class=""><?php echo $value->fullname ?></td>
                                <td class=""><?php echo $value->address ?></td>
                                <td class=""><?php echo $value->phone ?></td>
                                <td class=""><?php echo date('d-m-Y H:i:s', $value->time) ?></td>
                                <td><?php if (isset($value->time_start_job)) echo date('d-m-Y H:i:s', substr($value->time_start_job, 0, 10)) ?></td>
                                <td><?php if (isset($value->time_end)) echo date('d-m-Y H:i:s', substr($value->time_end, 0, 10)) ?></td>
                                <td class=""><?php if ($value->count != '') echo $value->count. ' (phút)' ?></td>
                                <?php
                                $sao_dcm = '';
                                if ($value->so_sao != NULL) {
                                $tags = explode(',',$value->so_sao);
                                    $sao_tb  ='';
                                foreach($tags as $key12 => $value12) {
                                    $sao_tb += $value12;
//                                    echo $key. '--'.$value. '--'.sizeof($tags) .'<br/>';
                                }
                                    $sao_dcm =$sao_tb/sizeof($tags);
//                                $sao_tb_ = $sao_tb/sizeof($tags);
//                                echo $sao_tb_;
                                }
                                ?>
                                <td class=""><?php if ($sao_dcm != '') echo  number_format($sao_dcm,1, ',', '') ?></td>
                                <td class=""><?php echo $value->khach_hang_danh_gia ?></td>
                                <td class=""><?php echo number_format($value->bonus_ktv) ?></td>
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