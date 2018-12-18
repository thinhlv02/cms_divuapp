<?php

Class Cms_admin_level_model extends MY_Model
{
    var $table = 'cms_admin_level';

    public function abcxxxxxx($company_id)
    {
        $add = "";
        if ($company_id != 'all') {
            $add = "AND a.company_id = $company_id ";
        }
        $sql = "";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}