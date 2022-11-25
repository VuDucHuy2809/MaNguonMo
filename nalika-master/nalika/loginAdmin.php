<?php
 error_reporting(0);
    session_start();
    $data = array("email"=>$_POST['email'],
                  "password"=>$_POST['password']);
    $data_json = json_encode($data);
    $url='http://localhost:8000/api/login/admin';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    $resJSON=json_decode($response);
    if(isset($resJSON->token))
    {
        $_SESSION['token']=$resJSON->token;
        $mess='Login Success!';
        echo "<script>
        alert('".$mess."');
        window.location.href='index.php';
        </script>";
    }
    else
    {
        $mess='Login Fail!';
        echo "<script>
        alert('".$mess."');
        window.location.href='login.php';
        </script>";
    }
    //$mess=$resJSON->message;
    /*if(is_null($mess))
    {
    $mess="Login Fail";
    }*/
   // var_dump($resJSON);
?>