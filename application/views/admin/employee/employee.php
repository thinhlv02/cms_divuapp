<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Danh sách nhân sự (<?php if (isset($res) && $res > 0) echo count($res) ?>)</h3></div>
</div>
<div class="x_panel">
    <form method="post">
<!--        --><?php //pre($menu_access) ?>
        <div class="col-md-3 col-sm-3 col-xs-12 pull-left">
            <?php if ($menu_access[8] == 2) { ?>
                <a href="<?php echo admin_url('employee/add') ?>" class="btn btn-primary btn-sm">Thêm mới</a>
            <?php } ?>
            <input type="submit" name="btnExportData" class="btn btn-primary btn-sm"
                   value="Xuất excel">
            <!--            <a href="-->
            <?php //echo admin_url('asset') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left" id="new-search-area"></div>
    </form>
    <div class="x_content">
        <!--        --><?php //echo $ban; ?>
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <!--        <table id="" class="table table-striped table-bordered bulk_action">-->
            <thead>
            <tr>
                <th>STT</th>
                <th>Mã NV</th>
                <th>Họ tên</th>
                <!--                <th>Nick</th>-->
                <!--                <th>Ngày bắt đầu</th>-->
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Chi nhánh</th>
                <th>Chức vụ</th>
                <th>Điện thoại</th>
                <th>Ảnh</th>
                <!--                <th>CMTND số</th>-->
                <!--                <th>CMTND Ngày cấp</th>-->
                <!--                <th>CMTND cấp tại</th>-->

                <!--                <th>Email</th>-->

                <!--                <th>Đ/c</th>-->
                <th>Hành động</th>
            </tr>

            </thead>

            <tbody>
            <?php $i = 0 ?>
            <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                <?php
                $i++;
                $department = $this->department_model->get_info($value->department_id);
//                $date = '';
//                $start_date_contract = $this->contract_detail_model->contract_start($value->id);
////                pre($start_date_contract[0]->start_contract_date);
//                if ($start_date_contract) {
//                    $date = $start_date_contract[0]->start_contract_date;
//                }
//                pre($department);
                ?>
                <!--                <tr id="--><?php //echo $value->id; if (isset($_GET['employee_id'])) echo 'class="bg-danger"';  ?><!--">-->
                <tr id="<?php echo $value->id; ?>"
                    class="<?php if (isset($_GET['employee_id']) && $_GET['employee_id'] == $value->id) echo 'bg_thanhly'; ?>">
                    <td><?php echo $i ?></td>
                    <td><?php echo $value->maso ?></td>
                    <td><?php echo $value->name ?></td>
                    <!--                    <td>--><?php //echo $value->displayName ?><!--</td>-->
                    <!--                    <td>--><?php //if ($date != '') echo date('d-m-Y', $date); ?><!--</td>-->
                    <td><?php echo date('d/m/Y', $value->birthday) ?></td>
                    <td><?php if ($value->sex == 0) {
                            echo 'Nam';
                        } else {
                            echo 'Nữ';
                        } ?></td>
                    <td><?php if ($department) echo $department->name; ?></td>
                    <td><?php echo $value->position ?></td>
                    <td><?php echo $value->phone ?></td>
                    <td><img src="<?php echo base_url() ?>public/images/employee/<?php echo $value->img ?>" alt="..."
                             class="" style="width: 50px;"></td>
                    <!--                    --><?php //$identity = explode('|', $value->identity_card) ?>
                    <!--                    <td>--><?php //echo $identity[0] ?><!--</td>-->
                    <!--                    <td>--><?php //echo date('d-m-y', $identity[1]) ?><!--</td>-->
                    <!--                    <td>--><?php //echo $identity[2] ?><!--</td>-->
                    <!--                    <td>--><?php //echo $value->email ?><!--</td>-->
                    <!--                    <td>--><?php //echo $value->address ?><!--</td>-->

                    <?php if ($menu_access[1] == 2 && $ban == 0) { ?>
                        <td>
                            <a href="<?php echo admin_url('employee/details/') . $value->id ?>"
                               class="btn btn-primary btn-xs">Chi tiêt</a>
                            <a href="<?php echo admin_url('employee/edit/') . $value->id ?>"
                               class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Sửa</a>
                            <a onclick="confirm_del_event(<?php echo $value->id ?>)"
                               class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Xóa</a>
                        </td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>
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
<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa nhân sự này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('employee/del/')?>" + id;
        }
    }
</script>