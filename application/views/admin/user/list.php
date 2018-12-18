<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Đăng ký mới(<?php if (isset($res)) echo count($res); else echo 0 ?>)</h3></div>
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
            <!--            <a href="-->
            <?php //echo admin_url('city/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
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
        <!--        <form method="post">-->
        <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
              enctype="multipart/form-data">
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
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Khu vực<span class="required">*</span></label>

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="area">
                        <option value="all">Tất cả</option>
                        <?php
                        if (isset($_POST['area'])) {
                            $_SESSION['area'] = $_POST['area'];
                        }
                        foreach ($area as $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php if ($_SESSION['area'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tỉnh thành<span
                            class="required">*</span></label>

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="vn_city" id="mySelect"
                            onchange="myFunction()">
                        <option value="all">Tất cả</option>
                        <?php
                        $_SESSION['vn_city'] = $_POST['vn_city'];
                        foreach ($vn_city as $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php if ($_SESSION['vn_city'] == $value->id) echo 'selected'; ?>><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!--                <script type="text/javascript">-->
                <!--                    $('#mySelect').change(function () {-->
                <!--                        $('#sl_provider_id').empty();-->
                <!--                        $('#sl_provider_id').append("<option value='all'>All</option>");-->
                <!--                        $('#sl_provider_id').append("<option value='1'>test</option>");-->
                <!--                    })-->
                <!--                </script>-->

            </div>
            <!--                <div class="ln_solid"></div>-->
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Quận/huyện<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="vn_district" id="vn_district_new">
                        <!--                        <option value="all">Tất cả</option>-->
                        <?php
                        $str_district = $this->session->userdata('str_district');
                        if (isset($str_district)) {
                            echo $str_district;
                        } else { ?>
                            <option value="all">Tất cả</option>
                        <?php } ?>
                        <!--                        <option value="1">1</option>-->
                        <!--                        <option value="2">2</option>-->
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Mã kinh doanh<span
                            class="required">*</span></label>

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="device" id="">
                        <option value="all">Tất cả</option>
                        <?php if (isset($_POST['device'])) {
                            $_SESSION['device'] = $_POST['device'];
                        }
                        foreach ($app_info as $value) { ?>
                            <option value="<?php echo $value->device ?>" <?php if (isset($_SESSION['device']) && $_SESSION['device'] == $value->device) echo 'selected'; ?>><?php echo $value->device_name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Mã giới thiệu<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control-custom" name="recipient_id">
                        <option value="all">Tất cả</option>
                        <?php
                        $_SESSION['recipient_id'] = '';
                        if (isset($_POST['recipient_id'])) {
                            $_SESSION['recipient_id'] = $_POST['recipient_id'];
                        }
                        foreach ($list_phone_intro as $value) { ?>
                            <option value="<?php echo $value->recipient_id . '|' . $value->recipient_type ?>"
                                <?php if ($_SESSION['recipient_id'] == $value->recipient_id . '|' . $value->recipient_type) echo 'selected'; ?>>
                                <?php echo $value->code_name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!--                            <div class="ln_solid"></div>-->
            <div class="form-group">
                <div class="col-xs-1 col-xs-1">
                    <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                </div>
            </div>
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

    <!--    TQ-->
    <h4>Bảng Tổng quát</h4>
    <div class="x_content">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã KD</th>
                <th>Thiết bị</th>
                <th>Tổng</th>
                <th>IMEI</th>
                <th>IP</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = $tong = $imei = $ip = 0; ?>
            <?php if (isset($user_tq)) foreach ($user_tq as $row) {
                $i++;
                $tong += $row->tong;
                $imei += $row->imei;
                $ip += $row->ip;
                ?>
                <tr class="">
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->device ?></td>
                    <td><?php echo $row->device_name ?></td>
                    <td><?php echo $row->tong ?></td>
                    <td><?php echo $row->imei ?></td>
                    <td><?php echo $row->ip ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr class="bg bg-info">
                <td colspan="3">Tổng</td>
                <td><?php echo number_format($tong) ?></td>
                <td><?php echo number_format($imei) ?></td>
                <td><?php echo number_format($ip) ?></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <!--    TQ-->

    <!--    Thật-->
    <h4>Bảng đăng ký thật</h4>
    <h5 class="text text-danger">là lượng user đk mới hoàn toàn về imei và ip so với ngày về trước</h5>
    <div class="x_content">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã KD</th>
                <th>Thiết bị</th>
                <th>Tổng</th>
                <th>Thời gian</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = $tong = 0; ?>
            <?php if (isset($userthuc_arr)) foreach ($userthuc_arr as $row) {
                $i++;
                $tong += $row->user_thuc ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->device ?></td>
                    <td><?php echo $row->device_name ?></td>
                    <td><?php echo $row->user_thuc ?></td>
                    <td><?php echo date('d-m-Y', strtotime($row->thoigian)) ?></td>
                </tr>
            <?php } ?>
            </tbody>
            <tfoot>
            <tr class="bg bg-info">
                <td colspan="3">Tổng</td>
                <td><?php echo number_format($tong) ?></td>
                <td></td>
            </tr>
            </tfoot>
        </table>
    </div>
    <!--    Thật-->


    <h4>Bảng chi tiết(<?php if (isset($res)) echo count($res); else echo 0 ?>)</h4>
    <div class="x_content">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã Giới thiệu</th>
                <th>UserID</th>
                <th>Tên</th>
                <th>Tên đầy đủ</th>
                <th>SĐT</th>
                <th>Email</th>
                <th>Địa chỉ</th>
                <th>Thành phố</th>
                <th>Quận/huyện</th>
                <th>Ngày tạo</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0;
            //            pre($res);
            ?>
            <?php if (isset($res)) foreach ($res as $row) {
                $i++; ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['code_intro_name'] ?></td>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['fullname'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['address'] ?></td>
                    <td><?php echo $row['province'] ?></td>
                    <td><?php echo $row['district'] ?></td>
                    <td><?php echo date('d/m/Y H:i:s', strtotime($row['created_at'])); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script>
    function confirmDel(id) {
        if (confirm('Bạn có chắc chắn muốn xóa??')) {
//            console.log('delll');
            window.location.href = '<?php echo base_url('admin/city/del/')?>' + id;
        }
    }

    function myFunction() {
        var vn_city = document.getElementById("mySelect").value;
        console.log('vn_city: ' + vn_city);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/get_department/get_vn_district')?>',
            data: {
                'vn_city': vn_city
            },
            success: function (msg) {
                // console.log('fuck');
                $('#vn_district_new').html(msg);
            },
            error: function (xhr, status, error) {
                console.log(status);
                console.log(xhr.responseText);
                // alert(status);
                // alert(xhr.responseText);
            }
        });
    }
</script>