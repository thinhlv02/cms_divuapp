<?php

Class Info_search_model extends MY_Model
{
    var $table = '';

    public function get_info_search($type_cart, $userid, $username, $phone, $fullname)
    {
        $where = '';

//        if ($date1 != 'all' && $date2 != 'all') {
//            $where .= " AND date(a.`created_time`) between  '" . $date1 . "' AND  '" . $date2 . "' ";
//        }
        if ($type_cart == 1) {
            $table1 = 'user';
//            $table2 = 'user';
//            $on1 = 'user_id';
        } else {
            $table1 = 'admin';
//            $table2 = 'admin';
//            $on1 = 'admin_id';
        }
        if ($userid != '') {
            $where .= " AND a.id = " . $userid . " ";
        }
        if ($username != '') {
            $where .= " AND a.username = '" . $username . "' ";
        }
        if ($fullname != '') {
            $where .= " AND a.fullname = '" . $fullname . "' ";
        }
        if ($phone != '') {
            $where .= " AND a.phone = " . $phone . " ";
        }
//        $limit = '';
//        if ($search == 'all') {
//            $limit = ' order by a.created_time desc limit 100';
//        }
        $sql = " SELECT   * FROM `divuapp`.`" . $table1 . "` a where a.id > 0 $where
        ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

//    public function get_info_search2($userid)
    public function get_info_search2($type_cart, $userid, $username, $phone, $fullname)
    {
        $where = '';
        if ($userid != '') {
            $where .= " AND a.user_id = " . $userid . " ";
        }
        if ($username != '') {
            $where .= " AND c.username = '" . $username . "' ";
        }
        if ($fullname != '') {
            $where .= " AND c.fullname = '" . $fullname . "' ";
        }
        if ($phone != '') {
            $where .= " AND c.phone = " . $phone . " ";
        }
        $sql = "SELECT 
          a.`id`,
          a.`user_id`,
          a.`service_package_id`,
          b.`name`,
         a. `start_time`,
          a.`end_time`,
         a. `address`,
          a.`latitude`,
          a.`longitude`, 
          c.`fullname` 
        FROM
          `divuapp`.`service_package_user` a 
          JOIN divuapp.`service_package` b ON a.`service_package_id` = b.`id`   
          JOIN divuapp.`user` c ON a.`user_id` = c.`id` WHERE a.id > 0 $where ";
        //        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function get_info_search3($id)
    {
        $sql = "SELECT 
  a.`id`,
  `service_package_user_id`,
  `des`,
  `status`,
  `time`,
  a.`admin_id`,
  `des_cancel`,
  `number`,
  `evaluate_admin`,
  `bonus_ktv` ,
  b.`name`
FROM
  `divuapp`.`service_package_maintenance` a 
  JOIN divuapp.`service_package_maintenance_status` b ON a.`status` = b.id
  WHERE a.`service_package_user_id` = $id

";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}