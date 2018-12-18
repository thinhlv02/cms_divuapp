<?php

Class Transaction_history_model extends MY_Model
{
    var $table = 'transaction_history_user';

    public function get_info_transaction_history($search, $date1, $date2, $status,$type_cart,$userid,$username)
    {
        $where = '';

        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " AND date(a.`created_time`) between  '" . $date1 . "' AND  '" . $date2 . "' ";
        }
        if ($type_cart == 1) {
            $table1 = 'transaction_history_user';
            $table2 = 'user';
            $on1 = 'user_id';
        } else {
            $table1 = 'transaction_history_admin';
            $table2 = 'admin';
            $on1 = 'admin_id';
        }
        if ($status != 'all') {
            $where .= " AND a.status = " . $status . " ";
        }
        if ($userid != '') {
            $where .= " AND b.id = " . $userid . " ";
        }

        if ($username != '') {
            $where .= " AND b.username = '" . $username . "' ";
        }
        $limit = '';
        if ($search == 'all') {
            $limit = ' order by a.created_time desc limit 100';
        }
        $sql = " SELECT  a.`id`,
  a.`".$on1."`,
  b.`username`,
  a.`type`,
  a.`transaction_id`,
  a.`status`,
  a.`price`,
  a.`descriptions`,
  a.`created_time` ,
 b.`fullname`,
 b.`address`
FROM
  `divuapp`.`".$table1."` a JOIN divuapp.`".$table2."` b ON a.`".$on1."` = b.id where a.id > 0
  $where $limit order by a.created_time desc
        ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}