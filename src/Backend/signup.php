<?php
    include('../../config/database.php');

    $fullname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $enc_pass = md5($password);

    $sql = "
    INSERT INTO users (fullname,email,password)
    VALUES ('$fullname','$email','$pass')
    ";

    $ans = pg_query($conn,$sql);
    if($ans){
        echo"user has been created seccessfully";
    }else{
        echo "error: " . pg_last_error();
    }

 
?>