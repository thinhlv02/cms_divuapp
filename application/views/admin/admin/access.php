<script language="javascript" src="<?php echo base_url('public') ?>/ckeditor/ckeditor.js"
        type="text/javascript"></script>
<div class="page-title">
    <div class="title_left">
        <h4>Tên đăng nhập : <span style="color: red"><?php echo $access_info->displayName ?></span>
        </h4>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 pull-right">
            <!--            <a href="-->
            <?php //echo admin_url('employee/add') ?><!--" class="btn btn-primary btn-sm">Thêm mới</a>-->
            <a href="<?php echo admin_url('admin') ?>" class="btn btn-info btn-sm">Quay lại danh sách</a>
        </div>
    </div>
</div>
<?php if ($message) {
    $this->load->view('admin/message', $this->data);
} ?>

<div class="x_panel">
    <form id="" data-parsley-validate class="form-horizontal form-label-left" method="post"
          enctype="multipart/form-data">

        <div class="x_title">
            <h2>Danh sách quyền</h2>
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
        </div>
        <div class="x_content">
            <!--            <table id="datatable-product" class="table table-striped table-bordered bulk_action">-->
            <table class="table table-striped table-bordered bulk_action">
                <thead>
                <tr>
                    <!--                    <th>ID</th>-->
                    <th>Stt</th>
                    <th>Chức năng</th>
                    <th class="center">Quyền xem</th>
                    <th class="center">Quyền thêm, sửa</th>
                    <th class="center">Quyền xóa</th>
                </tr>
                </thead>

                <tbody>
                <?php $i = 0;
                //                pre($menu_access);
                ?>
                <?php foreach ($menu_access as $key => $value): ?>
                    <!--                --><?php //echo $key. '->'. $value->menu_id. '<br/>' ?>
                    <?php
                    $i++;
//                $department = $this->department_model->get_info($value->department_id);
//                pre($department);
                    $menu = $this->menu_model->get_info($value->menu_id);
//                    pre($menu);
                    if ($i == 1) {
//                    if (in_array($value->menu_id,array(1,2,3,4,5,6))) {
                        ?>
                        <tr class="cusom_heading" style="">
                            <td colspan="2">Tổng hợp</td>
                            <td class="center"><input type="checkbox" id="checkbox_11"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_21"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_31"/>All</td>
                            <!--                            <p><label><input type="checkbox" id="checkAll"/> Check all</label></p>-->
                        </tr>
                    <?php }
                    if ($i == 7) { ?>
                        <tr class="cusom_heading">
                            <td colspan="2">Cấu hình</td>
                            <td class="center"><input type="checkbox" id="checkbox_12"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_22"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_32"/>All</td>
                        </tr>
                    <?php }
                    if ($i == 11) { ?>
                        <tr class="cusom_heading">
                            <td colspan="2">Quản trị</td>
                            <td class="center"><input type="checkbox" id="checkbox_13"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_23"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_33"/>All</td>
                        </tr>
                    <?php }

                    if ($i == 29) { ?>
                        <tr class="cusom_heading">
                            <td colspan="2">CSKH</td>
                            <td class="center"><input type="checkbox" id="checkbox_14"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_24"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_34"/>All</td>
                        </tr>
                    <?php }

                    if ($i == 33) { ?>
                        <tr class="cusom_heading">
                            <td colspan="2">Công việc</td>
                            <td class="center"><input type="checkbox" id="checkbox_15"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_25"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_35"/>All</td>
                        </tr>
                    <?php }

                    if ($i == 35) { ?>
                        <tr class="cusom_heading">
                            <td colspan="2">Gian hàng</td>
                            <td class="center"><input type="checkbox" id="checkbox_16"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_26"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_36"/>All</td>
                        </tr>
                    <?php }

                    if ($i == 39) { ?>
                        <tr class="cusom_heading">
                            <td colspan="2">Kinh doanh</td>
                            <td class="center"><input type="checkbox" id="checkbox_17"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_27"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_37"/>All</td>
                        </tr>
                    <?php }

                    if ($i == 45) { ?>
                        <tr class="cusom_heading">
                            <td colspan="2">Thống kê</td>
                            <td class="center"><input type="checkbox" id="checkbox_18"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_28"/>All</td>
                            <td class="center"><input type="checkbox" id="checkbox_38"/>All</td>
                        </tr>
                    <?php }

                    ?>
                    <tr>
                        <!--                        <td>--><?php //echo $value->id ?><!--</td>-->
                        <td><?php echo $i ?></td>


                        <td><?php echo $menu->name ?></td>
                        <td class="center"><input class="<?php
                            if ($i >= 1 && $i <= 6) {
                                echo 'checkbox_11';
                            } elseif ($i >= 7 && $i <= 10) {
                                echo 'checkbox_12';
                            } elseif ($i >= 11 && $i <= 28) {
                                echo 'checkbox_13';
                            } elseif ($i >= 29 && $i <= 32) {
                                echo 'checkbox_14';
                            } elseif ($i >= 33 && $i <= 34) {
                                echo 'checkbox_15';
                            } elseif ($i >= 35 && $i <= 38) {
                                echo 'checkbox_16';
                            } elseif ($i >= 39 && $i <= 44) {
                                echo 'checkbox_17';
                            }elseif ($i >= 45 && $i <= 52) {
                                echo 'checkbox_18';
                            } ?>" type="checkbox" name="access[]"
                                                  value="<?php echo $value->id ?>" <?php if ($value->access == 1) echo 'checked' ?>>
                        </td>
                        <td class="center"><input class="<?php if ($i >= 1 && $i <= 6) {
                                echo 'checkbox_21';
                            } elseif ($i >= 7 && $i <= 10) {
                                echo 'checkbox_22';
                            } elseif ($i >= 12 && $i <= 28) {
                                echo 'checkbox_23';
                            } elseif ($i >= 29 && $i <= 32) {
                                echo 'checkbox_24';
                            } elseif ($i >= 33 && $i <= 34) {
                                echo 'checkbox_25';
                            } elseif ($i >= 35 && $i <= 38) {
                                echo 'checkbox_26';
                            } elseif ($i >= 39 && $i <= 44) {
                                echo 'checkbox_27';
                            }elseif ($i >= 45 && $i <= 52) {
                                echo 'checkbox_28';
                            } ?>" type="checkbox" name="access2[]"
                                                  value="<?php echo $value->id ?>" <?php if ($value->access2 == 1) echo 'checked' ?>>
                        </td>
                        <td class="center"><input class="<?php if ($i >= 1 && $i <= 6) {
                                echo 'checkbox_31';
                            } elseif ($i >= 7 && $i <= 10) {
                                echo 'checkbox_32';
                            } elseif ($i >= 12 && $i <= 28) {
                                echo 'checkbox_33';
                            } elseif ($i >= 29 && $i <= 32) {
                                echo 'checkbox_34';
                            } elseif ($i >= 33 && $i <= 34) {
                                echo 'checkbox_35';
                            } elseif ($i >= 35 && $i <= 38) {
                                echo 'checkbox_36';
                            } elseif ($i >= 39 && $i <= 44) {
                                echo 'checkbox_37';
                            }elseif ($i >= 45 && $i <= 52) {
                                echo 'checkbox_38';
                            } ?>" type="checkbox" name="access3[]"
                                                  value="<?php echo $value->id ?>" <?php if ($value->access3 == 1) echo 'checked' ?>>
                        </td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td>Bổ sung Menu</td>
                    <td>chọn menu
                        <select class="" id="mySelect">
                            <?php if (isset($menu_new) && count($menu_new) > 0) foreach ($menu_new as $key33 => $value33): ?>
                                <option value="<?php echo $value33->id ?>"><?php echo $value33->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <?php if (!empty($menu_new)) { ?>
                            <input type="button" class="appliance" value="thêm"/>
                        <?php } ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2" style="width: 70px">
                <input type="submit" id="btnUpdateEvent" name="btnUpdateemployee" required
                       class="btn btn-success" value="Cập nhật">
            </div>
        </div>
    </form>
</div>

<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type=radio][name=changeImg]').change(function () {
            if (this.value == 1) {
                $("#imgChange").html('<input type="file" id="imageEvent" name="imageEvent" value="" required="required" style="padding: 5px;" accept="image/*">');
                $('#pre_img').show();
                $("#img_event").hide();
            }
            else if (this.value == 2) {
                $("#img_event").show();
                $("#imgChange").html('');
                $('#pre_img').hide();
            }
            $("#imageEvent").change(function () {
                readURL(this);
            });
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#pre_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#checkbox_11").change(function () {
        $(".checkbox_11").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_12").change(function () {
        $(".checkbox_12").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_13").change(function () {
        $(".checkbox_13").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_14").change(function () {
        $(".checkbox_14").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_15").change(function () {
        $(".checkbox_15").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_16").change(function () {
        $(".checkbox_16").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_17").change(function () {
        $(".checkbox_17").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_18").change(function () {
        $(".checkbox_18").prop('checked', $(this).prop("checked"));
    });

    //    2222222222222
    $("#checkbox_21").change(function () {
        $(".checkbox_21").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_22").change(function () {
        $(".checkbox_22").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_23").change(function () {
        $(".checkbox_23").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_24").change(function () {
        $(".checkbox_24").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_25").change(function () {
        $(".checkbox_25").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_26").change(function () {
        $(".checkbox_26").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_27").change(function () {
        $(".checkbox_27").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_28").change(function () {
        $(".checkbox_28").prop('checked', $(this).prop("checked"));
    });
    /////////////////////////////////////////////////
    $("#checkbox_31").change(function () {
        $(".checkbox_31").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_32").change(function () {
        $(".checkbox_32").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_33").change(function () {
        $(".checkbox_33").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_34").change(function () {
        $(".checkbox_34").prop('checked', $(this).prop("checked"));
    });

    $("#checkbox_35").change(function () {
        $(".checkbox_35").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_36").change(function () {
        $(".checkbox_36").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_37").change(function () {
        $(".checkbox_37").prop('checked', $(this).prop("checked"));
    });
    $("#checkbox_38").change(function () {
        $(".checkbox_38").prop('checked', $(this).prop("checked"));
    });

    $('.appliance').click(function () {
        var self = this;
        var menu_id = $('#mySelect').val();
        var employee_id = <?php echo intval($this->uri->segment(4)); ?>;

        console.log(menu_id, employee_id);
        if (confirm('Bạn có đồng ý thêm thiết bị???')) {
            if (menu_id == '' || employee_id == '') {
                alert('không được để trống các trường');
            } else {
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/process/add_menu') ?>",
                    cache: false,
                    data: {
                        'employee_id': employee_id,
                        'menu_id': menu_id,
                    },
                    success: function (kq) {
                        console.log('kt' + kq);
                        alert(kq)
                        if (kq.indexOf('Thành công') != -1) {
                            $(self).parent().parent().find(".appliance").hide();
                            // $(self).parent().parent().find(".no").hide();
                            // $(self).hide();
                        }
                    },
                    error: function (xhr, textStatus, error) {
                        console.log(xhr.responseText);
                        console.log(xhr.statusText);
                        console.log(textStatus);
                        console.log(error);
                    }
                });
            }
        }
    });
</script>

<style>
    input[type=checkbox] {
        margin: 0px 0 0;
        zoom: 1.5;
    }

    .center {
        text-align: center;
    }

    .cusom_heading {
        text-transform: uppercase;
        color: red;
        font-weight: bold;
    }
</style>