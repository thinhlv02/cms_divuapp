<?php $menu_access = $this->session->userdata('menu_access');
//$month = monthyears();
//pre($month);


?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Lịch hẹn định kỳ khách hàng(<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
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
                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tháng<span
                                class="required"></span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">

                        <select class="form-control" name="date1" id="selectMonth">
                            <?php
                            $_SESSION['date1'] = date('m-Y');
                            if (isset($_POST['date1'])) {
                                $_SESSION['date1'] = $_POST['date1'];
                                echo 'ss' . $_SESSION['date1'];
                            }
                            foreach ($monthyears as $key => $value) { ?>
                                <option value="<?php echo $value ?>"
                                    <?php if ($value == $_SESSION['date1']) echo 'selected' ?>>
                                    <?php echo $value ?> </option>
                            <?php } ?>
                        </select>
                    </div>


                    <!--                    <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Tháng<span-->
                    <!--                                class="required"></span></label>-->
                    <!--                    <div class="col-md-2 col-sm-2 col-xs-12">-->
                    <!--                        <input type="text" id="txtTo4" name="date1" required-->
                    <!--                               value="-->
                    <?php //if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])); ?><!--"-->
                    <!--                               class="form-control col-md-7 col-xs-12"/>-->
                    <!--                    </div>-->


                    <!--                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Khu vực<span-->
                    <!--                                class="required">*</span></label>-->
                    <!---->
                    <!--                    <div class="col-md-2 col-sm-2 col-xs-12">-->
                    <!--                        <select class="select2_group form-control-custom" name="area_id">-->
                    <!--                            <option value="all">All</option>-->
                    <!--                            --><?php
                    //                            $_SESSION['area_id'] = $_POST['area_id'];
                    //                            foreach ($area as $value) { ?>
                    <!--                                <option value="--><?php //echo $value->id ?><!--" -->
                    <?php //if ($_SESSION['area_id'] == $value->id) echo 'selected'; ?><!-->
                    <?php //echo $value->name ?><!--</option>-->
                    <!--                            --><?php //} ?>
                    <!--                        </select>-->
                    <!--                    </div>-->
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
                        <th>STT/ ID svpk</th>
                        <!--                        <th>id</th>-->
                        <th>Khu vực</th>
                        <th>id KH</th>
                        <th>Tên KH</th>
                        <th>Địa chỉ KH</th>
                        <th>Ngày khách đã hẹn</th>
                        <th>Số lần gọi cứu hộ</th>
                        <!--                        <th>Ngày</th>-->
                        <th>Lịch đã tạo</th>
                        <th>Phân công</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0 ?>
                    <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                        <?php $i++;
//                        $itemMonId = '';
//                        $itemMonId = $value->admin_id;
//                        pre($value->admin_id);
                        ?>
                        <tr id="<?php echo $value->id; ?>"
                            class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
                            <!--                                <td class="center"><input class='check_invoice' type="checkbox" name="asset_excel[]"-->
                            <!--                                                          value="-->
                            <?php //echo $value->id ?><!--">-->
                            <!--                                </td>-->
                            <td><?php echo $i . '/' . $value->id ?></td>
                            <!--                            <td class="text-nowrap">-->
                            <?php //echo $value->id ?><!--</td>-->
                            <td class="text-nowrap"><?php echo $value->name_district ?></td>
                            <td class="text-nowrap"><?php echo $value->user_id ?></td>
                            <td class="text-nowrap"><?php echo $value->fullname ?></td>
                            <td class=""><?php echo $value->address ?></td>
                            <td class="text-nowrap"><?php
                                foreach ($value->admin_mission as $k2 => $v2) {
                                    echo date('H', $v2->time) . 'h' . date('i', $v2->time) . ', ' . date('d-m', $v2->time) . '<br/>';
                                }
                                ?></td>
                            <td class="text-nowrap"><?php
                                echo sizeof($value->admin_emergency);
                                ?></td>
                            <!--                            <td>-->
                            <?php //echo date('d/m/Y H:i:s', $value->time) ?><!--</td>-->
                            <td>
                                <?php
                                $date1 = date('d-m-Y');
                                $size_admin_arr = 0;
                                if (!empty($value->admin_arr)) { ?>
                                    <?php
                                    $size_admin_arr = sizeof($value->admin_arr);
//                                    echo 'size: ' . $size_admin_arr;
                                    if (isset($_GET['date1'])) {
                                        $date1 = $_GET['date1'];
                                    }
                                    if (isset($_POST['date1'])) {
                                        $date1 = date('d-') . $_POST['date1'];
                                    }
                                    foreach ($value->admin_arr as $row) {
//                                           echo 'id teach: ' . $row .'---'. $value->status. '<br>';
                                        $itemMon = $this->admin_model->get_info($row->admin_id);
                                        if (!empty($itemMon)) { ?>
                                            <div id="<?php echo $row->admin_id; ?>">
                                                <p class="text-nowrap text-info"> <?php echo date('H', $row->time) . 'h' . date('i', $row->time) . ', ' . date('d-m', $row->time) . ' / ' . $itemMon->username ?></p>
                                                <a <?php if (in_array($row->status, array(2, 3, 4, 5, 6, 7))) echo 'class="disabled"' ?>
                                                        onclick="confirm_del_event(<?php echo $row->id ?>,<?php echo $row->admin_id ?>, '<?php echo $itemMon->fullname ?>', '<?php echo $value->id ?>', '<?php echo $date1 ?>')"
                                                        class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                                         aria-hidden="true">
                                                        <!--                                                        --><?php //echo $row->id ?>
                                                    </i>
                                                </a>
                                            </div>
                                            <hr>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <td id="<?php echo $value->id . '_mon' ?>"
                                class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_mon') echo 'bg_thanhly'; ?>">
                                <!--                                --><?php //if ($itemMonId) { ?>
                                <div class="btn_them_1">
                                    <input type="text" name="datetimes"
                                           value="<?php echo date('Y-m-d', strtotime($value->date1)) . ' ' . date('H:i:s') ?>"
                                           id="datetimes_<?php echo $value->id ?>"/><br/><br/>
                                    <select id="mySelect_<?php echo $value->id ?>" class="form-control">
                                        <?php foreach ($list_emp as $k => $v) { ?>
                                            <option value="<?php echo $v->id ?>"><?php echo $v->username ?></option>
                                        <?php } ?>
                                    </select>
                                    <!--                                    <a href="-->
                                    <?php //echo base_url('admin/admin_mission/add/' . $value->id . '/' . $value->district_id . '/' . $date1) ?><!--"><i-->
                                    <!--                                                class="fa fa-plus" aria-hidden="true"></i></a>-->
                                </div>
                            </td>
                            <td><input <?php if ($size_admin_arr >= 4) echo 'class = "disabled" ' ?> type="button"
                                                                                                     tid="<?php echo $value->id ?>"
                                                                                                     time_url="<?php echo $date1 ?>"
                                                                                                     service_package_id="<?php echo $value->service_package_id ?>"
                                                                                                     class="confirm"
                                                                                                     value="giao việc"/>
                            </td>
                            <!--                                <td style="padding-top: 2%;width:10%">-->
                            <!--                                        <a href="-->
                            <?php //echo base_url('admin/admin_mission/edit/'.$value->id) ?><!--" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a></br>-->
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
        display: none !important;
        pointer-events: none;
        cursor: default;
        opacity: 0.6;
    }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
    function confirm_del_event(id, admin_id, fullname, service_package_user_id, date1) {
        var r = confirm("Bạn có chắc chắn muốn xóa: " + fullname);
        if (r == true) {
            console.log(id, fullname);
            window.location.href = "<?php echo admin_url('regular_appointments/del/')?>" + id + '/' + admin_id + '/' + service_package_user_id + '/' + date1;
        }
    }

    $('.confirm').click(function () {
        var tid = $(this).attr('tid');
        var service_package_id = $(this).attr('service_package_id');
        var time_url = $(this).attr('time_url');
        // var datetimes = 'datetimes_'+tid;
        var datetimes = $('input#datetimes_' + tid).val();
        var admin_id = $('#mySelect_' + tid).val();
        // console.log('time' +  datetimes2);
        // console.log(tid, datetimes, admin_id);
        if (confirm('Bạn có đồng ý ?')) {
            $.ajax({
                url: "<?php echo base_url('admin/process/add_regular_appointments') ?>",
                type: 'POST',
                // dataType: "json",
                data: {
                    'time': datetimes,
                    'admin_id': admin_id,
                    'service_package_id': service_package_id,
                    'service_package_user_id': tid,
                },

                success: function (msg) {
                    //window.location.href = "<?php //echo base_url('admin/regular_appointments') ?>//" + '?date1=' + time_url + '&asset_id=' + tid + '#' + tid;
                    window.location.href = "<?php echo base_url('admin/regular_appointments') ?>" + '?date1=' + time_url;
                    //window.location.href = "<?php //echo base_url('admin/regular_appointments') ?>//" + '?date1=' + time_url + '&asset_id=' + tid + '#' + tid;
                    // document.location.href = 'Your url',true;
                    // date1=01-09-2018&asset_id=4#4
                    // redirect(base_url('admin/regular_appointments?date1=' . $date1 . '&asset_id=' . $service_package_user_id . '#' . $service_package_user_id));
                    alert('Đã giao việc!');
                    console.log(msg);
                },
                error: function (xhr, status, error) {
                    console.log(status);
                    console.log(xhr.responseText);
                    // alert(status);
                    // alert(xhr.responseText);
                }
            });
        }
    });
</script>

