<?php 



$login = false;
$showError = false;

 // sleep(1);
//  $showError = false;

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



//echo $_SESSION['captcha_code'];

include 'Partials/_dbconnect.php';


if($_SERVER["REQUEST_METHOD"]  == "POST"){

   
  
 
  $uname =  (test_input($_POST["uname"]));
  $password = test_input($_POST["pwd"]) ;
//   $captcha = test_input($_POST["captcha"]) ;

//   if( $captcha == $_SESSION['captcha_code']){
  
 //  $sql = " SELECT * FROM student WHERE  Student_Id = '$uname' and mob = '$password' ";
 $sql = " SELECT * FROM member WHERE binary uid = '$uname'  ";

  $result = mysqli_query($conn,$sql);
  $numrows = mysqli_num_rows($result);
  

  if($numrows > 0  ){
    $row = mysqli_fetch_assoc($result);

    $verify_password = password_verify($password, $row['password']) ;

    if($verify_password == 1  ){

                $login = true;

                session_start();


                $update_activity = "UPDATE member SET activity = '1' WHERE uid = '$uname' ";
                $result = mysqli_query($conn, $update_activity);

                
                            $_SESSION['loggedin'] = true;
                            $_SESSION['uname'] = $uname;
                            $_SESSION['upass'] = $password;
                            $_SESSION['role'] = $row['role'];

                            
                            ?>
                           
            <?php
            }
  
              else{  
                    
                      $showError = " Invalid Credentials";
                  }


   

    
}

else{

  $showError = " Invalid Credentials";
}
// }
// else{
//   $showError = " Invalid Captcha";
// }
}

include 'Partials/_visit_count.php';


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>LOGIN - MATHHUB COMBINED</title>
    <?php include 'Partials/_link.php'; ?>

</head>

<body>

<!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>

<?php

if($login){

  


    if($_SESSION['role']==3 || $_SESSION['role']==0){
    ?>
    
    <script>
        swal({
            title: "Login Successful",
            text: "Welcome to MathHub Combined",
            icon: "success",
            button: "Continue",
        }).then(function() {
            window.location = "StudyMaterials.php";
        });
    </script>
    <?php
}
else if($_SESSION['role']==1 || $_SESSION['role']==2){
    ?>
    
    <script>
        swal({
            title: "Admin Login Successful",
            text: "Welcome to MathHub Combined Admin Dashboard",
            icon: "success",
            button: "Continue",
        }).then(function() {
            window.location = "Management/Admin_Dashboard.php";
        });
    </script>
    <?php
}
}

if($showError){
    ?>
    <script>
        swal({
            title: "<?php echo $showError; ?>",
            // text: " ",
            icon: "error",
            button: "Try Again",
        }).then(function() {
            window.location = "SignIn.php";
        });
    </script>
    <?php
}



?>


    <?php include 'Partials/_header.php' ?>
    <div class="topnav" >

<p class=' text-center topnav-title'>
<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  Login

<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  </p>

</div>



    <div class="container  my-3  ">

        <div class="row">






            <div class=" col-sm-6 col-md-4 col-md-offset-4">
              

                    

                    <div class="alert alert-info border-1 mt-3">
                   <div class="text-center">
                    <i class="fa fa-user-circle" style="font-size:6rem;"></i>
                   <h3 class="mb-3  font-weight-bold">Login to continue</h3>
                   </div>
                   <hr class="hr-info">
                        <form method = "POST">
                            <div class="form-group">
                                <label for="uname" class="font-weight-bold"> <i class="fa fa-user"></i>  Member Id :</label>
                                <input type="text" class="form-control" id="uname" name="uname" minlength="12" maxlength="12" required>
                            </div>
                            <div class="form-group">
                                <label for="pwd" class="font-weight-bold"> <i class="fa fa-lock"></i> Password:</label>
                                <input type="password" minlength="5" class="form-control" id="pwd" name="pwd" required>
                            </div>
                            <!-- <div class="form-group">
                            <label for="uname" class="font-weight-bold">  Enter Captcha :</label>
                            <label class="sr-only" for="Captcha">Captcha</label>
                                    <div class="input-group">
                                    <div class="input-group-addon" style="font-weight: bold; font-size:22px;"><?php //echo $rand_num; ?></div>
                                    <input type="text" class="form-control" id="Captcha" name="captcha" placeholder="Enter Captcha" required>
                            </div>
                            </div> -->
                           
                            <div class="text-center">
                                <button type="submit" class="btn btn-read" onclick="showLoader()"> Login Now</button>
                            </div>



                        </form>
                 
                        <p class="text-center pt-1 font-weight-bold "> 

                          Donot have an account? <a href="SignUp.php" class="text-danger">Sign Up</a>
                    </p>
                    <p class="text-center pt-1 font-weight-bold "> 

                         Forget Password ? <a href="forgetPassword.php" class="text-danger">Change Now</a>
                    </p>


                    </div>

            


            </div>



        </div>
    </div>



    <?php include 'Partials/_footer.php' ?>
    <script src="js/loader.js"></script>
</body>

</html>






















