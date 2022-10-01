
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

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>PROFILE - MATHHUB COMBINED</title>
    <?php include 'Partials/_link.php'; ?>

</head>

<body>
<!-- Preloader -->
<!-- <div id="preloader">
  <div id="status">&nbsp;</div>
</div> -->

    <?php include 'Partials/_header.php' ?>
  

    <div class="topnav" >

<p class=' text-center topnav-title'>
<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  Profile Details

<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  </p>

</div>
<?php  include 'Partials/_navbar.php' ?>

    <div class="container  my-3  ">

        <div class="row">

<div class="col-md-3">
  
<div class="panel panel-danger">
    <div class="panel-heading bg-danger">
      <h3 class="panel-title"> <i class="fa fa-info-circle"></i> <b> Other Links </b> </h3>
    </div>
    <div class="panel-body">

    <div class="well well-sm well-3"><a href="index.php" > <i class="fa fa-home"></i> Go to home</a></div>

    <div class="well well-sm well-2"><a href="StudyMaterials.php"> <i class="fa fa-graduation-cap"></i>  Study Materials for PRO user</a></div>

<div class="well well-sm "><a href="https://mathhubcombined.vercel.app/"> <i class="fa fa-graduation-cap"></i> Free Study Materials</a></div>

                     </div>
                   


                    </div>

                    <div class="panel panel-default">
    <div class="panel-heading bg-danger">
      <h3 class="panel-title"> <i class="fa fa-bullhorn"></i> <b> Announcements </b> </h3>
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

include 'Partials/_visit_count.php';

  
    ?>
    
  

   

</div>
</div>


</div>




            <div class=" col-md-9 ">
              

                    

                    <div class="alert alert-info border-1 mt-3">
                   <h3 class="mb-3  font-weight-bold"><i class="fa fa-user"></i> Profile Info</h3>
                   <hr class="hr-info">

                   <?php

                   $sql = "SELECT * FROM `member` WHERE `uid` = '$_SESSION[uname]'";

                     $result = mysqli_query($conn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
    
                            $uid = $row['uid'];
                            $name = $row['name'];
                            $email = $row['email'];
                           $role = $row['role'];
                        }

                   ?>

                     <div class="row">
                          <div class="col-md-6">
                            <h4 class="font-weight-bold"><i class="fa fa-user"></i> Member Id : <span class="text-danger"> <?php echo $uid; ?> </span></h4>
                            <h4 class="font-weight-bold"><i class="fa fa-user-circle"></i> Name : <span class="text-danger">  <?php echo $name; ?> </span></h4>
                            <h4 class="font-weight-bold"><i class="fa fa-envelope"></i> Email : <span class="text-danger">  <?php echo $email; ?> </span></h4>
                            <h4 class="font-weight-bold"><i class="fa fa-info-circle"></i> Account Status :
                                 <?php
                                 if($role==0) {

                                    echo " <span class='label label-danger '> <i class='fa fa-spinner fa-spin'></i> Verfication Pending </span>"; 

                                 } else {
                                        
                                        echo " <span class='label label-success'> <i class='fa fa-check-circle'></i> Verified </span>"; 
    
                                 }
                                 ?>
                            </h4>
                            <h4 class="font-weight-bold"><i class='fa fa-user'></i> Usertype:
                            
                            <?php
                                 if($role==0) {

                                    echo " <span class='label label-warning '> Normal User </span>"; 

                                 } else {
                                        
                                        echo " <span class='label label-warning'>Pro User</span>"; 
    
                                 }
                                 ?>
                            </h4>
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






















