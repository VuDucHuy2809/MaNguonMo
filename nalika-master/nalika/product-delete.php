<?php
$ch = curl_init();
$url='http://localhost:8000/api/products/'.$_GET['id'];
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = json_decode($result);
curl_close($ch);
header('Location:product-list.php');
?>