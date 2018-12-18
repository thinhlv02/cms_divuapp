<?php

Class Admin_emergency_model extends MY_Model
{
    var $table = 'admin_emergency';

    public function get_info_logs($search, $date1, $date2, $status, $area_id)
    {
        $where = '';

        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " AND DATE_FORMAT(FROM_UNIXTIME(SUBSTRING(a.`time`,1,10)), '%Y-%m-%d') between '".$date1."' AND '".$date2."' ";
        }
        if ($status != 0) {
            $where .= ' AND b.`status` = ' . $status . ' ';
        }
        if ($area_id != 'all') {
            $where .= ' AND e.`area` = ' . $area_id . ' ';
        }
//        $limit = '';
        if ($search == 'all') {
            $limit = ' order by a.time desc limit 100';
        } else {
            $limit = ' order by a.time desc';
        }
//        $sql_old = "SELECT a.`id`, a.`service_package_user_id`, a.`des`, a.`status`, a.`images`,
//a.`time`, a. `partner_id` admin_id, a.`des_cancel` , c.`username`, c.`fullname`,c.district_id,c.province_id,
//b.`address`, d.`name` name_status FROM
//`divuapp`.`emergency` a JOIN divuapp.`service_package_user` b ON a.`service_package_user_id` = b.`id` JOIN
//divuapp.`user` c ON b.`user_id` = c.`id` JOIN divuapp.`service_package_maintenance_status` d ON a.`status` = d.`id`
//JOIN divuapp.`vn_city` e ON c.`province_id` = e.`id`
//WHERE a.id > 0  $where $limit
//        ";

        $sql = "SELECT a.`id`, a.`service_package_user_id`, a.`des`, a.`status`, a.`images`,
a.`time`, a. `partner_id` admin_id, a.`des_cancel` , c.`username`, c.`fullname`,c.district_id,c.province_id, 
a.`address`, d.`name` name_status FROM 
`divuapp`.`emergency` a JOIN 
divuapp.`user` c ON a.`user_id` = c.`id` JOIN divuapp.`service_package_maintenance_status` d ON a.`status` = d.`id`
JOIN divuapp.`vn_city` e ON c.`province_id` = e.`id`
WHERE a.id > 0  $where $limit
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
              a.`user_id`,
              a.`des`,
              a.`images`,
              c.`username`,
              c.`fullname`,
              c.`address`,
              c.`phone`
            FROM
              `divuapp`.`emergency` a JOIN divuapp.`user` c ON a.`user_id` = c.id WHERE a.id = $id
        ";
        //        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function dropdown_menu_list()
    {
        $sql = "
SELECT * FROM (  
  SELECT pass1.* FROM 
 (SELECT a.id,
  a.`user_id`,
  b.`fullname`,
  b.`link_avatar`,
  a.`des`,
   LENGTH(a.`time`) `leng`,
  SUBSTR(a.`time`,1,10) `time`
FROM
  `divuapp`.`emergency` a JOIN divuapp.`user` b ON a.`user_id` = b.id ORDER BY TIME DESC LIMIT 10
) AS pass1
UNION ALL 
SELECT pass2.* FROM 
  (  SELECT 
  a.`id`,
  b.`user_id`,
  c.`fullname`,
  c.`link_avatar`,
  a.`des`,
  LENGTH(a.`time`) `leng`,
  a.`time`
FROM
  `divuapp`.`service_package_maintenance` a 
  JOIN divuapp.`service_package_user` b ON a.`service_package_user_id` = b.`id`  
  JOIN divuapp.`user` c ON b.`user_id` = c.`id`
  ORDER BY TIME DESC LIMIT 10
  ) AS pass2 ) p ORDER BY p.time DESC
  
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function NewEmergency($id)
    {
        $sql = "SELECT a.id,
          a.`user_id`,
          b.`fullname`,
          b.`phone`,
          b.`address`,
          a.`des`,
          a.`des_cancel`,
          a.images,
          SUBSTR(a.`time`,1,10) `time`
        FROM
          `divuapp`.`emergency` a JOIN divuapp.`user` b ON a.`user_id` = b.id WHERE a.`id` = $id
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function ChangeMaintenance($id)
    {
        $sql = "SELECT 
  a.`id`,
  b.`user_id`,
  c.`fullname`,
   c.`address`,
  c.`phone`,
  a.`des`,
  a.`time`
FROM
  `divuapp`.`service_package_maintenance` a 
  JOIN divuapp.`service_package_user` b ON a.`service_package_user_id` = b.`id`  
  JOIN divuapp.`user` c ON b.`user_id` = c.`id` WHERE a.`id` = $id
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}