
<?php

// date format 
date_default_timezone_set("Asia/Calcutta");
$dt = date('Y-m-d H:i:s A');
$year = date('Y');

// registration id generator
$ip = $_SERVER['REMOTE_ADDR'];


$reg_id = "MCU" . $year. rand(10000, 99999);

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
//echo $reg_id;
$insert = false;
$errorMSG = false;

sleep(2);

if($_SERVER["REQUEST_METHOD"]=="POST"){

    include 'Partials/_dbconnect.php'; 

    
  
    
    $name = test_input( $_POST['uname']);
   
   
    $email = test_input($_POST['uemail']);
    $password = test_input($_POST['upwd']);
    $cpassword =test_input($_POST['ucpwd']);

    if( $password == $cpassword ){
     $hash_password = password_hash($password, PASSWORD_DEFAULT);
  
    
  
   
    $date = test_input( $_POST['Date_Time']);
    $uid = test_input($_POST['User_Id']);
    $reg_time_ip = test_input($_POST['Reg_Time_IP']);
  
 
    
    
    $check = "SELECT * from member where email = '$email'";
    $result = mysqli_query($conn,$check);
    $count = mysqli_num_rows($result);
  
    if(!($count) == 1){
   // insert data code goes here 
         $sql = "INSERT INTO `member` (`Date_Time`, `uid`, `name`, `email`, `ip`, `password`) VALUES ('$date', '$uid', '$name', '$email',  '$reg_time_ip' , '$hash_password')";
  
         
           
    $result = mysqli_query($conn,$sql);
         
    
        if($result){
  
         // echo $sql;
  
            $insert = true;
        // echo "<script>window.location.href='mathhub_admin_dashboard.php';</>";
// edit details send mail 
 require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';

        include 'Partials/_mail.php';

        $to   =  $_POST['uemail'];
        $from = 'no-reply@nandysagar.in';
        $name = ' MATHHUB COMBINED PORTAL';  
        $subj = 'Welcome to MATHHUB COMBINED PORTAL';
        $msg = '
        <html>
       
        <body style="font-size: 18px;">
        <div class="container">
        <center><h3 style="color:green; font-weight:bold;">Account Created Successfully</h3></center> <br>
        <h4>Hi, <span style=" font-weight:bold;color:blue;"> ' .$_POST['uname'] . ' </span> Congratulations!  Your account has been created successfully. </h4> <br>
        
        <table border="1">
        <thead > <tr><th style="font-weight:bold;" colspan="2">Profile Details</th> </tr></thead>
        <tbody>
        <tr>
        <td   style="font-weight:bold;">Member Id</td>
        <td>' . $uid . '</td>
        </tr>
        <tr>
        <td  style="font-weight:bold;">Email Id</td>
        <td>'  . $email. '</td>
        </tr>
        <tr>
        <td  style="font-weight:bold;">Login Password</td>
        <td>' .$cpassword.  '</td>
        </tr>
        
        <tr>
        <td  style="font-weight:bold;">Registration Time </td>
        <td>'  .$date. '</td>
        
        
        
        </tr>
        <tr>
        <td  style="font-weight:bold;">Network IP </td>
        <td>'  .$reg_time_ip. '</td>
        
        
        
        </tr>
       
        
        
        </tbody>
        </table>
        
        
        <br>
        <br>
        
        
         <p>** Please login to the portal . Login Link - <a href="https://projects.nandysagar.in/Combined/SignIn.php"> Click Here </a> </p>
          <br>
          
          <p style="font-weight:bold; font-size:15px;">** PLEASE NOTE :-  DONOT REPLY TO THIS EMAIL AS IT IS AUTOMATICALLY GENERATED. </p>
          </div>
        </body>
        </html>
        
        ';
        
        $error=member($to,$from, $name ,$subj, $msg);

        // echo $error;

        
  
  
        }
        else{
            $errorMSG = "We could not insert the record successfully";
        }
  
        
         
  
  
    }  
    else{
     
        $errorMSG = "Email already exists";
    }
  }
   else{
    
    $errorMSG = "Password does not match";
    
  
  
    }
  
    
}
   
  
  
  
include 'Partials/_visit_count.php';
  
  


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>CREATE ACCOUNT  - MATHHUB COMBINED</title>
    <?php include 'Partials/_link.php'; ?>

</head>

<body>

<?php

if($insert){
    ?>
    <script>
       swal("Your account has been created successfully", " Member Id is : <?php echo $uid; ?> ", "success");
    </script>
    <?php
    header("refresh:3;url=SignIn.php");
}

if($errorMSG){
    ?>
    <script>
       swal("Oops Error!!", "<?php echo $errorMSG; ?>", "error");
    </script>
    <?php
}


?>

<!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
    <?php include 'Partials/_header.php' ?>
    <div class="topnav" >

<p class=' text-center topnav-title'>
<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

 Sign up

<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  </p>

</div>
<?php include 'Partials/_navbar.php'; ?>



    <div class="container  my-3  ">

        <div class="row">






            <div class=" col-md-6 col-md-offset-3">
              

                    

         <div class="alert alert-info border-1 mt-3">
                   <h3 class="mb-3  font-weight-bold"> <i class="fa fa-user-plus"></i> Create Account</h3>
                   <hr class="hr-info">
                        <form method = "POST" id="signup-form">
                            <input type="hidden" name="Date_Time" value="<?php echo $dt; ?>">
                            <input type="hidden" name="User_Id" value="<?php echo $reg_id; ?>">
                            <input type="hidden" name="Reg_Time_IP" value="<?php echo $ip; ?>">

                        <div class="form-group">
                                <label for="uname" class="font-weight-bold"><i class="fa fa-user-circle"></i> Full Name:</label>
                                <input type="text" class="form-control" id="uname"  name="uname" required>
                                <span class="nameCheck"></span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold"><i class="fa fa-envelope"></i> Email address:</label>
                                <input type="email" class="form-control" id="email" style="text-transform:lowercase ;" name="uemail" required>
                                <div class="text-muted">** We'll send you a confirm mail  to this email.</div> 
                                <span class="emailCheck"></span>
                            </div>
                            <div class="form-group">
                                <label for="pwd" class="font-weight-bold"> <i class="fa fa-lock"></i> Create Password:</label>
                                <input type="password" class="form-control" id="pwd" name="upwd" required>
                                <div class="text-muted">** Don't share your password with anyone else.</div> 

                                <span class="pwdCheck"></span>
                            </div>
                            <div class="form-group">
                                <label for="cpwd" class="font-weight-bold"> <i class="fa fa-lock"></i> Confirm Password:</label>
                                <input type="password" class="form-control" id="cpwd" name="ucpwd" required>
                                <span class="cpwdCheck"></span>
                            </div>

                            <div class="checkbox">
                              <label for="cdn" class="font-weight-bold"><input type="checkbox"  id="cdn" name="cdn" required> <b >  

                              I confirmed that I will not share any content from this portal to any other portal or social media platform or any person without the permission of the owner of this portal. 

                              </b></label>
                                
                                
                            </div>
                           
                            <div class="text-center">
                                <input type="submit" class="btn  btn-read" value="Create Account" onclick="showLoader()">
                            </div>

                        </form>

                        <p class="text-center pt-1 font-weight-bold">
                            Already have an account? <a href="SignIn.php " class="text-danger">Login</a>
                        </p>


                    </div>

            


            </div>




            
                    </div>
                </div>
            
            
            
                <?php include 'Partials/_footer.php' ?>
                <script src="js/loader.js"></script>
                <script>

                    $(document).ready(function(){


                        $(".nameCheck").hide();
                        $(".emailCheck").hide();
                        $(".pwdCheck").hide();
                        $(".cpwdCheck").hide();


                        var error_name = true;
                        var error_email = true;
                        var error_pwd = true;
                        var error_cpwd = true;

                        $("#uname").keyup(function(){
                            check_name();
                        });

                        $("#email").keyup(function(){
                            check_email();
                        });

                        $("#pwd").keyup(function(){
                            check_pwd();
                        });

                        function check_name(){
                            var name = $("#uname").val().length;
                            if(name < 5){
                                $(".nameCheck").show();
                                $(".nameCheck").html("Name should be atleast 5 characters");
                                $(".nameCheck").css("color","red");
                                error_name = false;
                                return false;
                            }else{
                                $(".nameCheck").hide();
                            }

                            var name_val = $("#uname").val();
                            var reg = /^[a-zA-Z ]+$/;
                           
                            if(reg.test(name_val)){
                                $(".nameCheck").hide();
                            }else{
                                $(".nameCheck").show();
                                $(".nameCheck").html("Name should contain only alphabets");
                                $(".nameCheck").css("color","red");
                                error_name = false;
                                return false;
                            }

                            var name_empty = $("#uname").val();
                            if(name_empty.length == ""){
                                $(".nameCheck").show();
                                $(".nameCheck").html("Name should not be empty");
                                $(".nameCheck").css("color","red");
                                error_name = false;
                                return false;
                            }else{
                                $(".nameCheck").hide();
                            }
                        }

                        function check_email(){
                            var email = $("#email").val().length;
                            if(email < 14){
                                $(".emailCheck").show();
                                $(".emailCheck").html("Invalid email");
                                $(".emailCheck").css("color","red");
                                error_email = false;
                                return false;
                            }
                            else{
                                $(".emailCheck").hide();
                            }
                         var email_val = $("#email").val();
                            var reg = /^([a-zA-Z0-9]+)@([a-z]+).([a-z]{3,5})(.[a-z]{3,5})?$/;
                            if(reg.test(email_val)){
                                $(".emailCheck").hide();
                            }else{
                                $(".emailCheck").show();
                                $(".emailCheck").html("Invalid email");
                                $(".emailCheck").css("color","red");
                                error_email = false;
                                return false;
                            }

                            var email_empty = $("#email").val();

                            if(email_empty.length == "" ){
                                $(".emailCheck").show();
                                $(".emailCheck").html("Email should not be empty");
                                $(".emailCheck").css("color","red");
                                error_email = false;
                                return false;
                            }else{
                                $(".emailCheck").hide();
                            }


                        }

                        function check_pwd(){
                            var pwd = $("#pwd").val().length;

                           
                            if(pwd < 8){
                                $(".pwdCheck").show();
                                $(".pwdCheck").html("Please enter at least 8 characters");
                                $(".pwdCheck").css("color","red");
                                error_pwd = false;
                                return false;
                            }else{
                                $(".pwdCheck").hide();
                            }

                            var pwd_empty = $("#pwd").val();
                            if(pwd_empty.length == "" ){
                                $(".pwdCheck").show();
                                $(".pwdCheck").html("Password should not be empty");
                                $(".pwdCheck").css("color","red");
                                error_pwd = false;
                                return false;
                            }else{
                                $(".pwdCheck").hide();
                            }

                            var pwd_val = $("#pwd").val();
                            var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
                            if(reg.test(pwd_val)){
                                $(".pwdCheck").hide();
                            }else{
                                $(".pwdCheck").show();
                                $(".pwdCheck").html("Password should contain atleast one uppercase, one lowercase and one digit");
                                $(".pwdCheck").css("color","red");
                                error_pwd = false;
                                return false;
                            }
                        }

                      var cpwd = $("#cpwd").val();
                      var reg =  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
                        if(reg.test(cpwd)){
                            $(".cpwdCheck").hide();
                        }else{
                            $(".cpwdCheck").show();
                            $(".cpwdCheck").html("Password should contain atleast one uppercase, one lowercase and one digit");
                            $(".cpwdCheck").css("color","red");
                            error_cpwd = false;
                            return false;
                        }

                        if(cpwd != pwd){
                            $(".cpwdCheck").show();
                            $(".cpwdCheck").html("Password does not match");
                            $(".cpwdCheck").css("color","red");
                            error_cpwd = false;
                            return false;


                    }

                    if(cpwd = " "){ 
                        $(".cpwdCheck").show();
                        $(".cpwdCheck").html("Password should not be empty");
                        $(".cpwdCheck").css("color","red");
                        error_cpwd = false;
                        return false;
                    }else{
                        $(".cpwdCheck").hide();
                    }

                        $("#submit").click(function(){
                            error_name = true;
                            error_email = true;
                            error_pwd = true;
                            error_cpwd = true;

                            check_name();
                            check_email();
                            check_pwd();
                            check_cpwd();

                            if(error_name == true && error_email == true && error_pwd == true && error_cpwd == true){
                                return true;
                            }else{
                                return false;
                            }
                        });

                    });

                </script>
            </body>
            
            </html>
