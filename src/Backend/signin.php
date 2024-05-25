<?php
    session_start();
    if(isset($_SESSION["id_user"])){
        //header("Location:home.php");
        header("refresh:0;url=home.php");
        exit;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pets | login</title>
</head>
<body>
    <style>
        body{
             background-color :rgb(148, 212, 242);
        }
    </style>
    <center>
        
        <img src="images/survey.png" width="85" alt="450">

        <h2> <span style="color: rgb(6, 13, 19);"> 
            log in pets.</span></h2>

        <form action="backend/signin.php" method="post">
            <input type="email" name="email" placeholder="jhgda@gmail.com" required ></td></tr>
            <td> <input type="password" name="passwd" placeholder="********" required></td></tr>
            <tr><td align="center"><button>iniciar</button></td></tr>
            <a href="signup.html">create an account </a>
        </form></form>
    </center>
   <form name=" signin-form" action="" method="post">
    <table border="0" align="center"> 

    </table>
   </form> 
</body>
</html>