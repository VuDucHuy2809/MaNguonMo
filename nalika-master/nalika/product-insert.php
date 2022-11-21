<?php
    $data = array("name"=>$_POST['name'],
                  "quantity"=>$_POST['quantity'],
                  "price"=>$_POST['price'],
                  "description"=>$_POST['description'],
                  "sale_price"=>$_POST['sale_price'],  
                  "subcate_id"=>$_POST['subcate_id']
                );
    $ch = curl_init('http://localhost:8000/api/products');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // execute!
    $response = curl_exec($ch);

    // close the connection, release resources used
    curl_close($ch);

    // do anything you want with your response
    var_dump($response);
    /*curl_close($ch);
    echo "<script>
        alert('".$mess."');
        window.location.href='product-list.php';
        </script>";*/
?>
