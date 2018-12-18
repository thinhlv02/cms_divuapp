<?php

Class Doanhthu_paycards_model extends MY_Model
{
    var $table = 'pay_cards';
    public function get_doanhthu_paycards($search, $date1, $date2) {
$where = '';
        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " date(a.`created_at`) between '".$date1."' AND '".$date2."' ";
        } else{
            $where .= ' DATE(a.`created_at`) = DATE(NOW()) ';
        }
        $sql = "SELECT 
  a.`id`,
  a.`game_id`,
  a.`trans_id`,
  a.`session_id`,
  a.`user_id`,
  a.`username`,
  a.`request`,
  a.`response`,
  a.`requested_at`,
  a.`responsed_at`,
  a.`status`,
  a.`created_at`,
  a.`response_status`,
  a.`provider_code`,
  a.`card_code`,
  a.`card_seri`,
  a.`price`,
  a.`conversion_price`,
  a.`provider_id` ,
  b.`username`,
  b.`fullname`
FROM
  `divuapp`.`pay_cards` a JOIN divuapp.`user` b ON a.`user_id` = b.`id` where $where
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}