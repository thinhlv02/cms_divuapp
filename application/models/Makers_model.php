<?php

Class Makers_model extends MY_Model
{
    var $table = 'markers';
    public function get_info_map() {

        $sql = "SELECT 
          a.`user_id` AS id,
          b.`fullname` AS `name`,
          a.`address` as address,
          a.`latitude` AS lat,
          a.`longitude` AS lng
        FROM
          `divuapp`.`service_package_user` a JOIN divuapp.`user` b ON a.`user_id` = b.`id` GROUP BY a.`user_id`";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}