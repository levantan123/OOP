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
        'check_in'=>'',
        'check_out'=>'',
    ),
    array(
        'bill_id'=>02,
        'number_table'=>2,
         'check_in'=>'',
        'check_out'=>'',
    ),
    array(
        'bill_id'=>03,
        'number_table'=>3,
        'check_in'=>'',
        'check_out'=>'',
    ),

);
$listGetBill=array(
    array(
        'getBill_id'=>01,
        'staff_id'=>01,
        'accompany'=>0,
        'bill_id'=>02,
        'time'=>1
    ),
    array(
        'getBill_id'=>02,
        'staff_id'=>02,
        'accompany'=>1,
        'bill_id'=>02,
        'time'=>1
    ),
    array(
        'getBill_id'=>03,
        'staff_id'=>03,
        'accompany'=>1,
        'bill_id'=>03,
        'time'=>2
    ),
    array(
        'getBill_id'=>04,
        'staff_id'=>04,
        'accompany'=>0,
        'bill_id'=>03,
        'time'=>2
    ),

);
$listStaff = array(
    array(
        'id'=>01,
        'name'=>'Le Van A',
        'age'=>25,
        'gender'=>'Nam',
        'accompany'=>0,
        'bill_id'=>02,
        'time'=>1
    ),
    array(
        'id'=>02,
        'name'=>'Nguyen Thi A',
        'age'=>27,
        'gender'=>'Nữ',
        'accompany'=>1,
        'bill_id'=>02,
        'time'=>1
    ),
    array(
        'id'=>03,
        'name'=>'Le Van B',
        'age'=>30,
        'gender'=>'Nam',
        'accompany'=>1,
        'bill_id'=>03,
        'time'=>2
    ),
    array(
        'id'=>04,
        'name'=>'Nguyen Thi B',
        'age'=>22,
        'gender'=>'Nữ',
        'accompany'=>0,
        'bill_id'=>03,
        'time'=>2
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

?>