<?php
  try
  {
    $data = array("name"=>$_GET['name'],
                  "phone"=>$_GET['phone'],
                  "address"=>$_GET['address']  
                );
    $data_json = json_encode($data);
    $url='http://localhost:8000/api/accounts/'.$_GET['id'];
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
        window.location.href='user-list.php';
        </script>";
    }
    catch(\Error $e)
    {
      echo "<script>
      alert('Update user fail!');
      window.location.href='product-list.php';
      </script>";
    }
?>
