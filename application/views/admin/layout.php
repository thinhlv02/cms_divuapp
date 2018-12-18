<?php
$menu_access = $this->session->userdata('menu_access');
//                                pre($dropdown_menu);
//?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('admin/head');
    $this->load->view('admin/chat_realtime/process.php');
    ?>
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php $this->load->view('admin/left'); ?>
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <!--                                                <li><a href="-->
                        <!--                        --><?php //echo base_url('admin/home/logout') ?><!--"><i-->
                        <!--                                                                class="fa fa-sign-out pull-right"></i></a></li>-->
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <!--                                                        <img src="-->
                                <!--                        -->
                                <?php //echo base_url() ?><!--/public/icon-user-default.png"-->
                                <!--                                                             alt="">-->
                                <?php if ($admin->link_avatar != '') { ?>
                                    <!--                    <img src="--><?php //echo base_url() ?><!--/upload/--><?php //echo $admin->img ?><!--" alt="..." class="img-circle profile_img">-->
                                    <img src="<?php echo $admin->link_avatar ?>" alt="..." class="">
                                    <!--                                                            <img src="--><?php //echo base_url() ?><!--public/images/employee/--><?php //echo $admin->img ?><!--" alt="..."-->

                                <?php } else { ?>
                                    <img src="<?php echo base_url() ?>/public/icon-user-default.png" alt="..."
                                         class="">
                                <?php } ?>
                                <?php echo $admin->UserName ?>
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <!--                                                        <li><a href="-->
                                <!--                        -->
                                <?php //echo base_url('admin/home/info') ?><!--"> Thông tin cá nhân</a></li>-->
                                <li><a href="
                        <?php echo base_url('admin/home/logout') ?>"><i
                                                class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <?php
                                    if (isset($menu_access[55]) && $menu_access[55] >=1) { ?>
                                <i class="fa fa-envelope-o"></i>
                                <?php } ?>
                                <span id="number_noti" class="badge bg-green"></span>
                            </a>
                            <style>
                                ul#menu1 {
                                    height: 500px;
                                    overflow: scroll;
                                }

                                ul.msg_list li {
                                    border-bottom: 1px solid;
                                }

                                .top_nav .dropdown-menu li a:hover {
                                    background-color: wheat !important;
                                }
                                .text-emergency {
                                    color: #ff9900 !important;
                                }

                            </style>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <?php $i = 0;
                                foreach ($dropdown_menu as $key => $value) {
                                    $date = date('d-m-Y', $value->time);
                                    if ($value->leng == 13) {
                                        $controller = 'admin_emergency';
                                        $des = 'Cứu hộ khẩn cấp: '. $value->des;
                                    } else {
                                        $controller = 'admin_mission';
                                        $des = $value->des;
                                    }
                                    $i++;
                                    ?>
                                    <li>
                                        <a target="_blank"
                                           href="<?php echo admin_url($controller . '?date1=' . $date . '&date2=' . $date . '&asset_id=' . $value->id . '#' . $value->id) ?>">
                                            <span><?php echo $i . ' ) ' . $value->fullname ?></span>
                                            <span class="time"><?php echo date('d-m-Y H:i:s', $value->time) ?></span>
                                            <span class="message <?php if ($value->leng == 13) echo 'text-emergency' ?>" ><?php echo $des ?></span>
                                        </a>
                                    </li>
                                <?php }
                                ?>
                                <li>
                                    <div class="text-center">
                                        <a>
                                            <strong>Ẩn</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <!--                        <li class="margin_left_30" role="presentation" class="dropdown">-->
                        <!--                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"-->
                        <!--                               aria-expanded="false">-->
                        <!--                            </a><i class="fa fa-search" aria-hidden="true"></i>-->
                        <!---->
                        <!--                            <span><a href="http://vimag.sse.net.vn/Main/Login.aspx"-->
                        <!--                                     target="_blank">SSE.ACCOUNTING</a></span></li>-->
                        <!--                        <li class="margin_left_30" role="presentation" class="dropdown">-->
                        <!--                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"-->
                        <!--                               aria-expanded="false">-->
                        <!--                            </a><i class="fa fa-desktop" aria-hidden="true"></i>-->
                        <!---->
                        <!--                            <span><a href="-->
                        <?php //echo admin_url('employee') ?><!--">NHÂN SỰ</a></span></li>-->
                        <!--                        <li class="margin_left_30" role="presentation" class="dropdown">-->
                        <!--                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"-->
                        <!--                               aria-expanded="false">-->
                        <!--                            </a><i class="fa fa-list" aria-hidden="true"></i>-->
                        <!---->
                        <!--                            <span><a href="-->
                        <?php //echo admin_url('asset') ?><!--">TÀI SẢN</a></span></li>-->

                        <!--                        <li class="margin_left_30" role="presentation" class="dropdown">-->
                        <!--                            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown"-->
                        <!--                               aria-expanded="false">-->
                        <!--                            </a><i class="fa fa-wordpress" aria-hidden="true"></i>-->
                        <!---->
                        <!--                            <span><a href="-->
                        <?php //echo admin_url('dashboard') ?><!--">TRANG CHỦ</a></span></li>-->


                        <style>
                            .topnav {
                                overflow: hidden;
                                /*background-color: #333;*/
                            }

                            .topnav a {
                                float: left;
                                display: block;
                                /*color: #f2f2f2;*/
                                text-align: center;
                                padding: 14px 10px;
                                text-decoration: none;
                                /*font-size: 17px;*/
                            }

                            .topnav .icon {
                                display: none;
                            }

                            @media screen and (max-width: 600px) {
                                .topnav a:not(:first-child) {
                                    display: none;
                                }

                                .topnav a.icon {
                                    float: right;
                                    display: block;
                                }
                            }

                            @media screen and (max-width: 600px) {
                                .topnav.responsive {
                                    position: relative;
                                }

                                .topnav.responsive .icon {
                                    position: absolute;
                                    right: 0;
                                    top: 0;
                                }

                                .topnav.responsive a {
                                    float: none;
                                    display: block;
                                    text-align: left;
                                }
                            }
                        </style>

                        <div class="topnav" id="myTopnav">
                            <!--                            <a href="-->
                            <?php //echo admin_url('service_package') ?><!--" class="active text-uppercase font15"><i-->
                            <!--                                        class="fa fa-home" aria-hidden="true"></i> trang chủ</a>-->
                            <!--                            <a class="text-uppercase font15" href="-->
                            <?php //echo admin_url('') ?><!--"><i-->
                            <!--                                        class="fa fa-user" aria-hidden="true"></i> nhân sự</a>-->
                            <!--                            <a class="text-uppercase font15" href="-->
                            <?php //echo admin_url('') ?><!--"><i-->
                            <!--                                        class="fa fa-diamond" aria-hidden="true"></i> tài sản</a>-->
                            <!--                            <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>-->
                            <!--                        </div>-->
                            <!--                        <script>-->
                            <!--                            function myFunction() {-->
                            <!--                                var x = document.getElementById("myTopnav");-->
                            <!--                                if (x.className === "topnav") {-->
                            <!--                                    x.className += " responsive";-->
                            <!--                                } else {-->
                            <!--                                    x.className = "topnav";-->
                            <!--                                }-->
                            <!--                            }-->
                            <!--                        </script>-->
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php $this->load->view($temp) ?>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-left">
        Tel: 0123456789
    </div>
    <div class="pull-right">
        <a href="#" target="_blank">Copyright © ABC Media</a>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
<?php //$this->load->view('admin/js') ?>
<?php $this->load->view('admin/js_admin') ?>
<?php //$this->load->view('admin/js_month_picker') ?>
</body>
</html>
<!--<style>-->
<!--    .margin_left_30 {-->
<!--        /*margin-left: 30px;*/-->
<!--    }-->
<!--</style>-->