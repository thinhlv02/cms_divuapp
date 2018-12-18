<?php $menu_access = $this->session->userdata('menu_access'); ?>
<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left">
        <h3>Gói: <?php echo explode('.',$this->uri->segment(4))[0] ?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-12 col-sm-12 col-xs-12 pull-right">
        </div>
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="text text-danger">Lịch hẹn chi tiết</h2>
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
                        <th class="">Thời gian</th>
                        <th class="">KTV thực hiện</th>
                        <th class="">Thời gian hoàn thành</th>
                        <th class="">đánh giá về thời gian</th>
                        <th class="">đánh giá về thái độ phục vụ</th>
                        <th class="">đánh giá về chuyên môn</th>
                        <th class="">mô tả thêm (nôi dung text mà khách viết)</th>
                        <th class="">thưởng cho ktv</th>
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
                            <td class="text-nowrap"><?php echo date('d-m-Y H:i:s',$value2->time) ?></td>
                            <td class="text-nowrap"><?php echo $value2->fullname ?></td>
                            <td class="text-nowrap"><?php echo date('d-m-Y H:i:s', substr($value2->time_end,'0','10')) ?></td>
                            <?php
                            $sao_0 =$sao_1=$sao_2= '';
                            if ($value2->so_sao != NULL) {
                                $tags = explode(',',$value2->so_sao);
                                if (isset($tags[0])){
                                    $sao_0 = $tags[0];
                                }
                                if (isset($tags[1])){
                                    $sao_1 = $tags[1];
                                }
                                if (isset($tags[2])){
                                    $sao_2 = $tags[2];
                                }
//                                $sao_tb_ = $sao_tb/sizeof($tags);
//                                echo $sao_tb_;
                            }
                            ?>
                            <td class="text-nowrap"><?php echo $sao_0 ?></td>
                            <td class="text-nowrap"><?php echo $sao_1 ?></td>
                            <td class="text-nowrap"><?php echo $sao_2 ?></td>
                            <td class="text-nowrap"><?php echo $value2->khach_hang_danh_gia ?></td>
                            <td class="text-nowrap"><?php echo number_format($value2->bonus_ktv) ?></td>
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