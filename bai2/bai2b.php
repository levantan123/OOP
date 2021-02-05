<?php
require_once 'bai2-data.php';

class getTime{
    public function datetime($column, $listGetBill)
    {
        $array = [];
        $lenght = count($listGetBill);
        for ($i = 0; $i < $lenght; $i++) {
            $cut_two = explode(':', $listGetBill[$i][$column]);
            $hour = ($cut_two[0]) + ($cut_two[1] / 60) + ($cut_two[2] / 3600);
            array_push($array, $hour);
        }
        return $array;
    }
    public function start_time($listGetBill)
    {
        $Star_time = $this->datetime('start_time', $listGetBill);
        return $Star_time;
    }
    public function end_time($listGetBill)
    {
        $End_time = $this->datetime('end_time', $listGetBill);
        return $End_time;
    }
    public function getWorkTime($listGetBill){
        $arr = [];
        $Star_time =  $this->start_time($listGetBill);
        $End_time = $this->end_time($listGetBill);
        $lenght = count($listGetBill);
        for ($i=0;$i<$lenght;$i++){
            $h = $End_time[$i] - $Star_time[$i];
            array_push($arr,$h);
        }
        return $arr;
    }

}
$a = new getTime;
echo '<pre>';
print_r($a->getWorkTime($listGetBill));
echo '</pre>';

//class Bill
//{
//    public function getMoney($listMenu, $listOrder,$listGetBill)
//    {
//        $arr = [];
//        $lenght_listGetBill = count($listGetBill);
//        $array=[];
//        $lenght_listMenu = count($listMenu);
//        $lenght_listOrder = count($listOrder);
//        for ($k = 0; $k < $lenght_listOrder; $k++) {
//            for ($z = 0; $z < $lenght_listMenu; $z++) {
//                if ($listOrder[$k]['menu_id'] !== $listMenu[$z]['id']) continue;
//                $listOrder[$k]['money'] = $listOrder[$k]['quantity'] * $listMenu[$z]['price'];
//                if ($listMenu[$z]['alcohol'] === 1) {
//                    $listOrder[$k]['money'] = $listOrder[$k]['quantity'] * ($listMenu[$z]['price'] + 5000);
//                }
//
//                if (isset($array[$listOrder[$k]['bill_id']])) {
//                    $array[$listOrder[$k]['bill_id']] += $listOrder[$k]['money'];
//                } else {
//                    $array[$listOrder[$k]['bill_id']] = $listOrder[$k]['money'];
//                }
//                for ($x = 0; $x < $lenght_listGetBill; $x++) {
//                    if (isset($listGetBill[$x]['bill_id'])) {
//                        if ($listGetBill[$x]['time'] ===1){
//                            $arr[$listGetBill[$x]['bill_id']] = ($array[$listOrder[$k]['bill_id']]+80000)*90/100;
//
//                        }
//                        if ($listGetBill[$x]['time'] ===2){
//                            $arr[$listGetBill[$x]['bill_id']] = ($array[$listOrder[$k]['bill_id']]+140000)*90/100;
//
//                        }
//                        if ($listGetBill[$x]['time'] ===3){
//                            $arr[$listGetBill[$x]['bill_id']]=  ($array[$listOrder[$k]['bill_id']]+180000)*90/100;
//
//                        }
//                    }
//                    else{
//                        if ($listGetBill[$x]['time'] ===1){
//                            $arr[$listGetBill[$x]['bill_id']] =  ($array[$listOrder[$k]['bill_id']]+100000)*90/100;
//                        }
//                        if ($listGetBill[$x]['time'] ===2){
//                            $arr[$listGetBill[$x]['bill_id']] =  ($array[$listOrder[$k]['bill_id']]+180000)*90/100;
//
//                        }
//                        if ($listGetBill[$x]['time'] ===3){
//                            $arr[$listGetBill[$x]['bill_id']] =  ($array[$listOrder[$k]['bill_id']]+230000)*90/100;
//
//                        }
//                    }
//                }
//            }
//        }
//
//        return $arr;
//    }
//
//}
//
//$bill = new Bill;
//echo '<pre>';
//print_r($bill->getMoney($listMenu, $listOrder,$listGetBill));
//echo '</pre>';
?>

