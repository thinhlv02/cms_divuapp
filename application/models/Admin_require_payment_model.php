<?php
/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 5/5/2018
 * Time: 9:02 AM
 */
Class Admin_require_payment_model extends MY_Model
{
    var $table = 'admin_require_payment';

    function get_admin_require($search, $date1, $date2, $status) {
        $where = '';

        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " AND date(a.`created`) between  '" . $date1 . "' AND  '" . $date2 . "' ";
        }
        if ($status != 'all') {
            $where .= " AND a.status = " . $status . " ";
        }
        $limit = '';
        if ($search == 'all') {
            $limit = ' order by a.created_time desc limit 100';
        }
        $sql = "
        SELECT 
  a.`id`,
  a.`admin_id`,
  a.`level`,
 a. `type`,
  a.`balance_wait_payment`,
  a.`bonus_wait_payment`,
  a.`bonus_introduce_customer_wait_payment`,
  a.`total_money_payment`,
  a.`vnd`,
  a.`conversion_rate`,
  a.`account_bank_admin_id`,
 a. `description`,
  a.`bank_info`,
  a.`status`,
  a.`created`,
  b.`username`,
  b.`fullname`, 
  b.`address`, 
  b.`address` 
FROM
  `divuapp`.`admin_require_payment` a JOIN divuapp.`admin` b ON a.`admin_id` = b.`id`
  where a.id > 0 $where
        ";

        $rows = $this->db->query($sql);
        return $rows->result();
    }
}