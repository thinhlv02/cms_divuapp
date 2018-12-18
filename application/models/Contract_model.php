<?php

Class Contract_model extends MY_Model
{
    var $table = '';

    public function contract_arr($date1,$date2,$dcm_tr,$parent_id, $time_id) {
        $where = '';
        if ($parent_id != 'all') {
            $where = " AND b.parent_id = $parent_id ";
        }
        if ($time_id != 'all') {
            $where .= " AND b.time_id = $time_id ";
        }
        if (!empty($dcm_tr)) {
            $where .= " AND c.province_id IN (".$dcm_tr.") ";
        }
        $sql = "SELECT 
  a.`id`,
  b.`id` service_package_id,
  b.`name`,
  b.`price`,
  a.`user_id`,
  c.`fullname`,
  c.`address`,
  c.`email`,
  c.`phone`,
  a.`start_time`,
  a.`end_time`,
  d.`name` limit_time
FROM
  `divuapp`.`service_package_user` a JOIN divuapp.`service_package` b ON a.`service_package_id` = b.`id`
  JOIN divuapp.`user` c ON a.`user_id` = c.`id`
  JOIN divuapp.`service_package_time` d ON b.`time_id` = d.`id` where 
          a.`start_time` >= $date1 AND a.`start_time` <= $date2 $where
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function list_search()
    {
        $sql = "SELECT 
          a.`id`,
         a. `parent_id`,
          a.`name`,
          a.`time_id`,
          b.`name` name_time
        FROM
          `divuapp`.`service_package` a JOIN divuapp.`service_package_time` b ON
  a.`time_id` = b.id GROUP BY `parent_id`";
        //        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();

    }


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
  a.`longitude`,
 a. `appointment_time` 
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