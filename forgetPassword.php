<?php 



$status = false;

$success = false;
$showError = false;



//  $showError = false;

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

session_start();

include 'Partials/_dbconnect.php';


if(isset($_POST['changePassword'])){

   

    
      $newPwd =test_input($_POST['pwd']);
      $cpwd = test_input($_POST['cpwd']);

if($newPwd == $cpwd){



   $hash_passwordEdit = password_hash($newPwd, PASSWORD_DEFAULT);

 


    $sql = " UPDATE `member` SET `password` = '$hash_passwordEdit' WHERE `member`.`email` = '$_SESSION[uemail]' ";
    
    $result = mysqli_query($conn, $sql);

    if($result){
       
        $success =  "Password Changed Successfully";


        // send email 

        
        $sql = " SELECT * FROM `member` WHERE `member`.`email` = '$_SESSION[uemail]' ";

        $result = mysqli_query($conn, $sql);
           if(mysqli_num_rows($result) > 0){

         while($row = mysqli_fetch_assoc($result)){
        
          require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';

          include 'Partials/_mail.php';
          
          $to =  $row['email'];
          $from = 'no-reply@nandysagar.in';
          $name = ' MATHHUB COMBINED PORTAL';  
          $subj =  ' LOGIN PASSWORD CHANGED ';
          $msg = ' <h3> Dear '.$row['name'].', </h3> <br> <p> Your password has been changed. <br> New password is '.$cpwd.' </p> <br> <p> If you did not change your password, please contact us immediately. </p> <br> <p> Thank you. </p> <br> <p> Regards, </p> <br> <p> MATHHUB COMBINED PORTAL </p> ';
      
           
          $error=member($to,$from, $name ,$subj, $msg);



      }
    
  }

    
  

}
    else{
       
        $showError = "Password not changed. Please try again.";
    }




}
else{

    $showError  = "Password not matched";

}
}





if(isset($_POST['checkEmail'])){

   
   
 
  $uemail =  (test_input($_POST["uemail"]));



//   $password = test_input($_POST["pwd"]) ;
//   $captcha = test_input($_POST["captcha"]) ;

//   if( $captcha == $_SESSION['captcha_code']){
  
 //  $sql = " SELECT * FROM student WHERE  Student_Id = '$uname' and mob = '$password' ";
 $sql = " SELECT * FROM member WHERE email = '$uemail'  ";

  $result = mysqli_query($conn,$sql);
  $numrows = mysqli_num_rows($result);
  

  if($numrows > 0 ){
    $row = mysqli_fetch_assoc($result);

  if($row > 0  ){

                $status = 1;

               

                $_SESSION['uemail'] = $uemail;

                $num = mt_rand(1000,9999);
               // echo $num;

               $sql = " UPDATE `member` SET `otp` = '$num' WHERE `member`.`email` = '$uemail' ";

                $result = mysqli_query($conn, $sql);


               if($result){

                  // send email 

     
      
        require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';

        include 'Partials/_mail.php';
        
        $to =  $_SESSION['uemail'];
        $from = 'no-reply@nandysagar.in';
        $name = ' MATHHUB COMBINED PORTAL';  
        $subj =  ' VERIFICATION CODE ';
        $msg = '  <p> Your verification code is '.$num.' </p> <br>  <br> <p> Regards, </p> <br> <p> MATHHUB COMBINED PORTAL </p> ';
    
         
        $error=member($to,$from, $name ,$subj, $msg);

        if($error){
            $success = "Email sent successfully";
        }
        else{
            $showError = "Email not sent";
        }    

    }
    else{
        $showError = "Email not sent";
    }
}
else{
    $showError = "Invalid Credentials";
}
}
else{
    $showError = "Invalid Credentials";
}


}







include 'Partials/_visit_count.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>FORGET PASSWORD - MATHHUB COMBINED</title>
    <?php include 'Partials/_link.php'; ?>

</head>

<body>

<!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>

<?php

if($success){
    ?>

    <script>
        swal({
            title: "Success",
            text: "<?php echo $success; ?>",
            icon: "success",
            button: "OK",
        }).then(function() {
            window.location = "SignIn.php";
        });
    </script>

    <?php
   session_destroy();
}






if($showError){
    
        ?>
        
        <script>
            swal({
                title: "Error",
                text: "<?php echo $showError; ?>",
                icon: "error",
                button: "Try Again",
            }).then(function() {
                window.location = "forgetPassword.php";
            });
        </script>
        <?php
}



?>


    <?php include 'Partials/_header.php' ?>
    <div class="topnav" >

<p class=' text-center topnav-title'>
<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  Change Password

<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  </p>

</div>



    <div class="container  my-3  ">

        <div class="row">






            <div class=" col-sm-6 col-md-4 col-md-offset-4">
              

                    

                    <div class="alert alert-info border-1 mt-3">
                   <div class="text-center">
                    <i class="fa fa-key" style="font-size:6rem;"></i>
                   <h3 class="mb-3  font-weight-bold">Forget Password</h3>
                   </div>
                   <hr class="hr-info">
                   <?php

                   if(!$status){

                    ?>


                  


                        <form method = "POST">
                            <div class="form-group">
                                <label for="uname" class="font-weight-bold"> <i class="fa fa-envelope"></i> Email :</label>
                                <input type="email" class="form-control" id="uname" name="uemail" minlength="12" maxlength="50" placeholder="Enter your registered email" required>
                            </div>

                            <!-- <div class="form-group">
                                <label for="pwd" class="font-weight-bold"> <i class="fa fa-lock"></i> Password:</label>
                                <input type="password" minlength="5" class="form-control" id="pwd" name="pwd" required>
                            </div> -->
                           
                           
                            <div class="text-center">
                                <input type="submit"  class="btn btn-read btn-block" onclick="showLoader()" value="Submit" name="checkEmail">
                            </div>



                        </form>
                 
                        <?php
                   }

                   if($status==1){

                    ?>

                    <script>
                        swal({
                            
                            title: " Verification code has been sent to <?php echo $uemail; ?>. Please check your email.",
                            icon: "success",
                            button: "OK",
                        });
                    </script>

                    <form method = "POST">
                    <div class="form-group">
                        <label for="uname" class="font-weight-bold"> Enter  Verification Code:</label>
                        <input type="number" class="form-control" id="uname" name="otp" minlength="4" maxlength="4" required>
                    </div>

                  
                   
                   
                    <div class="text-center">
                        <input type="submit"  class="btn btn-read btn-block"  value="Validate OTP" name="checkOtp">
                    </div>



                </form>
<?php
                   }

                   if($status==2){

                    ?>

<form method="POST">
        <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"> <i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control" name="pwd" placeholder="New Password" aria-describedby="basic-addon1" minlength="8" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Must contain at least one number and one uppercase and lowercase letter and atleast 8 characters." required>
        </div>
        <div class="text-muted">** Only letters and numbers are allowed.</div> 

        <div class="input-group mt-3">
                  <span class="input-group-addon" id="basic-addon2"> <i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control" name="cpwd" placeholder="Confirm Password" aria-describedby="basic-addon2" minlength="8" maxlength="50" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Must contain at least one number and one uppercase and lowercase letter and atleast 8 characters." required>
        </div>
        <div class="text-muted">** Confirm password should be same as new password.</div> 

       <div class="text-center mt-3">
       <input type="submit" class="btn btn-success btn-block" value="Save Changes" name="changePassword">
       </div>
        </form>


                   <?php

                   }


                   ?>


                    </div>

            


            </div>



        </div>
    </div>



    <?php include 'Partials/_footer.php' ?>
    <script src="js/loader.js"></script>
</body>

</html>






















