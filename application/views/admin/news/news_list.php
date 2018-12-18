<style>
    h5 a {
        color: red !important;
    }
</style>


<div class="page-title">
    <div class="title_left"><h3>Danh sách các bài đăng tin nội bộ(<?php if (isset($news)) echo count($news) ?>)</h3>
    </div>
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
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Giới thiệu</th>
                <th>Nội dung</th>
                <th>Ngày đăng</th>
                <th>Link</th>
                <th>Ảnh</th>
                <th>Chi tiết</th>
            </tr>
            </thead>

            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($news as $key => $value): ?>
                <?php $i++; ?>
                <tr>
                    <td><?php echo $i ?> </td>
                    <td><?php echo $value->title ?></td>
                    <td><?php echo $value->intro ?></td>
                    <td><?php echo $value->content ?></td>
                    <td><?php echo date('d-m-Y', $value->created) ?></td>
                    <td><?php echo $value->link ?></td>
                                        <td><img src="<?php echo base_url('public/images/news/') . $value->img ?>" width="80px"></td>

                    <td>
                        <a href="<?php echo admin_url('news/news_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?>"
                           class="btn btn-warning btn-xs">Xem chi tiết</a>
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
