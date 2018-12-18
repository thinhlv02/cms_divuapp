<?php

Class Log_payment_cart_user_model extends MY_Model
{
    var $table = 'log_payment_cart_user';

    public function get_info_cart_user($search, $date1, $date2, $status,$type_cart,$id)
    {
        $where = '';

        if ($id != '') {
            $where = " AND a.`id` = $id ";
        }

        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " AND date(a.`created`) between  '" . $date1 . "' AND  '" . $date2 . "' ";
        }
        if ($type_cart == 1) {
            $table1 = 'log_payment_cart_user';
            $table2 = 'user';
            $on1 = 'user_id';
        } else {
            $table1 = 'log_payment_cart_admin';
            $table2 = 'admin';
            $on1 = 'admin_id';
        }
        if ($status != 'all') {
            $where .= " AND a.status = " . $status . " ";
        }
        $limit = '';
        if ($search == 'all') {
            $limit = ' order by a.created desc limit 100';
        }
        $sql = "SELECT 
  a.`id`,
  a.`".$on1."`,
  a.`price`,
  a.`product_id_detail`,
  a.`detail_cart`,
  a.`status`,
  a.`nguoi_giao`,
  a.`detail_step`,
 a. `created` ,
 b.`username`,
 b.`phone`,
 b.`address`
FROM
  `divuapp`.`".$table1."` a JOIN divuapp.`".$table2."` b ON a.`".$on1."` = b.id where a.id > 0
  $where $limit order by a.created desc
        ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}