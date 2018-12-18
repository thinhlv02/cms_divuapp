<!--<script language="javascript" src="--><?php //echo base_url('public')?><!--/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/scripts/ckeditor/ckeditor.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Trang sửa</h3></div>
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
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tiêu đề<span
                            class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" id="txtName" name="txtName" value="<?php echo $res->title ?>"
                           required="required" class="form-control col-md-7 col-xs-12"
                           placeholder="Tiêu đề">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12">Giới thiệu<span class="required">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea class="form-control" name="intro" rows="3" placeholder=""><?php echo $res->intro ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Nội dung <span
                            class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <!--                        <div style="margin: 10px 0px">Tiếng Việt</div>-->
                    <textarea name="txtContent" class="form-control"
                              style="height: 120px"><?php echo $res->content ?></textarea>
                    <script type="text/javascript">CKEDITOR.replace('txtContent', {height: '300px'}); </script>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Ảnh<span
                            class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php if (isset($res->img)) { ?>
                        <td><img src="<?php echo $res->img ?>" style="max-width: 80px"> </td>
                    <?php } ?>
                    <input type="file" class="form-control" name="img_product" id="img_product">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">KH/KTV<span class="required">*</span></label>

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <select class="form-control" name="type">
                        <option value="1" <?php if ($res->type ==1) echo 'selected' ?>>Khách hàng</option>
                        <option value="8" <?php if ($res->type ==8) echo 'selected' ?>>KTV</option>
                    </select>
                </div>
            </div>
<!--            <div class="form-group">-->
<!--                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Link<span-->
<!--                            class="required">*</span></label>-->
<!--                <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                    <input type="text" id="" name="link" value="--><?php //echo $res->link ?><!--"-->
<!--                           class="form-control col-md-7 col-xs-12"-->
<!--                           placeholder="Link">-->
<!--                </div>-->
<!--            </div>-->

            <div class="form-group" style="margin-top: 30px">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <input type="submit" id="btnAddProduct" name="btnEdit" required="required"
                           class="btn btn-primary" value="Cập nhật">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <a href="<?php echo admin_url('notifications') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
