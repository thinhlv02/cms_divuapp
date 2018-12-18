<?php $menu_access = $this->session->userdata('menu_access');
//pre($menu_access);
//pre($admin->UserName);
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <!--        <div class="navbar nav_title" style="border: 0;">-->
        <!--            <a href="-->
        <?php //echo admin_url('dashboard') ?><!--" class="site_title"><i class="fa fa-paw"></i>-->
        <!--                <span>Trang chủ</span></a>-->
        <!--        </div>-->

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
<!--        <div class="profile clearfix">-->
<!--            <img src="--><?php //echo base_url() ?><!--/public/logo_custom.png" alt=""-->
<!--                 class="img-circle profile_img_logo">-->
<!---->
<!--        </div>-->
        <div class="profile clearfix">
            <div class="profile_pic">
                    <img src="<?php echo base_url() ?>/public/icon-user-default.png" alt="..."
                         class="img-circle profile_img">


            </div>
            <!--            <div class="profile_info">-->
            <!--                <span>Xin chào,</span>-->
            <!--                <h2>--><?php //echo $admin->UserName ?><!--</h2>-->
            <!---->
            <!--            </div>-->
        </div>
        <div class="profile clearfix text-center">
            <!--            --><?php //pre($admin) ?>
            <h2><?php echo $admin->UserName ?></h2>
<!--            <h4>(--><?php //echo $admin->UserName ?><!--)</h4>-->
            <a href="<?php echo admin_url('home/logout') ?>">
                <small class="text-primary">Đăng xuất</small>
            </a>
        </div>
        <!-- /menu profile quick info -->
<!--        <br/>-->
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <!--                <h3>Menu</h3>-->
                <ul class="nav side-menu">
                    <!---->
                    <!--                    // $access = $this->menu_access_model->get_column('menu_access', 'access',-->
                    <!--                    // array('employee_id' => $admin->employee_id, 'menu_id' => 1))[0]->access;-->
                    <!--                    --><?php //pre($menu_access) ?>
                    <?php if ($menu_access[1] >= 1 || $menu_access[2] >= 1 || $menu_access[3] >= 1 || $menu_access[4] >= 1 || $menu_access[5] >= 1 || $menu_access[6] >= 1 || $menu_access[7] >= 1) { ?>
                        <li><a><i class="fa fa-tasks"></i>Tổng hợp<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[1] >= 1) { ?>
                                    <!--                                    <li><a href="--><?php //echo admin_url('dashboard') ?><!--">Bàn làm việc</a></li>-->
                                <?php } ?>
                                <?php if ($menu_access[5] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('service_package') ?>">Dịch vụ /lắp đặt</a></li>
                                <?php } ?>
                                <?php if ($menu_access[2] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('a') ?>">Gian hàng</a></li>
                                <?php } ?>
                                <?php if ($menu_access[3] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('b') ?>">Điểm thưởng</a></li>
                                <?php } ?>
                                <?php if ($menu_access[6] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('e') ?>"> Rút tiền</a></li>
                                <?php } ?>
                                <?php if ($menu_access[4] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('account') ?>">Tài khoản</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[8] >= 1 || $menu_access[9] >= 1 || $menu_access[10] >= 1 || $menu_access[11] >= 1 || $menu_access[12] >= 1 || $menu_access[13] >= 1) { ?>
                        <li><a><i class="fa fa-user"></i>Cấu hình<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[8] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('employee') ?>">Nhân sự</a></li>
                                <?php } ?>
                                <?php if ($menu_access[9] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('f') ?>">Chấm công</a></li>
                                <?php } ?>
                                <?php if ($menu_access[10] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('g') ?>">Quản lý phép</a></li>
                                <?php } ?>
                                <?php if ($menu_access[11] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('h') ?>">Bảng lương</a></li>
                                <?php } ?>
                                <?php if ($menu_access[12] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('i') ?>">Quỹ công đoàn</a></li>
                                <?php } ?>
                                <?php if ($menu_access[13] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('j') ?>">Chính sách,chế độ</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[14] >= 1 || $menu_access[15] >= 1 || $menu_access[16] >= 1 || $menu_access[17] >= 1 || $menu_access[18] >= 1) { ?>
                        <li><a><i class="fa fa-diamond"></i>Quản trị<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[14] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('asset') ?>">Danh mục tài sản</a></li>
                                <?php } ?>
                                <!--                                --><?php //if ($menu_access[11] >= 1) { ?>
                                <!--                                    <li><a href="-->
                                <?php //echo admin_url('employee') ?><!--">In mã vạch</a></li>-->
                                <!--                                --><?php //} ?>
                                <!--                                --><?php //if ($menu_access[12] >= 1) { ?>
                                <!--                                    <li><a href="-->
                                <?php //echo admin_url('employee') ?><!--">Cấp phát - thu hồi</a></li>-->
                                <!--                                --><?php //} ?>
                                <?php if ($menu_access[16] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('Adminmission') ?>">Nhật ký điều chuyển</a></li>
                                <?php } ?>
                                <?php if ($menu_access[15] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('repair_logs') ?>">Nhật ký sửa chữa</a></li>
                                <?php } ?>

                                <?php if ($menu_access[17] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('liquidated_logs') ?>">Nhật ký thanh lý</a></li>
                                <?php } ?>
                                <!--                                --><?php //if ($menu_access[14] >= 1) { ?>
                                <!--                                    <li><a href="-->
                                <?php //echo admin_url('employee') ?><!--">Tài sản mất - hủy</a></li>-->
                                <!--                                --><?php //} ?>
                                <?php if ($menu_access[18] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('report') ?>">Báo cáo</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php
                    if ($admin->employee_id == 141189 || $admin->employee_id == 141188) { ?>
                        <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i>Thống kê<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo admin_url('news') ?>">Tin tức nội bộ</a></li>
                                <li><a href="<?php echo admin_url('news2') ?>">Bảng tin</a></li>
                                <li><a href="<?php echo admin_url('document') ?>">Văn bản nội bộ</a></li>
                                <li><a href="<?php echo admin_url('broom') ?>">Book phòng họp</a></li>
                                <li><a href="<?php echo admin_url('bcar') ?>">Đặt xe</a></li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[19] >= 1 || $menu_access[20] >= 1 || $menu_access[23] >= 1 || $menu_access[22] >= 1 || $menu_access[24] >= 1 || $menu_access[25] >= 1) { ?>
                        <li><a><i class="fa fa-cog"></i>Công việc<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[19] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('company') ?>">Công ty / Chi nhánh</a></li>
                                <?php } ?>
                                <?php if ($menu_access[20] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('department') ?>">Phòng ban</a></li>
                                <?php } ?>
                                <?php
                                if ($admin->employee_id == 141189 || $admin->employee_id == 141188) { ?>
                                    <li><a href="<?php echo admin_url('admin') ?>">Người dùng</a></li>
                                <?php } ?>
                                <li><a href="<?php echo admin_url('asset_rule') ?>">Quy tắc tạo mã tài sản</a></li>
                                <?php if ($menu_access[22] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('Assettype') ?>">Phân loại tài sản</a></li>
                                <?php } ?>
                                <?php if ($menu_access[23] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('asset_status') ?>">Trạng thái tài sản</a></li>
                                <?php } ?>

                                <?php if ($menu_access[24] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('unit') ?>">Đơn vị tính</a></li>
                                <?php } ?>
                                <?php if ($menu_access[25] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('supplier') ?>">Nhà cung cấp</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[19] >= 1 || $menu_access[20] >= 1 || $menu_access[23] >= 1 || $menu_access[22] >= 1 || $menu_access[24] >= 1 || $menu_access[25] >= 1) { ?>
                        <li><a><i class="fa fa-cog"></i>Gian hàng<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <?php if ($menu_access[19] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('company') ?>">Công ty / Chi nhánh</a></li>
                                <?php } ?>
                                <?php if ($menu_access[20] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('department') ?>">Phòng ban</a></li>
                                <?php } ?>
                                <?php
                                if ($admin->employee_id == 141189 || $admin->employee_id == 141188) { ?>
                                    <li><a href="<?php echo admin_url('admin') ?>">Người dùng</a></li>
                                <?php } ?>
                                <li><a href="<?php echo admin_url('asset_rule') ?>">Quy tắc tạo mã tài sản</a></li>
                                <?php if ($menu_access[22] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('Assettype') ?>">Phân loại tài sản</a></li>
                                <?php } ?>
                                <?php if ($menu_access[23] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('asset_status') ?>">Trạng thái tài sản</a></li>
                                <?php } ?>

                                <?php if ($menu_access[24] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('unit') ?>">Đơn vị tính</a></li>
                                <?php } ?>
                                <?php if ($menu_access[25] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('supplier') ?>">Nhà cung cấp</a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>