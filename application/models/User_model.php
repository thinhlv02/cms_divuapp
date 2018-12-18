<?php

/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 5/5/2018
 * Time: 9:02 AM
 */
Class User_model extends MY_Model
{
    var $table = 'user';

    public function user_tq($date1, $date2, $province_id, $district_id, $dcm_tr)
    {
        $where = '';
        if ($province_id != 'all') {
            $where .= ' AND province_id = ' . $province_id . ' ';
        }
        if ($district_id != 'all') {
            $where .= ' AND district_id = ' . $district_id . ' ';
        }
        if ($dcm_tr != 'all') {
            $where .= ' AND province_id in (' . $dcm_tr . ') ';
        }
        $sql = "SELECT 
  b.`device`,
 b.`device_name`,
 COUNT(DISTINCT a. `ip_current`) ip,
 COUNT(DISTINCT a. `imei`) imei,
 COUNT(a.id) tong
FROM
  `divuapp`.`user` a JOIN divuapp.`app_info` b ON a.`device` = b.`device` where date(a.created_at) between '$date1' and '$date2'
  $where
   GROUP BY a.`device`";

//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function user_thuc($date1, $date2, $province_id, $district_id, $dcm_tr, $a)
    {
        $query_thuc = "
            SELECT COUNT(device) user_thuc,device,device_name, thoigian FROM
             (SELECT DISTINCT `divuapp`.`user`.`imei`, `divuapp`.`app_info`.`device`, `divuapp`.`app_info`.`device_name`, 
             DATE(`divuapp`.`user`.`created_at`) thoigian FROM `divuapp`.`user` JOIN 
             `divuapp`.`app_info` ON `divuapp`.`user`.`device` = `divuapp`.`app_info`.`device` WHERE 
             DATE(user.`created_at`) = '$a' AND imei NOT IN (SELECT imei FROM `divuapp`.`user` 
             WHERE DATE(user.`created_at`) < '$a' )) p GROUP BY device
        ";
//        echo $query_thuc;
        $rows = $this->db->query($query_thuc);
        return $rows->result();
    }

    public function get_list_user($date1, $date2, $province_id, $vn_district, $dcm_tr, $recipient_id_post)
    {
        $where = '';
        $where .= " AND date(a.created_at) between '$date1' and '$date2'  ";
        if ($province_id != 'all') {
            $where .= ' AND a.province_id = ' . $province_id . ' ';
        }
        if ($vn_district != 'all') {
            $where .= ' AND a.district_id = ' . $vn_district . ' ';
        }
        if ($dcm_tr != 'all') {
            $where .= ' AND a.province_id in (' . $dcm_tr . ') ';
        }
        if ($recipient_id_post != 'all') {
//            $where .= ' AND c.`phone` = "' . $phone_intro . '" ';
            $re = explode('|',$recipient_id_post);
            $where .= ' AND b.`recipient_id` = '.$re[0].' ';
            $where .= ' AND b.`recipient_type` = '.$re[1].' ';
        }
        $sql12 = "SELECT
  a.`id`,
  b.`admin_id`,
  c.`phone` phone_intro,
  a.`username`,
  a.`password`,
 a. `fullname`,
  a.`phone`,
  a.`email`,
  a.`address`,
  a.`rank`,
  a.`score`,
  a.`balance`,
  a.`reward_point`,
  a.`status`,
  a.`created_at`,
  a.`fcm_token`,
  a.`link_avatar`,
  a.`device`,
  a.`total_money_charging_card`,
  a.`total_money_charging_bank`,
  a.`province`,
  a.`district`,
  a.`ward`,
 a. `province_id`,
  a.`district_id`,
  a.`ward_id`,
  a.`first_login`,
  a.`birthday`,
  a.`cancel_call_ctv`,
  a.`cancel_call_emergency`,
  a.`ip_current`,
 a. `imei`,
  a.`add_money_register`,
  a.`dia_chi_ktv_xac_nhan`
FROM
  `divuapp`.`user` a LEFT JOIN divuapp.`log_enter_introduction_code` b ON a.`id` = b.`user_id`
  LEFT JOIN divuapp.`admin` c ON b.`admin_id` = c.`id` where a.id > 0 $where
";

        $sql = "SELECT
  a.`id`,
  b.`recipient_id`,
  b.`recipient_type`,
  a.`username`,
  a.`password`,
 a. `fullname`,
  a.`phone`,
  a.`email`,
  a.`address`,
  a.`rank`,
  a.`score`,
  a.`balance`,
  a.`reward_point`,
  a.`status`,
  a.`created_at`,
  a.`fcm_token`,
  a.`link_avatar`,
  a.`device`,
  a.`total_money_charging_card`,
  a.`total_money_charging_bank`,
  a.`province`,
  a.`district`,
  a.`ward`,
 a. `province_id`,
  a.`district_id`,
  a.`ward_id`,
  a.`first_login`,
  a.`birthday`,
  a.`cancel_call_ctv`,
  a.`cancel_call_emergency`,
  a.`ip_current`,
 a. `imei`,
  a.`add_money_register`,
  a.`dia_chi_ktv_xac_nhan`
FROM
  `divuapp`.`user` a LEFT JOIN divuapp.`log_enter_introduction_code` b ON a.`id` = b.`user_id`
   where a.id > 0 $where
";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function get_list_id_intro($phone)
    {
        $sql = "
SELECT * FROM (
SELECT a.`id`,a.`fullname`,a.`phone` FROM divuapp.`admin` a WHERE a.level IN(3,4,6) AND a.username <> 'admin'
UNION ALL
SELECT b.id,b.fullname,b.phone FROM divuapp.`user`  b) p
WHERE p.phone = '" . $phone . "'  ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();

    }
}