<!--<script language="javascript" src="--><?php //echo base_url('public')?><!--/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/scripts/ckeditor/ckeditor.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Sửa gian hàng </h3></div>
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
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">name<span
                            class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="text" id="txtName" name="name" value="<?php echo $res->name ?>"
                           required="required" class="form-control col-md-7 col-xs-12"
                           placeholder="Tiêu đề">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">description<span
                            class="required">*</span></label>
<!--                <div class="col-md-3 col-sm-3 col-xs-12">-->
<!--                    <input type="text" id="txtName" name="descriptions" value="--><?php //echo $res->des ?><!--"-->
<!--                           required="required" class="form-control col-md-7 col-xs-12"-->
<!--                           placeholder="description">-->
<!--                </div>-->

                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea class="form-control" name="descriptions" rows="3" placeholder=""><?php echo $res->des ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">img<span
                            class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php if (isset($res->icon)) { ?>
                        <!--                        <td>--><?php //echo $res->img ?><!--</td>-->
                        <td><img src="<?php echo $res->icon ?>" style="max-width: 80px"> </td>


                    <?php } ?>
                    <input type="file" class="form-control" name="img_banner" id="img_banner">
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 30px">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <input type="submit" id="btnAddbanner" name="btnEdit" required="required"
                           class="btn btn-primary" value="Cập nhật">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <a href="<?php echo admin_url('banner') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
