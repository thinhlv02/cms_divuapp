<?php

Class Cms_add_money_logs_model extends MY_Model
{
    var $table = 'cms_add_money_logs';

    public function get_add_money_logs($search, $date1, $date2,$type,$sub,$money_id,$userid) {
        $where = '';
        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " AND date(a.`created_at`) between '".$date1."' AND '".$date2."' ";
        } else{
            $where .= ' AND DATE(a.`created_at`) = DATE(NOW()) ';
        }
        if ($type != 'all') {
            $where .= " AND a.`type` =   $type  ";
        }
        if ($sub != 'all') {
            $where .= " AND a.`sub` =   $sub  ";
        }
        if ($money_id != 'all') {
            $where .= " AND a.`money_id` =   $money_id  ";
        }
        if ($userid != '') {
            $where .= " AND a.`userid` =   $userid  ";
        }
        $sql = "SELECT 
          a.`id`,
          a.`admin_name`,
          a.`type`,
          a.`userid`,
         a. `note`,
          a.`money_id`,
         a. `money`,
          a.`sub`,
          a.`created_at` ,
          b.`name` money_name,
          c.`username`
        FROM
          `divuapp`.`cms_add_money_logs` a JOIN divuapp.`cms_config_payment_money` b ON 
          a.`money_id` = b.`id` 
          join divuapp.user c on a.userid = c.id
          where a.id > 0 $where";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}