<?php

Class Product_model extends MY_Model
{
    var $table = 'product';

    public function get_product_type($search,$product_type,$area,$city)
    {
        $where = '';

        if ($product_type != 'all') {
            $where .= " AND  e.`id`  =  " . $product_type . " ";
        }
        if ($area != 'all') {
            $where .= " AND  d.`id`  =  " . $area . " ";
        }
        if ($city != 'all') {
            $where .= " AND  c.`id`  =  " . $city . " ";
        }

        $limit = '';
        if ($search == 'all') {
            $limit = ' order by a.id desc limit 100';
        }
        $sql = "SELECT 
  a.`id`,
    a.`name`,
    a.`sale`,
    a.`number`,
    a.`unit`,
    a.`type`,
    a.`created`,
    a.`link_icon`,
    a.`shop`,
    a.`price`,
    a.`descriptions`,
    b.`name` name_shop ,
    b.`city`,
    b.`address` address ,
    c.`name` name_city,
    d.`name` name_area,
    e.`name` name_type
FROM
  `divuapp`.`product` a JOIN divuapp.`shop` b ON a.`shop` = b.id JOIN divuapp.`city` c ON b.`city` = c.`id`
  JOIN divuapp.`area` d ON c.`area` = d.`id` JOIN divuapp.`product_type` e ON a.`type` = e.`id` where a.id > 0 $where $limit
        ";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}