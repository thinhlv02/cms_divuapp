<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách kỹ thuật viên(<?php echo count($user_active) ?>)</h3></div>
    <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                    <a href="
        <?php echo admin_url('user_active/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
<!--                    <a href="-->
<!--        --><?php //echo admin_url('user_active') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
                </div>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
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
                <th>Avatar</th>
                <th>Tên đăng nhập</th>
                <th>Tên đầy đủ</th>
                <th>Kích hoạt</th>
<!--                <th>Level</th>-->
                <th>Số lần đánh giá</th>
                <th>Số sao</th>
                <th>Mở / Khóa</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Email</th>
                <th>Tỉnh/TP hoạt động</th>
                <th>Quận/Huyện hoạt động</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
                <th>Hành động</th>
<!--                <th>Hành động</th>-->
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($user_active as $row) {
                $i++;
                if ($row->rank != '') {
                    $rank_ = explode('_', $row->rank);
//                    $sao =
                }
//                echo $row->rank
                if ($row->status == 1 || $row->is_active == 1) {
                    $status = 'Mở';
                    $is_active = 'Online';
                }
                if($row->status == 2 || $row->is_active == 2) {
                    $status = 'Khóa';
                    $is_active = 'Offline';
                }
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->id ?></td>
                    <td><img src="<?php echo $row->link_avatar ?>" style="max-width: 100px"> </td>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->fullname ?></td>
                    <td class="<?php if ($row->is_active == 1) echo 'bg bg-info'; else echo 'bg bg-danger' ?>"><?php echo $is_active ?></td>
<!--                    <td>--><?php //echo $row->level ?><!--</td>-->
                    <td><?php if (isset($rank_[0])) echo $rank_[0] ?></td>
                    <td><?php if (isset($rank_[1])) echo number_format($rank_[1] / $rank_[0],2) ?></td>
<!--                    <td class="--><?php //if ($row->is_active == 1) echo 'label label-info'; else echo 'label label-danger' ?><!--">--><?php //echo $is_active ?><!--</td>-->
                    <td class="<?php if ($row->status == 1) echo 'bg bg-info'; else echo 'bg bg-danger' ?>"><?php echo $status ?></td>
                    <td><?php echo $row->phone ?></td>
                    <td><?php echo $row->address ?></td>
                    <td><?php echo $row->email ?></td>
                    <td><?php echo $row->city_work_id_ ?></td>
                    <td><?php echo $row->district_work_id_ ?></td>
                    <td>
                        <select id='status_<?php echo $row->id ?>'
                                class="<?php if ($row->status == 1) echo 'label label-success'; else echo 'label label-danger' ?>">
                            <option value="1" <?php if ($row->status == 1) echo 'selected' ?>>Mở</option>
                            <option value="2" <?php if ($row->status == 2) echo 'selected' ?>>Khóa</option>
                        </select>
                    </td>
                    <td><input type='button' class='yes btn-success btn-xs' tid='<?php echo $row->id ?>'
                               level ='<?php echo $row->level ?>'
                               value='Cập nhật'/>
                    </td>
                    <td>
                        <a href="
                        <?php echo admin_url('user_active/edit/') . $row->id ?>"
                           class="btn btn-default btn-xs">Sửa</a>
                        <a onclick="confirm_del_event(<?php echo $row->id ?>)"
                           class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                    <!--                    <td><img src="-->
                    <?php //echo base_url('public/images/news/'.$row->img)?><!--" style="max-width: 80px"> </td>-->
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>

<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa tài khoản này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('user_active/del/')?>" + id;
        }
    }

    $('.yes').click(function () {
        var self = this;
        var tid = $(this).attr("tid");
        var level = $(this).attr("level");
        // console.log(tid);
        var status = 'status_' + tid;
        var status_ = document.getElementById(status);
        var status_content = status_.value;
        // console.log(status_content);

        console.log(status_content + ' id: ' + tid);
        if (confirm('Bạn có đồng ý thay đổi ??')) {
            $.ajax({
                url: '<?php echo base_url('admin/lock_admin')?>',
                // url: 'quanlyserver/events_process.php',
                type: 'POST',
                data: {
                    'id': tid,
                    'level': level,
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