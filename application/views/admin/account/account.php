<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<div class="page-title">
    <div class="title_left"><h3>Tài khoản của bạn</h3></div>
    <!--	<div class="title_right">-->
    <!--		<div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
    <!--			<a href="-->
    <?php //echo admin_url('account/add')?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--			<a href="--><?php //echo admin_url('account')?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
    <!--		</div>-->
    <!--	</div>-->
</div>
<div class="x_panel">
    <!--	<div class="x_title">-->
    <!--		<h2>Danh sách sự kiện</h2>-->
    <!--		<ul class="nav navbar-right panel_toolbox">-->
    <!--	        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>-->
    <!--	        <li class="dropdown">-->
    <!--	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>-->
    <!--	          <ul class="dropdown-menu" role="menu">-->
    <!--	            <li><a href="#">Settings 1</a>-->
    <!--	            </li>-->
    <!--	            <li><a href="#">Settings 2</a>-->
    <!--	            </li>-->
    <!--	          </ul>-->
    <!--	        </li>-->
    <!--	        <li><a class="close-link"><i class="fa fa-close"></i></a></li>-->
    <!--	    </ul>-->
    <!--	    <div class="clearfix"></div>-->
    <!--	</div>-->
    <div class="x_content">
        <table id="datatable-product" class="table table-striped table-bordered bulk_action">
            <thead>
            <tr>
                <th>Avatar</th>
                <th>Tên đăng nhập</th>
                <th>Tên nhân sự</th>
                <th>Hành động</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($account as $key => $value): ?>
                <tr>
                    <td>
                        <?php if ($value->img != ''){ ?>
                        <img src="<?php echo base_url() ?>public/images/employee/<?php echo $value->img ?>" width="80px"></td>
                    <?php } else { ?>
                        <img src="<?php echo base_url('public/') . 'icon-user-default.png' ?>" width="80px"></td>
                    <?php } ?>

                    <td><?php echo $value->UserName ?></td>
                    <td><?php echo $value->employee_name ?></td>
                    <td>
                        <a href="<?php echo admin_url('account/edit/') . $value->id ?>" class="btn btn-info btn-xs">Thay
                            avatar và tên đăng nhập</a>
                        <a href="<?php echo admin_url('account/edit/') . $value->id. 'pw' ?>" class="btn btn-warning btn-xs">Thay mật khẩu</a>
                    </td>
                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>


<style type="text/css">
    td, th {
        vertical-align: middle !important;
        text-align: center;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }
</style>
<script type="text/javascript">
    function confirm_del_account(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa sự kiện này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('account/del/')?>" + id;
        }
    }
</script>
