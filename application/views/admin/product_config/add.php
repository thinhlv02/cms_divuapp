<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
} ?>
<!--<script language="javascript" src="--><?php //echo base_url('public')?><!--/ckeditor/ckeditor.js" type="text/javascript"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/scripts/ckeditor/ckeditor.js"></script>
<div class="page-title">
    <div class="title_left"><h3>Thêm mới</h3></div>
    <!--    <div class="title_right">-->
    <!--        <div class="col-md-9 col-sm-9 col-xs-12 pull-right">-->
    <!--            <!--            <a href="-->
    <!--            --><?php ////echo admin_url('product/add')?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="--><?php //echo admin_url('product') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
    <!--        </div>-->
    <!--    </div>-->
</div>
<div class="x_panel">
    <!--    <div class="x_title">-->
    <!--        <h2>Thêm Bảng tin mới</h2>-->
    <!--        <ul class="nav navbar-right panel_toolbox">-->
    <!--            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>-->
    <!--            <li class="dropdown">-->
    <!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>-->
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
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tên SP<span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" id="txtName" name="txtName" required="required"
                           class="form-control col-md-7 col-xs-12" placeholder="Tên">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Tên cửa hàng<span
                            class="required"></span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <select class="select2_group form-control" name="shop_id">
                        <?php
                        foreach ($shop as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Giá tiền<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="txtName" name="price" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="Giá tiền">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Ảnh minh họa<span
                            class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="file" class="form-control" name="img_product" id="img_product">
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-1 text-nowrap" for="first-name">Loại sản phẩm<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control" name="type">
                        <?php
                        foreach ($product_type as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">SL<span class="required">*</span></label>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <input type="number" id="" name="number" required="required"
                           class="form-control col-md-7 col-xs-12" placeholder="SL">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Giảm giá<span
                            class="required">*</span></label>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <input type="number" id="" name="sale" value="0"
                           required="required" class="form-control col-md-7 col-xs-12"
                           placeholder="nhập số" min="0" max="100">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Thông tin<span
                            class="required">*</span></label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                                            <div style="margin: 10px 0px">Tiếng Việt</div>
                    <textarea name="txtContent" class="form-control" style="height: 120px"></textarea>
                    <script type="text/javascript">CKEDITOR.replace('txtContent', {height: '300px'}); </script>
                </div>
                <div class="col-md-8 col-sm-8 col-xs-12">
                </div>
            </div>
<!--            <div class="form-group">-->
<!--                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Link<span-->
<!--                            class="required">*</span></label>-->
<!--                <div class="col-md-8 col-sm-8 col-xs-12">-->
<!--                    <input type="text" id="txtName" name="link"-->
<!--                           class="form-control col-md-7 col-xs-12" placeholder="nhập link">-->
<!--                </div>-->
<!--            </div>-->


            <div class="form-group" style="margin-top: 30px">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <input type="submit" id="btnAddProduct" name="btnAdd" required="required" class="btn btn-primary"
                           value="Thêm">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <a href="<?php echo admin_url('Product') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>

        </form>
        <!--        </div>-->
    </div>
</div>