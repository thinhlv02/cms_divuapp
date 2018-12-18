<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>KTV bị khóa(<?php echo count($user_lock) ?>)</h3></div>
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
        <!--        <h2>Danh sách bài đăng(--><?php //echo count($user_lock) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
            <a href="<?php echo admin_url('service_package/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
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
                <th>Tên</th>
                <th>Level</th>
                <th>Rank</th>
                <th>Tên đầy đủ</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Email</th>
<!--                <th>Hành động</th>-->
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($user_lock as $row) {
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->username ?></td>
                    <td><?php echo $row->level ?></td>
                    <td><?php echo $row->rank ?></td>
                    <td><?php echo $row->fullname ?></td>
                    <td><?php echo $row->phone ?></td>
                    <td><?php echo $row->address ?></td>
                    <td><?php echo $row->email ?></td>
                    <!--                    <td><img src="-->
                    <?php //echo base_url('public/images/news/'.$row->img)?><!--" style="max-width: 80px"> </td>-->
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>
<script>
    function confirmDel(id) {
        if (confirm('Bạn có chắc chắn muốn xóa??')) {
//            console.log('delll');
            window.location.href = '<?php echo base_url('admin/service_package/del/')?>' + id;
        }
    }
</script>