<?php

Class Doanhthu_bank_model extends MY_Model
{
    var $table = 'log_recharge_ngan_luong';
    public function get_doanhthu_bank($search, $date1, $date2) {
$where = '';
        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " date(a.`created_at`) between '".$date1."' AND '".$date2."' ";
        } else{
            $where .= ' DATE(a.`created_at`) = DATE(NOW()) ';
        }
        $sql = "SELECT 
 a.`id`,
 a.`transaction_status`,
  a.`type`,
  a.`type_account`,
  a.`account_id`,
  a.`tien_nap`,
  a.`fee`,
  a.`username_send_nap`,
  a.`merchant_id`,
  a.`transaction_id`,
  a.`bank_code`,
  a.`bank_name`,
  a.`is_add_money`,
  a.`temp_send`,
  a.`status`,
  a.`response_send`,
  a.`response_receive`,
  a.`description_send`,
  a.`link_checkout`,
  a.`token`,
  a.`description_receive`,
  a.`order_code`,
  a.`order_id`,
  a.`created_at`,
  b.`username`,
  b.`fullname`
FROM
  `divuapp`.`log_recharge_ngan_luong` a JOIN divuapp.`user` b ON a.`account_id` = b.`id` where type_account = 1 AND $where
  union all 
  
  SELECT 
a.`id`,
a.`transaction_status`,
  a.`type`,
  a.`type_account`,
  a.`account_id`,
  a.`tien_nap`,
  a.`fee`,
  a.`username_send_nap`,
  a.`merchant_id`,
  a.`transaction_id`,
  a.`bank_code`,
  a.`bank_name`,
  a.`is_add_money`,
  a.`temp_send`,
  a.`status`,
  a.`response_send`,
  a.`response_receive`,
  a.`description_send`,
  a.`link_checkout`,
  a.`token`,
  a.`description_receive`,
  a.`order_code`,
  a.`order_id`,
  a.`created_at`,
  b.`username`,
  b.`fullname`
FROM
  `divuapp`.`log_recharge_ngan_luong` a JOIN divuapp.`admin` b ON a.`account_id` = b.`id` where type_account = 2 AND $where
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}