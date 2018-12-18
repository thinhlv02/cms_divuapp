<?php

Class Shop_model extends MY_Model
{
    var $table = 'shop';

    public function get_shop_info()
    {
        $add = "";
//        if ($company_id != 'all') {
//            $add = "AND a.company_id = $company_id ";
//        }
        $sql = "SELECT 
          a.`id`,
          a.`name`,
         a. `address`,
         a. `city` ,
         b.`name` name_city
        FROM
          `divuapp`.`shop` a JOIN divuapp.`vn_city` b ON a.`city` = b.`id` ";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}