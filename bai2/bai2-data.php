<?php
$listMenu = array(
    array(
        'id'=>01,
        'name'=>'Nước Cam',
        'price'=>12000,
        'alcohol'=>0
    ),

    array(
        'id'=>02,
        'name'=>'Nước Dứa',
        'price'=>10000,
        'alcohol'=>0
    ),
    array(
        'id'=>03,
        'name'=>'Bia',
        'price'=>12000,
        'alcohol'=>1

    ),
    array(
        'id'=>04,
        'name'=>'Hải sản',
        'price'=>30000,
        'alcohol'=>0
    ),
    array(
        'id'=>05,
        'name'=>'Thịt rừng',
        'price'=>50000,
        'alcohol'=>0
    ),

);

$listTable = array(
    array(
        'number_table'=>1,
        'status'=>0
    ),
    array(
        'number_table'=>2,
        'status'=>1
    ),
    array(
        'number_table'=>3,
        'status'=>1
    ),

);
$listBill = array(
    array(
        'bill_id'=>01,
        'number_table'=>1,
        'check_in'=>'08:00:00',
        'check_out'=>'12:00:00',
    ),
    array(
        'bill_id'=>02,
        'number_table'=>2,
         'check_in'=>'14:00:00',
        'check_out'=>'18:00:00',
    ),
    array(
        'bill_id'=>03,
        'number_table'=>3,
        'check_in'=>'19:00:00',
        'check_out'=>'23:00:00',
    ),

);
$listGetBill=array(
    array(
        'getBill_id'=>01,
        'staff_id'=>01,
        'accompany'=>0,
        'bill_id'=>02,
        'start_time'=>'14:00:00',
        'end_time'=>'15:00:00',
        'tien'=>''
    ),
    array(
        'getBill_id'=>02,
        'staff_id'=>02,
        'accompany'=>1,
        'bill_id'=>02,
        'start_time'=>'14:00:00',
        'end_time'=>'18:00:00',
        'tien'=>''
    ),
    array(
        'getBill_id'=>05,
        'staff_id'=>04,
        'accompany'=>0,
        'bill_id'=>02,
        'start_time'=>'17:00:00',
        'end_time'=>'18:00:00',
        'tien'=>''
    ),
    array(
        'getBill_id'=>03,
        'staff_id'=>03,
        'accompany'=>1,
        'bill_id'=>03,
        'start_time'=>'19:00:00',
        'end_time'=>'23:00:00',
        'tien'=>''
    ),
    array(
        'getBill_id'=>04,
        'staff_id'=>04,
        'accompany'=>0,
        'bill_id'=>03,
        'start_time'=>'22:00:00',
        'end_time'=>'23:00:00',
        'tien'=>''
    ),

);
$listStaff = array(
    array(
        'id'=>01,
        'name'=>'Le Van A',
        'age'=>25,
        'gender'=>'Nam',

    ),
    array(
        'id'=>02,
        'name'=>'Nguyen Thi A',
        'age'=>27,
        'gender'=>'Nữ',

    ),
    array(
        'id'=>03,
        'name'=>'Le Van B',
        'age'=>30,
        'gender'=>'Nam',

    ),
    array(
        'id'=>04,
        'name'=>'Nguyen Thi B',
        'age'=>22,
        'gender'=>'Nữ',

    ),
);

$listOrder = array(
    array(
        'order_id'=>01,
        'menu_id'=>01,
        'bill_id'=>02,
        'quantity'=>2
    )  ,
    array(
        'order_id'=>02,
        'menu_id'=>04,
        'bill_id'=>03,
        'quantity'=>2
    )  ,
    array(
        'order_id'=>03,
        'menu_id'=>02,
        'bill_id'=>03,
        'quantity'=>1
    )  ,
);
$configs = [
    ['time' => 1, 'quantity' => 1, 'price' => 100000],
    ['time' => 1, 'quantity' => 2, 'price' => 80000],
    ['time' => 1, 'quantity' => 3, 'price' => 40000],
    ['time' => 2,'quantity' => 1,'price' => 80000],
    ['time' => 2, 'quantity' => 2, 'price' => 60000],
    ['time' => 2, 'quantity' => 3, 'price' => 60000],
    ['time' => 3,'quantity' => 1,'price' => 50000],
    ['time' => 3, 'quantity' => 2, 'price' => 40000],
    ['time' => 3, 'quantity' => 3, 'price' => 40000]
];
?>