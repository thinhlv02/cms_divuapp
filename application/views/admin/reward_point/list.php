<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Cấu hình điểm thưởng(<?php echo count($res) ?>)</h3></div>
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
    <div class="x_title">
        <!--        <h2>Danh sách bài đăng(--><?php //echo count($res) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
            <a href="<?php echo admin_url('reward_point/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
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
                <th>Hành động</th>
                <th>Đơn vị</th>
                <th>Tỉnh / T.Phố</th>
                <th>Khu vực</th>
                <th>Điểm</th>
                <th>Sửa</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($res as $row) {
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->action ?></td>
                    <td><?php echo $row->unit ?></td>
                    <td><?php echo $row->name_city ?></td>
                    <td><?php echo $row->name_area ?></td>
                    <td><?php echo $row->point ?></td>
                    <td>
                        <a class="btn btn-info btn-xs"
                           href="<?php echo base_url('admin/reward_point/edit/' . $row->id) ?>"><i class="fa fa-pencil"></i> Sửa</a>
                        <a class="btn btn-xs btn-danger" onclick="confirmDel(<?php echo $row->id ?>)"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>

<!--config server-->
<div class="page-title">
    <div class="title_left"><h3>Cấu hình server(<?php echo count($config_server) ?>)</h3></div>
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
    <div class="x_title">
        <!--        <h2>Danh sách bài đăng(--><?php //echo count($res) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
<!--            <a href="--><?php //echo admin_url('reward_point/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
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
                <th>tiền thưởng đăng ký tài khoản</th>
                <th>Tiền thưởng nhập mã giới thiệu</th>
                <th>Sửa</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($config_server as $row) {
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
<!--                    <td>--><?php //echo number_format($row->money_register_account) ?><!--</td>-->
                    <td><input id="money_register_account_<?php echo $row->id ?>" value="<?php echo $row->money_register_account ?>"/></td>
                    <td><input id="money_thuong_nhap_ma_gioi_thieu_<?php echo $row->id ?>" value="<?php echo $row->money_thuong_nhap_ma_gioi_thieu ?>"/></td>
<!--                    <td>--><?php //echo number_format($row->money_thuong_nhap_ma_gioi_thieu) ?><!--</td>-->
<!--                    <td>-->
<!--                        <a class="btn btn-info btn-xs"-->
<!--                           href="--><?php //echo base_url('admin/reward_point/edit/' . $row->id) ?><!--"><i class="fa fa-pencil"></i> Sửa</a>-->
<!--                    </td>-->

                    <td><input type='button' class='yes btn-success btn-xs'
                               tid='<?php echo $row->id ?>'
                               value='Cập nhật'/></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>
<!--config server-->
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>

<script>
    function confirmDel(id) {
        if (confirm('Bạn có chắc chắn muốn xóa??')) {
//            console.log('delll');
            window.location.href = '<?php echo base_url('admin/reward_point/del/')?>' + id;
        }
    }

    $('.yes').click(function () {
        var self = this;
        var tid = $(this).attr("tid");
        // console.log(tid);

        var money_register_account = 'money_register_account_' + tid;
        var money_register_account_ = document.getElementById(money_register_account);
        var money_register_account_content = money_register_account_.value;

        var money_thuong_nhap_ma_gioi_thieu = 'money_thuong_nhap_ma_gioi_thieu_' + tid;
        var money_thuong_nhap_ma_gioi_thieu_ = document.getElementById(money_thuong_nhap_ma_gioi_thieu);
        var money_thuong_nhap_ma_gioi_thieu_content = money_thuong_nhap_ma_gioi_thieu_.value;

        console.log(' id: ' + tid + 'money_register_account' + money_register_account_content + '--> '+ money_thuong_nhap_ma_gioi_thieu_content);
        if (confirm('Bạn có đồng ý thay đổi ??')) {
            $.ajax({
                url: '<?php echo base_url('admin/lock_admin/update_config_server') ?>',
                // url: 'quanlyserver/events_process.php',
                type: 'POST',
                data: {
                    'id': tid,
                    'money_register_account': money_register_account_content,
                    'money_thuong_nhap_ma_gioi_thieu': money_thuong_nhap_ma_gioi_thieu_content,
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