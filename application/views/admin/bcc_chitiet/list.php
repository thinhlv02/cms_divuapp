<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Bảng chấm công chi tiết</h3>
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
                <div class="form-group">
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">ngày<span
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
                <h4>Tháng: <?php if (isset($_POST['date1'])) echo date('m-Y', strtotime($_POST['date1'])) ?></h4>
                <!--                <div class="table-responsive">-->
                <!--        --><?php //echo $ban; ?>
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                    <!--        <table id="" class="table table-striped table-bordered bulk_action">-->
                    <thead>
                    <tr>
                        <!--                            <th><input type='checkbox' id='select_all_invoices' onclick="selectAll()">All</th>-->
                        <th>Ngày</th>
                        <th>lộ trình làm việc trong ngày</th>
                        <th>thời gian bắt đầu nhận việc làm</th>
                        <th>thời gian kết thúc công việc cuối cùng trong ngày</th>
                        <th>tổng thời gian di chuyển trong ngày</th>
                        <th>tổng thời gian làm việc thực tế tại nhà khách hàng trong ngày</th>
                        <th>ngày công thực tế</th>
                        <th>tổng khối lượng công việc trong ngày</th>
                        <th>khối lượng hoàn thành</th>
                        <th>khối lượng chưa hoàn thành</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $congchan = $congle = $unfinished = $sao_thang = 0; ?>
                    <?php $count = 0;
                    if (!empty($kq) && count($kq) != 0)
                        foreach ($kq as $key => $value): ?>
                            <?php
                            if (!empty($value->work)) {
                                $count++;
                                $size_kq = sizeof($kq);
                                ?>
                                <tr>
                                    <td class=""><?php echo $value->date ?></td>
                                    <td class="text-nowrap">
                                        <?php $j = $dem = $work_finish = $so_sao = $sao_ngay = 0;
                                        $time_end_last = $time_start_go_first = $total_time_go = $total_time_end = 0;
                                        foreach ($value->work as $key2 => $value2) {
                                            $size_work = sizeof($value->work);
                                            if ($value2->name_status == 'Đã xong') {
                                                $work_finish++;
                                            }
                                            if (strpos($value2->so_sao, ',') !== false) {
                                                $so_sao = array_sum(explode(',', $value2->so_sao)) / 3;
                                                $sao_ngay += $so_sao;
                                            }

                                            $report_name = '';
                                            if (strpos($value2->name, 'Bảo dưỡng') !== false) {
                                                $report = $this->admin_mission_report_model->get_list(array('where' => array('admin_mission_id' => $value2->id)));
                                                if ($report) {
                                                    $report_name = explode('***', $report[0]->content);
                                                    $report_name = $report_name[1];
                                                }
                                            } else {
                                                $report = $this->admin_emergency_report_model->get_list(array('where' => array('admin_emergency_id' => $value2->id)));
                                                if ($report) {
                                                    $report_name = $report[0]->content;
                                                }
                                            }
                                            $round1 = 0;
                                            if ($value2->time_start_go != '' && $value2->time_start_job != '') {
                                                $time1 = strtotime($value2->time_start_go);
                                                $time2 = strtotime($value2->time_start_job);
                                                $round1 = round(abs($time1 - $time2) / 60, 2);
                                                $total_time_go += $round1;
                                                // echo 'round1 ->>>>>>>>>'. $round1;
                                            }

                                            if ($value2->time_start_job != '' && $value2->time_end != '') {
                                                $time3 = strtotime($value2->time_start_job);
                                                $time4 = strtotime($value2->time_end);
                                                $round2 = round(abs($time3 - $time4) / 60, 2);
                                                $total_time_end += $round2;
                                            }

                                            if ($j == 0) {
                                                //do ze business
                                                $time_start_go_first = $value2->time_start_go;
                                            }
                                            if (++$j === count($value->work)) {
                                                $time_end_last = $value2->time_end;
                                            }
                                            $j++;
                                            $dem++;
                                            ?>
                                            <p class="text-center">CV_<?php echo $dem; ?></p>
                                            Mã KH: <?php echo $value2->user_id; ?><br/>
                                            đ/c : <?php echo $value2->address ?><br/>
                                            đánh giá : <?php if ($so_sao != '') echo number_format($so_sao, 1, ',', '') . '-> ' . $value2->so_sao ?>
                                            <br/>
                                            bonus : <?php number_format($value2->bonus_ktv, 1, ',', '') ?><br/>
                                            tg bđau đi: <?php if ($value2->time_start_go != '') echo date('H:i:s', strtotime($value2->time_start_go)) ?>
                                            <br/>
                                            tg đến: <?php if ($value2->time_start_job != '') echo date('H:i:s', strtotime($value2->time_start_job)) ?>
                                            <br/>
                                            tg làm: <?php if ($value2->time_end != '') echo date('H:i:s', strtotime($value2->time_end)) ?>
                                            <br/>
                                            báo cáo : <?php echo $report_name ?></p>
                                            <hr/>
                                        <?php }
                                        //                                        echo 'saongay-------   '.$sao_ngay;
                                        ?>
                                    </td>
                                    <td><?php if ($time_start_go_first != '') echo date('d-m-Y H:i:s', strtotime($time_start_go_first)); else echo 'bị trống' ?></td>
                                    <td><?php if ($time_end_last != '') echo date('d-m-Y H:i:s', strtotime($time_end_last)); else echo 'bị trống' ?></td>
                                    <td><?php echo $total_time_go ?></td>
                                    <td><?php echo $total_time_end ?></td>
                                    <td>
                                        <?php
                                        if ($work_finish >= 1 && $work_finish <= 3) {
                                            $congle += 1;
                                            echo '-';
                                        }
                                        if ($work_finish >= 4) {
                                            $congchan += 1;
                                            echo '+';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo sizeof($value->work) ?></td>
                                    <td><?php echo $work_finish ?></td>
                                    <td><?php
                                        if (sizeof($value->work) - $work_finish == 0) {
                                            $unfinished += 1;
                                        }
                                        echo sizeof($value->work) - $work_finish ?></td>
                                </tr>
                                <?php $sao_thang += $sao_ngay / sizeof($value->work);
//                                echo 'w: '.$count;
                            } endforeach
                    ?>
                    </tbody>
                    <?php $admin_info = $this->admin_model->get_info($this->input->post('admin_id'));
                    if (isset($kq)) { ?>
                        - Họ tên: <?php echo $admin_info->fullname ?>
                        - Chức vụ: <?php echo 'ktv' ?>
                        - Công cả buổi: <?php echo $congchan ?>
                        - Công nửa buổi: <?php echo $congle ?>
                        - ngày công thực tế: <?php echo $congchan + $congle * 0.5 ?>
                        - số ngày chưa hoàn thành công việc được giao: <?php echo $unfinished ?>
                        - đánh giá từ khách hàng trong tháng: <?php if ($sao_thang != '') echo number_format($sao_thang / $count, 1, ',', '') ?>
                        <!--                        - đánh giá từ khách hàng trong tháng: --><?php //echo $count ?>
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