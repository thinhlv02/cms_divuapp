<?php

Class Ccu_model extends MY_Model
{
    var $table = 'ccu_log';

    public function function_getlist_ccu($date1, $date2)
    {
        $add = "";
        if ($date1 != '' && $date2 != '') {
            $add = "AND DATE(`date`) BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";

            $date1x = date_create(" " . $date1 . " ");
            $date2x = date_create(" " . $date2 . " ");
            $diff = date_diff($date1x, $date2x);
            $go = $diff->format("%a");

            if ($go == 0) {
                $sql = "SELECT TIME,(ccu) AS ccutong,ccu_info, action_user,ccu_users,ccu_ktv FROM 
divuapp.`ccu_log` WHERE id > 0  $add";
            } else {
                $sql = "SELECT TIME,MAX(ccu) AS ccutong,MAX(ccu_info) ccu_info,action_user,
                    MAX(ccu_users) ccu_users,MAX(ccu_ktv) ccu_ktv FROM divuapp.`ccu_log`
                    WHERE id > 0 $add GROUP BY DATE(`date`), DATE_FORMAT(`time`,'%H')";
            }
        } else {
            $add = " AND DATE(DATE) = DATE(NOW())";
            $sql = "SELECT TIME,(ccu) AS ccutong,ccu_info, action_user,ccu_users,ccu_ktv 
              FROM divuapp.`ccu_log` WHERE id > 0  $add";
        }
        //            var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}