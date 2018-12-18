<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trang quản lý</title>

    <!-- Bootstrap -->
    <link href="<?php echo admin_theme(''); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo admin_theme(''); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo admin_theme(''); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo admin_theme(''); ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo admin_theme(''); ?>/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <!--                --><?php //if ($message) {
                //                    $this->load->view('admin/message', $this->data);
                //                } ?>
                <form method="post" action="">
<!--                    <img src="../public/logo_login.png" class="img-rounded" alt="Cinque Terre" width="" height="">-->
                    <h1>Quản trị divuapp</h1>
                    <!-- <p><?php //echo validation_errors(); ?><p> -->
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username" required=""/>
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required=""
                               value=""/>
                    </div>
                    <div style="color: red"><?php echo validation_errors(); ?></div>
                    <div>
                        <button type="submit">Đăng nhập</button>
                        <!--                        <a class="reset_pass" href="#">Quên mật khẩu?</a>-->
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>

<style>
    /*.login {*/
    /*!*background: #1abb9c;*!*/
    /*background-image: url('../public/Logo Vimag Holdings 300x300 PNG.png');*/
    /*background-repeat: no-repeat;*/
    /*background-attachment: fixed;*/
    /*background-size: 100% 100%;*/
    /*}*/
    .login_content h1:before, .login_content h1:after {
        display: none;
    }
</style>
