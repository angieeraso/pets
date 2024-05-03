<?php
    include('../../config/database.php');

    $email = $_POST['email'];
    $password = $_POST['password'];
    $enc_pass = md5($password);

    $sql ="
        SELECT * from users where email= '$email' and password ='$enc_pass' limit 1";
    $result = pg_query($conn,$sql);
    $total = pg_num_rows($result);

    if($total > 0){
        //echo "login ok";
        header("refresh:0; url=../Home.php");
    }else{
    echo"Credenciales Incorrectas";
    }
?>