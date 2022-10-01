<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    $loggedin = false;
?>
<script>
  window.location.href = "../SignIn.php";
</script>
<?php
    exit;
}
else{
    $loggedin = true;

    
    $sql = " SELECT * FROM member WHERE uid = '$_SESSION[uname]' ";

                    

  $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($result)){

      $username = $row['name'];
      $userid = $row['uid'];
      $useremail = $row['email'];
      $role = $row['role'];

      if($role == 1){
        $role_name = "Admin";
      }
      else if($role == 2){
        $role_name = "Moderator";
      }
      else{
        header("location: ../index.php");
      }
  }
}


include '../Partials/_dbconnect.php' ;

$update = false;

$showAlert = false;

if(isset($_POST['changePassword'])){


    $uid = $_GET['uid'];

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    
      $passwordEdit = test_input($_POST['passwordEdit']);
      $cpasswordEdit = test_input($_POST['cpasswordEdit']);

     if($passwordEdit == $cpasswordEdit){

   $hash_passwordEdit = password_hash($cpasswordEdit, PASSWORD_DEFAULT);

    $sql = " UPDATE `member` SET `password` = '$hash_passwordEdit' WHERE `member`.`uid` = '$uid' ";
    
    $result = mysqli_query($conn, $sql);

    if($result){
       
        $update = true;


        // send email 

      $sql = " SELECT * FROM `member` WHERE `member`.`uid` = '$uid' ";

        $result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

        require '../PHPMailer-5.2-stable/PHPMailerAutoload.php';

        include '../Partials/_mail.php';
        
        $to = $row['email'];
        $from = 'no-reply@nandysagar.in';
        $name = ' MATHHUB COMBINED PORTAL';  
        $subj =  ' LOGIN PASSWORD CHANGED ';
        $msg = ' <h3> Dear '.$row['name'].', </h3> <br> <p> Your password has been changed. </p> <br> <p> If you did not change your password, please contact us immediately. </p> <br> <p> Thank you. </p> <br> <p> Regards, </p> <br> <p> MATHHUB COMBINED PORTAL </p> ';
    
         
        $error=member($to,$from, $name ,$subj, $msg);




    }
}
    }
    else{
        
        $showAlert = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}
    else{
       
        $showAlert = " Passwords do not match. ";
    }




}






?>





<!DOCTYPE html>
<html lang="en">

<head>

    <title>CHANGE PASSWORD - MATHHUB COMBINED</title>
    <?php include '../Partials/_admin_link.php'; ?>

</head>

<body>
<!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>

    <?php include '../Partials/_topNav.php' ?>



    <?php


if($update){

    ?>

    <script>
        swal({
            // title: "Success!",
            title: "Password changed successfully.",
            icon: "success",
            button: "OK",
        }).then(function() {
            window.location = "userControl.php";
        });
    </script>
<?php
}

if($showAlert){
    ?>

    <script>
        swal({
            title: "Error!",
            text: "<?php echo $showAlert; ?>",
            icon: "error",
            button: "OK",
        }).then(function() {
            window.location = "userContorl.php";
        });
    </script>
<?php
}

?>
  

    <div class="container  my-3  " style="padding-top:50px;">

        <div class="row">






            <div class=" col-md-6 col-md-offset-3">
              

                    

                    <div class="alert alert-info border-1 mt-3">
                   <h3 class="mb-3" style="font-weight:bold;"> <i class="fa fa-key"></i> Change Password</h3>
                   <hr class="hr-info">
                        <form method = "POST">
                            
                            <div class="form-group">
                                <label for="pwd" class="font-weight-bold"> <i class="fa fa-lock"></i> New Password:</label>
                                <input type="password" class="form-control" id="pwd" name="passwordEdit">
                            </div>

                            <div class="form-group">
                                <label for="cpwd" class="font-weight-bold"> <i class="fa fa-lock"></i> Re-enter Password:</label>
                                <input type="password" class="form-control" name="cpasswordEdit" id="cpwd">
                            </div>
                           
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger btn-block"  name="changePassword"> Change </button>
                            </div>



                        </form>
                 
                       


                    </div>

            


            </div>



        </div>
    </div>



    
    <script src="../js/loader.js"></script>
    <script>
      function Logout()
      {
        swal({
          title: "Confirm us!",
          text: " Are you sure you want to logout?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("You have been logged out!", {
              icon: "success",
            });
            window.location.href = "logout.php";
          } else {
            swal("You are still logged in!");
          }
          
        });
      }
      
    </script>
</body>

</html>






















