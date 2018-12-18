<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Gian hàng(<?php echo count($res) ?>)</h3></div>
    <div class="title_right">
                <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                    <a href="<?php echo admin_url('product/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
<!--                    <a href="-->
<!--        --><?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
                </div>
    </div>
</div>
<div class="x_panel">
    <div class="x_title">
<!--        <h2>Danh sách bài đăng(--><?php //echo count($res) ?><!--)</h2>-->
<!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">-->
<!--            <a href="--><?php //echo admin_url('product/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
<!--            <!--            <a href="-->
<!--            --><?php ////echo admin_url('admin') ?><!--<!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
<!--        </div>-->
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

        <form method="post">
            <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Loại<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="product_type">
                        <option value="all">Tất cả</option>
                        <?php
                        $_SESSION['product_type'] = $_POST['product_type'];
                        foreach ($product_type as $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php if ($_SESSION['product_type'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Khu vực<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="area">
                        <option value="all">Tất cả</option>
                        <?php
                        $_SESSION['area'] = $_POST['area'];
                        foreach ($area as $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php if ($_SESSION['area'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Thành phố<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="city">
                        <option value="all">Tất cả</option>
                        <?php
                        $_SESSION['city'] = $_POST['city'];
                        foreach ($city as $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php if ($_SESSION['city'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
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
    </div>
    <div class="x_content">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên sp</th>
                <th>SL</th>
                <th>Loại</th>
                <th>Tên cửa hàng</th>
                <th>Tỉnh / TP</th>
                <th>Khu vực</th>
<!--                <th>Ngày đăng</th>-->
                <th>Địa chỉ</th>
                <th>Thành tiền</th>
                <th>Giảm giá(%)</th>
                <th>Hình ảnh</th>
<!--                <th>Mô tả</th>-->
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=0; ?>
            <?php foreach ($res as $row){ $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->name?></td>
                    <td><?php echo $row->number?></td>
                    <td><p class="label label-info"><?php echo $row->name_type  ?></p></td>
                    <td><?php echo $row->name_shop  ?></td>
                    <td><?php echo $row->name_city ?></td>
                    <td><?php echo $row->name_area  ?></td>
<!--                    <td>--><?php //echo date('d/m/Y', $row->created); ?><!--</td>-->
                    <td><?php echo $row->address  ?></td>
                    <td><?php echo number_format($row->price)  ?></td>
                    <td><?php echo $row->sale*100  ?></td>
<!--                    <td><img src="--><?php //echo base_url('public/images/product/'.$row->img)?><!--" style="max-width: 80px"> </td>-->
                    <td><img src="<?php echo $row->link_icon ?>" style="max-width: 80px"> </td>
<!--                    <td>--><?php //echo $row->descriptions ?><!-- </td>-->
                    <td>
                        <a class="btn btn-info btn-xs" href="<?php echo base_url('admin/product_config/edit/'.$row->id)?>"><i class="fa fa-pencil"></i> Sửa</a>
                        <a class="btn btn-success btn-xs" href="<?php echo base_url('admin/product_config/details/'.$row->id)?>"><i class="fa fa-pencil"></i> Chi tiết</a>
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
            window.location.href = '<?php echo base_url('admin/product_config/del/')?>' + id;
        }
    }
</script>