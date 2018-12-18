<?php

Class Area_model extends MY_Model
{
    var $table = 'area';

//    public function get_area()
//    {
//        $sql = "
//          SELECT
//              a.`id`,
//              a.`name`,
//              a.`area`,
//              a.`phone`,
//              a.`created` ,
//              b.`name` name_area
//            FROM
//              `divuapp`.`agency` a JOIN divuapp.`area` b ON a.`area` = b.`id`
//        ";
//        $rows = $this->db->query($sql);
//        return $rows->result();
//    }
}