<?php
  error_reporting(0);
    try
    {
    $tmpfile = $_FILES['fileToUpload']['tmp_name'];
    $filename = basename($_FILES['fileToUpload']['name']);
    $data = array("name"=>$_POST['name'],
                  "quantity"=>$_POST['quantity'],
                  "price"=>$_POST['price'],
                  "description"=>$_POST['description'],
                  "sale_price"=>$_POST['sale_price'],  
                  "subcate_id"=>$_POST['subcate_id'],
                  "image"=>curl_file_create($tmpfile, $_FILES['fileToUpload']['type'], $filename)
                );  
    $ch = curl_init('http://localhost:8000/api/products');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // execute!
    $response = curl_exec($ch);
    $resJSON=json_decode($response);
    $mess=$resJSON->message;
    if(is_null($mess))
    {
      $mess="Add Product Fail";
    }
    // close the connection, release resources used
 

    // do anything you want with your response
    //var_dump($response);
    curl_close($ch);
    echo "<script>
        alert('".$mess."');
        window.location.href='product-list.php';
        </script>";
    } catch(\Error $e)
    {
      echo "<script>
      alert('Add product fail!');
      window.location.href='product-list.php';
      </script>";
    }
        
?>
