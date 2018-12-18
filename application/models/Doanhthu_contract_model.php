<?php

Class Doanhthu_contract_model extends MY_Model
{
    var $table = 'cms_doanhthu_contract';
    public function get_doanhthu_contract($search, $date1, $date2) {
$where = '';
        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " date(a.`time_topup`) between '".$date1."' AND '".$date2."' ";
        } else{
            $where .= ' DATE(a.`time_topup`) = DATE(NOW()) ';
        }
        $sql = "SELECT 
  a.`id`,
  a.`user_id`,
  a.`money`,
  a.`description`,
  a.`description_response`,
  a.`admin_id`,
  a.`status`,
  a.`is_add_money`,
  a.`time_topup`,
  a.`created_at` ,
  b.`username`,
  b.`fullname`
FROM
  `divuapp`.`cms_doanhthu_contract` a JOIN divuapp.`user` b ON a.`user_id` = b.`id` where $where
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}