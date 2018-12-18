<div class="x_panel">
    <div class="x_title">
        <h2>Cập nhật thông tin mật khẩu người dùng</h2>
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
    </div>
    <div class="x_content">
        <?php if ($message) {
            $this->load->view('admin/message', $this->data);
        } ?>
        <?php
        $this->load->model('admin_model');
        $employee_info = $this->admin_model->get_info($admin_id);
        ?>
        <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
              enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tên hiển thị <span
                            class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input disabled type="text" id="txtName" name="txtName"
                           value="<?php echo $employee_info->username ?>"
                           required="required" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Mật khẩu <span
                            class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input id="password-field" type="password" class="form-control" name="txtPassword"
                           value="123456">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>


<!--                    <input type="password" id="txtPassword" name="txtPassword" value="123456" required="required"-->
<!--                           class="form-control col-md-7 col-xs-12"><input type="checkbox" onclick="myFunction()">Hiện-->
<!--                    mật khẩu-->
                    <!--                    <small>mật khẩu mặc định là :123456</small>-->
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-2" style="width: 70px">
                    <input type="submit" id="btnUpdateInfo" name="btnUpdateInfo" required="required"
                           class="btn btn-success" value="Cập nhật">
                </div>
            </div>
        </form>
    </div>
</div>