
<?php 

include 'Partials/_dbconnect.php';

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
?>
<script>
  window.location.href = "SignIn.php";
</script>
<?php
    exit;
}
else{
  
  $sql = "SELECT * FROM `member` WHERE `uid` = '$_SESSION[uname]'";

  $result = mysqli_query($conn, $sql);

     while($row = mysqli_fetch_assoc($result)){

         $uid = $row['uid'];
         $name = $row['name'];
         $email = $row['email'];
        $role = $row['role'];
     }

     


}


include 'Partials/_visit_count.php';


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>STUDY MATERIALS - MATHHUB COMBINED</title>
    <?php include 'Partials/_link.php'; ?>
    

</head>

<body>
<!-- Preloader -->
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>

<?php include 'Partials/_notice.php'; ?>

    <?php
     include 'Partials/_header.php' ;
   
     
     ?>

    <div class="topnav" >

<p class=' text-center topnav-title'>
<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  Study Materials

<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Fbulb.gif&w=32&q=75" alt="New" width=28 height=25 />

  </p>

</div>
<?php 

include 'Partials/_navbar.php' ;

?>

    <div class="container-fluid  my-3  ">

        <div class="row">

          <div class="col-md-3">
            <div class="panel panel-default">

            <div class="panel-heading">
             <b><i class="fa fa-link"></i> Important Links</b>
            </div>
            <div class="panel-body font-weight-bold">

    <a href="index.php"  class="text-danger"> <i class="fa fa-home"></i> Go to home</a><br>
   <a href="StudyMaterials.php"  class="text-danger"> <i class="fa fa-graduation-cap"></i> Study Materials for PRO user</a> <br>


   <a href="https://mathhubcombined.vercel.app/"  class="text-danger"> <i class="fa fa-graduation-cap"></i> Free Study Materials</a> <br>

            </div>


            </div>
            <div class="panel panel-danger">
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
  
    ?>
</div>
</div>
          </div>
        






            <div class=" col-md-9">
            <div class="alert alert-danger fs-1" style="padding: 0; padding-top:2px;">
            <marquee behavior="alternate" scrolldelay="4" width="100%">

            <strong ><i class="fa fa-info-circle"></i> Move left to right or, right to left to view the table.</strong>


</strong> 
    
</marquee>

</div>

            <?php

            if($role!=0){
              ?>



<div class="panel-body bg-info border-1 table-responsive">

<table class="table table-bordered" id="myTable">
    <thead class="bg-primary">
    

      <tr>
        
        <th scope="col">S.No</th>

        <th scope="col"><i class="fa fa-meh-o"></i> Title</th>
        <th scope="col"><i class="fa fa-link"></i> Link</th>
        

        
      </tr>
    </thead>
    <tbody>
      <?php 
        $sql = "SELECT * FROM `products`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
          echo "<tr>
          <th scope='row'>". $sno . "</th>
          <td ><span style='font-size:16px;font-weight:bold;'> ". $row['product_title'] . " <br/> <p class='label label-warning ' style='font-size:10px;'> Posted on : ". $row['Date_Time'] . "  </p></span></td>
          <td> <a class='btn btn-sm btn-success' href='". $row['product_link'] ."'><i class='fa fa-eye'> View</i></a> </td>
         

         </tr> ";
      } 
    
        ?>


    </tbody>
  </table>

  

    </div>



<div class="well well-sm my-3">
    <p class="text-center"> <b> <i class="fa fa-info-circle"></i> Note: </b> <i> 

    Don't share this study materials with anyone else. 

       </i> </p>
  </div>
    </div>
  
 
    

    

    

            


          


              <?php
            }
            else {
              ?>

              <div class="alert alert-danger ">



  <h3><strong><span class="glyphicon glyphicon-warning-sign"></span> Sorry!</strong> You are not authorized to view this page. </h3>
  <h4>
  <br>
  <br>
  <b><i class="glyphicon glyphicon-hand-right"></i> Why I am seeing this page?</b> 
  <br>
  <br>
  <div style="padding-left: 2rem;">
  <ul>
 
 <li> You are not a verfied member of MathHub Combined. 
  <a href="profileInfo.php" style="color: blue;">Check  status. </a>
 </li>
 <li> 
  
 Please contact the admin for more details.  Helpline  <a href="mailto:nandysagar@yahoo.com " style="color:blue;"> <i class="fa fa-envelope"></i> nandysagar@yahoo.com</a>


 </li>

 </ul>
  </div>
</h4> 

              </div>
              <?php 
            }


            ?>
              

                    
              </div>


        </div>
    </div>


    

 

   
  


    <?php include 'Partials/_footer.php' ;?>
    <script src="js/loader.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
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






















