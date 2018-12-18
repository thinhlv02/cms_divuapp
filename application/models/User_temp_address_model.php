<?php

/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 5/5/2018
 * Time: 9:02 AM
 */
Class User_temp_address_model extends MY_Model
{
    var $table = 'user_temp_address';

    public function edit_address($user_id)
    {
        $where = '';
        if ($user_id != '') {
            $where = " WHERE a.`user_id` = $user_id ";
        }
        $sql = "
            SELECT 
  a.`id`,
  a.`user_id`,
  a.`province`,
  a.`district`,
  a.`ward`,
  a.`address`,
  a.`province_id`,
  a.`district_id`,
  a.`ward_id`,
  a.`latitude`,
  a.`longitude`,
  b.`fullname`,
  b.`username`, 
  b.`phone` 
FROM
  `divuapp`.`user_temp_address` a JOIN divuapp.`user` b ON a.`user_id` = b.id $where
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    public function change_service_package($user_id, $address, $latitude, $longitude)
    {
        $sql = "UPDATE 
              `divuapp`.`service_package_user` 
            SET
              `address` = '$address',
              `latitude` = '$latitude',
              `longitude` = '$longitude'
            WHERE `user_id` = $user_id AND service_package_id IN (6,7);
";
//        echo $sql;
        $rows = $this->db->query($sql);
//        return $rows->result();
    }
}