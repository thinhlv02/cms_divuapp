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
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên SP<span
                            class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="text" id="txtName" name="txtName" value="<?php echo $res->name ?>"
                           required="required" class="form-control col-md-7 col-xs-12"
                           placeholder="Tiêu đề">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Tên cửa hàng<span
                            class="required"></span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <select class="select2_group form-control" name="shop_id">
                        <?php
                        foreach ($shop as $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php if ($value->id == $res->shop) echo 'selected' ?>><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Giá tiền<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="txtName" name="price" value="<?php echo $res->price ?>"
                           class="form-control col-md-7 col-xs-12" placeholder="Giá tiền">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Ảnh<span
                            class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php if (isset($res->link_icon)) { ?>
                        <!--                        <td>--><?php //echo $res->img ?><!--</td>-->
                        <td><img src="<?php echo $res->link_icon ?>" style="max-width: 80px"> </td>


                    <?php } ?>
                    <input type="file" class="form-control" name="img_product" id="img_product">
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Loại<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control" name="type">
                        <?php
                        foreach ($product_type as $value) { ?>
                            <option value="<?php echo $value->id ?>" <?php if ($value->id == $res->type) echo 'selected' ?>><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">SL<span class="required">*</span></label>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <input type="number" id="" name="number" required="required" value="<?php echo $res->number ?>"
                           class="form-control col-md-7 col-xs-12" placeholder="SL">
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Giảm giá<span
                            class="required">*</span></label>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <input type="number" id="" name="sale" value="<?php echo $res->sale*100 ?>"
                           required="required" class="form-control col-md-7 col-xs-12"
                           placeholder="nhập số" min="0" max="100">
                </div>
            </div>
<!--            <div class="form-group">-->
<!--                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Giới thiệu<span-->
<!--                            class="required">*</span></label>-->
<!--                <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                    <input type="text" id="txtName" name="intro" value="--><?php //echo $res->intro ?><!--"-->
<!--                           class="form-control col-md-7 col-xs-12"-->
<!--                           placeholder="Giới thiệu">-->
<!--                </div>-->
<!--            </div>-->
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Nội dung <span
                            class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div style="margin: 10px 0px">Tiếng Việt</div>
                    <textarea name="txtContent" class="form-control"
                              style="height: 120px"><?php echo $res->descriptions ?></textarea>
                    <script type="text/javascript">CKEDITOR.replace('txtContent', {height: '300px'}); </script>
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
                    <a href="<?php echo admin_url('Product') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
