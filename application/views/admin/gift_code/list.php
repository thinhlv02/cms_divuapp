<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>mã voucher(<?php if (isset($res)) echo count($res) ?>)</h3></div>
    <div class="title_right">
        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
            <a href="
        <?php echo admin_url('gift_code/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <!--                    <a href="-->
            <!--        --><?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
    </div>
</div>
<div class="x_panel">
    <?php if ($message) {
        $this->load->view('admin/message', $this->data);
    } ?>
    <form id="formAddProduct" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="type" id="type" onchange="val()">
                    <option value="all">all</option>
                    <option value="1" <?php if (isset($_POST['type']) && $_POST['type'] == 1) echo 'selected' ?>>Tang
                        DIV
                    </option>
                    <option value="2" <?php if (isset($_POST['type']) && $_POST['type'] == 2) echo 'selected' ?>>Tang
                        goi dich vu
                    </option>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Gói DV<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="service_package_id" id="id_service_package_id">
                    <option value="all">all</option>
                    <?php
                    if (isset($_POST['service_package_id'])) {
                        $_SESSION['service_package_id'] = $_POST['service_package_id'];
                    }
                    foreach ($service_package as $k => $v) { ?>
                        <option value="<?php echo $v->id ?>"
                            <?php if (isset($_SESSION['service_package_id']) && $_SESSION['service_package_id'] == $v->id) echo 'selected' ?>><?php echo $v->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Đại lý<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="agent">
                    <option value="all">all</option>
                    <?php
                    if (isset($_POST['agent'])) {
                        $_SESSION['agent'] = $_POST['agent'];
                    }
                    foreach ($agency as $k => $v) { ?>
                        <option value="<?php echo $v->id ?>"
                            <?php if (isset($_SESSION['agent']) && $_SESSION['agent'] == $v->id) echo 'selected' ?>
                        ><?php echo $v->name ?></option>
                    <?php } ?>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Tạo bởi<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="create_by">
                    <option value="all">all</option>
                    <?php
                    if (isset($_POST['create_by'])) {
                        $_SESSION['create_by'] = $_POST['create_by'];
                    }
                    foreach ($create_by as $k => $v) { ?>
                        <option value="<?php echo $v->id ?>"
                            <?php if (isset($_SESSION['create_by']) && $_SESSION['create_by'] == $v->id) echo 'selected' ?>
                        ><?php echo $v->username ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Người sử dụng<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <select class="select2_group form-control" name="use_by" id="use_by">
                    <option value="all">all</option>
                    <option value="1" <?php if (isset($_POST['use_by']) && $_POST['use_by'] == 1) echo 'selected' ?>>Đã
                        dùng
                    </option>
                    <option value="2" <?php if (isset($_POST['use_by']) && $_POST['use_by'] == 2) echo 'selected' ?>>
                        Chưa
                    </option>
                </select>
            </div>

            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Code<span
                        class="required"></span></label>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input type="text" name="code" value="<?php if (isset($_POST['code'])) echo $_POST['code'] ?>"
                       class="form-control"/>
            </div>
            <!--            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Hạn dùng<span-->
            <!--                        class="required"></span></label>-->
            <!--            <div class="col-md-2 col-sm-2 col-xs-12">-->
            <!--                <input type="text" id="txtFrom" name="expire_date" required-->
            <!--                       value="-->
            <?php //if (isset($_POST['expire_date'])) echo date('d-m-Y', strtotime($_POST['expire_date'])) ?><!--"-->
            <!--                       class="form-control col-md-7 col-xs-12"/>-->
            <!--            </div>-->
            <!--            <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại cộng, trừ<span-->
            <!--                        class="required"></span></label>-->
            <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--                <select class="select2_group form-control" name="sub">-->
            <!--                    --><?php //foreach ($service_package as $k => $v) { ?>
            <!--                        <option value="--><?php //echo $v->id ?><!--">-->
            <?php //echo $v->name ?><!--</option>-->
            <!--                    --><?php //} ?>
            <!---->
            <!--                    <option value="1">Cộng</option>-->
            <!--                    <option value="2">Trừ</option>-->
            <!--                </select>-->
            <!--            </div>-->
        </div>

        <div class="form-group">
            <div class="col-md-1 col-sm-1 col-xs-12 col-md-offset-1" style="">
                <input type="submit" id="btnAddEvent" name="btnAdd" required="required" class="btn btn-success"
                       value="Tìm kiếm">
            </div>
            <!--            <div class="col-md-3 col-sm-3 col-xs-12">-->
            <!--            <a href="-->
            <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--                <a href="-->
            <?php //echo admin_url('config_payment') ?><!--" class="btn btn-success">Quay lại danh sách</a>-->
            <!--            </div>-->
        </div>
    </form>
</div>
<div class="x_panel">
    <!--    <div class="x_title">-->
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
    <!--        <div class="clearfix"></div>-->
    <!--    </div>-->
    <div class="x_content">
        <!--        <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
        <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>STT</th>
                <th>code</th>
                <th>Kiểu</th>
                <th>tiền div</th>
                <th>Gói dịch vụ</th>
                <th>đại lý</th>
                <th>hạn sử dụng</th>
                <th>người sử dụng</th>
                <th>ngày tạo</th>
                <th>tạo bởi</th>
                <th>khu vực</th>
                <th>Đc phục vụ</th>
                <!--                <th>Hành động</th>-->
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php if (isset($res)) foreach ($res as $row) {
                $i++; ?>
                <tr id="<?php echo $row->id ?>"
                    class="<?php if (isset($_GET['id']) && $_GET['id'] == $row->id) echo 'bg_thanhly'; ?>">
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->code ?></td>
                    <td><?php echo $row->type ?></td>
                    <td><?php echo $row->div ?></td>
                    <td><?php echo $row->service_package_id ?></td>
                    <td><?php echo $row->agent ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row->expire_date)) ?></td>
                    <td><?php echo $row->use_by ?></td>
                    <td><?php echo $row->create_time ?></td>
                    <td><?php echo $row->create_by ?></td>
                    <td><?php echo $row->area_id ?></td>
                    <td><?php echo $row->service_package_user_id ?></td>
                    <!--                    <td></td>-->
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <!-- <a href="#" class="btn btn-danger">Xóa đã chọn </a> -->
    </div>
</div>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    function confirmDel(id) {
        if (confirm('Bạn có chắc chắn muốn xóa??')) {
//            console.log('delll');
            window.location.href = '<?php echo base_url('admin/config_payment/del/')?>' + id;
        }
    }

    // $('#id_service_package_id').hide();
    $('#type').change(function () {
        // var type = $('#type').val();
        var type = $('#type').val();
        // console.log(type);
        if (type == 2) {
            // $('#id_service_package_id').show();
        } else {
            // $('#id_service_package_id').hide();
        }
    });

    function val() {
        d = document.getElementById('type').value;
        console.log('value: ' + d);
        // if (d == 1) {
        //     document.getElementById("id_service_package_id").style.display = 'none';
        // }
        // if (d == 2) {
        //     document.getElementById("id_service_package_id").style.display = 'block';
        // }
    }
</script>