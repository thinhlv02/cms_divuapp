<?php

Class Reward_point_model extends MY_Model
{
    var $table = 'cms_reward_point';

    public function get_reward_point_info()
    {
        $sql = "SELECT 
          a.`id`,
          a.`action`,
         a. `unit`,
         a. `city` ,
         a. `point` ,
         b.`name` name_city,
         c.`name` name_area
        FROM
          `divuapp`.`cms_reward_point` a JOIN divuapp.`city` b ON a.`city` = b.`id` 
          JOIN divuapp.`area` c ON b.`area` = c.id ";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}