<?php if (isset($message)) {
    $this->load->view('admin/message', $this->data);
}
//pre($dau);
?>
<div class="page-title">
    <div class="title_left"><h3>Biểu đồ DAU</h3></div>
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
    <div class="x_title">
        <!--        <h2>Danh sách bài đăng(--><?php //echo count($res) ?><!--)</h2>-->
        <div class="col-md-6 col-sm-6 col-xs-12 pull-left">
<!--            <a href="--><?php //echo admin_url('notifications/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <!--            <a href="-->
            <?php //echo admin_url('admin') ?><!--" class="btn btn-info btn-sm">Quay lại danh sách</a>-->
        </div>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i
                            class="fa fa-wrench"></i></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
        <form method="post">
            <!--        <div class="col-md-2 col-sm-2 col-xs-12">-->
            <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Từ ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtFrom" name="date1" required
                           value="<?php if (isset($_POST['date1'])) echo date('d-m-Y', strtotime($_POST['date1'])) ?>"
                           class="form-control col-md-7 col-xs-12" />
                </div>

                <label class="control-label col-md-1 col-sm-1 col-xs-12 text-nowrap" for="first-name">Đến ngày<span
                            class="required"></span></label>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <input type="text" id="txtTo" name="date2" required
                           value="<?php if (isset($_POST['date2'])) echo date('d-m-Y', strtotime($_POST['date2'])) ?>"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <!--                <div class="ln_solid"></div>-->
            <div class="form-group">
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12 pull-left" id="new-search-area"></div>
                </div>
                <div class="col-xs-1 col-xs-1">
                    <input type="submit" class="btn btn-success btn-sm" name="search" value="Tìm kiếm"/>
                </div>
            </div>

            <!--                <div class="col-xs-1 col-xs-1">-->
            <!--                    --><?php //if (isset($res) && count($res) > 0) { ?>
            <!--                        <input type="submit" id="" name="btn_excel" required-->
            <!--                               class="btn btn-primary btn-sm" value="Xuất excel">-->
            <!--                    --><?php //} ?>
            <!--                </div>-->
        </form>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>

    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Daily Active user',
                align: 'left',
                x: 120,
            },
            xAxis: {
                //categories: ['<?php //echo '14-11' ?>//', '14-11', '14-11', '14-11', '14-11', '14-11', '14-11', '14-11', '14-11', '14-11', '14-11', '14-11', '14-11']
                categories: [
                    <?php
                    //                    foreach ($new_user1 as $value) {
                    //                        echo date('d', strtotime($value)) . ',';
                    //                    }
                    if ($go == 0) {
//                        echo 'ahihi';
//                        die();
//                        foreach ($date as $value) {
                        foreach ($dau as $value) {
//                                echo '"' . date("d", strtotime($value)) . '"' . ',';
                            echo '"' . $value->hour . '"' . ',';
                        }
                    } else {
                        foreach ($dau as $value) {
                            echo '"' . date("d", strtotime($value->date)) . '"' . ',';
//                                echo '"' . $value . '"' . ',';
                        }
                    }
//                    die();
                    ?>
                ]
            },

            yAxis: {
                min: 0,
                title: {
                    text: 'Total user consumption'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -29,
                verticalAlign: 'top',
                y: -5,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                // marginBottom: 500,
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                name: 'Users_ login',
               // data: [3, 4, 4, 2, 5]
                data: [
                    <?php
                    foreach ($dau as $value) {
                        echo $value->user_login . ',';
                    }
                    ?>
                ]
            },
                {
                    name: 'New User',
//                data: [3, 4, 4, 2, 5]
                    data: [
                        <?php
                        foreach ($dau as $value) {
                            echo $value->user_reg . ',';
                        }
                        ?>
                    ]
                },
                {
                    type: 'spline',
                    name: 'DAU',
//                data: [8418, 7672, 7845],
                    data: [
                        <?php
                        foreach ($dau as $value) {
                            echo $value->dau . ',';
                        }
                        ?>
                    ],
                    marker: {
                        lineWidth: 2,
                        lineColor: Highcharts.getOptions().colors[3],
                        fillColor: 'white'
                    }
                },
            ]
        });
    </script>
</div>

<style>
    /*#container {*/
        /*min-width: 310px;*/
        /*max-width: 800px;*/
        /*height: 400px;*/
        /*margin: 0 auto*/
    /*}*/
</style>