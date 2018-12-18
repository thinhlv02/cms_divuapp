<!-- jQuery -->
<script src="<?php echo admin_theme() ?>vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo admin_theme() ?>vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo admin_theme() ?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo admin_theme() ?>vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="<?php echo admin_theme() ?>vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="<?php echo admin_theme() ?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo admin_theme() ?>vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo admin_theme() ?>vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo admin_theme() ?>build/js/custom.min.js"></script>

<!-- Datatables -->
<script>
    $(document).ready(function () {
        var handleDataTableButtons = function () {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                    "pageLength": 50,
                    "language": {
                        // "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Vietnamese.json"
                        "sProcessing": "Đang xử lý...",
                        "sLengthMenu": "Xem _MENU_ mục",
                        "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                        "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                        "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                        "sInfoPostFix": "",
                        "sSearch": "",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "Đầu",
                            "sPrevious": "Trước",
                            "sNext": "Tiếp",
                            "sLast": "Cuối"
                        }
                    },
                    dom: "Bfrtip",
                    "DisplayLength": 7,
                    // buttons: [
                    //     {
                    //         extend: "copy",
                    //         className: "btn-sm"
                    //     },
                    //     {
                    //         extend: "csv",
                    //         className: "btn-sm"
                    //     },
                    //     {
                    //         extend: "excel",
                    //         className: "btn-sm"
                    //     },
                    //     {
                    //         extend: "pdfHtml5",
                    //         className: "btn-sm"
                    //     },
                    //     {
                    //         extend: "print",
                    //         className: "btn-sm"
                    //     },
                    // ],
                    buttons: [
                        {
                            extend: "excel", text: 'Xuất Excel', className: "red"
                        },
                        {
                            extend: "print", text: 'IN bảng này', className: "green"
                        },
                    ],
                    responsive: true
                });
            }
        };

        TableManageButtons = function () {
            "use strict";
            return {
                init: function () {
                    handleDataTableButtons();
                }
            };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
            keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });

        $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
            'order': [[1, 'asc']],
            'columnDefs': [
                {orderable: false, targets: [0]}
            ]
        });
        $datatable.on('draw.dt', function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green'
            });
        });

        TableManageButtons.init();
    });
</script>
<!-- /Datatables -->

<!--//add-->

<!-- bootstrap-daterangepicker -->
<link href="<?php echo admin_theme() ?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<script src="<?php echo admin_theme(''); ?>/vendors/moment/min/moment.min.js"></script>
<script src="<?php echo admin_theme(''); ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable-product').dataTable({
            //disabled sorting:
            "aaSorting": [],
            "pageLength": 50,
            "language": {
                // "url": "http://cdn.datatables.net/plug-ins/1.10.16/i18n/Vietnamese.json"
                "sProcessing": "Đang xử lý...",
                "sLengthMenu": "Xem _MENU_ mục",
                "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix": "",
                "sSearch": "",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Đầu",
                    "sPrevious": "Trước",
                    "sNext": "Tiếp",
                    "sLast": "Cuối"
                }
            },
            //custom box search
            // initComplete: function () {
            //     $("#datatable-product_filter").detach().appendTo('#new-search-area');
            // },
            //custom box search
            // đẩy show leng xuống bottom
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            // đẩy show leng xuống bottom
            "lengthMenu": [[10, 25, 50, 1000, -1], [10, 25, 50, 1000, "All"]]
            // "iDisplayLength": 3,
        });

        $('#txtFrom').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY',
                daysOfWeek: [
                    "CN",
                    "T2",
                    "T3",
                    "T4",
                    "T5",
                    "T6",
                    "T7"
                ],
                monthNames: [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12"
                ],
            },
        }, function (start, end, label) {
            // console.log(' fromxxxx '+start + $('#txtTo').val());
            console.log(' from ' + start.format('DD-MM-YYYY'));
            job_start_date = start.format('DD-MM-YYYY').split('-');
            job_end_date = $('#txtTo').val().split('-');
            var new_start_date = new Date(job_start_date[2], job_start_date[0], job_start_date[1]);
            var new_end_date = new Date(job_end_date[2], job_end_date[0], job_end_date[1]);

            if (new_start_date > new_end_date) {
                // console.log('lớn hơn');
                $('#txtTo').val(start.format('DD-MM-YYYY'));
            }
            // console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#txtTo').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY',
                daysOfWeek: [
                    "CN",
                    "T2",
                    "T3",
                    "T4",
                    "T5",
                    "T6",
                    "T7"
                ],
                monthNames: [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12"
                ],
            }
        }, function (start, end, label) {
            // console.log(start.toISOString(), end.toISOString(), label);
            console.log(' to ' + end.format('DD-MM-YYYY'));
            job_start_date = start.format('DD-MM-YYYY').split('-');
            job_end_date = $('#txtFrom').val().split('-');
            var new_start_date = new Date(job_start_date[2], job_start_date[0], job_start_date[1]);
            var new_end_date = new Date(job_end_date[2], job_end_date[0], job_end_date[1]);
            if (new_end_date > new_start_date) {
                // console.log('lớn hơn');
                $('#txtFrom').val(start.format('DD-MM-YYYY'));
            }
        });

//        conga1411 thêm
        $('#txtTo2').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY',
                daysOfWeek: [
                    "CN",
                    "T2",
                    "T3",
                    "T4",
                    "T5",
                    "T6",
                    "T7"
                ],
                monthNames: [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12"
                ],
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#txtTo3').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY',
                daysOfWeek: [
                    "CN",
                    "T2",
                    "T3",
                    "T4",
                    "T5",
                    "T6",
                    "T7"
                ],
                monthNames: [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12"
                ],
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

        $('#txtTo4').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4",
            showDropdowns: true,
            locale: {
                format: 'DD-MM-YYYY',
                daysOfWeek: [
                    "CN",
                    "T2",
                    "T3",
                    "T4",
                    "T5",
                    "T6",
                    "T7"
                ],
                monthNames: [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12"
                ],
            }
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });

//        datepicker month
        $('input[name="datetimes"]').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            showDropdowns: true,
            // minDate: '2018-09-01',
            // startDate: moment().startOf('hour'),
            // endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                // format: 'M/DD hh:mm A'
                format: 'YYYY-MM-DD H:mm:ss',
                daysOfWeek: [
                    "CN",
                    "T2",
                    "T3",
                    "T4",
                    "T5",
                    "T6",
                    "T7"
                ],
                monthNames: [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12"
                ],
            }
        });

//        datepicker month
//        /conga1411 thêm

        $("#uploadImg").change(function () {
            readURL(this);
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

    function showFormAdd() {
        $(".add-folder").show();
    }

    function hideFormAdd() {
        $(".add-folder").hide();
    }

    function showFormUpload() {
        $(".upload-image").show();
    }

    function hideFormUpload() {
        $(".upload-image").hide();
    }

    function confirmDelImage(link) {
        if (confirm("Xác nhận xóa hình ảnh?")) {
            $.ajax({
                url: "<?php echo admin_url(); ?>" + "file/delImage/",
                type: "post",
                dataType: "text",
                data: {
                    path: link
                },
                success: function (result) {
                    location.reload();
                }
            });
        }
    }

    function confirmDelFolder(name) {
        if (confirm("Xác nhận xóa thư mục '" + name + "'?")) {
            $.ajax({
                url: "<?php echo admin_url(); ?>" + "file/delFolder/",
                type: "post",
                dataType: "text",
                data: {
                    path: link
                },
                success: function (result) {

                    // location.reload();
                }
            });
        }
    }
</script>
<!--js show hide psassword in form__ conga1411-->
<script>
    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
<!--js show hide psassword in form__ conga1411-->

<!--checkbox all-->
<script>
    function selectAll() {
        var blnChecked = document.getElementById("select_all_invoices").checked;
        var check_invoices = document.getElementsByClassName("check_invoice");
        var intLength = check_invoices.length;
        for (var i = 0; i < intLength; i++) {
            var check_invoice = check_invoices[i];
            check_invoice.checked = blnChecked;
        }
    }
</script>
<!--checkbox all-->