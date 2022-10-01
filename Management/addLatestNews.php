<?php
    include '../Partials/_dbconnect.php'; 


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



// date format 
date_default_timezone_set("Asia/Calcutta");
$dt = date('Y-m-d H:i:s A');

$insert = false;
$msg = false;


if($_SERVER["REQUEST_METHOD"]=="POST"){

  
    
    $title = test_input( $_POST['title']);
    $date = $_POST['Date_Time'];
    $start_date = test_input($_POST['start_date']);
    $end_date = test_input($_POST['end_date']);

    $edit_date = test_input($_POST['edit_date']);


    $fees = test_input($_POST['fees']);
    $applyUrl = test_input($_POST['application_link']);
    $notiUrl = test_input($_POST['Notification_link']);
    $otherInfo = test_input($_POST['other']);
  
    
  
   
    $sql = "INSERT INTO `news` ( `title`, `Date_Time`, `start_date`, `end_date`, `edit_date`, `fees`, `application_link`, `notification_link`, `other`) VALUES ( '$title', '$date','$start_date', '$end_date', '$edit_date', '$fees', '$applyUrl', '$notiUrl', '$otherInfo')";
  
         
           
    $result = mysqli_query($conn,$sql);
         
    
        if($result){
  
         $insert = true;
         
  
        }

        else{
            
            $msg = "We are facing some technical issues. Please try again later. ";
        }
  
        
         
  
  
        
  }
   
  
  
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
  
  
  
  
  
  
  
  
    include '../Partials/_visit_count.php';



?>





<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>ADMIN DASHBOARD</title>
   <?php include '../Partials/_admin_link.php' ?>
   
<!------ Include the above in your HEAD tag ---------->
</head>
<body>



<!-- <div id="preloader">
  <div id="status">&nbsp;</div>
</div> -->

<section>
<div id="throbber" style="display:none; min-height:120px;"></div>
<div id="noty-holder"></div>
<div id="wrapper">

<?php include '../Partials/_topNav.php' ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row" id="main" >
                <div class="col-sm-12 col-md-12 " id="content">

                <?php


if($insert){
?> 

    <script>
    swal({
        title: 'Latest News Published Successfully',
        // text: 'Your data has been inserted successfully',
        icon: 'success',
        button: 'Ok',
      }).then(function() {
        window.location.href = "viewNews.php";
    });

      
    </script>
    
    <?php
   
}



if($msg){
  ?>

    <script>
    swal({
        title: '<?php echo $msg ?>',
        // text: '$msg',
        icon: 'error',
        button: 'Ok',
      });
    </script>
  <?php
}




?>
                <div class="panel panel-primary ">
                  
                   <div class="panel-heading"> <div class=" panel-title font-weight-bold"> <i class="fa fa-bullhorn"></i> Add Latest News</div></div>
                   <div class="panel-body">
                        <form method = "POST">
                      
                        <input type="hidden" name="Date_Time"  value = "<?=$dt?>" >

                        <div class="form-group">
                                <label for="uname" class="font-weight-bold"><span class="glyphicon glyphicon-flag"></span> Title</label>
                                <input type="text" class="form-control" id="title" name="title" minlength="5"  maxlength="255" required>
                                
                            </div>
                            <div class="form-group">
                                <label for="start_date" class="font-weight-bold"><span class="glyphicon glyphicon-calendar"></span> Start Date</label>
                                <input type="text" class="form-control" id="start_date" minlength="5" maxlength="255" name="start_date" required> 
                                
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="font-weight-bold"> <span class="glyphicon glyphicon-calendar"></span> End Date</label>
                                <input type="text" class="form-control" id="end_date" minlength="5"  maxlength="255"name="end_date" required> 
                                
                            </div>
                            <div class="form-group">
                                <label for="edit_date" class="font-weight-bold"> <span class="glyphicon glyphicon-calendar"></span> Edit Date</label>
                                <input type="text" class="form-control" id="edit_date" minlength="5" maxlength="255" name="edit_date" required> 
                                
                          </div>
                          <div class="form-group">
                                <label for="application_link" class="font-weight-bold"> <i class="fa fa-link"></i> Application Link</label>
                                <input type="url" class="form-control" id="application_link"  minlength="5" name="application_link" required> 
                                
                          </div>
                          <div class="form-group">
                                <label for="Notification_link" class="font-weight-bold"><i class="fa fa-link"></i> Notification Link</label>
                                <input type="url" class="form-control" id="Notification_link" minlength="5"  maxlength="255" name="Notification_link" required> 
                                
                          </div>
                            <div class="form-group">
                                <label for="fees" class="font-weight-bold"> <i class="fa fa-money"></i> Application Fees</label>
                                <input type="text" class="form-control" id="fees" name="fees" minlength="5" maxlength="255" required>
                               
                            </div>

                            <div class="form-group">
                                <label for="other" class="font-weight-bold"><i class="fa fa-info-circle"></i> Other Information</label>
                                <input type="text" class="form-control" id="other" name="other" minlength="5" maxlength="255">
                               
                            </div>
                           
                            <div class="text-center">
                                <input type="submit" class="btn  btn-block btn-success" value="Publish News">
                            </div>

                        </form>
                        <br>

                        

                        </div>
                    </div>

            
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
</section>


<script src="../js/loader.js"></script>

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
            window.location.href = "logout.php";
          } else {
            swal("You are still logged in!");
          }
          
        });
      }
      
    </script>
               
    
</body>
</html>