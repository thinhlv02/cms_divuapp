<?php
/**
 * Created by PhpStorm.
 * User: conga1411
 * Date: 5/5/2018
 * Time: 9:02 AM
 */
Class City_model extends MY_Model
{
    var $table = 'city';

    public function get_list_city()
    {
        $sql = "SELECT 
  a.`id`,
   a.`name`,
    a.`area` ,
    a.`created` ,
    b.`name` name_area
FROM
  `divuapp`.`city` a JOIN divuapp.`area` b ON a.`area` = b.`id`
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}