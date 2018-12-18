<?php

Class Admin_model extends MY_Model
{
    var $table = 'admin';

    public function function_getlist($company_id)
    {
        $add = "";
        if ($company_id != 'all') {
            $add = "AND a.company_id = $company_id ";
        }
        $sql = "SELECT 
  a.`id`,
  a.`UserName`,
  a.`Password`,
  a.`status`,
  a.`employee_id`,
  b.`name`,
  c.`name` name_company 
FROM
  `vimag_asset`.`adusers` a 
  JOIN `vimag_asset`.`employee` b 
    ON a.`employee_id` = b.`id` 
  JOIN vimag_asset.`company` c 
    ON a.`company_id` = c.`id` 
WHERE a.`UserName` NOT IN ('admin') $add";
//        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }

    function check_ktv($txtName,$phone)

    {
        $sql = "
        SELECT 
  `id`,
  `username`,
  `password`,
  `level`,
  `rank`,
  `fullname`,
  `phone`,
  `address`,
  `email`,
  `status`,
  `balance`,
  `balance_wait_payment`,
  `bonus`,
  `bonus_wait_payment`,
  `bonus_introduce_customer`,
  `bonus_introduce_customer_wait_payment`,
  `created`,
  `create_by`,
  `fcm_token`,
  `is_active`,
  `work_status`,
  `latitude`,
  `longitude`,
  `position`,
  `link_avatar`,
  `time_update`,
  `device`,
  `province`,
  `district`,
  `ward`,
  `province_id`,
  `district_id`,
  `district_work_id`,
  `city_work_id`,
  `ward_id`,
  `service_id`,
  `han_muc`,
  `so_tien_da_tru_am`,
  `birthday`,
  `salary`,
  `salary_add_month` 
FROM
  `divuapp`.`admin` a WHERE a.`username` = '".$txtName."' OR a.`phone` = '".$txtName."' AND a.`level` <> 5

        ";
        //        var_dump($sql);
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}