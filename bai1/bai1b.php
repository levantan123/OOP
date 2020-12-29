<?php
require_once 'bai1-data.php';

class manager
{
    public $code;
    public $full_name;
    public $age;
    public $gender;
    public $start_work_time;
    public $luong;
    public $workday;
    public $marital_status;

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setName($name)
    {
        $this->full_name = $name;
    }

    public function getName()
    {
        return $this->full_name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setMarital_status($marital_status)
    {
        $this->marital_status = $marital_status;
    }

    public function getMarital_status()
    {
        return $this->marital_status;
    }

    public function setStart_work_time($start_work_time)
    {
        $this->start_work_time = $start_work_time;
    }

    public function getStart_work_time()
    {
        return $this->start_work_time;
    }

    public function setWorkdays($workdays)
    {
        $this->workday = $workdays;
    }

    public function getWorkdays()
    {
        return $this->workday;
    }

    public function setLuong($luong)
    {
        $this->luong = $luong;
    }

    public function getLuong()
    {
        return $this->luong;
    }

    public function datetime($column, $arrlistWorkTime)
    {
        $array = [];
        $lenght = count($arrlistWorkTime);
        for ($i = 0; $i < $lenght; $i++) {
            $cut_one = explode(' ', $arrlistWorkTime[$i][$column]);
            $cut_two = explode(':', $cut_one[1]);
            $hour = ($cut_two[0]) + ($cut_two[1] / 60) + ($cut_two[2] / 3600);
            array_push($array, $hour);
        }
        return $array;
    }

    public function start_datetime($arrlistWorkTime)
    {
        $arrStar_datetime = $this->datetime('start_datetime', $arrlistWorkTime);
        return $arrStar_datetime;
    }

    public function end_datetime($arrlistWorkTime)
    {
        $arrEnd_datetime = $this->datetime('end_datetime', $arrlistWorkTime);
        return $arrEnd_datetime;
    }

    public function getDay($m, $y)
    {
        $sumDay = date('t', mktime(0, 0, 0, $m, 1, $y));
        $getDay = 0;
        for ($d = 1; $d <= $sumDay; $d++) {
            $getDayinW = date('w', mktime(0, 0, 0, $m, $d, $y));
            if ($getDayinW > 0 && $getDayinW < 6) {
                $getDay++;
            }
        }
        switch ($m) {
            case 1:
            case 3:
            case 4:
            case 5:
                $getDay -= 1;
                break;
            case 2:
                $getDay -= 5;
                break;
            case 9:
                $getDay -= 2;
                break;
        }

        return $getDay;
    }
}

class Timekeeping
{
    public function getHour($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime, $arr)
    {
        $array = [];
        $lenght = count($arrlistWorkTime);
        for ($j = 0; $j < count($arr); $j++) {
            for ($i = 0; $i < $lenght; $i++) {
                if ($arr[$j]['code'] !== $arrlistWorkTime[$i]['member_code']) continue;
                $sum = $arrEnd_datetime[$i] - $arrStar_datetime[$i];
                if ($arr[$j]['has_lunch_break'] === 1) $sum = $sum - 1.5;
                array_push($array, $sum);

            }
        }
        return $array;
    }

    public function calculate($arrlistWorkTime, $arr, $getHour, $arrStar_datetime)
    {
        $lenght = count($arr);
        for ($i = 0; $i < $lenght; $i++) {
            $h = explode(':', $arr[$i]['start_work_time']);
            $h = ($h[0]) + ($h[1] / 60) + ($h[2] / 3600);
            $arr[$i]['start_work_time'] = $h;
            for ($j = 0; $j < count($arrlistWorkTime); $j++) {
                if ($arr[$i]['code'] !== $arrlistWorkTime[$j]['member_code']) continue;
                $arrlistWorkTime[$j]['work_time'] = $getHour[$j];
                if ($arrStar_datetime[$j] > $arr[$i]['start_work_time']) {
                    $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                    if ($arrlistWorkTime[$j]['work_time'] < 4) {
                        $arrlistWorkTime[$j]['chamcong'] = 0;
                    }
                } else {
                    if ($arrlistWorkTime[$j]['work_time'] >= $arr[$i]['work_hour']) {
                        $arrlistWorkTime[$j]['chamcong'] = 1;
                    }
                    if ($arrlistWorkTime[$j]['work_time'] < $arr[$i]['work_hour']
                        && $arrlistWorkTime[$j]['work_time'] >= 4) {
                        $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                    }
                    if ($arrlistWorkTime[$j]['work_time'] < 4) {
                        $arrlistWorkTime[$j]['chamcong'] = 0;
                    }
                }

                if ($arr[$i]['has_lunch_break'] === 0) {
                    if ($arrStar_datetime[$j] > $arr[$i]['start_work_time']) {
                        $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                        if ($arrlistWorkTime[$j]['work_time'] < 2) {
                            $arrlistWorkTime[$j]['chamcong'] = 0;
                        }
                    } else {
                        if ($arrlistWorkTime[$j]['work_time'] >= $arr[$i]['work_hour']) {
                            $arrlistWorkTime[$j]['chamcong'] = 1;
                        }
                        if ($arrlistWorkTime[$j]['work_time'] < $arr[$i]['work_hour']
                            && $arrlistWorkTime[$j]['work_time'] >= 2) {
                            $arrlistWorkTime[$j]['chamcong'] = 1 / 2;
                        }
                        if ($arrlistWorkTime[$j]['work_time'] < 2) {
                            $arrlistWorkTime[$j]['chamcong'] = 0;
                        }
                    }

                }
            }
        }
        return $arrlistWorkTime;
    }

    public function sum($inputNumber, $getDay, $arrlistWork_Cal, $arr)
    {
        $lenght = count($arr);
        for ($i = 0; $i < $lenght; $i++) {
            for ($j = 0; $j < count($arrlistWork_Cal); $j++) {
                if ($arr[$i]['code'] !== $arrlistWork_Cal[$j]['member_code']) continue;
                if ($arrlistWork_Cal[$j]['member_code'] !== $inputNumber) continue;
                $arr[$i]['workdays'] += $arrlistWork_Cal[$j]['chamcong'];
                $arr[$i]['luong'] = round($arr[$i]['salary'] / $getDay * $arr[$i]['workdays'], 2);
            }
        }
        return $arr;
    }

}

$manager = new manager;
$time = new Timekeeping;
$arr = array_merge($listMemberFullTime, $listMemberPartTime);
$arrlistWorkTime = $listWorkTime;
$arrStar_datetime = $manager->start_datetime($arrlistWorkTime);
$arrEnd_datetime = $manager->end_datetime($arrlistWorkTime);
$y = substr($arrlistWorkTime[0]['start_datetime'], 0, 4);
$m = substr($arrlistWorkTime[0]['start_datetime'], 5, 2);
$getDay = $manager->getDay($m, $y);
$getHour = $time->getHour($arrlistWorkTime, $arrStar_datetime, $arrEnd_datetime, $arr);
$arrlistWork_Cal = $time->calculate($arrlistWorkTime, $arr, $getHour, $arrStar_datetime);
echo '<pre>';
print_r($time->calculate($arrlistWorkTime, $arr, $getHour, $arrStar_datetime));
//print_r($time->sum($inputNumber, $getDay, $arrlistWork_Cal, $arr));
echo '</pre>';
?>

<form action="" method="post">
    <input type="text" name="inputNumber" value="">
    <input type="submit" name="submit" value="Tìm kiếm">
    <?php
    if (isset($_POST['submit'])) {
        $inputNumber = $_POST['inputNumber'];
        $arrs = $time->sum($inputNumber, $getDay, $arrlistWork_Cal, $arr);
        foreach ($arrs as $arr)
            if ($arr['code'] === $inputNumber) {
                $manager->setName($arr['full_name']);
                $manager->setCode($arr['code']);
                $manager->setAge($arr['age']);
                $manager->setGender($arr['gender']);
                $manager->setLuong($arr['luong']);
                $manager->setWorkdays($arr['workdays']);
                $manager->setStart_work_time($arr['start_work_time']);
                $manager->setMarital_status($arr['marital_status']);
                echo '<br>' . "Mã: " . $manager->getCode() . '<br>';
                echo "Họ tên: " . $manager->getName() . '<br>';
                echo "Tuổi: " . $manager->getAge() . '<br>';
                if ($manager->getGender() === 0) {
                    echo "Gioi tinh: Nam" . '<br>';
                }
                if ($manager->getGender() === 1) {
                    echo "Gioi tinh: Nữ" . '<br>';
                }
                if ($manager->getMarital_status() === 0) {
                    echo "Tình trạng hôn nhân: Chưa kết hôn" . '<br>';
                }
                if ($manager->getMarital_status() === 1) {
                    echo "Tình trạng hôn nhân: Đã kết hôn" . '<br>';
                }
                echo "Thời gian đăng kí đi làm: " . $manager->getStart_work_time() . '<br>';
                echo "Số ngày công: " . $manager->getWorkdays() . '<br>';
                echo "Lương: " . $manager->getLuong() . '<br>';
            }
    }
    ?>
</form>

