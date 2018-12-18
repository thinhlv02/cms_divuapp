<?php

Class General_customers_model extends MY_Model
{
    var $table = '';

    public function general_customers($vn_city,$vn_district,$userid, $username, $phone, $fullname)
    {
        $where = '';

//        if ($date1 != 'all' && $date2 != 'all') {
//            $where .= " AND date(a.`created_time`) between  '" . $date1 . "' AND  '" . $date2 . "' ";
//        }
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
        if ($vn_city != 'all') {
            $where .= " AND a.province_id = " . $vn_city . " ";
        }
        if ($vn_district != 'all') {
            $where .= " AND a.district_id = " . $vn_district . " ";
        }
//        $limit = '';
//        if ($search == 'all') {
//            $limit = ' order by a.created_time desc limit 100';
//        }
        $sql = " SELECT * FROM `divuapp`.`user` a where a.id > 0 $where
        ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function general_customers2($userid)
    {
        $sql = "SELECT 
  a.`id`,
  a.`user_id`,
  a.`service_package_id`,
  b.`name`,
 a. `start_time`,
  a.`end_time`,
 a. `address`,
  a.`latitude`,
  a.`longitude` 
FROM
  `divuapp`.`service_package_user` a JOIN divuapp.`service_package` b ON a.`service_package_id` = b.`id` WHERE a.`user_id` = $userid";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function general_customers3($id)
    {
        $sql = "SELECT a.`id`, `service_package_user_id`, `des`, a.`status`,
 `time`, a.`admin_id`, `des_cancel`, `number`, `evaluate_admin`, `bonus_ktv` 
 , b.`name`,c.`fullname`, d.`time_end`,d.`so_sao`,d.`khach_hang_danh_gia`,a.`bonus_ktv` FROM `divuapp`.`service_package_maintenance` a 
 JOIN divuapp.`service_package_maintenance_status` b ON a.`status` = b.id 
 JOIN divuapp.`admin` c ON a.`admin_id` = c.id
 JOIN divuapp.`admin_mission` d ON a.`id` = d.`service_package_maintenance_id`
  WHERE a.`service_package_user_id` = $id
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function get_list_details1($id) {
        $sql = "SELECT 
  a.`id`,
  b.`name` name_stt,
  a.`service_package_user_id`,
  a.`des`,
  a.`status`,
  a.`time`,
  a.`admin_id`,
  a.`des_cancel`,
  a.`number`,
  a.`evaluate_admin`,
  a.`bonus_ktv` 
FROM
  `divuapp`.`service_package_maintenance` a JOIN divuapp.`service_package_maintenance_status` b ON a.`status` = b.`id`
  WHERE a.`id` = $id
        ";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}