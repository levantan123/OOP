<?php
require_once 'bai2-data.php';

class getTime
{
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

    public function get_Time($listGetBill)
    {
        $arr = [];
        $Star_time = $this->start_time($listGetBill);
        $End_time = $this->end_time($listGetBill);
        $lenght = count($listGetBill);
        for ($i = 0; $i < $lenght; $i++) {
            $h = $End_time[$i] - $Star_time[$i];
            array_push($arr, $h);
        }
        return $arr;
    }

}

class Bill extends getTime
{
    public function getMoney($listMenu, $listOrder)
    {
        $array = [];
        $lenght_listMenu = count($listMenu);
        $lenght_listOrder = count($listOrder);
        for ($k = 0; $k < $lenght_listOrder; $k++) {
            for ($z = 0; $z < $lenght_listMenu; $z++) {
                if ($listOrder[$k]['menu_id'] !== $listMenu[$z]['id']) continue;
                $listOrder[$k]['money'] = $listOrder[$k]['quantity'] * $listMenu[$z]['price'];
                if ($listMenu[$z]['alcohol'] === 1) {
                    $listOrder[$k]['money'] = $listOrder[$k]['quantity'] * ($listMenu[$z]['price'] + 5000);
                }

                if (isset($array[$listOrder[$k]['bill_id']])) {
                    $array[$listOrder[$k]['bill_id']] += $listOrder[$k]['money'];
                } else {
                    $array[$listOrder[$k]['bill_id']] = $listOrder[$k]['money'];
                }
            }
        }

        return $array;
    }
}

class Calculator extends Bill{
    function create_time_range($start, $end, $interval = '1 hours', $format = '24')
    {
        $startTime = strtotime($start);
        $endTime = strtotime($end);
        $returnTimeFormat = ($format == '12') ? 'g:i:s A' : 'G:i:s';

        $current = time();
        $addTime = strtotime('+' . $interval, $current);
        $diff = $addTime - $current;

        $times = array();
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }
        $times[] = date($returnTimeFormat, $startTime);
        unset($times[count($times) - 1]);
        return $times;
    }
    function getId($listGetBill,$listBill,$configs){
        for ($i=0;$i<count($listBill);$i++){
            $rangesEat = $this->create_time_range($listBill[$i]['check_in'], $listBill[$i]['check_out']);
        }
    print_r($rangesEat);

        $listTimeWork = [];
        $demo = [];
        foreach ($listGetBill as $staffWork) {
            for ($i = 0; $i < count($listBill); $i++) {
                if ($staffWork['bill_id'] === $listBill[$i]['bill_id']) {
                    $listTimeWork[$staffWork['staff_id']] = $this->create_time_range($staffWork['start_time'], $staffWork['end_time']);
                }
            }
        }
        foreach ($rangesEat as $keyHour) {
            $demo[$keyHour] = $this->findStaffByTime($keyHour, $listTimeWork);
        }
        $end=$this->service($demo,$configs);
        return $end;

    }

    function findStaffByTime($time, $list)
    {
        $data = [];
        foreach ($list as $key => $times) {
            if (in_array($time, $times)) $data[] = $key;

        }
        return $data;
    }
    function service($array,$configs)
    {
        $data=[];
        $countTime = 1;
        foreach ($array as $time=>$peoples){
            $price=$this->showPrice($configs,$countTime,count($peoples));
            $data[$time]=array_map(function ($people)use ($price){
                return [
                    'id'=>$people,
                    'price'=>$price
                ];
            },$peoples);
            $countTime++;
        }
        return $data;
    }
    public function SumMoney($listGetBill,$listBill,$configs,$listMenu, $listOrder){
        $end = $this->getId($listGetBill,$listBill,$configs);
        echo '<pre>';
        print_r($end);
        echo '</pre>';
        $a=0;
        $sum=0;
        $arr=[];
        $lenght_listOrder = count($listOrder);
        foreach ($end as $array){
            foreach ($array as $value) {
                $sum += $value['price'];
            }
        }
        $asum = $this->getMoney($listMenu, $listOrder);

        for ($k = 0; $k < $lenght_listOrder; $k++) {
            for ($i = 0; $i < count($listBill); $i++) {
                    if ($listBill[$i]['bill_id'] === $listOrder[$k]['bill_id']) {
                        $asum[$listOrder[$k]['bill_id']] += $sum * 90 / 100;
                    }
            }
        }
        return $asum;

    }
function showPrice($configs,$hour,$countPeople){
    if($hour>3) $hour=3;
    if($countPeople>3) $countPeople=3;
    $price=0;
    foreach ($configs as $config){
        if($config['time']===$hour && $config['quantity']===$countPeople) $price=$config['price'];
    }
    return $price;
}
}

$a = new Calculator;
print_r($a->SumMoney($listGetBill,$listBill,$configs,$listMenu, $listOrder));
//echo '<pre>';
//print_r($bill['money_for_staff']);
//echo '</pre>';
?>