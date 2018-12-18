<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Thông tin dịch vụ(<?php echo count($info_service) ?>)</h3></div>
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
<!--        <h2>Danh sách bài đăng(--><?php //echo count($info_service) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
            <a href="<?php echo admin_url('info_service/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
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
<!--                <th>Tiêu đề</th>-->
                <th>Nội dung</th>
                <th>Gói dịch vụ</th>
                <th>Ảnh</th>
                <th>Ngày đăng</th>
<!--                <th>Link</th>-->
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; ?>
            <?php foreach ($info_service as $row){ $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
<!--                    <td>--><?php //echo $row->title?><!--</td>-->
                    <td><?php echo $row->content  ?></td>
                    <td><?php echo $row->name  ?></td>
                    <td><img src="<?php echo $row->icon ?>" style="max-width: 80px"> </td>
                    <td><?php echo date('d/m/Y', $row->created); ?></td>
<!--                    <td>--><?php //echo $row->link  ?><!--</td>-->
                    <td>
                        <a class="btn btn-info btn-xs" href="<?php echo base_url('admin/info_service/edit/'.$row->id)?>"><i class="fa fa-pencil"></i> Sửa</a>
                        <a class="btn btn-xs btn-danger" onclick="confirmDel(<?php echo $row->id?>)"><i class="fa fa-trash-o"></i> Xóa</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>


<!--service-->
<div class="page-title">
    <div class="title_left"><h3>Ảnh gói dịch vụ tổng hợp(<?php echo count($res2) ?>)</h3></div>
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
<!--            <a href="--><?php //echo admin_url('banner/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
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
        <table id="datatable-banner" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Name </th>
                <th>Img</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; ?>
            <?php foreach ($res2 as $row){ $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->name?></td>
                    <td><img src="<?php echo $row->icon ?>" style="max-width: 80px"> </td>
                    <td><?php echo $row->des ?> </td>
                    <td>
                        <a class="btn btn-info btn-xs" href="<?php echo base_url('admin/info_service/edit_package/'.$row->id)?>"><i class="fa fa-pencil"></i> Edit</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>
<!--service-->


<script>
    function confirmDel(id) {
        if(confirm('Bạn có chắc chắn muốn xóa??')){
//            console.log('delll');
            window.location.href = '<?php echo base_url('admin/info_service/del/')?>' + id;
        }
    }
</script>