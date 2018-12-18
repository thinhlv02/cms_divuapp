<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Công việc bàn giao(<?php if (isset($res) && $res > 0) echo count($res); else echo 0 ?>)</h3>
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

                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Khu vực<span class="required">*</span></label>

                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="select2_group form-control-custom" name="area_id">
                            <option value="all">All</option>
                            <?php
                            $_SESSION['area_id'] = $_POST['area_id'];
                            foreach ($area as $value) { ?>
                                <option value="<?php echo $value->id ?>" <?php if ($_SESSION['area_id'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
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
                            <th>ID</th>
                            <th>Ngày</th>
                            <th>Tên</th>
                            <th>Tên đầy đủ</th>
                            <th>Địa chỉ</th>
<!--                            <th>Thời gian</th>-->
                            <th>Mô tả</th>
                            <th>Ảnh</th>
                            <th>Trạng thái</th>
                            <th>Phân công nhân sự</th>
<!--                            <th>Thao tác</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0 ?>
                        <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <?php $i++;
                            $itemMonId = $value->admin_id;
                            $strStart = '2013-06-19 18:25';
                            $strEnd   = '06/19/13 21:47';
                            $dteStart = new DateTime($strStart);
                            $dteEnd   = new DateTime($strEnd);
                            $dteDiff  = $dteStart->diff($dteEnd);
                            $images_exp = explode('*', $value->images);
                            ?>
                            <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <!--                                <td class="center"><input class='check_invoice' type="checkbox" name="asset_excel[]"-->
                                <!--                                                          value="-->
                                <?php //echo $value->id ?><!--">-->
                                <!--                                </td>-->
                                <td><?php echo $i ?></td>
                                <td class="text-nowrap"><?php echo $value->id ?></td>
                                <td><?php echo date('d/m/Y H:i:s', $value->time/1000) ?></td>
                                <td class="text-nowrap"><?php echo $value->username ?></td>
                                <td class=""><?php echo $value->fullname ?></td>
                                <td class=""><?php echo $value->address ?></td>
<!--                                <td>--><?php //echo date('H:i:s', $value->time/1000) ?><!--</td>-->
                                <td><?php echo  $value->des ?></td>
                                <?php if (isset($images_exp[0]) && $images_exp[0] != '') { ?>

                                <td><img src="<?php if (isset($images_exp)) echo $images_exp[0] ?>" height="180px" /></td>
                                <?php } else echo '<td></td>' ?>
                                <td><?php echo  $value->name_status ?></td>
<!--                                <td>--><?php //echo $value->admin_id ?><!--</td>-->
                                <td id="<?php echo $value->id . '_mon' ?>"
                                    class="<?php if (isset($_GET['td']) && $_GET['td'] == $value->id . '_mon') echo 'bg_thanhly'; ?>">
                                    <?php
                                    if (isset($_GET['date1']) && isset($_GET['date2'])) {
                                        $date1 = $_GET['date1'];
                                        $date2 = $_GET['date2'];
                                    } else {
                                        $date1 = $_POST['date1'];
                                        $date2 = $_POST['date2'];
                                    }
                                    ?>
                                    <?php if ($itemMonId) { ?>
                                        <?php
                                        $tags = explode(',',$itemMonId);
                                        foreach ($tags as $row) {
//                                echo 'id teach: ' . $row . '<br>';
                                            $itemMon = $this->admin_model->get_info($row);
                                            if (!empty($itemMon)) { ?>
                                            <div id="<?php echo $row; ?>"
                                                 class="<?php if (isset($_GET['teach_id']) && $_GET['teach_id'] == $row) echo 'bg_thanhly'; ?>">
                                                <p class="text-nowrap text-info"> <?php echo $itemMon->fullname ?></p>
<!--                                                <a href="--><?php //echo base_url('admin/admin_emergency/edit/' . $row . '/' . $value->id) ?><!--"><i-->
<!--                                                            class="fa fa-pencil-square-o" aria-hidden="true"></i></a>-->
                                                <a <?php if (in_array($value->status,array(2,3,4,5,6,7))) echo 'class="disabled"'  ?> onclick="confirm_del_event(<?php echo $row ?>, <?php echo $value->id ?>, '<?php echo $date1 ?>', '<?php echo $date2 ?>', '<?php echo $itemMon->fullname ?>')"
                                                   class="btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg"
                                                                                    aria-hidden="true"></i></a>
                                            </div>
                                            <hr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    <div class="btn_them_1">
                                        <!--note link thêm: week_id/id/branch_id/thứ-->
                                        <a <?php if (in_array($value->status,array('5','6','7'))) echo 'class="disabled"'  ?> href="
                            <?php echo base_url('admin/admin_emergency/add/' . $value->id.'/'.$value->district_id.'/'.$value->province_id. '/' . $date1 . '/' . $date2) ?>"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </td>
<!--                                <td style="padding-top: 2%;width:10%">-->
<!--                                        <a href="--><?php //echo base_url('admin/admin_emergency/edit/'.$value->id) ?><!--" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa </a></br>-->
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
    function confirm_del_event(admin_id, id, date1, date2,fullname) {
        var r = confirm("Bạn có chắc chắn muốn xóa: "+fullname);
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin_emergency/del/')?>" + admin_id + "/" + id + '/' + date1 + '/' + date2;
        }
    }
</script>