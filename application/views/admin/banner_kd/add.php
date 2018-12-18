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
    <!--            --><?php ////echo admin_url('banner/add')?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="--><?php //echo admin_url('banner') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
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
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Loại<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control" name="type" id="colorselector">
                        <option value="1">Vật tư</option>
                        <option value="2">Gói DV</option>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tiêu đề<span class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="text" id="" name="title" required="required"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Mô tả<span class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <textarea name="description" class="form-control" rows="1" placeholder=""></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Ảnh minh họa<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="file" class="form-control" name="img_banner" id="img_banner">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Bắt đầu<span
                            class="required"></span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="text" id="txtFrom" name="date1" required
                           value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                           class="form-control col-md-7 col-xs-12" />
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Kết thúc<span
                            class="required"></span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="text" id="txtTo" name="date2" required
                           value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <div id="1" class="colors">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Sản phẩm<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <select class="select2_group form-control" name="product_id">
                        <?php
                        foreach ($product_list as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Số lượng<span class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="number" id="" name="number"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>
                </div>

                <div id="2" class="colors" style="display: none">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Gói dịch vụ<span class="required">*</span></label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <select class="select2_group form-control" name="service_package_id">
                        <?php
                        foreach ($service_list as $value) { ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                        <?php } ?>
                    </select>
                </div>
                </div>
            </div>
            <script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
            <script>
                $(function() {
                    $('#colorselector').change(function(){
                        $('.colors').hide();
                        $('#' + $(this).val()).show();
                    });
                });
            </script>

            <div class="form-group" style="margin-top: 30px">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <input type="submit" id="btnAddbanner" name="btnAdd" required="required" class="btn btn-primary"
                           value="Thêm">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <a href="<?php echo admin_url('banner_kd') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </form>
        <!--        </div>-->
    </div>
</div>