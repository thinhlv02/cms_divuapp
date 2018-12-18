<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>TK yêu cầu rút tiền(<?php if (isset($res)) echo count($res); else echo 0 ?>)</h3></div>
    <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
<!--                    <a href="-->
<!--        --><?php //echo admin_url('user_active/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
<!--                    <a href="-->
<!--        --><?php //echo admin_url('user_active') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
                </div>
    </div>
</div>
<div class="x_panel">
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


                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Trạng thái<span class="required">*</span></label>

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="status">
                        <?php if (isset($_POST['status'])){
                            $_SESSION['status'] = $_POST['status'];
                        } ?>
                        <option value="all">All</option>
                        <?php foreach ($status as $key => $value) { ?>
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
        <!--        <h2>Danh sách bài đăng(--><?php //echo count($user_active) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
<!--            <a href="--><?php //echo admin_url('service_package/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--            <a href="-->
            <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
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
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>UserID</th>
                <th>username</th>
                <th>Địa chỉ</th>
                <th>Thời gian gửi</th>
                <th>Số tiền</th>
                <th>Hình thức thanh toán</th>
                <th>bank_info</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
<!--                <th>Hành động</th>-->
            </tr>
            </thead>
            <tbody>
            <?php $i = $total= 0; ?>
            <?php if (isset($res) && count($res) > 0) foreach ($res as $row) {
                $i++;
                $total +=$row->total_money_payment;
                if ($row->type == 1 ) {
                    $type = 'chuyển khoản';
                }
                if($row->type == 2) {
                    $type = 'nhận tiền mặt';
                }
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->id ?></td>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->address ?></td>
                    <td><?php echo date('d-m-Y H:i:s', strtotime($row->created)) ?></td>
                    <td><?php echo number_format($row->total_money_payment) ?></td>
                    <td class="<?php if ($row->type == 1) echo 'bg bg-info'; else echo 'bg bg-danger' ?>"><?php echo $type ?></td>
                    <td><?php echo $row->bank_info ?></td>
                    <td>
                        <select id='status_<?php echo $row->id ?>'
                                class="<?php if ($row->status == 1) echo 'label label-success'; else echo 'label label-danger' ?>">
                            <option value="1" <?php if ($row->status == 1) echo 'selected' ?>>gửi yêu cầu</option>
                            <option value="2" <?php if ($row->status == 2) echo 'selected' ?>>đang thanh toán</option>
                            <option value="3" <?php if ($row->status == 3) echo 'selected' ?>>Đã thanh toán</option>
                            <option value="4" <?php if ($row->status == 4) echo 'selected' ?>>hủy thanh toán</option>
                        </select>

<!--                        3: Đã thanh toán, 4: hủy thanh toán-->
                    </td>
                    <?php if ($row->status != 4) { ?>
                        <td><input type='button' class='yes btn-success btn-xs' tid='<?php echo $row->id ?>' admin_id='<?php echo $row->admin_id ?>'
                                   value='Cập nhật'/></td>
                    <?php } else{
                        echo '<td></td>';
                    } ?>

                    <!--                    <td><img src="-->
                    <?php //echo base_url('public/images/news/'.$row->img)?><!--" style="max-width: 80px"> </td>-->
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr class="text-center">
                <td colspan="5">Tổng tiền</td>
                <td><?php echo number_format($total) ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tfoot>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>

<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa tài khoản này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin/del/')?>" + id;
        }
    }

    $('.yes').click(function () {
        var self = this;
        var tid = $(this).attr("tid");
        var admin_id = $(this).attr("admin_id");
        // console.log(tid);
        var status = 'status_' + tid;
        var status_ = document.getElementById(status);
        var status_content = status_.value;
        // console.log(status_content);

        console.log(status_content + ' id: ' + tid + 'admin_id' + admin_id);
        if (confirm('Bạn có đồng ý thay đổi ??')) {
            $.ajax({
                url: '<?php echo base_url('admin/lock_admin/update_admin_require_payment')?>',
                // url: 'quanlyserver/events_process.php',
                type: 'POST',
                data: {
                    'id': tid,
                    'admin_id': admin_id,
                    'status_content': status_content
                },
                success: function (response) {
                    //Do something here...
                    alert(response);
                    // console.log(response.indexOf('Hủy thành công'));
                    if (response.indexOf('cập nhật thành công') != -1) {
                        $(self).parent().parent().find(".yes").hide();
                        // $(self).parent().parent().find(".no").hide();
                        // $(self).hide();
                    }
                }
            });
        }
    });
</script>