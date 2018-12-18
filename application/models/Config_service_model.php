<?php

Class Config_service_model extends MY_Model
{
    var $table = 'config_service';

    public function get_config_service_type()
    {
        $sql = "SELECT 
          a.`id`,
          a.`name`,
          b.`name` name_city,
          c.`name` name_area,
          a.time,
          a.`employee`,
          a.`money`,
          a.`type`,
          d.`name` name_type,
          a.`created`,
          a.`money`,
          a.`city`,
         a. `time`,
          a.`employee` 
        FROM
          `divuapp`.`config_service` a JOIN divuapp.`city` b ON a.`city` = b.`id` JOIN divuapp.`area` c ON b.`area` = c.`id`
          JOIN divuapp.`config_service_type` d ON a.`type` = d.`id`
        ";
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}