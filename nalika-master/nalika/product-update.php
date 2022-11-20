<?php
    $data = array("name"=>$_GET['name'],
                  "quantity"=>$_GET['quantity'],
                  "price"=>$_GET['price'],
                  "description"=>$_GET['description'],
                  "status"=>$_GET['status']   
                );
    $data_json = json_encode($data);
    $url='http://localhost:8000/api/products/'.$_GET['id'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    $resJSON=json_decode($response);
    $mess=$resJSON->message;
    //echo $response;
    curl_close($ch);
    echo "<script>
        alert('".$mess."');
        window.location.href='product-list.php';
        </script>";
?>
