<?php



include 'Partials/_dbconnect.php';

session_start() ;


include 'Partials/_visit_count.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>HOME - MATHHUB COMBINED</title>
    <?php include 'Partials/_link.php'; ?>

</head>

<body>


    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <?php include 'Partials/_header.php' ?>
    
    <div class="topnav">

        <p class=' text-center topnav-title'>
            <Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New"
                width=28 height=25 />

            Latest News

            <Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New"
                width=28 height=25 />

        </p>

    </div>


    <?php
    // include 'Partials/_navbar.php';

    
     include 'Partials/_modal.php';

    ?>



    <div class="container  my-3  ">

        <div class="row">






            <div class=" col-md-12">


<?php 


$msg = false;
$data = false;
$status = false;

$sql = "SELECT * FROM `news` ORDER BY start_date DESC ";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if($num>0){
    $data = true;
while($row = mysqli_fetch_assoc($result)){




$startTime  = strtotime( $row['start_date'] );
/* echo    $start;
echo "<br>";*/
$endTime  = strtotime($row['end_date']);
/* echo    $end;
echo "<br>";
echo time();*/

if(time() < $startTime){
    $status = "<span class='text-center label label-pink'> Application is not started yet </span>";
    
}
else {
    if($startTime < time() && $endTime > time()){
        $status = "<span class='text-center label label-success'> <i class='fa fa-spinner fa-spin'></i> Application is going on </span>";
    }
    else{
        $status = "<span class='text-center label label-danger'><i class='fa fa-remove'></i> Application is closed </span>";
        $display = "display:none;";
    }
}




if($data){

?>

<div class="alert alert-info border-1 mt-3">

<p class="font-weight-bold text-center">
    <span class="label label-danger  blink" style="<?php echo $display; ?>;">New</span><span class="titleOne "><?= $row['title']?></span> 
<span class="label label-danger blink " style="<?php echo $display; ?>;">New</span><br>
 <?= $status ;?> <br>
<br><span class="text-danger"><span
            class="glyphicon glyphicon-hand-right"></span> Application Start : </span> <?=  $row['start_date'];?>
    <br><span class="text-danger"><span class="glyphicon glyphicon-hand-right"></span> Application
        End : </span> <?=  $row['end_date'];?> <br><span class="text-danger"><span
            class="glyphicon glyphicon-hand-right"></span> Edit Window : </span><?=  $row['edit_date'];?><br><span
        class="text-danger"><span class="glyphicon glyphicon-hand-right"></span> Application Fees :
    </span> <?= $row['fees']; ?><br>
    <span class="text-danger"> <?= $row['other']; ?>
    </span> <br>
</p>
<hr class="hr-info">
<div class="text-center"><a href="<?= $row['application_link'] ?>" type="button"
        class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Apply Now</a><a
        href="<?= $row['notification_link'] ?>"
        type="button" class="btn btn-down"><i class="fa fa-download"></i> Notification </a></div>

</div>






    <?php 
    }
    else{
        echo '<div class="col-md-6 col-md-offset-3"><div class="alert alert-danger text-center my-3"><strong><h2><i class="fa fa-exclamation-triangle"></i> No Data Found</h2></strong><a class="btn btn-danger btn-lg" href="StudyMaterials.php"><i class="fa fa-graduation-cap"></i> Study Materials</a></div></div>';
    }
}
}


?>

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