<!--<script language="javascript" src="--><?php //echo base_url('public')?><!--/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/scripts/ckeditor/ckeditor.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Sửa</h3></div>
    <div class="title_right">
        <!--        <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
        <!--            <a href="-->
        <?php //echo admin_url('admin/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
        <!--            <a href="-->
        <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        <!--        </div>-->
    </div>
</div>
<div class="x_panel">
    <!--    <div class="x_title">-->
    <!--        <h2>Chỉnh sửa Bảng tin</h2>-->
    <!--        <ul class="nav navbar-right panel_toolbox">-->
    <!--            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>-->
    <!--            <li class="dropdown">-->
    <!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i-->
    <!--                            class="fa fa-wrench"></i></a>-->
    <!--                <ul class="dropdown-menu" role="menu">-->
    <!--                    <li><a href="#">Settings 1</a>-->
    <!--                    </li>-->
    <!--                    <li><a href="#">Settings 2</a>-->
    <!--                    </li>-->
    <!--                </ul>-->
    <!--            </li>-->
    <!--            <li><a class="close-link"><i class="fa fa-close"></i></a></li>-->
    <!--        </ul>-->
    <!--        <div class="clearfix"></div>-->
    <!--    </div>-->
    <div class="x_content">
        <!--        <div class="row" style="margin-top: 40px">-->
        <form id="formAddCatalog" data-parsley-validate class="form-horizontal form-label-left" method="post"
              enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên<span
                            class="required">*</span></label>
                <div class="col-md-11 col-sm-11 col-xs-12">
                    <input type="text" id="txtName" name="name" value="<?php echo $news2->name ?>"
                           required="required" class="form-control col-md-7 col-xs-12"
                           placeholder="Tiêu đề">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Giá<span
                            class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="number" id="txtName" name="price" value="<?php echo $news2->price ?>"
                           class="form-control col-md-7 col-xs-12"
                           placeholder="Giới thiệu">
                </div>

                 <label class="control-label col-md-3 col-sm-3 col-xs-12 white-space" for="first-name">Số lần khách chủ động đặt lịch<span
                            class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="number" id="txtName" name="number_maintenance" value="<?php echo $news2->number_maintenance ?>"
                           class="form-control col-md-7 col-xs-12"
                           placeholder="number_maintenance">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Mô tả <span
                            class="required">*</span></label>
                <div class="col-md-11 col-sm-11 col-xs-12">
                    <!--                        <div style="margin: 10px 0px">Tiếng Việt</div>-->
                    <textarea name="des" class="form-control"
                              style="height: 120px"><?php echo $news2->des ?></textarea>
                    <script type="text/javascript">CKEDITOR.replace('des', {height: '150px'}); </script>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Lợi ích <span
                            class="required">*</span></label>
                <div class="col-md-11 col-sm-11 col-xs-12">
                    <!--                        <div style="margin: 10px 0px">Tiếng Việt</div>-->
                    <textarea name="benefit" class="form-control"
                              style="height: 120px"><?php echo $news2->benefit ?></textarea>
                    <script type="text/javascript">CKEDITOR.replace('benefit', {height: '150px'}); </script>
                </div>
            </div>
<!--            <div class="form-group">-->
<!--                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Link<span-->
<!--                            class="required">*</span></label>-->
<!--                <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                    <input type="text" id="" name="link" value="--><?php //echo $news2->link ?><!--"-->
<!--                           class="form-control col-md-7 col-xs-12"-->
<!--                           placeholder="Link">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="form-group">-->
<!--                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">File<span-->
<!--                            class="required">*</span></label>-->
<!--                <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                    --><?php //if (isset($news2->img)) { ?>
<!--                        <td>--><?php //echo $news2->img ?><!--</td>-->
<!---->
<!--                    --><?php //} ?>
<!--                    <input type="file" class="form-control" name="img_news2" id="img_news2">-->
<!--                </div>-->
<!--            </div>-->

            <div class="form-group" style="margin-top: 30px">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <input type="submit" id="btnAddProduct" name="btnEdit" required="required"
                           class="btn btn-primary" value="Cập nhật">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <a href="<?php echo admin_url('service_package') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
