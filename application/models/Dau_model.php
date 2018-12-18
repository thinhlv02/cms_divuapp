<?php

Class Dau_model extends MY_Model
{
    var $table = 'cutoff_dau2';

    public function getlist_cutoff_dau2($date1, $date2, $go)
    {
//        $add = "";
        $add = "AND DATE(`date`) BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
//        echo $date1 .'------'. $date2. '<br />';
        if ($date2 < date('Y-m-d')) {
            //echo not yet expired!
            $sql = "SELECT
                      DATE(`date`) `date`,
                      SUM(`user_login`) user_login,
                      SUM(`user_reg`) user_reg,
                      SUM(`dau`) dau
                    FROM `divuapp`.`cutoff_dau2` WHERE id > 0 $add GROUP BY DATE(`date`) ";
        }

        if ($date2 == date('Y-m-d') && $date1 < $date2) {
            //echo not yet expired!
            $sql = "SELECT pass1.* FROM 
 (SELECT
                      DATE(`date`) `date`,
                      SUM(`user_login`) user_login,
                      SUM(`user_reg`) user_reg,
                      SUM(`dau`) dau
                    FROM `divuapp`.`cutoff_dau2` WHERE id > 0 $add GROUP BY DATE(`date`)) as pass1 
                    union all 
                    SELECT DATE(NOW()) date, p.a user_login,p.b user_reg,(p.a + p.b) dau FROM ( 
SELECT
(SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) < DATE(NOW()) AND 
             a.`id` IN (SELECT b.`user_id` FROM divuapp.`money_log` b WHERE DATE(b.`login_time`) = DATE(NOW())) ) a,
             
              (SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) = DATE(NOW()) ) b ) p
                    ";
        }

        if ($date1 == $date2 && $date2 == date('Y-m-d')) {

            //echo not yet expired!
            $sql = "SELECT DATE(NOW()) date, p.a user_login,p.b user_reg,(p.a + p.b) dau FROM ( 
SELECT
(SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) < DATE(NOW()) AND 
             a.`id` IN (SELECT b.`user_id` FROM divuapp.`money_log` b WHERE DATE(b.`login_time`) = DATE(NOW())) ) a,
             
              (SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) = DATE(NOW()) ) b ) p ";
        }
        if (isset($sql)) {
//                var_dump($sql);
            $rows = $this->db->query($sql);
            return $rows->result();
        } else return false;

        die();
        if ($date1 != '' && $date2 != '') {
            $add = "AND DATE(`date`) BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
            if ($go == 0) {
                if ($date1 == $date2) {
                    $sql = "SELECT DATE(NOW()) date, p.a user_login,p.b user_reg,(p.a + p.b) dau FROM ( 
                        SELECT
                        (SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) < DATE(NOW()) AND 
                     a.`id` IN (SELECT b.`user_id` FROM divuapp.`money_log` b WHERE DATE(b.`login_time`) = DATE(NOW())) ) a,
                     
                      (SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) = DATE(NOW()) ) b ) p ";
                } else {
                    $sql = "SELECT `user_login`,`user_reg`,`dau`, `date` FROM `divuapp`.`cutoff_dau2`  WHERE id > 0 $add ";
                }
            } else {
                $sql = "
                    SELECT
                      DATE(`date`) `date`,
                      SUM(`user_login`) user_login,
                      SUM(`user_reg`) user_reg,
                      SUM(`dau`) dau
                    FROM `divuapp`.`cutoff_dau2` WHERE id > 0 $add GROUP BY DATE(`date`) 
    ";
            }
        } else {
//            $add = " AND DATE(DATE) = DATE(NOW())";
//            $sql = "SELECT `user_login`,`user_reg`,`dau`, `date` FROM `divuapp`.`cutoff_dau2`  WHERE id > 0 $add ";
            $sql = "SELECT DATE(NOW()) date, p.a user_login,p.b user_reg,(p.a + p.b) dau FROM ( 
SELECT
(SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) < DATE(NOW()) AND 
             a.`id` IN (SELECT b.`user_id` FROM divuapp.`money_log` b WHERE DATE(b.`login_time`) = DATE(NOW())) ) a,
             
              (SELECT COUNT(a.`id`) sl FROM `divuapp`.`user` a WHERE DATE(a.`created_at`) = DATE(NOW()) ) b ) p ";
        }
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}