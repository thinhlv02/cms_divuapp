<?php

Class Menu_model extends MY_Model
{
    var $table = 'menu';

    public function get_list_new($abc)
    {
        $sql = "SELECT 
  `id`,
  `name`,
  `access`,
  `access2`,
  `access3` 
FROM
  `divuapp`.`menu` a WHERE a.`id` NOT IN (" . $abc . ") order by a.id asc ";
//        echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}

