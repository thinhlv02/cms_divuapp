<?php

Class Technician_jobs_model extends MY_Model
{
    var $table = 'admin_mission';

//    public function get_info_logs($search, $date1, $date2, $status)
//    {
//        $where = '';
//
//        if ($date1 != 'all' && $date2 != 'all') {
//            $where .= " AND a.`time` >=  " . $date1 . " AND a.`time` <=  " . $date2 . " ";
//        }
//        if ($status != 0) {
//            $where .= ' AND b.`status` = ' . $status . ' ';
//        }
//        $limit = '';
//        if ($search == 'all') {
//            $limit = ' order by a.time desc limit 100';
//        }
//        $sql = "SELECT a.`id`, a.`service_package_user_id`, a.`des`, a.`status`,
//a.`time`, a. `admin_id`, a.`des_cancel`, a.`number` , c.`username`, c.`fullname`, b.`address`, d.`name` name_status FROM
//`divuapp`.`service_package_maintenance` a JOIN divuapp.`service_package_user` b ON a.`service_package_user_id` = b.`id` JOIN
//divuapp.`user` c ON b.`user_id` = c.`id` JOIN divuapp.`service_package_maintenance_status` d ON a.`status` = d.`id`
//WHERE a.id > 0  $where $limit
//        ";
////        echo $sql;
//        $rows = $this->db->query($sql);
//        return $rows->result();
//    }

    public function get_info_mission($search, $date1, $date2, $admin_id, $service_package_maintenance_status)
    {
        $where = $where2 = '';
        if ($date1 != 'all' && $date2 != 'all') {
//            $where2 .= " AND SUBSTRING(a.`time_start_go`, 1, 10) >=  " . $date1 . " AND SUBSTRING(a.`time_start_go`, 1, 10) <=  " . $date2 . " ";
            $where .= " AND b.time >=  " . $date1 . " AND b.time <=  " . $date2 . " ";
            $where2 .= " AND SUBSTRING(b.time,1,10) >=  " . $date1 . " AND SUBSTRING(b.time,1,10) <=  " . $date2 . " ";
        }
        if ($admin_id != 'all') {
            $where .= " AND a.`admin_id` = $admin_id  ";
            $where2 .= " AND a.`admin_id` = $admin_id  ";
        }
        if ($service_package_maintenance_status != 'all') {
            $where .= " AND f.`id` =   $service_package_maintenance_status  ";
            $where2 .= " AND f.`id` =   $service_package_maintenance_status  ";
        }
//        $limit = '';
        if ($search == 'all') {
//            $date1 = date('Y-m-d') . ' 00:00:00';
            $date11 = date('Y-m-d');
//            pre($date1);
            $date11 = new DateTime($date11);
            $date11 = $date11->getTimestamp();
//            $where .= " AND SUBSTRING(a.`time_start_go`, 1, 10) =  " . $date11 . " ";
            $where .= " AND b.time =  " . $date11 . " ";
            $where2 .= " AND substring(b.time,1,10) =  " . $date11 . " ";

//            $limit = ' order by a.time_start_go desc limit 100';
        }
        $sql = "SELECT 
          a.`id`,
          b.`status`,
          a.`admin_id`,
          a.`name`,
          a.`position_start`,
         a. `time_start_go`,
         a. `time_start_job`,
          a.`time_end`,
         a. `so_sao`,
         a. `khach_hang_danh_gia` ,
         b.`des`,
         b.`time`,
         b.`bonus_ktv`,
         c.`fullname` fullname_admin,
         c.`district_work_id`,
         d.`address`,
         e.`name` name_package, f.`name` name_status, g.`phone`, g.`fullname`
        FROM
          `divuapp`.`admin_mission` a 
          JOIN divuapp.`service_package_maintenance` b ON a.`service_package_maintenance_id` = b.id 
          JOIN divuapp.`admin` c ON a.`admin_id` = c.`id` 
          JOIN divuapp.`service_package_user` d ON b.`service_package_user_id` = d.`id` 
          JOIN divuapp.`service_package` e ON d.`service_package_id` = e.`id` 
          JOIN divuapp.`service_package_maintenance_status` f ON b.`status` = f.`id`
          JOIN divuapp.`user` g ON d.`user_id` = g.`id`
          $where
          
          union all 
          
          SELECT 
              a.`id`,
              b.`status`,
              a.`admin_id`,
             b.`des` `name`,
              a.`position_start`,
              a.`time_start_go`,
              a.`time_start_job`,
                a.`time_end`,
              a.`so_sao`,
                a.`khach_hang_danh_gia`,
              b.`des` , 
              SUBSTRING(b.`time`,1,10) `time` , 
              b.`bonus_ktv`,
              c.`fullname` fullname_admin,
              c.`district_work_id`,
               d.`address`,
                e.`name` name_package, f.`name` name_status, g.`phone`, g.`fullname`
            FROM
              `divuapp`.`admin_emergency` a JOIN divuapp.`emergency` b ON a.`emergency_id` = b.`id`
              JOIN divuapp.`admin` c ON a.`admin_id` = c.`id` 
              JOIN divuapp.`service_package_user` d ON b.`service_package_user_id` = d.`id`
               JOIN divuapp.`service_package` e ON d.`service_package_id` = e.`id` 
              JOIN divuapp.`service_package_maintenance_status` f ON b.`status` = f.`id`
              JOIN divuapp.`user` g ON d.`user_id` = g.`id` $where2
   ";
        //echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    function bcc_chitiet_tq($date1, $admin_id)
    {
        $where = $where2 = '';
        $where .= " AND DATE_FORMAT(FROM_UNIXTIME(b.time), '%Y-%m-%d') =  '" . $date1 . "'  ";
        $where2 .= " AND DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(b.time,1,10)), '%Y-%m-%d') =  '" . $date1 . "' ";
//        if ($admin_id != 'all') {
        $where .= " AND a.`admin_id` = $admin_id  ";
        $where2 .= " AND a.`admin_id` = $admin_id  ";
//        }
//        $limit = '';

        $sql = "select * from (SELECT 
          a.`id`,
          b.`status`,
          a.`admin_id`,
          a.`name`,
          a.`position_start`,
         DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time_start_go`,1,10)), '%Y-%m-%d %H:%i:%s') `time_start_go`,
         DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time_start_job`,1,10)), '%Y-%m-%d %H:%i:%s') `time_start_job`,
         DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time_end`,1,10)), '%Y-%m-%d %H:%i:%s') `time_end`,
         a. `so_sao`,
         a. `khach_hang_danh_gia` ,
         b.`des`,
        DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(b.`time`,1,10)), '%Y-%m-%d %H:%i:%s') `time`,
         b.`bonus_ktv`,
         c.`fullname` fullname_admin,
         c.`district_work_id`,
         d.`address`,
         e.`name` name_package, f.`name` name_status, g.`phone`, g.`fullname`,d.`user_id`
        FROM
          `divuapp`.`admin_mission` a 
          JOIN divuapp.`service_package_maintenance` b ON a.`service_package_maintenance_id` = b.id 
          JOIN divuapp.`admin` c ON a.`admin_id` = c.`id` 
          JOIN divuapp.`service_package_user` d ON b.`service_package_user_id` = d.`id` 
          JOIN divuapp.`service_package` e ON d.`service_package_id` = e.`id` 
          JOIN divuapp.`service_package_maintenance_status` f ON b.`status` = f.`id`
          JOIN divuapp.`user` g ON d.`user_id` = g.`id`
          $where
          
          union all
          SELECT 
              a.`id`,
              b.`status`,
              a.`admin_id`,
             b.`des` `name`,
              a.`position_start`,
          DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time_start_go`,1,10)), '%Y-%m-%d %H:%i:%s') `time_start_go`,
         DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time_start_job`,1,10)), '%Y-%m-%d %H:%i:%s') `time_start_job`,
         DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time_end`,1,10)), '%Y-%m-%d %H:%i:%s') `time_end`,
              a.`so_sao`,
                a.`khach_hang_danh_gia`,
              b.`des` , 
                DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(b.`time`,1,10)), '%Y-%m-%d %H:%i:%s') `time`,

              b.`bonus_ktv`,
              c.`fullname` fullname_admin,
              c.`district_work_id`,
               d.`address`,
                e.`name` name_package, f.`name` name_status, g.`phone`, g.`fullname`,d.`user_id`
            FROM
              `divuapp`.`admin_emergency` a JOIN divuapp.`emergency` b ON a.`emergency_id` = b.`id`
              JOIN divuapp.`admin` c ON a.`admin_id` = c.`id` 
              JOIN divuapp.`service_package_user` d ON b.`service_package_user_id` = d.`id`
               JOIN divuapp.`service_package` e ON d.`service_package_id` = e.`id` 
              JOIN divuapp.`service_package_maintenance_status` f ON b.`status` = f.`id`
              JOIN divuapp.`user` g ON d.`user_id` = g.`id` $where2 ) p order by date(p.time_start_go) asc 
   ";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}