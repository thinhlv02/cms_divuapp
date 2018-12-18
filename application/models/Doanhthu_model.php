<?php

Class Doanhthu_model extends MY_Model
{
    var $table = 'admin_mission';
    public function get_doanhthu($search, $date1, $date2) {
$where = '';
        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " date(`created_at`) between '".$date1."' AND '".$date2."' ";
        } else{
            $where .= ' DATE(`created_at`) = DATE(NOW()) ';
        }
//        if ($admin_id != 'all') {
////            SUBSTRING('SQL Tutorial', 1, 3)
//            $where .= " AND a.`admin_id` =   $admin_id  ";
//        }

        $sql = "SELECT
(SELECT 
  SUM(`price`) pay_cards
FROM
  `divuapp`.`pay_cards` a WHERE $where) pay_cards,
  (SELECT 
  SUM(`tien_nap`) bank
FROM
  `divuapp`.`log_recharge_ngan_luong`  WHERE $where) bank,
  (SELECT 
  SUM(`money`) 
FROM
  `divuapp`.`log_recharge_via_ktv`  WHERE $where) ktv";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}

//SELECT
//  `id`,
//  `service_package_user_id`,
//  `des`,
//  `status`,
//  `time`,
//  `admin_id`,
//  `des_cancel`,
//  `number`
//FROM
//  `divuapp`.`service_package_maintenance`
//
//WHERE id > 0 $where $limit