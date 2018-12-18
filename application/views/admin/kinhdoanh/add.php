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
    <!--            --><?php ////echo admin_url('doanhthu_contract/add')?><!--<!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
    <!--            <a href="--><?php //echo admin_url('doanhthu_contract') ?><!--" class="btn btn-info btn-sm">Danh sách</a>-->
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
                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Ngày<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">

                    <input type="text" id="txtFrom" name="date1" required
                           value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                           class="form-control col-md-7 col-xs-12" />
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tổng doanh thu<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="" name="total" required="required" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">CP quảng cáo<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="" name="cp_quangcao" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Giá vốn<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="" name="gia_von" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Cp văn phòng<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="" name="cp_vanphong" required="required" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">Lương<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="" name="luong" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>
                <label class="control-label col-md-1 col-sm-1 col-xs-12 white-space" for="first-name">CP khác<span
                            class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="" name="cp_khac" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">LN thuần<span class="required">*</span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="number" id="" name="ln_thuan" required="required" value="0"
                           class="form-control col-md-7 col-xs-12" placeholder="">
                </div>
            </div>

            <div class="form-group" style="margin-top: 30px">
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <input type="submit" id="btnAddProduct" name="btnAdd" required="required" class="btn btn-primary"
                           value="Thêm">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-1" style="width: 70px">
                    <a href="<?php echo admin_url('doanhthu_contract') ?>" class="btn btn-primary">Quay lại</a>
                </div>
            </div>
        </form>
        <!--        </div>-->
    </div>
</div>