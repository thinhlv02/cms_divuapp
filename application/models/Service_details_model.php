<?php

Class Service_details_model extends MY_Model
{
    var $table = 'service_info';

    public function get_service_type()
    {
        $sql = "SELECT 
 a. `id`,
 a. `name`,
  a.`des`,
  a.`link_icon`,
  a.`service_package_id` ,
  b.`name` name_service_package
FROM
  `divuapp`.`service_info` a JOIN divuapp.`service_package` b ON a.service_package_id = b.`id`

        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}