<?php

Class Config_payment_model extends MY_Model
{
    var $table = 'cms_config_payment';

    public function get_payment_info($id_money,$area_id)
    {
        $add = "";
        if ($id_money != '' && $area_id != '') {
            $add = " where a.id_money = $id_money AND area_id = $area_id ";
        }
        $sql = "SELECT 
  a.`id`,
  a.`id_money`,
  a.`area_id`,
  a.`time`,
 a. `limit`,
 a. `tyle`,
  a.`admin_id`,
  a.`time_update` ,
  b.`name` name_area,
  c.`name` name_money
FROM
  `divuapp`.`cms_config_payment` a JOIN divuapp.`area` b ON a.area_id = b.`id` JOIN
  divuapp.`cms_config_payment_money` c ON a.`id_money` = c.`id` $add
";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}