<?php
    $data = array(
                );
    //$data_json = json_encode($data);
    $url='http://localhost:8000/api/admin/orders/'.$_GET['id'];
    //echo $url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    //curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    //$resJSON=json_decode($response);
    //$mess=$resJSON->message;
    //echo $response;
    curl_close($ch);
    echo "<script>
        window.location.href='bill-list.php';
        </script>";
?>
