<?php

Class Agency_model extends MY_Model
{
    var $table = 'agency';

    public function get_area()
    {
        $sql = " SELECT 
            a.`id`,
            a.`name`,
            a.`area`,
            b.`name` name_area,
            a.`phone`,
            a.`created`,
            a.`city`,
            c.`name` name_city
            FROM
            `divuapp`.`agency` a JOIN divuapp.`area` b ON a.`area` = b.`id` JOIN divuapp.`vn_city` c ON a.`city` = c.`id`
            ORDER BY a.`created` DESC
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}