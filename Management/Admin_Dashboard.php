<?php
include '../Partials/_dbconnect.php';

include '../Partials/_visit_count.php';



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
    // $loggedin = true;
    $sql = " SELECT * FROM member WHERE uid = '$_SESSION[uname]' ";

    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
      $role = $row['role'];
      $name = $row['name'];

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





$first_sql = " SELECT * FROM `member` ";
$first_result = mysqli_query($conn, $first_sql);

// Find the number of records returned
$first_num = mysqli_num_rows($first_result);

// check verified member

$verified_sql = "SELECT * FROM `member` WHERE role = '3' OR role = '1' OR role = '2' ";
$verified_result = mysqli_query($conn, $verified_sql);

// Find the number of records returned
$verified_num = mysqli_num_rows($verified_result);

// check moderator

$moderator_sql = "SELECT * FROM `member` WHERE role = '2' ";
$moderator_result = mysqli_query($conn, $moderator_sql);

// Find the number of records returned
$moderator_num = mysqli_num_rows($moderator_result);


// check Admin 

$admin_sql = "SELECT * FROM `member` WHERE role = '1' ";

$admin_result = mysqli_query($conn, $admin_sql);

// Find the number of records returned
$admin_num = mysqli_num_rows($admin_result);

// check unverified member

$unverified_sql = "SELECT * FROM `member` WHERE role = '0' ";
$unverified_result = mysqli_query($conn, $unverified_sql);

// Find the number of records returned
$unverified_num = mysqli_num_rows($unverified_result);


 // Latest News table

$second_sql = "SELECT * FROM `news`";
$second_result = mysqli_query($conn, $second_sql);

// Find the number of records returned
$second_num = mysqli_num_rows($second_result);

 // Notice table

 $third_sql = "SELECT * FROM `notices`";
 $third_result = mysqli_query($conn, $third_sql);
 
 // Find the number of records returned
 $third_num = mysqli_num_rows($third_result);



// total earnings

// $third_sql = "SELECT sum(amount_paid) as   `Earnings` FROM `fees`";
// $third_result = mysqli_query($conn, $third_sql);
// $sum = mysqli_fetch_array($third_result);


?>


<!DOCTYPE html>
<html lang="en">
<head>
   
    <title><?php echo $role_name; ?> Dashboard - MATHHUB COMBINED</title>
   <?php include '../Partials/_admin_link.php' ?>

<!------ Include the above in your HEAD tag ---------->
</head>
<body>

<section>
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">

<?php include '../Partials/_topNav.php' ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
              

                    <div id="content">

                    <div class="alert alert-info" style="padding:2px 0 0 0 ; ">
                    <marquee behavior="alternate" scrolldelay="4" width="100%">
  <strong style="font-size:18px;">Welcome To MathHub  <?php echo $role_name; ?> Dashboard <i class="fa fa-user"></i> <?php echo $name; ?></strong> 
</marquee>
</div>

<a href="../index.php"> 
                <div class="col-md-3">
                        <div class="well well4 ">
                          <i class="fa fa-home blink " style="font-size:30px;"></i> Go Home 
                          </span>
                        </div>
                      </div>
</a>
      <?php

      if($role==1){

     echo' 
      <a href="userControl.php"> 
                      <div class="col-md-3">
                              <div class="well well1 ">
                                <i class="fa fa-group blink " style="font-size:30px;"></i> Total Member <span
                                  class="label label-warning" style="font-size:15px;">
                                  '. $first_num .'
                                </span>
                              </div>
                            </div>
      </a>
      <a href="userControl.php">      <div class="col-md-3">
        <div class="well well2 ">
          <i class="fa fa-check-circle blink" style="font-size:30px;" ></i> Total Verified Member <span
            class="label label-warning" style="font-size:15px;">
             '.$verified_num.'
          </span>
        </div>

      </div>
    </a>';
      
      }
      
      ?>
                      <a href="addNotice.php">     <div class="col-md-3">
                        <div class="well well3 ">
                          <i class="fa fa-bullhorn blink" style="font-size:30px;" ></i> Active Notices  <span
                            class="label label-warning" style="font-size:15px;">
                            <?php echo $third_num; ?>
                          </span>
                        </div>
                      </div></a>
                      <a href="viewNews.php">     <div class="col-md-3">
                        <div class="well well2 ">
                          <i class="fa fa-bell blink" style="font-size:30px;" ></i> Latest News <span
                            class="label label-warning" style="font-size:15px;">
                            <?php echo $second_num; ?>
                          </span>
                        </div>
                      </div>
                      </a>
                      <?php

      if($role==1){

      ?>
      <a href="userControl.php">   <div class="col-md-3">
        <div class="well well5 ">
          <i class="fa fa-user-circle blink" style="font-size:30px;"></i> Total Moderator <span
            class="label label-warning" style="font-size:15px;">
            <?php echo $moderator_num; ?>
          </span>
        </div>
      </div> </a>
      <a href="userControl.php">   <div class="col-md-3">
        <div class="well well4 ">
          <i class="fa fa-bullhorn blink" style="font-size:30px;" ></i> Total Admin  <span
            class="label label-warning" style="font-size:15px;">
            <?php echo $admin_num; ?>
          </span>
        </div>
      </div>
      </a>

     <a href="userControl.php"> <div class="col-md-3">
        <div class="well well1 ">
          <i class="fa fa-spinner fa-spin" style="font-size:30px;" ></i> Verification Pending   <span
            class="label label-warning" style="font-size:15px;">
            <?php echo $unverified_num; ?>
          </span>
        </div>
      </div>
      </a>
      <?php 
      }
      
      ?>
                      

                      <div class="col-md-4">
                        <div class="panel panel-primary">
                          <div class="panel-heading">
                            <h3 class="panel-title"><b><i class="fa fa-flag"></i> Latest News</b></h3>
                          </div>
                          <div class="panel-body " style="padding:10px ;" >

                          <?php

                          $sql = "SELECT * FROM `news`";
                          $result = mysqli_query($conn, $sql);

                          $num = mysqli_num_rows($result);
                           $sno = 0;
                          if($num>0){

                            while($row = mysqli_fetch_assoc($result)){

                              $sno = $sno + 1;

                              $startTime  = strtotime( $row['start_date'] );
/* echo    $start;
echo "<br>";*/
$endTime  = strtotime($row['end_date']);
/* echo    $end;
echo "<br>";
echo time();*/

if(time() < $startTime){
    $status = "<span class='text-center label label-warning'> Application is not started yet </span>";
    
}
else {
    if($startTime < time() && $endTime > time()){
        $status = "<span class='text-center label label-success'> <i class='fa fa-spinner fa-spin'></i> Running </span>";
    }
    else{
        $status = "<span class='text-center label label-danger blink'><i class='fa fa-remove'></i> Closed </span>";
      
    }
}

                              ?>

                        
                        <a href="<?= $row['application_link'] ?>"  >

                        <b>
                            

                        <?= $sno; ?>) <?= $row['title']; ?> <?= $status; ?>

                        </b>
                            </a> <br> <br>

                        

                              <?php



                            }

                          }
                          else{
                            echo "<div class='alert alert-danger' style='padding:2px 0 0 0 ; '>
                            <strong style='font-size:18px;'>No News Found</strong>";
                          }


                          ?>

                         

                          </div>

                        </div>
                      </div>
                      <div class="col-md-4">
                      <div class="panel panel-danger">
                      <div class="panel-heading">
                            <h3 class="panel-title"><b><i class="fa fa-bullhorn"></i> Notices</b></h3>
                          </div>
                          <div class="panel-body">

                              <?php
    $sql = "SELECT * FROM `notices`";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num>0){
    
    
       
    while($row = mysqli_fetch_assoc($result)){
    
      ?>

<div class="alert alert-danger">
<strong><span class="label label-danger  blink">New</span> <a href="<?= $row['notice_link']; ?>" class="text-danger"><?= $row['notice_title']; ?></a> </strong> <span class="label label-info">Posted On <?= $row['Date_Time']; ?></span> 
</div>

      <?php
     
    
    }
    }
  
    ?>
                            
                          </div>
                          
                          </div>
                      </div>

                      <?php

      if($role==1){

      ?>
      <div class="col-md-4">
      <div class="panel panel-info">
      <div class="panel-heading">
            <h3 class="panel-title"><b><i class="fa fa-flag"></i> Online Users</b></h3>
          </div>
          <div class="panel-body">

              <?php

              $check_activity = "SELECT * FROM `member` WHERE activity = '1'";
              $result = mysqli_query($conn, $check_activity);
              $num = mysqli_num_rows($result);
              if($num>0){

                while($row = mysqli_fetch_assoc($result)){

                  ?>

                  <div class="alert alert-success">
                  <strong> <i class="fa fa-user"></i>
                  <?= $row['name']; ?> <span class="label label-success  blink">Online</span></strong> 
                  </div>

                    <?php
                }
              }
              else{
                echo "<div class='alert alert-danger'>
                <strong>No Active User Found</strong>
                </div>";
              }

              ?>
            
          </div>
          
          </div>
      </div>
      <?php 
      }
      
      ?>







                
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
</section>

<script>
      function Logout ()
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