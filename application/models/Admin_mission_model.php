<?php

Class Admin_mission_model extends MY_Model
{
    var $table = 'admin_mission';

    public function get_info_logs($search, $date1, $date2, $status, $area_id)
    {
        $where = '';
        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " AND DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time`,1,10)), '%Y-%m-%d') between '" . $date1 . "' AND '" . $date2 . "' ";
        }
        if ($status != 0) {
            $where .= ' AND b.`status` = ' . $status . ' ';
        }

        if ($area_id != 'all') {
            $where .= ' AND e.`area` = ' . $area_id . ' ';
        }
        $limit = '';
        if ($search == 'all') {
            $limit = ' order by a.time desc limit 100';
        }
        $sql = "SELECT a.`id`, a.`service_package_user_id`, a.`des`, a.`status`, 
a.`time`, a. `admin_id`, a.`des_cancel`, a.`number` , c.`username`, c.`fullname`,c.district_id,c.province_id,
 b.`address`, d.`name` name_status,
 f.name service_package_name FROM 
`divuapp`.`service_package_maintenance` a JOIN divuapp.`service_package_user` b ON a.`service_package_user_id` = b.`id` JOIN 
divuapp.`user` c ON b.`user_id` = c.`id` JOIN divuapp.`service_package_maintenance_status` d ON a.`status` = d.`id`
JOIN divuapp.`vn_city` e ON c.`province_id` = e.`id`
join service_package f on b.service_package_id = f.id
WHERE a.id > 0 and a.type = 1  $where $limit
        ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function get_info_user($id)
    {
        $sql = "
            SELECT 
  a.`id`,
  a.`service_package_user_id`,
  a.`des`,
  b.`user_id`,
  c.`username`,
  c.`fullname`,
  c.`address`,
  c.`phone`
FROM
  `divuapp`.`service_package_maintenance` a JOIN divuapp.`service_package_user` b ON
  a.`service_package_user_id` = b.id JOIN divuapp.`user` c ON b.`user_id` = c.id WHERE a.id = $id 
        ";
        //        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function regular_appointments_list($search, $date1, $status, $area_id)
    {
        $where = '';
        if ($date1 != 'all') {
//            $where .= " AND DATE_FORMAT(FROM_UNIXTIME(b.`start_time`), '%Y-%m-%d') between '".$date1."' AND '".$date2."' ";
//            $where .= " AND DATE_FORMAT(FROM_UNIXTIME(b.`start_time`), '%Y-%m') = '" . date('Y-m', strtotime($date1)) . "' ";
            $where .= " AND DATE_FORMAT(FROM_UNIXTIME(b.`start_time`), '%Y-%m') <= '" . date('Y-m', strtotime($date1)) . "'
             AND DATE_FORMAT(FROM_UNIXTIME(b.`end_time`), '%Y-%m') >= '" . date('Y-m', strtotime($date1)) . "'
             ";
        }
        if ($status != 0) {
            $where .= ' AND b.`status` = ' . $status . ' ';
        }

//        if ($area_id != 'all') {
//            $where .= ' AND e.`area` = ' . $area_id . ' ';
//        }
        $limit = '';
        if ($search == 'all') {
            $limit = ' order by a.time desc limit 100';
        }
        $sql = "SELECT b.`id`, b.user_id, c.`username`, c.`fullname`,c.district_id,
 b.`address`,e.name name_district,b.service_package_id FROM divuapp.`service_package_user` b  JOIN 
divuapp.`user` c ON b.`user_id` = c.`id` 
JOIN divuapp.`vn_district` e ON b.`district_id` = e.`id`
WHERE b.id > 0  $where $limit
        ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}