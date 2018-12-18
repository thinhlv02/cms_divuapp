<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Bảng chấm công tổng hợp</h3>
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
                <!--                <label for="startDate">Date :</label>-->
                <!--                <input id="IconDemo" class='Default' type="text"/>-->

                <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Từ ngày<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <input type="text" id="txtTo4" name="date1" required
                               value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                               class="form-control col-md-7 col-xs-12"/>
                    </div>

                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">KTV<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control" name="admin_id">
                            <option value="all">All</option>
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
                <h4>Tháng: <?php if (isset($_POST['date1'])) echo date('m-Y', strtotime($_POST['date1'])) ?></h4>
                <!--                <div class="table-responsive">-->
                <!--        --><?php //echo $ban; ?>
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                    <!--        <table id="" class="table table-striped table-bordered bulk_action">-->
                    <thead>
                    <tr>
                        <!--                            <th><input type='checkbox' id='select_all_invoices' onclick="selectAll()">All</th>-->
                        <th>STT</th>
                        <th class="text-nowrap">HỌ VÀ TÊN</th>
                        <th class="text-nowrap">CHỨC VỤ</th>
                        <?php if (isset($day_arr)) foreach ($day_arr as $k => $v) { ?>
                            <th class="text-nowrap text-center"><?php
                                //                                echo '<p class="text-nowrap">'.convert_name_day(date('D', strtotime($v))).'</p>';
                                //                                $new_day = convert_name_day(date('D', strtotime($v))). '<br />';
                                echo date('d', strtotime($v)) . '<br/>'
                                ?>
                            </th>
                        <?php } ?>
                        <th>cả buổi</th>
                        <th>nửa buổi</th>
                        <th>ngày công thực tế</th>
                        <th>trung bình KH đánh giá trong tháng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php ?>
                    <?php $count = $dem = 0;
                    //                    pre($list_emp2);
                    if (!empty($list_emp2) && count($list_emp2) != 0)
                        foreach ($list_emp2 as $key => $value): ?>
                            <?php
                            $count++;
                            $congchan = $congle = $unfinished = $sao_thang = 0;
                            ?>
                            <tr>
                                <td><?php echo $count ?></td>
                                <td><?php echo $value->fullname ?></td>
                                <td><?php if ($value->level == 4) echo 'KTV'; else echo 'CTV' ?></td>
                                <?php if (isset($day_arr)) foreach ($day_arr as $k2 => $v2) {
//                                    echo (date('Y-m-d',strtotime($v2)));
                                    if (!empty($work))
//                                    $work = $this->technician_jobs_model->bcc_chitiet_tq('2018-08-13', 22);
//                                    pre($work);
//                                    foreach ($work as $k3 => $v3){
                                        ?>
                                        <!--<!--                                        cv: --><?php ////echo $v3->name ?>
                                    <!--<!--                                        <td>--><?php ////echo $v3->name ?><!--<!--</td>-->
                                    <!--                                    --><?php //}  ?>
                                    <td class="text-nowrap">
                                        <?php
                                        $work_finish = $sao_ngay = $work_count = 0;
                                        $work = $this->technician_jobs_model->bcc_chitiet_tq(date('Y-m-d', strtotime($v2)), $value->id);
                                        if (!empty($work)) {
                                            $dem++;
                                        }
                                        foreach ($work as $k3 => $v3) { ?>
                                            <?php
                                            if ($v3->name_status == 'Đã xong') {
//                                                echo 'w:'. $v3->name_status.'111111'. '<br/>';
                                                $work_finish += 1;
                                            }
                                            if (strpos($v3->so_sao, ',') !== false) {
                                                $so_sao = array_sum(explode(',', $v3->so_sao)) / 3;
                                                $sao_ngay += $so_sao;
                                            }
//                                            if ($v3->time_start_go != '') echo date('H:i:s', strtotime($v3->time_start_go)) . ' : ' . $v3->name . '<br/>'
                                            ?>
                                            <?php
                                            $work_count = sizeof($work);
                                        }
                                        //                                        echo $work_count . '--' . $sao_ngay;
                                        if ($sao_ngay > 0) {
                                            $sao_ngay = $sao_ngay / $work_count;
                                        }
                                        //                                        echo '$sao_thang: ' . $sao_ngay;
                                        if ($work_finish >= 1 && $work_finish <= 3) {
                                            $congle += 1;
                                            echo '-';
                                        }
                                        if ($work_finish >= 4) {
                                            $congchan += 1;
                                            echo '+';
                                        }
                                        $sao_thang += $sao_ngay;
                                        //                                        echo 'total sao: ' . $sao_thang . '-------' . $count;
                                        //                                        echo date('d', strtotime($v2)) ?>
                                    </td>
                                <?php } ?>
                                <td><?php echo $congchan ?></td>
                                <td><?php echo $congle ?></td>
                                <td><?php echo $congchan + $congle * 0.5 ?></td>
                                <td><?php if ($sao_thang != '') echo number_format($sao_thang / $dem, 1, ',', '') ?></td>
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