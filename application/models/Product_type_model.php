<?php

Class Product_type_model extends MY_Model
{
    var $table = 'product_type';

//    public function getxx_product_type()
//    {
//        $sql = "SELECT
//  a.`id`,
//    a.`name`,
//    a.`type`,
//    a.`created`,
//    a.`link_icon`,
//    a.`shop`,
//    a.`price`,
//    a.`descriptions`,
//    b.`name` name_shop ,
//    b.`city`,
//    b.`address` address ,
//    c.`name` name_city,
//    d.`name` name_area,
//    e.`name` name_type
//FROM
//  `divuapp`.`product` a JOIN divuapp.`shop` b ON a.`shop` = b.id JOIN divuapp.`city` c ON b.`city` = c.`id`
//  JOIN divuapp.`area` d ON c.`area` = d.`id` JOIN divuapp.`product_type` e ON a.`type` = e.`id`
//        ";
//        $rows = $this->db->query($sql);
//        return $rows->result();
//    }
}