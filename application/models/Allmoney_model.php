<?php

/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 5/5/2018
 * Time: 9:02 AM
 */
Class Allmoney_model extends MY_Model
{
    var $table = 'user';

    public function money_server($date1, $date2,$date11,$date22)
    {
        $where = '';
//        $sql2 = "SELECT
//  b.`device`,
// b.`device_name`,
// COUNT(DISTINCT a. `ip_current`) ip,
// COUNT(DISTINCT a. `imei`) imei,
// COUNT(a.id) tong
//FROM
//  `divuapp`.`user` a JOIN divuapp.`app_info` b ON a.`device` = b.`device` where date(a.created_at) between '$date1' and '$date2'
//  $where
//   GROUP BY a.`device`";
//                echo $sql;
        $sql = "SELECT 
            (SELECT ifnull(SUM(`money`),0) FROM `divuapp`.`log_recharge_via_ktv` 
              where date(created_at) between '$date1' and '$date2') kh_nap_qua_ktv,
            (SELECT SUM(`bonus_ktv`) FROM `divuapp`.`emergency` 
                where `time` >=  " . $date11 . " AND `time` <=  " . $date22 . ") bonus_ktv_emergency,
            (SELECT SUM(`bonus_ktv`) FROM `divuapp`.`service_package_maintenance` 
                where `time`*1000 >=  " . $date11 . " AND `time`*1000 <=  " . $date22 . ") bonus_ktv_maintenance,
            (SELECT ifnull(SUM(money),0) FROM divuapp.`log_enter_introduction_code` 
            where date(created_at) between '$date1' and '$date2') money_intro,
            (SELECT ifnull(SUM(tien_nap),0) FROM log_recharge_ngan_luong where date(created_at) between '$date1' and '$date2') nap_bank,
            (SELECT ifnull(SUM(CASE WHEN admin_name <> 'Server' THEN money END),0) FROM cms_add_money_logs 
            where date(created_at) between '$date1' and '$date2' and type = 1) admin_add_kh,
            (SELECT ifnull(SUM(CASE WHEN admin_name <> 'Server' THEN money END),0) FROM cms_add_money_logs 
            where date(created_at) between '$date1' and '$date2' and type = 2) admin_add_ktv,
            (SELECT ifnull(SUM(CASE WHEN admin_name = 'Server' THEN money END),0) FROM cms_add_money_logs 
                where date(created_at) between '$date1' and '$date2' and type = 1) server_add_kh,
                (SELECT ifnull(SUM(CASE WHEN admin_name = 'Server' THEN money END),0) FROM cms_add_money_logs 
                where date(created_at) between '$date1' and '$date2' and type = 2) server_add_ktv,
            (SELECT ifnull(SUM(b.`price`),0) FROM `divuapp`.`service_package_user` a JOIN divuapp.`service_package` b 
            ON a.`service_package_id` = b.`id` 
                where `start_time`*1000 >=  " . $date11 . " AND `start_time`*1000 <=  " . $date22 . ") mua_goi_dv,
            (SELECT IFNULL(SUM(`total_money_payment`),0) FROM `divuapp`.`admin_require_payment` 
                where date(created) between '$date1' and '$date2') total_money_payment
            ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function goidv_details($date1, $date2,$date11,$date22){
        $sql = "SELECT IFNULL(SUM(b.`price`),0) money_dv, b.`name` FROM `divuapp`.`service_package_user` a 
          JOIN divuapp.`service_package` b ON a.`service_package_id` = b.`id` 
          where `start_time`*1000 >=  " . $date11 . " AND `start_time`*1000 <=  " . $date22 . "
          GROUP BY b.`id`";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function money_cart_user($date1,$date2) {
        $sql = "SELECT 
  `price`,
  `product_id_detail`
FROM
  `divuapp`.`log_payment_cart_user` where date(created) between '$date1' and '$date2'
";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function money_cart_admin($date1,$date2) {
        $sql = "SELECT 
  `price`,
  `product_id_detail`
FROM
  `divuapp`.`log_payment_cart_admin` where date(created) between '$date1' and '$date2'
";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}