<?php
include "connect.php";

for($i = 0 ; $i < 5 ; $i++){
    $type = 'internet';
    $provider = 'indihome';
    $month = 6;
    $year = 2019;
    $price = 225000;
    $cust_id = $provider.'000'.strval($i).strval($month).strval($year); 
    $sql = $conn->prepare("INSERT INTO customer ( customer_id , tipe , provider, price, month , year ) VALUES ( ?, ?, ?, ?, ?, ?)");
    $sql->bind_param('sssiii', $cust_id,$type,$provider,$price,$month,$year);
    $sql->execute();
}
?>