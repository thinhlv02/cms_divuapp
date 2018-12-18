<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>CTV đăng ký(<?php echo count($res) ?>)</h3></div>
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
<!--            <a href="--><?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
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
        <form method="post">
            <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Từ ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtFrom" name="date1" required
                           value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                           class="form-control col-md-7 col-xs-12"/>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtTo" name="date2" required
                           value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                           class="form-control col-md-7 col-xs-12">
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Trạng thái<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="status">
                        <option value="all">Tất cả</option>
                        <option value="1" <?php if (isset($_POST['status']) && $_POST['status'] == 1) echo 'selected'; ?>>Gửi yêu cầu</option>
                        <option value="2" <?php if (isset($_POST['status']) && $_POST['status'] == 2) echo 'selected'; ?>>Đồng ý</option>
                        <option value="3" <?php if (isset($_POST['status']) && $_POST['status'] == 3) echo 'selected'; ?>>Không đồng ý</option>
                    </select>
                </div>
                <div class="col-xs-1 col-xs-1">
                    <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                </div>
            </div>
            <!--                <div class="ln_solid"></div>-->
            <div class="form-group">
                <!--                    <div class="col-md-2 col-sm-2 col-xs-12">-->
                <!--                        <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>-->
                <!--                    </div>-->
                <!--                    <div class="col-xs-1 col-xs-1">-->
                <!--                        <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>-->
                <!--                    </div>-->
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
                <th>UserID</th>
                <th>user_id</th>
                <th>Tên đầy đủ</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Ngày tạo</th>
                <th>status</th>
<!--                <th>Hành động</th>-->
            </tr>
            </thead>
            <tbody>
            <?php $i=0;
//            pre($res);
            ?>
            <?php foreach ($res as $key => $row){ $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->id?></td>
                    <td><?php echo $row->user_id?></td>
                    <td><?php echo $row->fullname  ?></td>
                    <td><?php echo $row->phone  ?></td>
                    <td><?php echo $row->address  ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($row->created_at)); ?></td>
                    <td><?php echo $row->status  ?></td>
<!--                    <td><img src="--><?php //echo base_url('public/images/news/'.$row->img)?><!--" style="max-width: 80px"> </td>-->
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
            window.location.href = '<?php echo base_url('admin/city/del/')?>' + id;
        }
    }
</script>