<?php

Class Report extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('asset_model');
        $this->load->model('asset_logs_model');
        $this->load->model('asset_rule_model');
        $this->load->model('supplier_model');
        $this->load->model('company_model');
        $this->load->model('asset_status_model');
        $this->load->model('unit_model');
        $this->load->model('assettype_model');
        $this->load->model('employee_model');
        $this->load->model('department_model');
        $this->load->model('menu_model');
        $this->load->model('menu_access_model');
        $this->load->model('contract_model');
        $this->load->model('contract_detail_model');

        $input_priority = array();
        $input_priority['order'] = array('priority', 'asc');
        $deparment = $this->department_model->get_list($input_priority);
        $this->data['deparment'] = $deparment;
//        pre($deparment);
        $input_e = array();
        $input_e['where']['ban'] = 0;
        $input_e['where']['role'] = 1;
        $input_e['where']['id > '] = 115;
//        $asset = $this->asset_model->get_list($input_e);
        $asset = $this->asset_model->get_list();
        $this->data['asset'] = $asset;

        $contract = $this->contract_model->get_list();
        $this->data['contract'] = $contract;

        $unit = $this->unit_model->get_list();
        $this->data['unit'] = $unit;
//        pre($unit);
        $assettype = $this->assettype_model->get_list();
        $this->data['assettype'] = $assettype;
//        pre($unit);
        $employee = $this->employee_model->get_list($input_e);
        $this->data['employee'] = $employee;
//        pre($employee);
//        trang thái ts
        $asset_status = $this->asset_status_model->get_list($input_priority);
        $this->data['asset_status'] = $asset_status;

        $supplier = $this->supplier_model->get_list();
        $this->data['supplier'] = $supplier;

        $company = $this->company_model->get_list($input_priority);
        $this->data['company'] = $company;
    }

    function index()
    {
        $input = array();
        $input['where']['role'] = 1;
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $company_id = 'all';
        $department_id = 'all';
        $employee_id = 'all';
        $assettype = 'all';
        $asset_status = 'all';
        $search = 'all';
        $status = 'all';
        if ($this->input->post('search')) {
            $search = 1;
            $company_id = $this->input->post('company_id');
            $department_id = $this->input->post('department_id');
            $employee_id = $this->input->post('employee_id');
            $assettype = $this->input->post('assettype_id');
            $asset_status = $this->input->post('asset_status_id');
            $status = $this->input->post('status');
//            if (isset($status)) {
//                $status = 2;
//            }
            $asset_dcm = $this->asset_model->get_info_ts($search, $company_id, $department_id, $employee_id, $assettype, $asset_status, $status);
            $arr_asset = array();
            $index = 0;
            if (isset($asset_dcm)) {
                foreach ($asset_dcm as $key => $value) {
                    if ($value->status == 1) {
                        $employee_name = $value->employee_name;
                    } else {
//                    $status = 'Ts Chung';
                        $employee_name = $value->employee_name . '(TS.Chung)';
                    }
                    $company_name = $this->company_model->get_info($value->company_id)->name;
                    $department_name = $this->department_model->get_info($value->department_id)->name;
                    $arr_asset[$index] = new stdClass();
                    $arr_asset[$index]->id = $value->id;
                    $arr_asset[$index]->asset_code = $value->asset_code;
                    $arr_asset[$index]->ngay_kiemke = $value->ngay_kiemke;
                    $arr_asset[$index]->asset_name = $value->asset_name;
                    $arr_asset[$index]->seri = $value->seri;
                    $arr_asset[$index]->unit_name = $value->unit_name;
                    $arr_asset[$index]->amount = $value->amount;
                    $arr_asset[$index]->ngaymua = $value->ngaymua;
                    $arr_asset[$index]->baohanh_den = $value->baohanh_den;
                    $arr_asset[$index]->asset_status_name = $value->asset_status_name;
                    $arr_asset[$index]->assettype_name = $value->assettype_name;
                    $arr_asset[$index]->company_name = $company_name;
                    $arr_asset[$index]->department_name = $department_name;
                    $arr_asset[$index]->employee_name = $employee_name;
//                $arr_asset[$index]->status = $status;
                    $arr_asset[$index]->asset_note = $value->asset_note;
                    $index++;
                }
            }
            /*get value search*/
            $company_id = $this->input->post('company_id');
            $department_id = $this->input->post('department_id');
            $employee_id = $this->input->post('employee_id');
            $assettype = $this->input->post('assettype_id');
            $asset_status = $this->input->post('asset_status_id');
            $status = $this->input->post('status');

//            pre($asset_status);
            $index_s_arr = array();
            $index_s_arr[0] = new stdClass();
            if ($company_id != 'all') {
                $company_id = $this->company_model->get_info($company_id)->name;
            }
            if ($department_id != 'all') {
                $department_id = $this->department_model->get_info($department_id)->name;
            }
            if ($employee_id != 'all') {
                $employee_id = $this->employee_model->get_info($employee_id)->name;
            }
            if ($assettype != 'all') {
                $assettype = $this->assettype_model->get_info($assettype)->assettype_name;
            }
            if ($asset_status != 'all') {
                $asset_status = $this->asset_status_model->get_info($asset_status)->name;
            }
            if ($status != 'all') {
                $status = 'all';
            } else {
                if ($status == 1) {
                    $status = 'Ts cá nhân';
                }
                if ($status == 2) {
                    $status = 'Ts chung';
                }
            }
            $index_s_arr[0]->company_id = $company_id;
            $index_s_arr[0]->department_id = $department_id;
            $index_s_arr[0]->employee_id = $employee_id;
            $index_s_arr[0]->assettype = $assettype;
            $index_s_arr[0]->asset_status = $asset_status;
            $index_s_arr[0]->status = $status;
//            pre($index_s_arr);

            /*get value search*/
//        pre($arr_asset);
            $this->session->set_userdata('s_arr', $index_s_arr);
            $this->session->set_userdata('Asset', $arr_asset);
            $this->data['res'] = $arr_asset;
            $this->data['temp'] = 'admin/report/report';
            $this->load->view('admin/layout', $this->data);
        } else {
            $asset_dcm = $this->asset_model->get_info_ts($search, $company_id, $department_id, $employee_id, $assettype, $asset_status, $status);
            $arr_asset = array();
            $index = 0;
            if (isset($asset_dcm)) {
                foreach ($asset_dcm as $key => $value) {
                    if ($value->status == 1) {
                        $employee_name = $value->employee_name;
                    } else {
//                    $status = 'Ts Chung';
                        $employee_name = $value->employee_name . '(TS.Chung)';
                    }
                    $company_name = $this->company_model->get_info($value->company_id)->name;
                    $department_name = $this->department_model->get_info($value->department_id)->name;
                    $arr_asset[$index] = new stdClass();
                    $arr_asset[$index]->id = $value->id;
                    $arr_asset[$index]->asset_code = $value->asset_code;
                    $arr_asset[$index]->ngay_kiemke = $value->ngay_kiemke;
                    $arr_asset[$index]->asset_name = $value->asset_name;
                    $arr_asset[$index]->seri = $value->seri;
                    $arr_asset[$index]->unit_name = $value->unit_name;
                    $arr_asset[$index]->amount = $value->amount;
                    $arr_asset[$index]->ngaymua = $value->ngaymua;
                    $arr_asset[$index]->baohanh_den = $value->baohanh_den;
                    $arr_asset[$index]->asset_status_name = $value->asset_status_name;
                    $arr_asset[$index]->assettype_name = $value->assettype_name;
                    $arr_asset[$index]->company_name = $company_name;
                    $arr_asset[$index]->department_name = $department_name;
                    $arr_asset[$index]->employee_name = $employee_name;
//                $arr_asset[$index]->status = $status;
                    $arr_asset[$index]->asset_note = $value->asset_note;
                    $index++;
                }
            }
//        pre($arr_asset);
//            $this->session->set_userdata('Asset', $arr_asset);
            $this->data['res'] = $arr_asset;
//        $this->data['ban'] = $ban;
//        pre($arr_asset);

            $this->data['temp'] = 'admin/report/report';
            $this->load->view('admin/layout', $this->data);
        }
        /* Export excel*/
        if ($this->input->post('btnExportData')) {
            $asset_2 = $this->session->userdata('Asset');
            $s_arr = $this->session->userdata('s_arr');
//            pre($s_arr);
            if (!empty($asset_2)) {
//                return false;
                $this->load->library("excel");
                $objPHPExcel = new PHPExcel();
                /* ADD LOGO */
                $objDrawing = new PHPExcel_Worksheet_Drawing();
                $objDrawing->setName('Logo');
                $objDrawing->setDescription('Logo');
                $objDrawing->setPath('public/logo_login.png');
                $objDrawing->setCoordinates('A1');
// set resize to false first
                $objDrawing->setResizeProportional(false);
                $objDrawing->setWidthAndHeight(268, 94);
                $objDrawing->setResizeProportional(true);
// set width later
//            $objDrawing->setWidth(145);
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
//            $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(5);
                /* END LOGO */

                //define center text
                $center = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    )
                );

                $objPHPExcel->setActiveSheetIndex(0);
                $sheet = $objPHPExcel->getActiveSheet();

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E' . (2) . ':I' . (2));

                $sheet->setCellValueByColumnAndRow(4, 2, "BÁO CÁO CHI TIẾT TÀI SẢN");
                $sheet->setCellValueByColumnAndRow(6, 3, "Ngày báo cáo  " . date('d-m-Y'));

                foreach ($s_arr as $key => $value) {
                    $sheet->setCellValueByColumnAndRow(0, 6, "Công ty/Chi nhánh: " . $value->company_id);
                    $sheet->setCellValueByColumnAndRow(4, 6, "Phòng ban:  " . $value->department_id);
                    $sheet->setCellValueByColumnAndRow(8, 6, "Người sử dụng/Q.lý:  " . $value->employee_id);

                    $sheet->setCellValueByColumnAndRow(0, 7, "Cá nhân/ Chung:  " . $value->assettype);
                    $sheet->setCellValueByColumnAndRow(4, 7, "Loại tài sản:  " . $value->asset_status);
                    $sheet->setCellValueByColumnAndRow(8, 7, "Trạng thái:  " . $value->status);
                }

                $objPHPExcel->getActiveSheet()->getStyle('C2:G2')->getFont()->setBold(true);
                $sheet->getStyle('C2:F2')->applyFromArray($center);

                $objPHPExcel->getActiveSheet()->getStyle("C2:G2")->getFont()->setSize(16);
                $objPHPExcel->getActiveSheet()->getStyle('A6:K6')->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('A7:K7')->getFont()->setBold(true);

//            pre($data);
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
//            $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
                $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
                $objPHPExcel->getActiveSheet()->getStyle('E6')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('J')->getAlignment()->setWrapText(true);
                $objPHPExcel->getActiveSheet()->getStyle('K')->getAlignment()->setWrapText(true);

                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

                $objPHPExcel->getActiveSheet()->SetCellValue('A9', 'STT');
                $objPHPExcel->getActiveSheet()->SetCellValue('B9', 'Mã tài sản');
                $objPHPExcel->getActiveSheet()->SetCellValue('C9', 'Ngày kiểm kê');
                $objPHPExcel->getActiveSheet()->SetCellValue('D9', 'Tên tài sản/ Model tài sản');
                $objPHPExcel->getActiveSheet()->SetCellValue('E9', 'Serial/ S.N/ Code/ Imei');
                $objPHPExcel->getActiveSheet()->SetCellValue('F9', 'ĐVT');
                $objPHPExcel->getActiveSheet()->SetCellValue('G9', 'Số Lượng');
                $objPHPExcel->getActiveSheet()->SetCellValue('H9', 'Ngày mua');
                $objPHPExcel->getActiveSheet()->SetCellValue('I9', 'Bảo hành đến');
                $objPHPExcel->getActiveSheet()->SetCellValue('J9', 'Người sử dụng/ Q. lý');
                $objPHPExcel->getActiveSheet()->SetCellValue('K9', 'Loại tài sản');
                $objPHPExcel->getActiveSheet()->SetCellValue('L9', 'Trạng thái');
                $objPHPExcel->getActiveSheet()->SetCellValue('M9', 'Ghi chú');
                $objPHPExcel
                    ->getActiveSheet()
                    ->getStyle('A9:M9')
                    ->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB('F5DEB3'); //i.e,colorcode=D3D3D3

                $sheet->getStyle("A9:K9")->applyFromArray($center);
                $i = 10;
                $j = 0;
//            pre($asset_2);
                foreach ($asset_2 as $key => $value) {
                    $j++;
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, 'Văn Phòng');
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i, $j);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $i, $value->asset_code);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $i, date('d/m/Y', $value->ngay_kiemke));
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $i, $value->asset_name);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $i, $value->seri);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, $i, $value->unit_name);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, $i, $value->amount);
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, date('d/m/Y', $value->ngaymua));
                    if ($value->ngaymua == 0) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, 'Trống');
//                        echo 'Trống';
                    } else {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, $i, date('d/m/Y', $value->ngaymua));

//                        echo date('d-m-Y', $asset->ngaymua);
//                        Trống
                    }
//                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, date('d/m/Y', $value->baohanh_den));

                    if ($value->baohanh_den == 0) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, 'Không bảo hành');
//                            echo '<span class="label label-danger">Không bảo hành</span> ';
                    } elseif ($value->baohanh_den == 1) {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, 'Hết bảo hành');
//                            echo ' <span class="label label-warning">Hết bảo hành</span>';
                    } else {
                        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i, date('d/m/Y', $value->baohanh_den));
//                            Hết bảo hành
//                            echo '<span class="label label-success">' . date('d-m-Y', $value->baohanh_den) . '</span>';
                    };

                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, $i, $value->employee_name);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(10, $i, $value->assettype_name);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $value->asset_status_name);
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(12, $i, $value->asset_note);
//                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(11, $i, $value->email);

                    /*borders*/
                    $BStyle = array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN,
//                                'color' => array('rgb' => '6665ff')
                            )
                        )
                    );
                    $objPHPExcel->getActiveSheet()->getStyle('A' . ($i) . ':M' . ($i))->applyFromArray($BStyle);
                    /*borders*/
                    $i++;
                }
                /*merge cell date, month, year footer*/
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:D6');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A7:D7');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E6:H6');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E7:H7');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I6:K6');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I7:K7');
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I' . ($i + 1) . ':K' . ($i + 1));
                $sheet->getStyle('I' . ($i + 1) . ':K' . ($i + 1))->applyFromArray($center);

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I' . ($i + 2) . ':K' . ($i + 2));
                $sheet->getStyle('I' . ($i + 2) . ':K' . ($i + 2))->applyFromArray($center);

                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $i + 1, ' Tổng số lượng: ' . $j . ' (Tài sản)');
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i + 1, 'Hà Nội, ngày ' . date('d') . ' tháng ' . date('m') . ' năm ' . date('Y'));
                $objPHPExcel->getActiveSheet()->getStyle('A' . ($i + 1))->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('I' . ($i + 1))->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, $i + 2, 'Người lập ');

                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                header("Content-Type: application/vnd.ms-excel");
                header('Content-Disposition: attachment; filename="DSTS.xls"');
                $objWriter->save('php://output');
            }
        }
        /* End Export excel*/
    }

    function details()
    {
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $asset_id = $this->uri->segment(4);
        $asset_id = intval($asset_id);
        //pre($asset_id);
        $asset = $this->asset_model->get_info($asset_id);
//        prev($asset);

//        lấy ngày bắt đầu ở contract_detail
        $date = $contract_id = '';
//        $start_date_contract = $this->contract_detail_model->contract_start($asset_id);
////                pre($start_date_contract[0]->start_contract_date);
//        if ($start_date_contract) {
//            $date = $start_date_contract[0]->start_contract_date;
//            $contract_id = $start_date_contract[0]->contract_id;
//        }
//        lấy ngày bắt đầu ở contract_detail

        if ($asset == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin sản phẩm!');
            redirect(base_url('admin/asset'));
        } else {
            $this->data['asset'] = $asset;
        }

        if ($this->input->post('btnback')) {
//            if ($this->asset_model->update($asset_id, $dataSubmit)) {
//                $this->session->set_flashdata('message', 'Sửa thông tin tài sản thành công!');
            redirect(base_url('admin/asset' . '?asset_id=' . $asset_id . '#' . $asset_id));
//            } else {
//                $this->session->set_flashdata('message', 'Sửa thông tin tài sản thất bại!');
//                redirect(base_url('admin/asset'));
//            }
        }

        $this->data['temp'] = 'admin/asset/details';
        $this->load->view('admin/layout', $this->data);
    }

    function del()
    {
        $asset_id = $this->uri->segment(4);
        $asset_id = intval($asset_id);
        $asset = $this->asset_model->get_info($asset_id);

        if ($asset == null) {
            $this->session->set_flashdata('message', 'Không tồn tại thông tin tài sản!');
            redirect(base_url('admin/asset'));
        } else {
            if ($this->asset_model->delete($asset_id)) {
//            $dataSubmit = array(
//                'ban' => 1
//            );
//            if ($this->asset_model->update($asset_id, $dataSubmit)) {
//                $img = './upload/' . $asset->img;
//                unlink($img);
                //unlink($thumb_img);
                $this->session->set_flashdata('message', 'Xóa tài sản thành công!');
                redirect(base_url('admin/asset'));
            } else {
                $this->session->set_flashdata('message', 'Thao tác không thành công!');
                redirect(base_url('admin/asset'));
            }
        }
    }
}