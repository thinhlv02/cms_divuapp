<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Cấu hình KTV rút tiền(<?php echo count($res) ?>)</h3></div>
    <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                    <a href="
        <?php echo admin_url('config_payment/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
<!--                    <a href="-->
<!--        --><?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
                </div>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
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
                <th>Luồng tiền</th>
                <th>Khu vực</th>
                <th>Thời gian</th>
                <th>Giới hạn</th>
                <th>Tỷ lệ</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($res as $row) {
                $i++; ?>
                <tr id="<?php echo $row->id ?>" class="<?php if (isset($_GET['id']) && $_GET['id'] == $row->id) echo 'bg_thanhly'; ?>">
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->name_money ?></td>
                    <td><?php echo $row->name_area ?></td>
                    <td><?php echo $row->time ?></td>
                    <td><?php echo number_format($row->limit) ?></td>
                    <td><?php echo $row->tyle ?></td>
                    <td>
                        <a class="btn btn-info btn-xs"
                           href="<?php echo base_url('admin/config_payment/edit/' . $row->id) ?>"><i class="fa fa-pencil"></i> Sửa</a>
                        <a class="btn btn-xs btn-danger" onclick="confirmDel(<?php echo $row->id ?>)"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
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
            window.location.href = '<?php echo base_url('admin/config_payment/del/')?>' + id;
        }
    }
</script>