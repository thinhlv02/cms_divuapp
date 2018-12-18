<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Giới thiệu chi tiết gói dịch vụ(<?php echo count($res) ?>)</h3></div>
    <div class="title_right">
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
        <!--            <a href="--><?php //echo admin_url('admin/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--            <a href="-->
        <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        <!--        </div>-->
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
<!--        <h2>Danh sách bài đăng(--><?php //echo count($res) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
            <a href="<?php echo admin_url('service_details/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <!--            <a href="-->
            <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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
                <th>Tên dịch vụ</th>
                <th>Tên gói</th>
                <th>Mô tả</th>
<!--                <th>Ngày đăng</th>-->
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; ?>
            <?php foreach ($res as $row){ $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->name?></td>
                    <td><?php echo $row->name_service_package?></td>
                    <td><?php echo $row->des ?> </td>
<!--                    <td>--><?php //echo date('d/m/Y', $row->created); ?><!--</td>-->
<!--                    <td><img src="--><?php //echo base_url('public/images/service_details/'.$row->img)?><!--" style="max-width: 80px"> </td>-->
                    <td><img src="<?php echo $row->link_icon ?>" style="max-width: 80px"> </td>
                    <td>
                        <a class="btn btn-info btn-xs" href="<?php echo base_url('admin/service_details/edit/'.$row->id)?>"><i class="fa fa-pencil"></i> Sửa</a>
                        <a class="btn btn-xs btn-danger" onclick="confirmDel(<?php echo $row->id?>)"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>
<script>
    function confirmDel(id) {
        if(confirm('Bạn có chắc chắn muốn xóa??')){
//            console.log('delll');
            window.location.href = '<?php echo base_url('admin/service_details/del/')?>' + id;
        }
    }
</script>