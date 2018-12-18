<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách tài khoản quản trị(<?php echo count($res) ?>)</h3></div>
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
        <!--        <h2>Danh sách (--><?php //echo count($res) ?><!--)</h2>-->
        <!--        <div class="col-md-5 col-sm-5 col-xs-12 pull-left">-->
        <!--            <form method="post">-->
        <!--                <div class="col-xs-4 col-xs-4 col-xs-12">-->
        <!--                    <select class="select2_group form-control-custom" name="company_id">-->
        <!--                        <option value="all">[Cty/C.nhánh]</option>-->
        <!--                        --><?php
        //                        $_SESSION['company_id'] = $_POST['company_id'];
        //                        foreach ($company as $value) { ?>
        <!--                            <option value="--><?php //echo $value->id ?><!--" -->
        <?php //if ($_SESSION['company_id'] == $value->id) echo 'selected'; ?><!-->
        <?php //echo $value->name ?><!--</option>-->
        <!--                        --><?php //} ?>
        <!--                    </select>-->
        <!--                </div>-->
        <!---->
        <!--                <div class="col-xs-5 col-xs-5 col-xs-12">-->
        <!--                    <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>-->
        <!--                </div>-->
        <!---->
        <!--                <div class="col-xs-2 col-xs-2 col-xs-12">-->
        <!--                    <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->
        <div class="col-md-2 col-sm-2 col-xs-12 pull-left">
            <a href="<?php echo admin_url('admin/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <!--            <a href="-->
            <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
        <!--        <ul class="nav navbar-right panel_toolbox">-->
        <!--            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>-->
        <!--            <li class="dropdown">-->
        <!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i-->
        <!--                            class="fa fa-wrench"></i></a>-->
        <!--                <ul class="dropdown-menu" role="menu">-->
        <!--                    <li><a href="#">Settings 1</a>-->
        <!--                    </li>-->
        <!--                    <li><a href="#">Settings 2</a>-->
        <!--                    </li>-->
        <!--                </ul>-->
        <!--            </li>-->
        <!--            <li><a class="close-link"><i class="fa fa-close"></i></a></li>-->
        <!--        </ul>-->
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <!--        <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Avatar</th>
                <th>Tên đăng nhập</th>
                <th>Tên đầy đủ</th>
                <th>phone</th>
                <th>address</th>
                <th>email</th>
                <th>Hành động</th>
                <th>Trạng thái</th>
                <th>Cập nhật</th>
                <!--                <th>Phân quyền</th>-->
            </tr>
            </thead>

            <tbody>
            <!--            --><?php //$this->load->model('level_model') ?>
            <?php $i = 0; ?>
            <!--            <tr>-->
            <!--                <td>1</td>-->
            <!--                <td>Admin</td>-->
            <!--                <td>Admin</td>-->
            <!--                <td></td>-->
            <!--                <td></td>-->
            <!--                <td></td>-->
            <!--                <td></td>-->
            <!--            </tr>-->
            <?php foreach ($res as $key => $value): ?>
                <?php
//            if ($value->employee_id == 123456) {
//                $name = 'No name';
//            }

//                if (strpos($value->employee_id, '123456') !== false) {
//                    $name = 'No name';
//                }
                $i++;
//                if ($value->UserName == 'admin') {
//                    $name = 'admin';
//                } else {
//                }
                ?>
                <tr id="<?php echo $value->id; ?>"
                    class="<?php if (isset($_GET['admin_id']) && $_GET['admin_id'] == $value->id) echo 'bg_thanhly';
                    ?> ">
                    <td><?php echo $i; ?></td>
                    <td><img src="<?php echo $value->link_avatar ?>" style="max-width: 100px"> </td>
                    <td><?php echo $value->username ?></td>
                    <td><?php echo $value->fullname ?></td>
                    <td><?php echo $value->phone ?></td>
                    <td><?php echo $value->address ?></td>
                    <td><?php echo $value->email ?></td>
                    <!--                    <td>-->
                    <!--                        -->
                    <?php //echo $this->level_model->get_info($value->level)->level_name ?><!--</td>-->
                    <td>
                        <a href="
                        <?php echo admin_url('admin/edit/') . $value->id ?>"
                           class="btn btn-default btn-xs">Sửa</a>
                        <a onclick="confirm_del_event(<?php echo $value->id ?>)"
                           class="btn btn-default btn-xs"><i class="fa fa-trash-o"></i> Xóa</a>
                        <a href="<?php echo admin_url('admin/info/') . $value->id ?>"
                           class="btn btn-default btn-xs">Đổi mật khẩu</a>
                        <a href="
                        <?php echo admin_url('admin/access/') . $value->id ?>"
                           class="btn btn-default btn-xs">Phân quyền</a>
                    </td>
                    <td>
                        <select id='status_<?php echo $value->id ?>'
                                class="<?php if ($value->status == 1) echo 'label label-success'; else echo 'label label-danger' ?>">
                            <option value="1" <?php if ($value->status == 1) echo 'selected' ?>>Mở</option>
                            <option value="2" <?php if ($value->status == 2) echo 'selected' ?>>Khóa</option>
                        </select>
                    </td>
                    <td><input type='button' class='yes btn-success btn-xs' tid='<?php echo $value->id ?>'
                               value='Cập nhật'/>
                    </td>
                    <!--                    <td><a href="-->
                    <?php //echo admin_url('admin/access/') . $value->employee_id ?><!--"-->
                    <!--                           class="btn btn-info btn-xs">-->
                    <?php //echo $value->UserName ?><!--</a>-->
                    <!--                    </td>-->
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
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
</style>
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