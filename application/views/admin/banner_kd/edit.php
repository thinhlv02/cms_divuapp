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


                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tiêu đề<span class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <input type="text" id="" name="title" required="required" value="<?php echo $res->title ?>"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Mô tả<span class="required">*</span></label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea name="description" class="form-control" rows="10" placeholder=""><?php echo $res->description ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-2 col-xs-12" for="first-name">Ảnh minh họa<span
                            class="required">*</span></label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php if (isset($res->link_icon)) { ?>
                        <td><img src="<?php echo $res->link_icon ?>" style="max-width: 200px"> </td>
                    <?php } ?>
                    <input type="file" class="form-control" name="img_banner" id="img_banner">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Bắt đầu<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtFrom" name="date1" required
                           value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])); else echo date('d-m-Y', strtotime($res -> time_event_start))?>"
                           class="form-control col-md-7 col-xs-12" />
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Kết thúc<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtTo" name="date2" required
                           value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ; else echo date('d-m-Y', strtotime($res -> time_event_stop)) ?>"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>
<!--            <div class="form-group">-->
<!--<!--                --><?php ////if ($res->type == 1) { ?>
<!---->
<!---->
<!--                <div id="1" class="colors">-->
<!--                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Sản phẩm<span class="required">*</span></label>-->
<!--                    <div class="col-md-2 col-sm-2 col-xs-12">-->
<!--                        <select class="select2_group form-control" name="product_id">-->
<!--                            --><?php
//                            foreach ($product_list as $value) { ?>
<!--                                <option value="--><?php //echo $value->id ?><!--">--><?php //echo $value->name ?><!--</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!--                    </div>-->
<!---->
<!--                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Số lượng<span class="required">*</span></label>-->
<!--                    <div class="col-md-3 col-sm-3 col-xs-12">-->
<!--                        <input type="number" id="" name="number"-->
<!--                               class="form-control col-md-7 col-xs-12" placeholder="">-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--<!--                --><?php ////} ?>
<!---->
<!--<!--                --><?php ////if ($res->type == 2) { ?>
<!---->
<!--                <div id="2" class="colors" style="">-->
<!--                    <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Gói dịch vụ<span class="required">*</span></label>-->
<!--                    <div class="col-md-4 col-sm-4 col-xs-12">-->
<!--                        <select class="select2_group form-control" name="service_package_id">-->
<!--                            --><?php
//                            foreach ($service_list as $value) { ?>
<!--                                <option value="--><?php //echo $value->id ?><!--">--><?php //echo $value->name ?><!--</option>-->
<!--                            --><?php //} ?>
<!--                        </select>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--<!--                --><?php ////} ?>
<!--            </div>-->
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
                    <input type="submit" id="btnAddbanner" name="btnEdit" required="required"
                           class="btn btn-primary" value="Cập nhật">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <a href="<?php echo admin_url('banner_kd') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </form>
    </div>
</div>
