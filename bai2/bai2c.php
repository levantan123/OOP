<?php
require_once 'bai2-data.php';
class managerDrink_Eat{
    public $id;
    public $name;
    public $price;
    public $quantity;
    public $order;
    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }public function setPrice($price){
    $this->price = $price;
}
    public function getPrice(){
        return $this->price;
    }
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function setOrder($order){
        $this->order = $order;
    }
    public function getOrder(){
        return $this->order;
    }
}
$managerDrink_Eat = new managerDrink_Eat;

class Bill{
    public function getMoneyBill($listGetBin,$listMenu,$listOrder)
    {
        $arr = [];
        $array = [];
        $lenght_listGetBin = count($listGetBin);
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
$bill = new Bill;
echo '<pre>';
print_r($bill->getMoneyBill($listGetBill,$listMenu,$listOrder)) ;
echo '</pre>';
?>

