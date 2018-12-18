<?php

Class Kinhdoanh_model extends MY_Model
{
    var $table = 'cms_kinhdoanh';
    public function kinhdoanh_money($search, $date1, $date2) {
$where = '';
        if ($date1 != 'all' && $date2 != 'all') {
            $where .= " date(`date`) between '".$date1."' AND '".$date2."' ";
        } else{
            $where .= ' DATE(`date`) = DATE(NOW()) ';
        }
        $sql = "SELECT 
  `id`,
  `date`,
  `total`,
  `cp_quangcao`,
  `gia_von`,
  `cp_vanphong`,
  `luong`,
  `cp_khac`,
  `ln_thuan` 
FROM
  `divuapp`.`cms_kinhdoanh`  where $where
";
//                echo $sql;
        $rows = $this->db->query($sql);
        return $rows->result();
    }
}