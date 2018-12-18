<?php
/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 5/5/2018
 * Time: 9:02 AM
 */
Class Information_model extends MY_Model
{
    var $table = 'information';

    public function get_info3()
    {
        $sql = "SELECT 
  a.`id`,
  a.`content`,
  a.`type`,
  a.`created`,
  a.`service_package_id` ,
  b.`name`,b.`icon`
FROM
  `divuapp`.`information` a JOIN divuapp.`service_package` b ON a.`service_package_id` = b.`id` WHERE a.`type` = 3
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}