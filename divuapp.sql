/*
 Navicat Premium Data Transfer

 Source Server         : DB - 10.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50722
 Source Host           : 10.0.0.1:33060
 Source Schema         : divuapp

 Target Server Type    : MySQL
 Target Server Version : 50722
 File Encoding         : 65001

 Date: 13/12/2018 13:24:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account_bank_admin
-- ----------------------------
DROP TABLE IF EXISTS `account_bank_admin`;
CREATE TABLE `account_bank_admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `level` smallint(6) DEFAULT NULL,
  `admin_id` bigint(20) DEFAULT NULL,
  `chu_tai_khoan` varchar(150) DEFAULT NULL,
  `so_tai_khoan` char(100) DEFAULT NULL,
  `tinh_thanh` varchar(150) DEFAULT NULL,
  `bank_name` varchar(150) DEFAULT NULL,
  `chi_nhanh` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `level` int(11) DEFAULT NULL COMMENT '1:Admin_cms, 2:lanh dao, 3: quan ly, 4:KTV , 5:CSKH, 6: cộng tác viên',
  `rank` char(50) DEFAULT NULL COMMENT 'soLanDanhGia_tongSao',
  `fullname` varchar(45) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1: active, 2: lock account',
  `balance` bigint(20) DEFAULT '0' COMMENT 'tổng tiền lương',
  `balance_wait_payment` bigint(20) DEFAULT '0' COMMENT 'tiền lương chờ rút',
  `bonus` bigint(20) DEFAULT '0' COMMENT 'tổng tiền khách hàng thưởng',
  `bonus_wait_payment` bigint(20) DEFAULT '0' COMMENT 'tiền thưởng khách hàng chờ rút',
  `bonus_introduce_customer` bigint(20) DEFAULT '0' COMMENT 'tổng tiền thưởng giới thiệu khách hàng',
  `bonus_introduce_customer_wait_payment` bigint(20) DEFAULT '0' COMMENT 'tiền thưởng giới thiệu khách hàng chờ rút',
  `created` timestamp NULL DEFAULT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `fcm_token` varchar(500) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL COMMENT '1: active, 2: inActive',
  `work_status` tinyint(4) DEFAULT '1' COMMENT '1: đang rảnh, 2: đang bận',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `link_avatar` varchar(255) DEFAULT NULL,
  `time_update` timestamp NULL DEFAULT NULL,
  `device` tinyint(4) DEFAULT '0',
  `province` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `ward` varchar(100) DEFAULT NULL,
  `province_id` char(50) DEFAULT NULL,
  `district_id` char(50) DEFAULT NULL,
  `district_work_id` char(50) DEFAULT NULL COMMENT 'mã quận / huyện khu vực quản lý',
  `city_work_id` varchar(50) DEFAULT NULL COMMENT 'tỉnh/tp hoạt động',
  `ward_id` char(50) DEFAULT NULL,
  `service_id` char(200) DEFAULT NULL COMMENT 'có dấu phảy (,) ở cuối',
  `han_muc` int(11) DEFAULT '1500000' COMMENT 'số tiền tối đa được trừ âm',
  `so_tien_da_tru_am` int(11) DEFAULT '0' COMMENT 'số tiền đã trừ âm, reset khi KTV nạp lại tiền đã trừ âm',
  `birthday` date DEFAULT NULL,
  `salary` int(11) DEFAULT '5000000',
  `salary_add_month` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='Chứa thông tin tài khoản Admin CMS, lãnh đạo, quản lý, kỹ thuật viên, CSKH';

-- ----------------------------
-- Table structure for admin_cart
-- ----------------------------
DROP TABLE IF EXISTS `admin_cart`;
CREATE TABLE `admin_cart` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `info_cart` varchar(2000) DEFAULT NULL,
  `info_cart_wait_buy` varchar(2000) DEFAULT NULL,
  `time_change` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for admin_emergency
-- ----------------------------
DROP TABLE IF EXISTS `admin_emergency`;
CREATE TABLE `admin_emergency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emergency_id` bigint(20) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `position_start` varchar(500) DEFAULT NULL COMMENT 'vi_do*kinh_do*vi_tri   (234234.234*34534.1232*206 Đê La Thành)',
  `time_start_go` bigint(20) DEFAULT NULL,
  `time_start_job` bigint(20) DEFAULT NULL,
  `time_end` bigint(20) DEFAULT NULL,
  `so_sao` char(50) DEFAULT NULL,
  `khach_hang_danh_gia` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='Chứa danh sách các nhiệm vụ cứu hộ';

-- ----------------------------
-- Table structure for admin_emergency_report
-- ----------------------------
DROP TABLE IF EXISTS `admin_emergency_report`;
CREATE TABLE `admin_emergency_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `admin_emergency_id` int(11) DEFAULT NULL,
  `content` text,
  `emergency_id` bigint(20) DEFAULT NULL,
  `service_package_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='báo cáo nhiệm vụ cứu hộ của kỹ thuật viên';

-- ----------------------------
-- Table structure for admin_mission
-- ----------------------------
DROP TABLE IF EXISTS `admin_mission`;
CREATE TABLE `admin_mission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `service_package_maintenance_id` int(11) DEFAULT NULL,
  `position_start` varchar(500) DEFAULT NULL COMMENT 'vi_do*kinh_do*vi_tri   (234234.234*34534.1232*206 Đê La Thành)',
  `time_start_go` bigint(20) DEFAULT NULL,
  `time_start_job` bigint(20) DEFAULT NULL,
  `time_end` bigint(20) DEFAULT NULL,
  `so_sao` char(50) DEFAULT NULL,
  `khach_hang_danh_gia` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='Nhiệm vụ đã giao cho KTV';

-- ----------------------------
-- Table structure for admin_mission_report
-- ----------------------------
DROP TABLE IF EXISTS `admin_mission_report`;
CREATE TABLE `admin_mission_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `admin_mission_id` int(11) DEFAULT NULL,
  `content` text,
  `service_package_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='báo cáo nhiệm vụ bảo trì của kỹ thuật viên';

-- ----------------------------
-- Table structure for admin_require_payment
-- ----------------------------
DROP TABLE IF EXISTS `admin_require_payment`;
CREATE TABLE `admin_require_payment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1: chuyển khoản, 2: nhận tiền mặt',
  `balance_wait_payment` int(11) NOT NULL,
  `bonus_wait_payment` int(11) NOT NULL,
  `bonus_introduce_customer_wait_payment` int(11) NOT NULL,
  `total_money_payment` bigint(20) NOT NULL,
  `vnd` int(11) NOT NULL,
  `conversion_rate` char(50) NOT NULL COMMENT 'maTien_ty_le,maTien_ty_le',
  `account_bank_admin_id` bigint(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  `bank_info` varchar(500) DEFAULT NULL COMMENT 'chu_tai_khoan|ngan_hang|chi_nhanh',
  `status` tinyint(3) DEFAULT NULL COMMENT '1: gửi yêu cầu, 2: đang thanh toán, 3: Đã thanh toán, 4: hủy thanh toán',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for adusers
-- ----------------------------
DROP TABLE IF EXISTS `adusers`;
CREATE TABLE `adusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for agency
-- ----------------------------
DROP TABLE IF EXISTS `agency`;
CREATE TABLE `agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `city` varchar(11) DEFAULT NULL,
  `phone` text,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for alert
-- ----------------------------
DROP TABLE IF EXISTS `alert`;
CREATE TABLE `alert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='thông báo trên loa dưới client';

-- ----------------------------
-- Table structure for app_info
-- ----------------------------
DROP TABLE IF EXISTS `app_info`;
CREATE TABLE `app_info` (
  `provider_id` int(11) DEFAULT NULL,
  `device_name` varchar(12) DEFAULT NULL,
  `device` tinyint(4) DEFAULT NULL COMMENT '1: Android, 2: IOS, 3: Web',
  `link_app` varchar(500) DEFAULT NULL,
  `link_fanpage` varchar(500) DEFAULT NULL,
  `version` char(10) DEFAULT NULL,
  `show_shop` tinyint(4) DEFAULT '0' COMMENT '1: hiện, 0: ẩn',
  `show_recharge` tinyint(4) DEFAULT '0' COMMENT '1: hiện, 0: ẩn',
  `show_register_ctv` tinyint(4) DEFAULT '0',
  `show_tim_tho_quanh_day` tinyint(4) DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for appliance
-- ----------------------------
DROP TABLE IF EXISTS `appliance`;
CREATE TABLE `appliance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time` bigint(20) NOT NULL,
  `type` int(11) NOT NULL,
  `service_package_user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1: dang cho, 2: da dan tem',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COMMENT='chứa danh sách các sản phẩm ứng với hãng sản xuất';

-- ----------------------------
-- Table structure for area
-- ----------------------------
DROP TABLE IF EXISTS `area`;
CREATE TABLE `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for bank_info
-- ----------------------------
DROP TABLE IF EXISTS `bank_info`;
CREATE TABLE `bank_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: bật, 0: ẩn mờ không cho click phía client',
  `link_icon` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for banner
-- ----------------------------
DROP TABLE IF EXISTS `banner`;
CREATE TABLE `banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `route` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ccu_log
-- ----------------------------
DROP TABLE IF EXISTS `ccu_log`;
CREATE TABLE `ccu_log` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `ccu` int(10) DEFAULT NULL,
  `ccu_users` int(11) DEFAULT '0',
  `ccu_ktv` int(11) DEFAULT '0',
  `ccu_cskh` int(11) DEFAULT '0',
  `ccu_ctv` int(11) DEFAULT '0',
  `ccu_info` char(80) DEFAULT NULL COMMENT 'ma_kinh_doanh:ccu,  ma_kinh_doanh:ccu   (mã kinh doanh xem trong bảng app_info trường os)',
  `action_user` char(50) DEFAULT '' COMMENT '1: map, 2: cứu hộ, 3: gói dịch vụ, 4: vật tư, 5: tìm thợ,6: đăng ký cộng tác viên, 7: nạp tiền, 8: khuyến mãi, 9: other',
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=244823 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chat_info
-- ----------------------------
DROP TABLE IF EXISTS `chat_info`;
CREATE TABLE `chat_info` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_account` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: KH, 2: KTV, 5: CSKH',
  `account_id` int(11) NOT NULL DEFAULT '0' COMMENT 'ID của user/admin',
  `account_id_chat` int(11) NOT NULL DEFAULT '0' COMMENT 'ID của user/admin (KTV)',
  `fullname` varchar(50) DEFAULT NULL COMMENT 'fullname của client',
  `content` varchar(300) NOT NULL,
  `id_cskh` int(11) NOT NULL,
  `type_account_chat` tinyint(4) NOT NULL DEFAULT '0',
  `is_read` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1:đọc,0: chưa',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1141 DEFAULT CHARSET=utf8 COMMENT='Chứa nội dung chat';

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for cms_add_money_logs
-- ----------------------------
DROP TABLE IF EXISTS `cms_add_money_logs`;
CREATE TABLE `cms_add_money_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL COMMENT '1: KH, 2: KTV',
  `userid` int(11) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `money_id` int(11) DEFAULT NULL COMMENT 'là id của bảng cms_config_payment_money',
  `money` int(11) DEFAULT NULL,
  `sub` int(11) DEFAULT NULL COMMENT '1:cộng, 2: trừ',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_name` varchar(11) DEFAULT NULL COMMENT 'nếu server cộng thì tên :Server',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_admin_level
-- ----------------------------
DROP TABLE IF EXISTS `cms_admin_level`;
CREATE TABLE `cms_admin_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_config_payment
-- ----------------------------
DROP TABLE IF EXISTS `cms_config_payment`;
CREATE TABLE `cms_config_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_money` tinyint(4) NOT NULL COMMENT 'là id của bảng cms_config_payment_money',
  `area_id` smallint(6) DEFAULT NULL COMMENT 'khu vực',
  `time` smallint(6) DEFAULT NULL COMMENT 'số ngày (số ngày đợi duyệt tiền)',
  `limit` int(11) DEFAULT NULL COMMENT 'số dư tối thiểu',
  `tyle` float DEFAULT NULL COMMENT 'tỷ lệ quy đổi sang tiền VND',
  `admin_id` varchar(50) DEFAULT NULL COMMENT 'ai chỉnh sửa',
  `time_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_config_payment_money
-- ----------------------------
DROP TABLE IF EXISTS `cms_config_payment_money`;
CREATE TABLE `cms_config_payment_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_doanhthu_contract
-- ----------------------------
DROP TABLE IF EXISTS `cms_doanhthu_contract`;
CREATE TABLE `cms_doanhthu_contract` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `description_response` varchar(500) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: gửi yêu cầu, 2: thành công, 3: hủy giao dịch, 4: KTV không đủ tiền để duyệt (số tiền được phép trừ âm không đủ)',
  `is_add_money` tinyint(4) NOT NULL COMMENT '1: đã xử lý yêu cầu của KTV, 0: KTV chưa xử lý',
  `time_topup` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'thời gian nạp',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'thời gian ghi log',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='lưu log yêu cầu nạp tiền qua ktv của khách hàng';

-- ----------------------------
-- Table structure for cms_kinhdoanh
-- ----------------------------
DROP TABLE IF EXISTS `cms_kinhdoanh`;
CREATE TABLE `cms_kinhdoanh` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `date` timestamp NULL DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `cp_quangcao` int(25) DEFAULT '0',
  `gia_von` int(25) DEFAULT '0',
  `cp_vanphong` int(25) DEFAULT '0',
  `luong` int(25) DEFAULT '0',
  `cp_khac` int(25) DEFAULT '0',
  `ln_thuan` int(25) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cms_reward_point
-- ----------------------------
DROP TABLE IF EXISTS `cms_reward_point`;
CREATE TABLE `cms_reward_point` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` text COMMENT 'hành động',
  `city` int(11) DEFAULT NULL COMMENT 'thành phố',
  `unit` int(11) DEFAULT NULL COMMENT 'đơn vị',
  `point` int(11) DEFAULT NULL COMMENT 'điểm',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for collaborator_mission
-- ----------------------------
DROP TABLE IF EXISTS `collaborator_mission`;
CREATE TABLE `collaborator_mission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `phone` char(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `images` varchar(500) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0: chưa ai nhận, 1: có người nhận, 2: đã xong, 3: k hoàn thành,4: hủy gọi ctv',
  `send_ktv` tinyint(4) NOT NULL COMMENT '0: chưa gửi yêu cầu tới ktv,>0 số KTV đã được gửi',
  `admin_id` int(11) DEFAULT NULL,
  `evaluate_ctv` tinyint(4) DEFAULT NULL COMMENT '1: đã đánh giá',
  `reason_cancel` varchar(500) DEFAULT NULL,
  `note` varchar(200) DEFAULT NULL COMMENT 'lý do hủy',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Chứa danh sách các nhiệm vụ của cộng tác viên';

-- ----------------------------
-- Table structure for collaborator_mission_report
-- ----------------------------
DROP TABLE IF EXISTS `collaborator_mission_report`;
CREATE TABLE `collaborator_mission_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` bigint(20) NOT NULL,
  `collaborator_mission_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='cộng tác viên báo cáo nhiệm vụ';

-- ----------------------------
-- Table structure for collaborator_register
-- ----------------------------
DROP TABLE IF EXISTS `collaborator_register`;
CREATE TABLE `collaborator_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `works` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: gửi yêu cầu, 2: đồng ý, 3: không đồng ý',
  `admin_check` varchar(50) DEFAULT NULL COMMENT 'người xét duyệt',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='Danh sách đăng ký làm cộng tác viên';

-- ----------------------------
-- Table structure for config_server
-- ----------------------------
DROP TABLE IF EXISTS `config_server`;
CREATE TABLE `config_server` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_url_recharge_card` varchar(150) DEFAULT NULL,
  `partner_card` varchar(50) DEFAULT NULL,
  `password_partner_card` varchar(50) DEFAULT NULL,
  `epay_link_url_recharge` varchar(150) DEFAULT NULL,
  `epay_merchant_code` varchar(50) DEFAULT NULL,
  `epay_merchant_send_key` varchar(50) DEFAULT NULL,
  `epay_merchant_receive_key` varchar(50) DEFAULT NULL,
  `epay_issuer_id` varchar(50) DEFAULT NULL COMMENT 'nhà phát hành',
  `epay_response_link` varchar(150) DEFAULT NULL,
  `key_firebase` varchar(150) DEFAULT NULL,
  `money_register_account` int(11) DEFAULT NULL,
  `money_thuong_nhap_ma_gioi_thieu` int(11) DEFAULT NULL,
  `ip_server` varchar(150) DEFAULT NULL COMMENT 'Bắt buộc phải để IP Server đang chạy (không để domain)',
  `link_port_3000` varchar(150) DEFAULT NULL COMMENT 'NodeJs',
  `link_port_90` varchar(150) DEFAULT NULL,
  `link_port_91` varchar(150) DEFAULT NULL,
  `link_port_93` varchar(150) DEFAULT NULL,
  `nl_url_recharge` varchar(150) DEFAULT NULL COMMENT 'link thật:  https://www.nganluong.vn/checkout.api.nganluong.post.php              link test:  https://sandbox.nganluong.vn:8088/nl30/checkout.api.nganluong.post.php ',
  `nl_merchant_id_send` varchar(150) DEFAULT NULL,
  `nl_merchant_password_send` varchar(150) DEFAULT NULL,
  `nl_merchant_id_check` varchar(150) DEFAULT NULL,
  `nl_merchant_password_check` varchar(150) DEFAULT NULL,
  `nl_receiver_email` varchar(150) DEFAULT NULL COMMENT 'nl: Ngân Lượng',
  `nl_return_url` varchar(150) DEFAULT NULL COMMENT 'trả kết quả nạp',
  `nl_cancel_url` varchar(150) DEFAULT NULL COMMENT 'hủy đơn hàng',
  `time_write_ccu_log` smallint(6) NOT NULL COMMENT 'số giây',
  `gmail_send` char(50) NOT NULL,
  `gmail_password` char(50) NOT NULL,
  `gmail_to` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for config_service
-- ----------------------------
DROP TABLE IF EXISTS `config_service`;
CREATE TABLE `config_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  `created` int(11) NOT NULL,
  `money` int(11) DEFAULT '0',
  `city` int(11) DEFAULT '1',
  `time` int(11) DEFAULT '0',
  `employee` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for config_service_type
-- ----------------------------
DROP TABLE IF EXISTS `config_service_type`;
CREATE TABLE `config_service_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for coupon
-- ----------------------------
DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1- giảm tiền, 2- giảm phần trăm với hạn mức',
  `coupon` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `percent` float DEFAULT NULL,
  `money` int(11) NOT NULL,
  `han_muc` int(11) NOT NULL,
  `used` tinyint(4) NOT NULL COMMENT '0: chưa sử dụng, 1: đã sử dụng',
  `sender` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='chứa mã giảm giá';

-- ----------------------------
-- Table structure for cutoff_dau2
-- ----------------------------
DROP TABLE IF EXISTS `cutoff_dau2`;
CREATE TABLE `cutoff_dau2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `hour` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_login` int(11) DEFAULT NULL,
  `user_reg` int(11) DEFAULT NULL,
  `dau` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for emergency
-- ----------------------------
DROP TABLE IF EXISTS `emergency`;
CREATE TABLE `emergency` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `partner_id` varchar(50) DEFAULT '' COMMENT 'danh sách các admin_id',
  `service_package_user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `des_cancel` varchar(255) DEFAULT NULL COMMENT 'thinhlv add',
  `address` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `images` varchar(500) NOT NULL,
  `status` int(4) DEFAULT '0' COMMENT '1: Chưa đến, 2: KTV bắt đầu đi , 3: KTV đã đến khách hàng chưa xác nhận, 4: KTV đã đến khách hàng đã xác nhận, 5: Đã xong, 6: Không hoàn thành, 7: Huỷ',
  `evaluate_partner` int(4) DEFAULT '0',
  `bonus_ktv` int(11) DEFAULT '0',
  `time` bigint(20) NOT NULL,
  `note` varchar(500) DEFAULT NULL COMMENT 'lý do hủy',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COMMENT='Chứa danh sách các nhiệm vụ cứu hộ, và tình trạng cứu hộ';

-- ----------------------------
-- Table structure for evaluate_ctv
-- ----------------------------
DROP TABLE IF EXISTS `evaluate_ctv`;
CREATE TABLE `evaluate_ctv` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `collaborator_id` bigint(20) NOT NULL,
  `so_sao` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='đánh giá cộng tác viên';

-- ----------------------------
-- Table structure for gift_code
-- ----------------------------
DROP TABLE IF EXISTS `gift_code`;
CREATE TABLE `gift_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1: Tang DIV, 2: Tang goi dich vu',
  `div` bigint(40) DEFAULT NULL,
  `service_package_id` bigint(40) DEFAULT NULL,
  `agent` varchar(255) DEFAULT NULL COMMENT 'chọn đại lý',
  `expire_date` timestamp NULL DEFAULT NULL COMMENT 'hạn dùng',
  `use_by` int(11) DEFAULT NULL COMMENT 'người sử dụng null',
  `use_date` timestamp NULL DEFAULT NULL COMMENT 'mặc định null',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` bigint(40) DEFAULT NULL COMMENT 'id cskh admin',
  `area_id` varchar(45) DEFAULT NULL COMMENT 'tỉnh_huyện_xãph',
  `service_package_user_id` bigint(40) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for information
-- ----------------------------
DROP TABLE IF EXISTS `information`;
CREATE TABLE `information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `content` text,
  `type` int(11) DEFAULT '1' COMMENT '1:thongbao;2:gioithieu;3:thongtindichvu;4:chinhsachcamket;5:hotline;6:dieukhoanKTV; 7: quyền lợi của CTV;8:notificaitons cho KTV;9:đk áp dụng;10:cách tính phí',
  `created` bigint(20) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `service_package_id` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for introduction
-- ----------------------------
DROP TABLE IF EXISTS `introduction`;
CREATE TABLE `introduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='chứa link ảnh giới thiệu về app';

-- ----------------------------
-- Table structure for log_buy_service_package_user
-- ----------------------------
DROP TABLE IF EXISTS `log_buy_service_package_user`;
CREATE TABLE `log_buy_service_package_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `service_package_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='log mua gói bảo trì của khách hàng';

-- ----------------------------
-- Table structure for log_enter_introduction_code
-- ----------------------------
DROP TABLE IF EXISTS `log_enter_introduction_code`;
CREATE TABLE `log_enter_introduction_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL COMMENT 'id người nhận, = user_id nếu recipient_type = 1, = admin_id nếu recipient_type = 2',
  `recipient_type` tinyint(4) DEFAULT NULL COMMENT '1: user, 2: admin',
  `money` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='log khách hàng nhập mã giới thiệu';

-- ----------------------------
-- Table structure for log_ktv_confirm_recharge_from_user
-- ----------------------------
DROP TABLE IF EXISTS `log_ktv_confirm_recharge_from_user`;
CREATE TABLE `log_ktv_confirm_recharge_from_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `balance_tru` int(11) NOT NULL COMMENT 'tiền balance trừ',
  `so_tien_da_tru_am` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='lưu log KTV xác nhận nạp tiền từ khách hàng';

-- ----------------------------
-- Table structure for log_payment_cart_admin
-- ----------------------------
DROP TABLE IF EXISTS `log_payment_cart_admin`;
CREATE TABLE `log_payment_cart_admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `product_id_detail` varchar(500) NOT NULL COMMENT 'productid:so_luong:shop_id,productid:so_luong:shop_id',
  `detail_cart` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: đã nhận đơn hàng, 2: đang xử lý đơn hàng, 3: đang lấy hàng, 4: đang vận chuyển, 5: giao hàng thành công, 6: hủy đơn hàng',
  `coupon_id` bigint(20) DEFAULT NULL,
  `nguoi_giao` varchar(100) DEFAULT NULL,
  `detail_step` varchar(100) DEFAULT NULL COMMENT 'chi tiết các bước status',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_payment_cart_user
-- ----------------------------
DROP TABLE IF EXISTS `log_payment_cart_user`;
CREATE TABLE `log_payment_cart_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `product_id_detail` varchar(500) NOT NULL COMMENT 'productid:so_luong:shop_id,productid:so_luong:shop_id',
  `detail_cart` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: đã nhận đơn hàng, 2: đang xử lý đơn hàng, 3: đang lấy hàng, 4: đang vận chuyển, 5: giao hàng thành công, 6: hủy đơn hàng',
  `coupon_id` bigint(20) DEFAULT NULL,
  `nguoi_giao` varchar(100) DEFAULT NULL,
  `detail_step` varchar(100) DEFAULT NULL COMMENT 'chi tiết các bước status',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_product_gift_user_used
-- ----------------------------
DROP TABLE IF EXISTS `log_product_gift_user_used`;
CREATE TABLE `log_product_gift_user_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_gift_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `used` tinyint(4) NOT NULL COMMENT '1: đã sử dụng, 0: chưa sử dụng',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_product_reward_points_user
-- ----------------------------
DROP TABLE IF EXISTS `log_product_reward_points_user`;
CREATE TABLE `log_product_reward_points_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_reward_points_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='log đổi quà từ điểm thưởng';

-- ----------------------------
-- Table structure for log_recharge_epay
-- ----------------------------
DROP TABLE IF EXISTS `log_recharge_epay`;
CREATE TABLE `log_recharge_epay` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1: Bank local, 2: Bank global',
  `type_account` tinyint(4) NOT NULL COMMENT '1: KH, 2: KTV',
  `account_id` int(11) NOT NULL,
  `tien_nap` bigint(20) NOT NULL,
  `fee` varchar(50) NOT NULL,
  `username_send_nap` varchar(200) NOT NULL,
  `issuer_id` varchar(50) NOT NULL,
  `transaction_id` varchar(150) NOT NULL,
  `bank_code` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `is_add_money` tinyint(4) NOT NULL,
  `temp_send` varchar(300) NOT NULL,
  `mac_send` varchar(200) NOT NULL,
  `mac_receive` varchar(200) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1: yêu cầu thanh toán, 2: thành công, 3: lỗi',
  `response_send` varchar(50) DEFAULT NULL,
  `link_checkout` varchar(50) DEFAULT NULL,
  `response_receive` varchar(50) DEFAULT NULL,
  `description_send` varchar(150) DEFAULT NULL,
  `description_receive` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='lịch sử nạp tiền qua EPAY';

-- ----------------------------
-- Table structure for log_recharge_ngan_luong
-- ----------------------------
DROP TABLE IF EXISTS `log_recharge_ngan_luong`;
CREATE TABLE `log_recharge_ngan_luong` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` tinyint(4) NOT NULL COMMENT '1: Bank local, 2: Bank global',
  `type_account` tinyint(4) NOT NULL COMMENT '1: KH, 2: KTV',
  `account_id` int(11) NOT NULL,
  `tien_nap` bigint(20) NOT NULL,
  `fee` varchar(50) NOT NULL,
  `username_send_nap` varchar(200) NOT NULL,
  `merchant_id` varchar(50) NOT NULL,
  `transaction_id` varchar(150) NOT NULL,
  `bank_code` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `is_add_money` tinyint(4) NOT NULL,
  `temp_send` varchar(1000) NOT NULL,
  `status` int(11) DEFAULT NULL COMMENT '1: yêu cầu thanh toán, 2: thành công, 3: lỗi, 4: hủy thanh toán',
  `response_send` varchar(50) DEFAULT NULL,
  `response_receive` varchar(50) DEFAULT NULL,
  `description_send` varchar(300) DEFAULT NULL,
  `link_checkout` varchar(300) DEFAULT NULL,
  `token` varchar(300) DEFAULT NULL,
  `description_receive` varchar(300) DEFAULT NULL,
  `order_code` varchar(300) DEFAULT NULL,
  `order_id` varchar(300) DEFAULT NULL,
  `transaction_status` varchar(50) DEFAULT NULL COMMENT '00 - Đã thanh toán; 01 - Đã thanh toán, chờ xử lý; 02 - Chưa thanh toán',
  `transaction_id_ngan_luong` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_recharge_via_ktv
-- ----------------------------
DROP TABLE IF EXISTS `log_recharge_via_ktv`;
CREATE TABLE `log_recharge_via_ktv` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `description_response` varchar(500) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1: gửi yêu cầu, 2: thành công, 3: hủy giao dịch, 4: KTV không đủ tiền để duyệt (số tiền được phép trừ âm không đủ)',
  `is_add_money` tinyint(4) NOT NULL COMMENT '1: đã xử lý yêu cầu của KTV, 0: KTV chưa xử lý',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='lưu log yêu cầu nạp tiền qua ktv của khách hàng';

-- ----------------------------
-- Table structure for markers
-- ----------------------------
DROP TABLE IF EXISTS `markers`;
CREATE TABLE `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `address` varchar(80) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `access` int(11) DEFAULT '1',
  `access2` int(11) DEFAULT '1',
  `access3` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for menu_access
-- ----------------------------
DROP TABLE IF EXISTS `menu_access`;
CREATE TABLE `menu_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `access` int(11) DEFAULT '0' COMMENT '0:k dc;1:dc;2:dc them sua xoa',
  `access2` int(11) NOT NULL DEFAULT '0' COMMENT 'thêm, sửa',
  `access3` int(11) NOT NULL DEFAULT '0' COMMENT 'xóa',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=956 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for money_log
-- ----------------------------
DROP TABLE IF EXISTS `money_log`;
CREATE TABLE `money_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `money_old` bigint(20) DEFAULT NULL,
  `money_new` bigint(20) DEFAULT NULL,
  `money_update` bigint(20) NOT NULL DEFAULT '0',
  `description` text,
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` int(11) DEFAULT NULL COMMENT '1:ktv;2:KH',
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for nodejs_backup
-- ----------------------------
DROP TABLE IF EXISTS `nodejs_backup`;
CREATE TABLE `nodejs_backup` (
  `map_khach_hang_maintain` mediumtext,
  `map_admin_maintain` mediumtext,
  `map_pos_admin` mediumtext,
  `map_khach_hang_emergency` mediumtext,
  `map_admin_emergency` mediumtext,
  `map_pos_admin_emergency` mediumtext,
  `map_collaborator_mission` mediumtext,
  `map_khach_hang_call_collaborator` mediumtext,
  `map_collaborator_doing` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for notify
-- ----------------------------
DROP TABLE IF EXISTS `notify`;
CREATE TABLE `notify` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sender` varchar(50) NOT NULL DEFAULT '0',
  `type_account` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: Khách hàng, 2: ktv',
  `account_id` bigint(20) NOT NULL DEFAULT '0',
  `title` varchar(300) NOT NULL DEFAULT '',
  `content` varchar(1000) NOT NULL DEFAULT '',
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `is_delete` tinyint(4) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COMMENT='Chứa thông báo';

-- ----------------------------
-- Table structure for pay_cards
-- ----------------------------
DROP TABLE IF EXISTS `pay_cards`;
CREATE TABLE `pay_cards` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `trans_id` varchar(200) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `request` varchar(1000) NOT NULL,
  `response` varchar(1000) DEFAULT NULL,
  `requested_at` datetime DEFAULT NULL,
  `responsed_at` datetime DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0: cho giao dich, 1: dang giao dich 2: ket thuc giao dich',
  `created_at` datetime DEFAULT NULL,
  `response_status` int(11) DEFAULT NULL,
  `provider_code` varchar(5) NOT NULL,
  `card_code` varchar(255) NOT NULL,
  `card_seri` varchar(255) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `conversion_price` int(11) DEFAULT NULL COMMENT 'tiền cộng thực',
  `provider_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for play_evolutions
-- ----------------------------
DROP TABLE IF EXISTS `play_evolutions`;
CREATE TABLE `play_evolutions` (
  `id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `applied_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `apply_script` mediumtext,
  `revert_script` mediumtext,
  `state` varchar(255) DEFAULT NULL,
  `last_problem` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for product
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) DEFAULT '1' COMMENT '1:điện lạnh;2:điện nước;3:điện tử;4:điện máy',
  `name` varchar(255) DEFAULT NULL,
  `descriptions` varchar(3000) DEFAULT NULL,
  `link_icon` varchar(255) DEFAULT NULL,
  `price` bigint(20) NOT NULL DEFAULT '0' COMMENT 'giá tiền',
  `sale` float NOT NULL DEFAULT '0' COMMENT 'tối đa là 1 (1 <==> 100%)',
  `is_new` tinyint(4) NOT NULL DEFAULT '0',
  `shop` int(11) NOT NULL DEFAULT '1' COMMENT 'mã shop',
  `number` int(11) NOT NULL COMMENT 'số hàng còn',
  `unit` varchar(50) DEFAULT NULL,
  `is_show` tinyint(4) NOT NULL DEFAULT '1',
  `created` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COMMENT='Cung cấp các sản phẩm';

-- ----------------------------
-- Table structure for product_gift
-- ----------------------------
DROP TABLE IF EXISTS `product_gift`;
CREATE TABLE `product_gift` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '1: vật tư, 2: ưu đãi gói dịch vụ (tặng thêm thời gian, giảm giá), 3: tặng gói dịch vụ',
  `title` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `link_icon` varchar(255) NOT NULL,
  `time_event_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_event_stop` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `number_day_use` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `service_package_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='shop quà tặng';

-- ----------------------------
-- Table structure for product_ktv
-- ----------------------------
DROP TABLE IF EXISTS `product_ktv`;
CREATE TABLE `product_ktv` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='sản phẩm của các Ktv mua';

-- ----------------------------
-- Table structure for product_ktv_log_buy
-- ----------------------------
DROP TABLE IF EXISTS `product_ktv_log_buy`;
CREATE TABLE `product_ktv_log_buy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` tinyint(4) NOT NULL,
  `product_type` tinyint(4) NOT NULL,
  `money` bigint(20) NOT NULL,
  `sale` float NOT NULL,
  `created` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='log mua vật phẩm của KTV';

-- ----------------------------
-- Table structure for product_ktv_log_use
-- ----------------------------
DROP TABLE IF EXISTS `product_ktv_log_use`;
CREATE TABLE `product_ktv_log_use` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `created` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='log Ktv sử dụng của vật phẩm';

-- ----------------------------
-- Table structure for product_reward_points
-- ----------------------------
DROP TABLE IF EXISTS `product_reward_points`;
CREATE TABLE `product_reward_points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(1000) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) NOT NULL COMMENT 'giá đổi',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: có gửi xuống client, 2: không gửi xuống',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='shop đổi quà điểm thưởng';

-- ----------------------------
-- Table structure for product_type
-- ----------------------------
DROP TABLE IF EXISTS `product_type`;
CREATE TABLE `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for product_user
-- ----------------------------
DROP TABLE IF EXISTS `product_user`;
CREATE TABLE `product_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='sản phẩm của các user mua';

-- ----------------------------
-- Table structure for product_user_log_buy
-- ----------------------------
DROP TABLE IF EXISTS `product_user_log_buy`;
CREATE TABLE `product_user_log_buy` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` tinyint(4) NOT NULL,
  `product_type` tinyint(4) NOT NULL,
  `money` bigint(20) NOT NULL,
  `sale` float NOT NULL,
  `created` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='log mua vật phẩm của khách hàng';

-- ----------------------------
-- Table structure for product_user_log_use
-- ----------------------------
DROP TABLE IF EXISTS `product_user_log_use`;
CREATE TABLE `product_user_log_use` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `created` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='log khách hàng sử dụng vật phẩm';

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for read_notify_system
-- ----------------------------
DROP TABLE IF EXISTS `read_notify_system`;
CREATE TABLE `read_notify_system` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type_account` tinyint(4) NOT NULL COMMENT '1: KH, 2 KTV',
  `account_id` int(11) NOT NULL,
  `notify_system` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='lưu trạng thái thông báo hệ thống phía client đã đọc';

-- ----------------------------
-- Table structure for service
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `link_icon` varchar(200) NOT NULL,
  `link_image` varchar(200) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Chứa danh sách các dịch vụ';

-- ----------------------------
-- Table structure for service_info
-- ----------------------------
DROP TABLE IF EXISTS `service_info`;
CREATE TABLE `service_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `des` text,
  `link_icon` varchar(255) DEFAULT NULL,
  `service_package_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COMMENT='Mô tả chi tiết gói dịch vụ';

-- ----------------------------
-- Table structure for service_package
-- ----------------------------
DROP TABLE IF EXISTS `service_package`;
CREATE TABLE `service_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL COMMENT 'Gói thuê bao hộ gia đình; Gói thuê bao văn phòng; Gói thuê bao nhà hàng, khách sạn; Gói thuê bao nhà máy, xưởng; 5: Gói khuyến mãi',
  `name` varchar(255) DEFAULT NULL,
  `time_id` int(11) DEFAULT NULL COMMENT 'xem trong bảng service_package_time',
  `square_id` int(11) DEFAULT NULL,
  `des` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `sale` float DEFAULT '0' COMMENT 'số phần trăm sale: lưu số từ 0.0 đến 1.0',
  `number_maintenance` int(11) DEFAULT NULL,
  `benefit` text COMMENT 'lợi ích (quyền lợi khách hàng)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='Thông tin các gói dịch vụ';

-- ----------------------------
-- Table structure for service_package_maintenance
-- ----------------------------
DROP TABLE IF EXISTS `service_package_maintenance`;
CREATE TABLE `service_package_maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_package_user_id` int(11) DEFAULT '0',
  `des` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1: Chưa đến, 2: KTV bắt đầu đi , 3: KTV đã đến khách hàng chưa xác nhận, 4: KTV đã đến khách hàng đã xác nhận, chưa báo cáo, 5: Đã xong, 6: Bỏ qua',
  `time` bigint(20) DEFAULT '0',
  `admin_id` varchar(50) DEFAULT '' COMMENT 'danh sách các admin_id',
  `des_cancel` varchar(255) DEFAULT NULL,
  `number` tinyint(4) DEFAULT NULL COMMENT 'Số lần bảo dưỡng',
  `evaluate_admin` tinyint(4) DEFAULT '0',
  `bonus_ktv` int(11) DEFAULT '0',
  `type` int(5) DEFAULT '1' COMMENT '1:kh y.cầu,2:cms đặt lịch',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='Khách hàng đặt lịch bảo dưỡng';

-- ----------------------------
-- Table structure for service_package_maintenance_status
-- ----------------------------
DROP TABLE IF EXISTS `service_package_maintenance_status`;
CREATE TABLE `service_package_maintenance_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for service_package_square
-- ----------------------------
DROP TABLE IF EXISTS `service_package_square`;
CREATE TABLE `service_package_square` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Gói bảo trì theo diện tích';

-- ----------------------------
-- Table structure for service_package_temp_address
-- ----------------------------
DROP TABLE IF EXISTS `service_package_temp_address`;
CREATE TABLE `service_package_temp_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_package_user_id` int(11) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `province_id` varchar(6) DEFAULT NULL,
  `district_id` varchar(6) DEFAULT NULL,
  `ward_id` varchar(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT '0' COMMENT '0: KTV chưa xác nhận, 1: KTV đã xác nhận, 2: Quản lý xác nhận',
  `type` int(2) DEFAULT NULL COMMENT '1: khách hàng, 2: KTV',
  `confirm_by` int(11) DEFAULT '0' COMMENT 'Mã KTV xác nhận',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for service_package_time
-- ----------------------------
DROP TABLE IF EXISTS `service_package_time`;
CREATE TABLE `service_package_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Gói bảo trì theo thời gian';

-- ----------------------------
-- Table structure for service_package_user
-- ----------------------------
DROP TABLE IF EXISTS `service_package_user`;
CREATE TABLE `service_package_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `service_package_id` int(11) DEFAULT NULL,
  `start_time` bigint(20) DEFAULT NULL,
  `end_time` bigint(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `province_id` varchar(6) DEFAULT NULL,
  `district_id` varchar(6) DEFAULT NULL,
  `ward_id` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='Chứa danh sách các gói bảo trì của khách hàng';

-- ----------------------------
-- Table structure for sg_admin
-- ----------------------------
DROP TABLE IF EXISTS `sg_admin`;
CREATE TABLE `sg_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `command` varchar(50) DEFAULT NULL,
  `status` char(50) DEFAULT NULL COMMENT 's (điền s vào là có hiệu lực trong khoảng 30 giây)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for shop
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tbl_gcm_api_key
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gcm_api_key`;
CREATE TABLE `tbl_gcm_api_key` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `api_key` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for transaction_history_admin
-- ----------------------------
DROP TABLE IF EXISTS `transaction_history_admin`;
CREATE TABLE `transaction_history_admin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 -> 10: nạp tiền(1: nhận thưởng từ khách hàng, 2: nạp tiền từ card), >=11: trừ tiền (11: mua gói dịch vụ, 12: log mua vật phẩm, 13: thưởng tiền cho KTV)',
  `transaction_id` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: thành công, 0: thất bại',
  `price` bigint(20) NOT NULL DEFAULT '0' COMMENT 'giá tiền giao dịch',
  `descriptions` varchar(500) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='Lưu thông tin lịch sử giao dịch của Admin';

-- ----------------------------
-- Table structure for transaction_history_type
-- ----------------------------
DROP TABLE IF EXISTS `transaction_history_type`;
CREATE TABLE `transaction_history_type` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for transaction_history_user
-- ----------------------------
DROP TABLE IF EXISTS `transaction_history_user`;
CREATE TABLE `transaction_history_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 -> 10: nạp tiền(1: nhận thưởng từ khách hàng, 2: nạp tiền từ card), >=11: trừ tiền (11: mua gói dịch vụ, 12: log mua vật phẩm, 13: thưởng tiền cho KTV)',
  `transaction_id` bigint(20) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1: thành công, 0: thất bại',
  `price` bigint(20) NOT NULL DEFAULT '0' COMMENT 'giá tiền giao dịch',
  `descriptions` varchar(500) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COMMENT='Lưu thông tin lịch sử giao dịch của khách hàng';

-- ----------------------------
-- Table structure for type_card
-- ----------------------------
DROP TABLE IF EXISTS `type_card`;
CREATE TABLE `type_card` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name_card` char(50) DEFAULT NULL,
  `provider_code` char(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1: bật, 0: tắt (ẩn mờ không cho click phía client)',
  `type_card` tinyint(4) DEFAULT '0',
  `link_icon_card` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Chứa danh sách các loại thẻ nạp';

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `balance` bigint(20) DEFAULT '0' COMMENT 'tiền để thanh toán dịch vụ',
  `reward_point` int(11) DEFAULT '0' COMMENT 'điểm thưởng',
  `status` int(11) DEFAULT NULL COMMENT '1: active, 2: lock account',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fcm_token` varchar(500) DEFAULT NULL,
  `link_avatar` varchar(255) DEFAULT NULL,
  `device` tinyint(4) DEFAULT '0',
  `total_money_charging_card` bigint(20) DEFAULT '0',
  `total_money_charging_bank` bigint(20) DEFAULT '0',
  `province` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `ward` varchar(100) DEFAULT NULL,
  `province_id` varchar(50) DEFAULT NULL,
  `district_id` varchar(50) DEFAULT NULL,
  `ward_id` varchar(50) DEFAULT NULL,
  `first_login` tinyint(4) DEFAULT NULL COMMENT '1: đăng nhập lần đầu',
  `birthday` date DEFAULT NULL,
  `cancel_call_ctv` mediumint(9) DEFAULT NULL COMMENT 'số lần hủy gọi CTV',
  `cancel_call_emergency` mediumint(9) DEFAULT NULL COMMENT 'số lần hủy gọi cứu hộ',
  `ip_current` char(50) DEFAULT NULL,
  `imei` char(200) DEFAULT NULL,
  `add_money_register` tinyint(4) NOT NULL,
  `dia_chi_ktv_xac_nhan` text COMMENT 'KTV đến xác nhận địa chỉ',
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COMMENT='thông tin tài khoản người dùng';

-- ----------------------------
-- Table structure for user_cart
-- ----------------------------
DROP TABLE IF EXISTS `user_cart`;
CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `info_cart` text,
  `info_cart_wait_buy` text,
  `time_change` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Chứa thông tin giỏ hàng';

-- ----------------------------
-- Table structure for user_reset_password
-- ----------------------------
DROP TABLE IF EXISTS `user_reset_password`;
CREATE TABLE `user_reset_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `expired_time` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user_temp_address
-- ----------------------------
DROP TABLE IF EXISTS `user_temp_address`;
CREATE TABLE `user_temp_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `ward` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `province_id` varchar(10) DEFAULT NULL,
  `district_id` varchar(10) DEFAULT NULL,
  `ward_id` varchar(10) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vn_city
-- ----------------------------
DROP TABLE IF EXISTS `vn_city`;
CREATE TABLE `vn_city` (
  `id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `area` int(11) DEFAULT '1' COMMENT 'Khu vực',
  `is_show` tinyint(4) DEFAULT '0' COMMENT '1: show, 0: hidden',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Table structure for vn_district
-- ----------------------------
DROP TABLE IF EXISTS `vn_district`;
CREATE TABLE `vn_district` (
  `id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `city_id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `is_show` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for vn_ward
-- ----------------------------
DROP TABLE IF EXISTS `vn_ward`;
CREATE TABLE `vn_ward` (
  `id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `district_id` varchar(5) CHARACTER SET utf8 NOT NULL,
  `is_show` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
