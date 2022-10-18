
<?php 


session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
?>
<script>
  window.location.href = "SignIn.php";
</script>
<?php
    exit;
}else{
    $loggedin = true;
}


include 'Partials/_dbconnect.php';


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

 


    $sql = " UPDATE `member` SET `password` = '$hash_passwordEdit' WHERE `member`.`uid` = '$_SESSION[uname]' ";
    
    $result = mysqli_query($conn, $sql);

    if($result){
       
        $success =  "Password Changed Successfully";


        // send email 

      $sql = " SELECT * FROM `member` WHERE `member`.`uid` = '$_SESSION[uname]' ";

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
       
        $errMsg = "Password not changed. Please try again.";
    }




}
else{

    $errMsg  = "Password not matched";

}
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>PROFILE - MATHHUB COMBINED</title>
    <?php include 'Partials/_link.php'; ?>

</head>

<body>
  <?php

  if($success){
    ?>
    <script>
      swal({
        title: "<?php echo $success; ?>",
        text: "",
        icon: "success",
        button: "OK",
      });
    </script>
    <?php
  }

  if($errMsg){
    ?>
    <script>
      swal({
        title: "<?php echo $errMsg; ?>",
        text: "",
        icon: "error",
        button: "OK",
      });
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

  Profile Details

<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  </p>

</div>


    <div class="container  my-3  ">

   

        <div class="row">


        <?php

$sql = "SELECT * FROM `member` WHERE `uid` = '$_SESSION[uname]'";

  $result = mysqli_query($conn, $sql);

     while($row = mysqli_fetch_assoc($result)){

      $date = $row['Date_Time'];

         $uid = $row['uid'];
         $name = $row['name'];
         $email = $row['email'];
        $role = $row['role'];
     }

?>


            <div class="  col-sm-6  col-md-offset-3 ">
              

                    

                    <div class="alert alert-info border-1 mt-3" >
                      <div class="text-center">
                      <i class="fa fa-user-circle" style="font-size:6rem;"> </i>
                      <h3 class=" font-weight-bold" style="margin-top: 8px;"> <?php echo $name; ?></h3>

                      </div>
                  
                   <hr class="hr-info" style="margin-top:2px;">

                

                     <div class="row">
                          <div class="col-md-12  text-center">
                           
                            <h5 class="font-weight-bold"><i class="fa fa-user"></i> Member Id : <span class="text-danger"> <?php echo $uid; ?> </span></h5>
                            
                            <h5 class="font-weight-bold"><i class="fa fa-envelope"></i> Email : <span class="text-danger">  <?php echo $email; ?> </span></h5>
                            <h5 class="font-weight-bold"><i class="fa fa-info-circle"></i> Account Status :
                                 <?php
                                 if($role==0) {

                                    echo " <span class='label label-danger '> <i class='fa fa-spinner fa-spin'></i> Verfication Pending </span>"; 

                                 } else {
                                        
                                        echo " <span class='label label-success'> <i class='fa fa-check-circle'></i> Verified </span>"; 
    
                                 }
                                 ?>
                            </h5>
                            <h5 class="font-weight-bold"><i class='fa fa-user'></i> Usertype:
                            
                            <?php
                                 if($role==0) {

                                    echo " <span class='label label-warning '> Normal User </span>"; 

                                 } elseif($role==1) {
                                        
                                        echo " <span class='label label-warning'>Admin</span>"; 
    
                                 }
                                 elseif($role==2) {
                                        
                                        echo " <span class='label label-warning'>Moderator</span>"; 
    
                                 }
                                 else{
                                    echo " <span class='label label-warning'>Normal User</span>"; 
                                 }
                                 ?>
                            </h5>
                            <h5 class="font-weight-bold"><i class="fa fa-calendar"></i> Joined On : <span class="text-danger"> <span class='label label-primary'> <?php echo $date; ?> </span></h5>


                            <button type="button" class="btn btn-down" data-toggle="modal" data-target="#changePassword">

                        <i class="fa fa-key"></i>   Change Password

                            </button>

                          </div>
                     </div>
                 
    <!-- Modal -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-key"></i> Change Password</h4>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
 
    

    

    

  </div>

                    

            </div>



        </div>
    </div>



    <?php include 'Partials/_footer.php' ?>
    <script src="js/loader.js"></script>
    <script>
      function confirm ()
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
            window.location.href = "Signout.php";
          } else {
            swal("You are still logged in!");
          }
          
        });
      }
      
    </script>
</body>

</html>






















