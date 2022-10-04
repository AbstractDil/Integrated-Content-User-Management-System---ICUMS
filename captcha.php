<?php

session_start();


$rand_num = substr(md5(microtime()),rand(0,26),5);

//echo $rand_num;

$_SESSION['rand_code'] = $rand_num;

if($_SERVER["REQUEST_METHOD"]  == "POST"){

$captcha_code = $_POST['captcha'];

if($captcha_code == $_SESSION['rand_code']){
echo "Captcha code matched";
}else{
echo "Captcha code does not match, please try again.";
}


}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .captcha{
        width: 100px;
        height: 30px;
        background-color: #ccc;
        text-align: center;
        line-height: 30px;
        font-size: 20px;
        font-weight: bold;
        color: red;
        margin: 10px;
    }
    body{
        background-color: gainsboro;
    }
</style>
<body>

    <form action="captcha.php" method="post">
      <span class="captcha"><?php echo  $_SESSION['rand_code'] ?></span>  <input type="text"  name="captcha" id="captcha">
        <input type="submit" value="submit">
    </form> 

</body>
</html>