<?php
$menu_access = $this->session->userdata('menu_access');
// pre($menu_access);
//pre($admin);
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php if ($admin->UserName == 'admin') echo admin_url('ccu') ?>" class="site_title"><i class="fa fa-paw"></i> <span>Trang chủ</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
<!--                <img src="--><?php //echo base_url() ?><!--/public/logo_custom.png" alt="..." class="img-circle profile_img">-->
                <?php if ($admin->link_avatar != '') { ?>
                    <!--                    <img src="--><?php //echo base_url() ?><!--/upload/--><?php //echo $admin->img ?><!--" alt="..." class="img-circle profile_img">-->
<!--                    <img src="--><?php //echo base_url() ?><!--public/images/employee/--><?php //echo $admin->link_avatar ?><!--" alt="..."-->
                    <img src="<?php echo $admin->link_avatar ?>" alt="..."
                         class="img-circle profile_img">
                <?php } else { ?>
                    <img src="<?php echo base_url() ?>/public/icon-user-default.png" alt="..."
                         class="img-circle profile_img">
                <?php } ?>
            </div>
            <div class="profile_info">
                <span>Xin chào,</span>
                <h2><?php echo $admin->UserName ?></h2>
<!--                <a href="--><?php //echo admin_url('home/logout') ?><!--">-->
<!--                    <small class="text-primary">Đăng xuất</small>-->
<!--                </a>-->
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <!--                <h3>Menu</h3>-->
                <ul class="nav side-menu">
                    <!---->
                    <!--                    // $access = $this->menu_access_model->get_column('menu_access', 'access',-->
                    <!--                    // array('employee_id' => $admin->employee_id, 'menu_id' => 1))[0]->access;-->
                    <!--                    --><?php //pre($menu_access) ?>
                    <?php if ($menu_access[1] >= 1 || $menu_access[2] >= 1 || $menu_access[3] >= 1 || $menu_access[4] >= 1 || $menu_access[5] >= 1 || $menu_access[6] >= 1) { ?>
                        <li><a><i class="fa fa-tasks"></i>Tổng hợp<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
<!--                                <li><a href="--><?php //echo admin_url('service_package') ?><!--">Dịch vụ /lắp đặt</a></li>-->
                                <li class="sub_menu current-page-left"><a href="<?php echo admin_url('user') ?>">Đăng ký mới</a></li>
                                <li><a href="<?php echo admin_url('ccu') ?>">CCU</a></li>
                                <li><a href="<?php echo admin_url('dau') ?>">DAU</a></li>
                                <li><a href="<?php echo admin_url('user_active') ?>">KTV Kích hoạt ,khóa</a></li>
                                <li><a href="<?php echo admin_url('allmoney') ?>">Tổng tiền trên Server</a></li>
<!--                                <li><a href="--><?php //echo admin_url('email') ?><!--">email</a></li>-->
<!--                                <li><a href="--><?php //echo admin_url('email_test') ?><!--">email</a></li>-->
<!--                                <li><a href="--><?php //echo admin_url('user_lock') ?><!--">KTV bị khóa</a></li>-->
                                <li><a href="<?php echo admin_url('makers') ?>">Bản đồ khách hàng</a></li>
<!--                                <li><a href="--><?php //echo admin_url('firebase_sending') ?><!--">firebase_sending</a></li>-->

                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[7] >= 1 || $menu_access[8] >= 1 || $menu_access[9] >= 1 || $menu_access[10] >= 1) { ?>

                    <li class=""><a><i class="fa fa-sitemap"></i>Cấu hình<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none;">
                            <li><a href="<?php echo admin_url('config_service') ?>">Cấu hình dịch vụ</a></li>
<!--                            <li class=""><a>Dịch Vụ<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu" style="display: none;">-->
<!--                                    <li class="sub_menu current-page-left"><a href="level2.html">Lắp đặt</a></li>-->
<!--                                    <li class="active"><a href="#level2_1">Cứu hộ</a></li>-->
<!--                                    <li class=""><a href="#level2_2">Sửa chữa</a></li>-->
<!--                                    <li class=""><a href="--><?php //echo admin_url('cf_service') ?><!--">Bảo dưỡng</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
                            <li><a href="<?php echo admin_url('product_config') ?>">Gian hàng</a></li>
                            <li><a href="<?php echo admin_url('reward_point') ?>">Điểm thưởng, server</a></li>
                            <li><a href="<?php echo admin_url('config_payment') ?>">KTV Rút tiền</a></li>
<!--                            <li class=""><a>Gian hàng<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu" style="display: none;">-->
<!--                                    <li class="sub_menu current-page-left"><a href="level3.html">Điện lạnh</a></li>-->
<!--                                    <li class="active"><a href="#level3_11">Điện nước</a></li>-->
<!--                                    <li class=""><a href="#level3_212">Điện tử</a></li>-->
<!--                                    <li class=""><a href="#level3_216">Điện máy</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                            <li class=""><a>Điểm thưởng khách hàng<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu" style="display: none;">-->
<!--                                    <li class="sub_menu current-page-left"><a href="level21.html">Chia sẻ</a></li>-->
<!--                                    <li class="active"><a href="#level2_11">Sinh nhật</a></li>-->
<!--                                    <li class=""><a href="#level2_21">Tích lũy nạp</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                            <li class=""><a>KTV Rút tiền<span class="fa fa-chevron-down"></span></a>-->
<!--                                <ul class="nav child_menu" style="display: none;">-->
<!--                                    <li class="sub_menu current-page-left"><a href="level211.html">Thu nhập KTV</a></li>-->
<!--                                    <li class="active"><a href="#level2_111">Thưởng bonus</a></li>-->
<!--                                    <li class=""><a href="#level2_211">Giới thiệu khách hàng</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
                        </ul>
                    </li>
                    <?php } ?>

                    <?php if ($menu_access[13] >= 1 || $menu_access[14] >= 1 || $menu_access[15] >= 1|| $menu_access[16] >= 1|| $menu_access[17] >= 1|| $menu_access[18] >= 1|| $menu_access[19] >= 1|| $menu_access[20] >= 1|| $menu_access[22] >= 1|| $menu_access[23] >= 1|| $menu_access[24] >= 1|| $menu_access[25] >= 1|| $menu_access[26] >= 1|| $menu_access[27] >= 1|| $menu_access[28] >= 1) { ?>
                        <li><a><i class="fa fa-diamond"></i>Quản trị<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none;">
                                <li class=""><a>Thông tin<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none;">
                                        <li class="sub_menu current-page-left"><a href="<?php echo admin_url('notifications') ?>">Thông báo hệ thống</a></li>
                                        <li class="sub_menu current-page-left"><a href="<?php echo admin_url('alert') ?>">Loa thông báo</a></li>
                                        <li class="active"><a href="<?php echo admin_url('intro_service') ?>">Giới thiệu về chúng tôi</a></li>
                                        <li class=""><a href="<?php echo admin_url('info_service') ?>">Thông tin dịch vụ</a></li>
                                        <li class=""><a href="<?php echo admin_url('service_details') ?>">Thông tin chi tiết gói dịch vụ</a></li>
                                        <li class=""><a href="<?php echo admin_url('policy') ?>">Điều khoản sử dụng</a></li>
                                        <li class=""><a href="<?php echo admin_url('hotline') ?>">Hotline</a></li>
                                        <li class=""><a href="<?php echo admin_url('service_package') ?>">quyền lợi khách hàng</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo admin_url('agency') ?>">Đại lý</a></li>
<!--                                <li class=""><a>Đại lý<span class="fa fa-chevron-down"></span></a>-->
<!--                                    <ul class="nav child_menu" style="display: none;">-->
<!--                                        <li class="sub_menu current-page-left"><a href="--><?php //echo admin_url('agency') ?><!--">Đại lý</a></li>-->
<!--<!--                                        <li class="active"><a href="--><?php ////echo admin_url('city') ?><!--<!--">Danh sách thành phố</a></li>-->
<!--<!--                                        <li class=""><a href="#level5_212">Miền Trung</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
                                <li class=""><a>Tài khoản<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none;">
<!--                                        --><?php //if ($admin->UserName == 'admin') { ?>
                                        <?php if ($menu_access[22] >= 1 ) { ?>
                                        <li class="active"><a href="<?php echo admin_url('admin') ?>">Tài khoản CMS</a></li>
                                        <?php } ?>
                                        <?php if ($admin->UserName == 'admin') { ?>
                                        <li class="active"><a href="<?php echo admin_url('menu') ?>">Danh sách menu</a></li>
                                        <?php } ?>
                                        <li class=""><a href="<?php echo admin_url('collaborator_register') ?>">Ctv ứng tuyển</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo admin_url('technician_jobs') ?>">Công việc KTV</a></li>
                                <li><a href="<?php echo admin_url('newsxxxx') ?>">Đối tác ( KTV bên ngoài)</a></li>
                                <li><a href="<?php echo admin_url('firebase') ?>">Push thông báo</a></li>
                                <li><a href="<?php echo admin_url('add_money') ?>">Cộng/ trừ tiền</a></li>
                                <li><a href="<?php echo admin_url('add_money_logs') ?>">Thống kê cộng tiền</a></li>
                                <li><a href="<?php echo admin_url('chat_realtime') ?>">Chat khách hàng</a></li>
                                <li><a href="<?php echo admin_url('banner') ?>">Tạo ảnh banner</a></li>
                                <li><a href="<?php echo admin_url('general_customers') ?>">Tài khoản khách hàng</a></li>

                                <li><a href="<?php echo admin_url('gift_code') ?>">Mã voucher</a></li>
                                <li><a href="<?php echo admin_url('bcth_cv') ?>">Báo cáo tổng hợp công việc</a></li>
                                <li><a href="<?php echo admin_url('bcc_tonghop') ?>">Bảng chấm công tổng hợp</a></li>
                                <li><a href="<?php echo admin_url('bcc_chitiet') ?>">Bảng chấm công chi tiết</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($menu_access[33] >= 1 || $menu_access[34] >= 1 || $menu_access[31] >= 1|| $menu_access[32] >= 1) { ?>

                    <li><a><i class="fa fa-diamond"></i>CSKH<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none;">
                            <li><a href="<?php echo admin_url('transaction_history') ?>">Thống kê giao dịch của khách hàng</a></li>
                            <li><a href="<?php echo admin_url('info_search') ?>">Thông tin khách hàng</a></li>
                            <li><a href="<?php echo admin_url('admin_require_payment') ?>">TK yêu cầu rút tiền của KTV</a></li>
                            <li><a href="<?php echo admin_url('question') ?>">Câu hỏi thường gặp</a></li>
                        </ul>
                    </li>

                    <?php } ?>

                    <?php if ($menu_access[47] >= 1 || $menu_access[48] >= 1|| $menu_access[49] >= 1|| $menu_access[50] >= 1|| $menu_access[51] >= 1|| $menu_access[52] >= 1|| $menu_access[53] >= 1|| $menu_access[54] >= 1) { ?>
                        <li><a><i class="fa fa-bar-chart" aria-hidden="true"></i>Thống kê<span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="<?php echo admin_url('news12') ?>">Thống kê người dùng</a></li>
                                <li><a href="<?php echo admin_url('news236') ?>">Thống kê KTV</a></li>
                                <li><a href="<?php echo admin_url('contract') ?>">Thống kê Hợp đồng</a></li>
                                <li class=""><a>Thống kê doanh thu<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none;">
                                        <li class="sub_menu current-page-left"><a href="level6xx.html">Doanh thu thuê bao</a></li>
                                        <li class="active"><a href="#level6_11xxxxxxx">Doanh thu cứu hộ/lắp đặt</a></li>
                                        <li class=""><a href="#4444t">Doanh thu shop</a></li>
                                        <li class=""><a href="#44ggg">Doanh thu nạp tiền</a></li>
                                        <li class=""><a href="#666667">Chi phí quà tặng</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[35] >= 1 || $menu_access[36] >= 1) { ?>
                        <li><a><i class="fa fa-cog"></i>Công việc<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
<!--                                --><?php //if ($menu_access[19] >= 1) { ?>
<!--                                    <li><a href="--><?php //echo admin_url('companyxxxxxx') ?><!--">Khu vực </a></li>-->
<!--                                --><?php //} ?>
<!--                                --><?php //if ($menu_access[20] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('admin_mission') ?>">Thời gian hẹn khách hàng</a></li>
                                    <li><a href="<?php echo admin_url('admin_emergency') ?>">Giao việc cứu hộ khẩn cấp</a></li>
                                    <li><a href="<?php echo admin_url('rating_jobs') ?>">Công việc - khách hàng đánh giá</a></li>
                                    <li><a href="<?php echo admin_url('regular_appointments') ?>">Lịch hẹn định kỳ KH</a></li>
<!--                                --><?php //} ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <?php if ($menu_access[37] >= 1 || $menu_access[38] >= 1 || $menu_access[39] >= 1 || $menu_access[40] >= 1) { ?>
                        <li><a><i class="fa fa-anchor" aria-hidden="true"></i>Gian hàng<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
<!--                                --><?php //if ($menu_access[19] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('product') ?>">Gian hàng chung</a></li>
<!--                                --><?php //} ?>
<!--                                --><?php //if ($menu_access[20] >= 1) { ?>
                                    <li><a href="<?php echo admin_url('shop') ?>">Quản lý shop</a></li>
<!--                                --><?php //} ?>
                                <?php
//                                if ($admin->employee_id == 141189 || $admin->employee_id == 141188) { ?>
                                    <li><a href="<?php echo admin_url('product_type') ?>">Quản lý loại sản phẩm</a></li>
                                    <li><a href="<?php echo admin_url('log_payment_cart_user') ?>">Yêu cầu mua đơn hàng </a></li>
<!--                                --><?php //} ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($menu_access[41] >= 1 || $menu_access[42] >= 1 || $menu_access[43] >= 1 || $menu_access[44] >= 1|| $menu_access[45] >= 1|| $menu_access[46] >= 1) { ?>

                    <li><a><i class="fa fa-anchor" aria-hidden="true"></i>Kinh doanh<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo admin_url('doanhthu') ?>">Doanh thu</a></li>
                            <li><a href="<?php echo admin_url('doanhthu_contract') ?>">Doanh thu từ ký hợp đồng</a></li>
                            <li><a href="<?php echo admin_url('doanhthu_paycards') ?>">Doanh thu thẻ nạp</a></li>
                            <li><a href="<?php echo admin_url('doanhthu_bank') ?>">Doanh thu bank</a></li>
                            <li><a href="<?php echo admin_url('kinhdoanh') ?>">Kinh doanh</a></li>
                            <li><a href="<?php echo admin_url('banner_kd') ?>">Banner, quà tặng</a></li>
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