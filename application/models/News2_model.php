<?php

Class News2_model extends MY_Model
{
    var $table = 'news2';

//    public function get_employee()
//    {
//        $sql = "
//            SELECT
//              DISTINCT(a.`employee_id`) id,
//              b.`name`
//            FROM
//              `vimag_asset`.`contract_detail` a
//              JOIN `vimag_asset`.`employee` b
//                ON a.`employee_id` = b.`id`
//        ";
//        $rows = $this->db->query($sql);
//        return $rows->result();
//    }
}