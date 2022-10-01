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
      else{
        $role_name = "Moderator";
      }
}
}

?>


<!DOCTYPE html>
<html lang="en">

<head>


    <title>Visitors</title>
    <?php include '../Partials/_admin_link.php' ?>
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
                   <div class="panel panel-primary ">
                  
                      <h3 class="text-center">Visitors</h3>
                                <hr>
                                <h5 class="text-center">Total Visitors:
                                    <?php echo $visit_count; ?>
                                </h5>
                               
                                <h5 class="text-center">Unique Visitors:
                                    <?php echo $total_visitors; ?>
                                </h5>
                             
                                <h5 class="text-center">Your IP Address:
                                    <?php echo $visitor_ip; ?>
                                </h5>
                              
                                <h5 class="text-center">Your Current Date and Time:
                                    <?php echo $date; ?>
                                </h5>
                                <hr>
                                
                                <div class=" table-responsive" style="padding:12px ;">
                                    <table class="table table-bordered table-hover" id="ipTable">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">IP Address</th>
                                                <th scope="col">Date and Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM `visits`";
                                            $result = mysqli_query($conn, $sql);
                                            $sno = 0;
                                            while($row = mysqli_fetch_assoc($result)){
                                                $sno = $sno + 1;
                                                echo "<tr>
                                                <th scope='row'>" . $sno . "</th>
                                                <td>" . $row['visitor_ip'] . "</td>
                                                <td>" . $row['visit_date_time'] . "</td>
                                            </tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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

    <div id="throbber" style="display:none; min-height:120px;"></div>
    <div id="noty-holder"></div>
    <div id="wrapper">

        <?php include '../Partials/_topNav.php' ?>


        <div id="page-wrapper">
            <div class="container-fluid" >
                <!-- Page Heading -->
                <div class="row" id="main">
                   
                            <div class="col-md-12" >
                                <div id="content">
                               
                                </div>
                            </div>
                  </div>
            </div>    
        </div> 
    </div>


<script src="../js/loader.js"></script>


    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#ipTable').DataTable();

    });
  </script>

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