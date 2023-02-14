<?php


session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
?>
<script>
  window.location.href = "index.php";
</script>
<?php
    exit;
}

$errMsg = false;
$success = false; 

if(isset($_POST['changePassword'])){

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    
      $newPwd =test_input($_POST['pwd']);
      $cpwd = test_input($_POST['cpwd']);

if($newPwd == $cpwd){



   $hash_passwordEdit = password_hash($newPwd, PASSWORD_DEFAULT);

   include 'Partials/_dbconnect.php';


    $sql = " UPDATE `member` SET `pwd` = '$hash_passwordEdit' WHERE `member`.`uid` = '$_SESSION[uname]' ";
    
    $result = mysqli_query($conn, $sql);

    if($result){
       
        $success =  "Password Changed Successfully";


        // send email 

      $sql = " SELECT * FROM `member` WHERE `member`.`uid` = '$_SESSION[uname]' ";

        $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0){

         while($row = mysqli_fetch_assoc($result)){
        
        $to_email = $row['email'];
        $subject = "MathHub Student Portal - Password Changed";
        $body = "Hi, " . $row['name']. ", Your profile password has been changed " . $newPwd .". DONOT REPLY TO THIS EMAIL AS IT IS AUTOMATICALLY GENERATED. "; 
        $headers = "From: no-reply@nandysagar.in";
         
        mail($to_email, $subject, $body, $headers) ;



      }
    
  }

}
    else{
       
        $errMsg = "Password not changed. Please try again.";
    }




}
else{

    $errMsg  = "Password not matched";

}
}




?>
