<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Tài khoản: <?php echo explode('-',$this->uri->segment(4))[0] ?> </h3>
    </div>
    <div class="title_right">
        <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="text text-danger">Gói dịch vụ đang sử  dụng</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>

        <div class="x_content">
<!--            <div class="table-responsive">-->
                <!--                <table class="table table-striped jambo_table bulk_action">-->
                <table id="datatable-product" class="table table-striped table-bordered bulk_action">
                    <thead>
                    <tr class="">
<!--                        <th class="">STT</th>-->
                        <th class="">Tên gói</th>
                        <th class="">Ngày đăng ký</th>
                        <th class="">Lịch hẹn</th>
                        <th class="">Trạng thái</th>
                        <th class="">Chi tiết</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php $i = 0 ?>
                    <?php if (isset($detail) ) foreach ($detail as $key2 => $value2): ?>
                        <?php $i++; ?>
                        <!--                <tr id="--><?php //echo $value2->id; if (isset($_GET['asset_id'])) echo 'class="bg-danger"';  ?><!--">-->
                        <tr id="<?php ?>"
                            class="<?php if (isset($_GET['asset_id']) && $_GET['asset_id'] == $value2->id) echo 'bg_thanhly'; ?>">
<!--                            <td class="text-nowrap">--><?php //echo $i ?><!--</td>-->
                            <td class="text-nowrap"><?php echo $value2->name ?></td>
                            <td class="text-nowrap"><?php echo date('d-m-Y H:i:s',$value2->start_time) ?></td>
                            <td class="text-nowrap"><?php
                                foreach ($value2->service_package_maintenance as $key3 => $value3) {
                                    echo 'lịch hẹn: ' . date('d-m-Y H:i:s', $value3->time). '<br>';
                                }
                                ?></td>
                            <td class="text-nowrap"><?php
                                foreach ($value2->service_package_maintenance as $key3 => $value3) {
                                    echo $value3->name_stt. '<br>';
                                }
                                ?></td>
                            <td>
                                <a class="text-primary" href="<?php echo admin_url('general_customers/general_customers_details2/' . create_slug($value2->name) . '-' . $value2->id . '.html') ?>">
                                    Chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
<!--            </div>-->
        </div>
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

    .pull-right a {
        float: right;
    }

    .pull-right {
        padding-right: 0px !important;
    }

    .disabled {
        pointer-events: none;
        cursor: default;
        opacity: 0.6;
    }
</style>
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>

<script type="text/javascript">
    function confirm_del_event(admin_id, id) {
        var r = confirm("Bạn có chắc chắn muốn xóa ?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('admin_mission/del/')?>" + admin_id + "/" + id;
        }
    }
</script>