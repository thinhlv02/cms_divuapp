<?php $menu_access = $this->session->userdata('menu_access');
//pre($menu_access);
?>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>
<!--<div class="page-title">-->
<!--</div>-->
<!--<div class="x_panel padding0">-->
<div class="row">
    <div class="x_title">
        <h2><span style="font-size: 30px;color: #73879C;">Dashboard</span> Bàn làm việc </h2>
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
        <div class="clearfix"></div>
    </div>
    <!--    <div class="x_panel x_title_custom">-->
    <!---->
    <!--        <div class="col-md-3 col-sm-3 col-xs-6 tile">-->
    <!--            <div style="float: left">-->
    <!--                <i style="font-size: 50px" class="fa fa-wordpress" aria-hidden="true"></i>-->
    <!--                <span>DMS</span>-->
    <!--                <h2>Quản lý tài liệu</h2>-->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--        <div class="col-md-3 col-sm-3 col-xs-6 tile">-->
    <!--            <div style="float: left">-->
    <!--                <i style="font-size: 50px" class="fa fa-desktop" aria-hidden="true"></i>-->
    <!--                <span>AMS</span>-->
    <!--                <h2>Quản lý tài sản</h2>-->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--        <div class="col-md-3 col-sm-3 col-xs-6 tile">-->
    <!--            <div style="float: left">-->
    <!--                <i style="font-size: 50px" class="fa fa-list" aria-hidden="true"></i>-->
    <!--                <span>OMS</span>-->
    <!--                <h2>Quản lý XNK</h2>-->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--        <div class="col-md-3 col-sm-3 col-xs-6 tile">-->
    <!--            <div style="float: left">-->
    <!--                <i style="font-size: 50px" class="fa fa-search" aria-hidden="true"></i>-->
    <!--                <span>ESS</span>-->
    <!--                <h2>Executive Search & Selection</h2>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <div class="col-md-8 col-sm-12 col-xs-12 padding0">
        <div class="col-md-12 col-sm-12 col-xs-12 padding0 x_title_custom">
            <div class="title_left"><h3>
                    <!--                    <i class="fa fa-calendar" style="color: #0073B7" aria-hidden="true"></i>-->
                    <i class="fa fa-bell-o" style="color: #0073B7" aria-hidden="true"></i>
                    Bảng tin</h3></div>
            <div class="x_content">
                <div class="table-responsive">
                    <!--                    <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
                    <table id="" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>Ngày</th>
                            <th>Tiêu đề</th>
                            <th>Đính kèm</th>
                            <th>Xem</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (isset($news2) && count($news2) > 0) foreach ($news2 as $key => $value): ?>
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['employee_id']) && $_GET['employee_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <td><?php echo date('d/m/Y', $value->created) ?></td>
                                <!--                            <td>--><?php //echo $value->title ?><!--</td>-->
                                <td>
                                    <a href="<?php echo admin_url('news2/news2_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?>">
                                        <?php echo $value->title ?></a>
                                </td>
                                <!--                            <td><img src="-->
                                <!--                            -->
                                <?php //echo base_url('public/images/news/' . $value->img) ?><!--" style="max-width: 50px"></td>-->
                                <td>
                                    <a target="_blank"
                                       href="<?php echo base_url('public/images/news/' . $value->img) ?>"><?php echo $value->img ?></a>
                                </td>
                                <!--                            <td><i class="fa fa-eye" style="color: #0073B7" aria-hidden="true"></i></td>-->
                                <td>
                                    <a href="<?php echo admin_url('news2/news2_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?>">
                                        <i class="fa fa-eye" style="color: #0073B7" aria-hidden="true"></i></a>

                                </td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--            <div class="title_left">-->
            <!--                <div class="col-md-6 col-sm-6 col-xs-12 pull-left">-->
            <!--                    --><?php //if ($menu_access[1] == 2) { ?>
            <!--                        <a href="" class="btn btn-green-cyan btn-sm">Đặt phòng họp</a>-->
            <!--                    --><?php //} ?>
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="title_right">-->
            <!--                <div class="col-md-2 col-sm-2 col-xs-12 pull-right">-->
            <!--                    --><?php //if ($menu_access[1] == 2) { ?>
            <!--                        <a href="" class="btn btn-green-cyan btn-sm">Xem tất cả</a>-->
            <!--                    --><?php //} ?>
            <!--                </div>-->
            <!--            </div>-->
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 padding0 x_title_custom">
            <div class="title_left"><h3><i class="fa fa-calendar" style="color: #0073B7" aria-hidden="true"></i>
                    Book phòng họp</h3></div>
            <div class="x_content">
                <div class="table-responsive">
                    <!--                    <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
                    <table id="" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>Ngày</th>
                            <th>Thời gian</th>
                            <th>Phòng họp</th>
                            <th>Tên cuộc họp</th>
                            <th>Phòng ban</th>
                            <th>Xem</th>
                            <!--                    <th>Hành động</th>-->
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['employee_id']) && $_GET['employee_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <td><?php echo date('d/m/Y', strtotime($value->create_time)) ?></td>
                                <td><?php echo date('d/m/Y', strtotime($value->create_time)) ?></td>
                                <td><?php echo $value->create_by ?></td>
                                <td class="white-space" style="color: #5bc0de"><?php echo $value->title ?></td>
                                <td class="white-space"><?php echo 'Nhân sụ nội bộ' ?></td>
                                <td><i class="fa fa-eye" style="color: #0073B7" aria-hidden="true"></i></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="title_left">
                <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
                    <?php if ($menu_access[1] == 2) { ?>
                        <a href="" class="btn btn-green-cyan btn-sm">Đặt phòng họp</a>
                    <?php } ?>
                </div>
            </div>
            <div class="title_right">
                <div class="col-md-2 col-sm-2 col-xs-12 pull-right">
                    <?php if ($menu_access[1] == 2) { ?>
                        <a href="" class="btn btn-green-cyan btn-sm">Xem tất cả</a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 padding0 x_title_custom">
            <div class="title_left"><h3><i class="fa fa-car" style="color: #0073B7" aria-hidden="true"></i>
                    Book xe ô tô</h3></div>
            <div class="x_content">
                <div class="table-responsive">
                    <!--                    <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
                    <table id="" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>Ngày</th>
                            <th>Thời gian</th>
                            <th>Phòng họp</th>
                            <th>Tên cuộc họp</th>
                            <th>Phòng ban</th>
                            <th>Xem</th>
                            <!--                    <th>Hành động</th>-->
                        </tr>
                        </thead>

                        <tbody>
                        <?php if (isset($res) && count($res) > 0) foreach ($res as $key => $value): ?>
                            <tr id="<?php echo $value->id; ?>"
                                class="<?php if (isset($_GET['employee_id']) && $_GET['employee_id'] == $value->id) echo 'bg_thanhly'; ?>">
                                <td><?php echo date('d/m/Y', strtotime($value->create_time)) ?></td>
                                <td><?php echo date('d/m/Y', strtotime($value->create_time)) ?></td>
                                <td><?php echo $value->create_by ?></td>
                                <td class="white-space" style="color: #5bc0de"><?php echo $value->title ?></td>
                                <td class="white-space"><?php echo 'Nhân sụ nội bộ' ?></td>
                                <td><i class="fa fa-eye" style="color: #0073B7" aria-hidden="true"></i></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="title_left">
                <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
                    <?php if ($menu_access[1] == 2) { ?>
                        <a href="" class="btn btn-green-cyan btn-sm">Đặt phòng họp</a>
                    <?php } ?>
                </div>
            </div>
            <div class="title_right">
                <div class="col-md-2 col-sm-2 col-xs-12 pull-right">
                    <?php if ($menu_access[1] == 2) { ?>
                        <a href="" class="btn btn-green-cyan btn-sm">Xem tất cả</a>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 padding0">
            <div class="title_left"><h3><i class="fa fa-file-word-o" style="color: #0073B7" aria-hidden="true"></i>
                    Quy trình tài liệu mới ban hành</h3></div>
            <div class="x_content">
                <div class="table-responsive">
                    <!--                    <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
                    <table id="" class="table table-striped table-bordered bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>STT</th>
                            <th>Mã tài liệu</th>
                            <th>Tiêu đề</th>
                            <th>Mô tả</th>
                            <th>Ngày hiệu lực</th>
<!--                            <th>Chi nhánh</th>-->
<!--                            <th>Phòng ban</th>-->
                            <th>File</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>
                        <?php if (isset($dcm) && count($dcm) > 0) foreach ($dcm as $key => $value): ?>
                            <?php $i++ ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $value->code ?></td>
                                <td><?php echo $value->title ?></td>
                                <td><?php echo $value->intro ?></td>
                                <td><?php echo date('d/m/Y', $value->date); ?></td>
                                <!--                            <td>--><?php //echo $value->company_name ?><!--</td>-->
                                <!--                            <td  class="btn btn-info">-->
                                <?php //echo $value->department_name ?><!--</td>-->
<!--                                <td><span class="label btn-warning">--><?php //echo $value->company_name ?><!--</span></td>-->
<!--                                <td><span class="label btn-info">--><?php //echo $value->department_name ?><!--</span></td>-->
                                <!--                                                <td><img src="-->
                                <!--                            -->
                                <?php //echo base_url('public/images/document/'.$value->img)?><!--" style="max-width: 80px"> </td>-->
                                <td><?php echo $value->img ?></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="title_right">
                <div class="col-md-2 col-sm-2 col-xs-12 pull-right">
                    <?php if ($menu_access[1] == 2) { ?>
                        <a href="" class="btn btn-green-cyan btn-sm">Xem tất cả</a>
                    <?php } ?>
                </div>
            </div>
        </div>


    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="col-md-12 col-sm-12 col-xs-12 padding0">
            <!--            <div class="title_left"><h3><i class="fa fa-calendar" style="color: #F39C12" aria-hidden="true"></i>-->
            <!--                    Tin tức nội bộ</h3></div>-->
            <div class="title_left"><h3><i class="fa fa-calendar" style="color: #0073B7" aria-hidden="true"></i>
                    Tin tức nội bộ</h3></div>
            <!--        --><?php //pre($news) ?>
            <div class="x_content">
                <div class="panel panel-default">
                    <div class="panel-body padding0">
                        <?php $i = 0;
                        if (isset($news) && count($news) > 0) foreach ($news as $key => $value): $i++; ?>
                            <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                                <h5 class="text-uppercase">
                                    <!--                                    <a href="-->
                                    <?php //echo admin_url('news/news_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?><!--">-->
                                    <?php //echo $value->title ?><!--</a>-->
                                    <a href="<?php echo $value->link ?>" target="_blank"><?php echo $value->title ?></a>
                                </h5>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                                <img class="img-responsive padding_top10"
                                     src="<?php echo base_url('public/images/news/') . $value->img ?>"
                                     style="width: 100%">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                                <!--        <a href="-->
                                <?php //echo $content->link_webgame ?><!--" target="_blank" class="btn btn-green-cyan">Chơi game</a>-->
                                <!--                                <h5><a-->
                                <!--                                            href="-->
                                <?php //echo admin_url('news/news_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?><!--">-->
                                <?php //echo $i . '.' . $value->title ?><!--</a>-->
                                <!--                                </h5>-->
                                <!--                                <a href="-->
                                <?php //echo admin_url('news/news_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?><!--">-->
                                <?php //echo $value->title ?><!--</a>-->
                                <!--                                <span style="font-style: italic; color: #666;">Ngày đăng: -->
                                <?php //echo date('d/m/Y', $value->created) ?><!--</span><br/>-->
                                <!--                                <div class="col-md-5 col-sm-12 col-xs-12">-->
                                <!--                                    <img class="img-responsive padding_top10"-->
                                <!--                                         src="-->
                                <?php //echo base_url('public/images/news/') . $value->img ?><!--"-->
                                <!--                                         height="200px">-->
                                <!--                                </div>-->
                                <div class="col-md-12 col-sm-12 col-xs-12 padding0">
                                    <div style="margin-top: 10px"><?php echo substr($value->intro, 0, 500); ?><a
                                                style="color: #247d47;font-weight: bold"
                                                href="<?php echo $value->link ?>" target="_blank">....Chi tiết</a></div>
                                    <!--                                    <a style="color: #247d47;font-weight: bold" href="-->
                                    <?php //echo admin_url('news/news_details/' . create_slug($value->title) . '-' . $value->id . '.html') ?><!--">....Chi tiết</a>-->

                                </div>
                            </div>
                            <!--                            <div style="clear: both; border-bottom: 1px solid #3c763d33"></div>-->
                        <?php endforeach ?>
                        <br/>
                        <div class="col-md-5 col-sm-12 col-xs-12 pull-right">
                            <?php if ($menu_access[1] == 2) { ?>
                                <!--                                <a href="--><?php //echo admin_url('news/news_details') ?><!--"-->
                                <!--                                   class="btn btn-default">Xem tất cả</a>-->
                                <a href="http://vimagholdings.cnv.vn/blogs/tin-noi-bo" target="_blank"
                                   class="btn btn-default">Xem tất cả</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--            <div class="title_right">-->
            <!--                <div class="col-md-6 col-sm-6 col-xs-12 pull-right">-->
            <!--                    --><?php //if ($menu_access[1] == 2) { ?>
            <!--                        <a href="-->
            <?php //echo admin_url('news/news_details') ?><!--" class="btn btn-green-cyan btn-sm">Xem tất cả</a>-->
            <!--                    --><?php //} ?>
            <!--                </div>-->
            <!--            </div>-->
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 padding0">
            <!--            <div class="title_left"><b style="text-transform: uppercase"><i class="fa fa-birthday-cake"-->
            <!--                                                                            style="color: #00A65A"-->
            <!--                                                                            aria-hidden="true"></i>-->
            <!--                    Chúc mừng sinh nhật tháng --><?php //echo date('m/Y') ?><!--</b></div>-->
            <div class="title_left"><h3><i class="fa fa-calendar" style="color: #0073B7" aria-hidden="true"></i>
                    Sinh nhật tháng <?php echo date('m/Y') ?></h3></div>
            <!--        --><?php //pre($news) ?>
            <div class="x_content">
                <div class="panel panel-default">
                    <div class="panel-body padding0">
                        <?php if (isset($birthday) && count($birthday) > 0) foreach ($birthday as $key => $value): ?>
                            <?php
                            $i++;
//                            $employee_info = $this->employee_model->get_info($value);
                            ?>
                            <div class="table22 mgb15">
                                <div class="align-middle">
                                    <?php if ($value->img == null) { ?>
                                        <i class="fa fa-user font60" aria-hidden="true"></i>
                                    <?php } else { ?>
                                        <img src="<?php echo base_url() ?>public/images/employee/<?php echo $value->img ?>"
                                             alt="..."
                                             class="" style="width: 50px;">
                                    <?php } ?>
                                </div>
                                <div class=" align-bottom">
                                    <b class="text-primary font12"><?php echo $value->name ?></b><br/>
                                    <span class="label btn-info btn-sm font10 font_weight0"><?php echo $value->department ?></span>
                                    <span class="font10"><?php echo $value->position ?></span><br/>
                                    <span class="label btn-warning btn-sm font10"
                                          style="font-style: italic; color: #eee;"><?php echo date('d/m/Y', $value->birthday) ?></span>
                                </div>
                            </div>

                            <!--                            <div class="table2">-->
                            <!---->
                            <!---->
                            <!--                                <div class="col-md-3 col-sm-3 col-xs-12 align-middle">-->
                            <!--                                    --><?php //if ($value->img == null) { ?>
                            <!--                                        <i class="fa fa-user font60" aria-hidden="true"></i>-->
                            <!--                                    --><?php //} else { ?>
                            <!--                                        <img src="--><?php //echo base_url() ?><!--public/images/employee/--><?php //echo $value->img ?><!--"-->
                            <!--                                             alt="..."-->
                            <!--                                             class="" style="width: 50px;">-->
                            <!--                                    --><?php //} ?>
                            <!--                                </div>-->
                            <!--                                <div class="col-md-9 col-sm-9 col-xs-12 align-bottom">-->
                            <!--                                    <b class="text-primary font12">--><?php //echo $value->name ?><!--</b><br/>-->
                            <!--                                    <span class="label btn-info btn-sm font10 font_weight0">--><?php //echo $value->department ?><!--</span><br/>-->
                            <!--                                    <span class="font10">--><?php //echo $value->position ?><!--</span><br/>-->
                            <!--                                    <span class="label btn-warning btn-sm font10"-->
                            <!--                                          style="font-style: italic; color: #eee;">--><?php //echo date('d/m/Y', $value->birthday) ?><!--</span>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <!--                                                        <div class="col-md-2 col-sm-2 col-xs-12"></div>-->
                            <div style="clear: both; border-bottom: 1px solid #3c763d33"></div>
                        <?php endforeach ?>
                        <div class="table" style="display: none">
                            <div class="align-middle">
                                Socrates (this should be on top of his head)
                            </div>
                            <div class="align-bottom">
                                <img src="http://www.mrdowling.com/images/701socrates.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 padding0">
            <!--            <div class="title_left"><b style="text-transform: uppercase"><i class="fa fa-calendar"-->
            <!--                                                                            style="color: #F39C12;"-->
            <!--                                                                            aria-hidden="true"></i>-->
            <!--                    Lịch nghỉ phép</b></div>-->

            <div class="title_left"><h3><i class="fa fa-calendar" style="color: #0073B7" aria-hidden="true"></i>
                    Lịch nghỉ phép</h3></div>
            <!--        --><?php //pre($news) ?>
            <div class="x_content">
                <div class="panel panel-default">
                    <div class="panel-body padding0">
                        <?php if (isset($res) && count($res) > 0) foreach ($birthday as $key => $value): ?>
                            <?php
//                            $employee_info = $this->employee_model->get_info($value);
                            ?>
                            <!--                            <div class="col-md-3 col-sm-3 col-xs-12">-->
                            <!--                                --><?php //if ($value->img == null) { ?>
                            <!--                                    <i class="fa fa-user font60" aria-hidden="true"></i>-->
                            <!--                                --><?php //} else { ?>
                            <!--                                    <img src="--><?php //echo base_url() ?><!--public/images/employee/--><?php //echo $value->img ?><!--"-->
                            <!--                                         alt="..."-->
                            <!--                                         class="" style="width: 50px;">-->
                            <!--                                --><?php //} ?>
                            <!--                            </div>-->
                            <!--                            <div class="col-md-9 col-sm-9 col-xs-12">-->
                            <!--                                <b class="text-primary font12">--><?php //echo $value->name ?><!--</b><br/>-->
                            <!--                                <span class="label btn-info btn-sm font10 font_weight0">--><?php //echo $value->department ?><!--</span><br/>-->
                            <!--                                <span class="font10">--><?php //echo $value->position ?><!--</span><br/>-->
                            <!--                                <span class="label btn-warning btn-sm font10"-->
                            <!--                                      style="font-style: italic;">--><?php //echo date('d/m/Y', $value->birthday) . ' -> ' . date('d/m/Y', $value->birthday) ?><!--</span>-->
                            <!--                            </div>-->
                            <!--                            <div class="col-md-2 col-sm-2 col-xs-12"></div>-->
                            <div class="table22 mgb15">
                                <div class="align-middle">
                                    <?php if ($value->img == null) { ?>
                                        <i class="fa fa-user font60" aria-hidden="true"></i>
                                    <?php } else { ?>
                                        <img src="<?php echo base_url() ?>public/images/employee/<?php echo $value->img ?>"
                                             alt="..."
                                             class="" style="width: 50px;">
                                    <?php } ?>
                                </div>
                                <div class=" align-bottom">
                                    <b class="text-primary font12"><?php echo $value->name ?></b><br/>
                                    <span class="label btn-info btn-sm font10 font_weight0"><?php echo $value->department ?></span>
                                    <span class="font10"><?php echo $value->position ?></span><br/>
                                    <span class="label btn-warning btn-sm font10"
                                          style="font-style: italic; color: #eee;"><?php echo date('d/m/Y', $value->birthday) . ' -> ' . date('d/m/Y', $value->birthday) ?></span>
                                </div>
                            </div>
                            <div style="clear: both; border-bottom: 1px solid #3c763d33"></div>
                        <?php endforeach ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12 col-sm-12 col-xs-12 padding0">
            <!--            <div class="title_left"><b style="text-transform: uppercase"><i class="fa fa-user" style="color: #DD4B39"-->
            <!--                                                                            aria-hidden="true"></i>-->
            <!--                    Chào mừng thành viên mới</b></div>-->

            <div class="title_left"><h3><i class="fa fa-calendar" style="color: #0073B7" aria-hidden="true"></i>
                    Thành viên mới</h3></div>
            <!--        --><?php //pre($news) ?>
            <div class="x_content">
                <div class="panel panel-default">
                    <div class="panel-body padding0">
                        <?php if (isset($res) && count($res) > 0) foreach ($users_new as $key => $value): ?>
                            <?php
//                            $employee_info = $this->employee_model->get_info($value);
                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <?php if ($value->img == null) { ?>
                                    <i class="fa fa-user font60" aria-hidden="true"></i>
                                <?php } else { ?>
                                    <img src="<?php echo base_url() ?>public/images/employee/<?php echo $value->img ?>"
                                         alt="..."
                                         class="" style="width: 50px;">
                                <?php } ?>
                            </div>

                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <b class="text-primary font12"><?php echo $value->name ?></b><br/>
                                <span class="label btn-info btn-sm font10 font_weight0"><?php echo $value->department ?></span><br/>
                                <span class="font10"><?php echo $value->position ?></span><br/>
                                <!--                                    <span>Ngày bắt đầu:</span>-->
                                <span class="label btn-warning btn-sm font10"
                                      style="font-style: italic; color: #eee;">
                                    <?php echo date('d/m/Y', $value->ngay_bd) ?></span>
                            </div>
                            <!--                            <div class="col-md-2 col-sm-2 col-xs-12"></div>-->
                            <div style="clear: both; border-bottom: 1px solid #3c763d33"></div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    td {
        vertical-align: middle !important;
    }

    .action a {
        font-size: 22px;
        display: block;
        cursor: pointer;
    }

    h2 {
        white-space: nowrap;
    }

    .table22 {
        display: table !important;
    }

    .align-middle {
        display: table-cell !important;
        vertical-align: middle !important;
        padding: 0 8px !important;
    }

    .align-bottom {
        display: table-cell !important;
        vertical-align: bottom;
    }

</style>
<script type="text/javascript">
    function confirm_del_event(id) {
        var r = confirm("Bạn có chắc chắn muốn xóa nhân sự này?");
        if (r == true) {
            window.location.href = "<?php echo admin_url('employee/del/')?>" + id;
        }
    }
</script>