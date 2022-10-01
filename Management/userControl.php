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

include '../Partials/_dbconnect.php';
require '../PHPMailer-5.2-stable/PHPMailerAutoload.php';

include '../Partials/_mail.php';

$update = false;
$errorMSG = false;

$delete = false;

if(isset($_GET['delete'])){

  $sno = $_GET['delete'];
  
  $sql = "DELETE FROM `member` WHERE `member`.`uid` = '$sno' ";
  $result = mysqli_query($conn, $sql);
  if($result){
    $delete = true;
    
    
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['snoEdit'])){
      // Update the record
        $sno = $_POST["snoEdit"];
        $nameEdit = $_POST["nameEdit"];
        $emailEdit = $_POST["emailEdit"];
       
        $dateEdit = $_POST["Date_Time_Edit"];

 // Sql query to be executed



        $sql = "UPDATE `member` SET `name` = '$nameEdit' , `email` = '$emailEdit', `Date_Time` = '$dateEdit' WHERE `member`.`uid` = '$sno' ";
    
    
        $result = mysqli_query($conn, $sql);
     
   
      if($result){

        $update = true;

      

        $to   =  $_POST['emailEdit'];
        $from = 'no-reply@nandysagar.in';
        $name = ' MATHHUB COMBINED PORTAL';  
        $subj = 'PROFILE UPDATE NOTIFICATION';
        $msg = '
        <html>
       
        <body style="font-size: 18px;">
        <div class="container">
        <center><h3 style="color:green; font-weight:bold;">PROFILE UPDATE</h3></center> <br>
        <h4>Hi, <span style=" font-weight:bold;color:blue;"> ' .$_POST['nameEdit'] . ' </span> Congratulations!  Your profile has been updated successfully. </h4> <br>
        
        <table border="1">
        <thead > <tr><th style="font-weight:bold;" colspan="2">Profile Details</th> </tr></thead>
        <tbody>
        <tr>
        <td   style="font-weight:bold;">Member Id</td>
        <td>' . $sno . '</td>
        </tr>
        <tr>
        <td  style="font-weight:bold;">Updated Email Id</td>
        <td>'  . $emailEdit. '</td>
        </tr>
        
        
        <tr>
        <td  style="font-weight:bold;">Update Time </td>
        <td>'  .$dateEdit. '</td>
        
        
        
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

    }
    else{
       
        $errorMsg = "We could not update the record successfully";
    }
}
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

<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
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

if($update){
    ?>
    <script>
        swal({
            title: "Member Record Updated Successfully",
            // text: "Your record has been updated successfully!",
            icon: "success",
            button: "Ok",
        });
    </script>
<?php
}

if($delete){
    ?> 
    
        <script>
        swal({
            title: ' Member Deleted Successfully',
            // text: 'Your data has been inserted successfully',
            icon: 'success',
            button: 'Ok',
          }). then(function(){
            window.location.href = 'userControl.php';
          });
    
          
        </script>
        
        <?php
       
    }

if($errorMSG){
    ?>
    <script>
        swal({
            title: "Error",
            text: "<?php echo $errorMsg; ?>",
            icon: "error",
            button: "Ok",
        });
    </script>
<?php
}

?>

                 <!-- Edit Modal -->
  <div class="modal fade" id="editModal"  role="dialog" >
    <div class="modal-dialog " >
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title" id="editModal"><b><i class="fa fa-edit"></i> Edit Window</b> </h4>
          <button type="button" class="close " data-dismiss="modal" >
            &times;
          </button>
        </div>
        <form action="userControl.php" method="POST">
<input type="hidden" id="Date_Time" name="Date_Time_Edit" value="<?php echo $dt; ?>">

          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <!-- <div class="form-group">
              <label for="memberId"><i class="fa fa-user"></i> Member Id</label>
              <input type="text" class="form-control" id="memberId" name="MemberId"  disabled>
            </div> -->
            <div class="form-group">
              <label for="nameEdit"><i class="fa fa-user"></i> Name</label>
              <input type="text" class="form-control" id="nameEdit" name="nameEdit" >
            </div>
            <div class="form-group">
                  <label for="feesEdit" class="font-weight-bold"> <i class="fa fa-envelope"></i> Email</label>
                  <input type="text" class="form-control" id="emailEdit" name="emailEdit" minlength="5" maxlength="255" required>
                 
              </div>
          </div>
          <div class="modal-footer d-block ">
            <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>


<?php

if($role!=1){
    ?>
    <script>
        swal({
            title: "Access Denied",
            text: "You are not authorized to access this page",
            icon: "error",
            button: "Ok",
        });
    </script>
<?php
}else{
  ?>


<div class="panel panel-warning">
                <div class="panel-heading "> <b><i class="fa fa-gear"></i> User Management System</b>
                    </div> 
                <div class="panel-body table-responsive">

<table class="table table-bordered" id="newsTable">
    <thead class="bg-primary">
      <tr>
        <th scope="col">S.No</th>
        <th scope="col">SignUp Date</th>
        <th scope="col"> User Id</th>
        <th scope="col"> <span class="glyphicon glyphicon-user"></span> Name</th>
        <th scope="col"><span class="glyphicon glyphicon-envelope"></span> Email</th>
        <th scope="col"> Ip</th>
          <th scope="col"> <i class="fa fa-wrench"></i> Actions</th>
          <th scope="col">Status</th>
          <th scope="col"> <i class="fa fa-gear"></i> Change Role</th>
          <th scope="col"> Activity </th>


         


      </tr>
    </thead>
    <tbody>
      
      <?php 
        $sql = "SELECT * FROM `member`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
          echo "<tr>
          <th scope='row'>". $sno . "</th>
          <td>". $row['Date_Time'] . "</td>
          <td>". $row['uid'] . "</td>

          <td>". $row['name'] . "</td>
          <td>". $row['email'] . "</td>
          <td><span class='label label-info'> ". $row['ip'] . " </span></td>

          <td> <button class='edit btn btn-sm btn-success' id=".$row['uid']."><i class='fa fa-edit'></i></button> <button class='delete btn btn-sm btn-danger' id=d".$row['uid']."> <i class='fa fa-trash'></i></button> 
          <a class=' btn btn-sm btn-warning' href='changePassword.php?uid=".$row['uid']."'> <i class='fa fa-key'></i></a>  
          </td>";

          if($row['role'] == 0){
            echo "<td><a class='label label-danger btn btn-sm'  href='role.php?uid=".$row['uid']."&role=3'> Not Active </a></td>";
          }else{
            echo "<td><a class='label label-success btn btn-sm'  href='role.php?uid=".$row['uid']."&role=0'> Active  </a></td>";
          }

          if($row['role'] == 3){
            echo "<td><a class='label label-success btn btn-sm'  href='role.php?uid=".$row['uid']."&role=2'> Verified User </a></td>";
          }else if ($row['role']==2){
            echo "<td><a class='label label-info btn btn-sm'  href='role.php?uid=".$row['uid']."&role=1'> Moderator </a></td>";
          }
          else if ($row['role']==1){
            echo "<td><a class='label label-warning btn btn-sm'  href='role.php?uid=".$row['uid']."&role=3'> Admin  </a></td>";
          }else{
            echo "<td><a class='label label-primary btn btn-sm'  href='role.php?uid=".$row['uid']."&role=3'> Normal User  </a></td>";
          }
         
         if($row['activity']==1){
            echo "<td><span class='label label-success  blink'> Online  </span></td>";
          }else{
            echo "<td><span class='label label-danger  '> Offline </span></td>";
          }
          
         
          
         
       echo "</tr>";
          

          // if($row['role']==0){
          //   echo "<td><a class='label label-danger btn btn-sm'  href='role.php?uid=".$row['uid']."&role=3'> Enable  </a></td>";
          // }
          // else{
          //   echo "<td></td><a class='label label-success btn btn-sm'  href='role.php?uid=".$row['uid']."&role=0'>  Disable</a></td>";
          // }

          //  if($row['role']==1){
          //   echo "<a class='label label-warning btn btn-sm'  href='role.php?uid=".$row['uid']."&role=2'> Admin </a> ";
          // }
          // else if($row['role']==2){
          //   echo "<a class='label label-info btn btn-sm'  href='role.php?uid=".$row['uid']."&role='> Moderator  </a> ";
          // }
          
         
      } 
        ?>


    </tbody>
  </table>

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
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
</section>


<script src="../js/loader.js"></script>


<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#newsTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
       // console.log("edit ");
        tr = e.target.parentNode.parentNode;
       // member = tr.getElementsByTagName("td")[1].innerText;

        name = tr.getElementsByTagName("td")[2].innerText;
        email = tr.getElementsByTagName("td")[3].innerText;
    //     endDate = tr.getElementsByTagName("td")[3].innerText;
    //     editDate = tr.getElementsByTagName("td")[4].innerText;
    //   fees = tr.getElementsByTagName("td")[5].innerText;
    //   otherInfo = tr.getElementsByTagName("td")[6].innerText;

    //   applyLink = tr.getElementsByTagName("td")[7].innerText;
    //  NotificationLink = tr.getElementsByTagName("td")[8].innerText;





        //console.log(title, description);
        //memberId.value = member;
        nameEdit.value = name;
        emailEdit.value = email;

        // start_dateEdit.value = startDate;
        // end_dateEdit.value = endDate;

        // edit_dateEdit.value = editDate;

        // feesEdit.value = fees;
        // otherEdit.value = otherInfo;

        // ApplyLinkEdit.value = applyLink;
        // NoticeEdit.value = NotificationLink;



        snoEdit.value = e.target.id;
      //  console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        //console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure, you want to delete this user ?")) {
         // console.log("yes");
          window.location = `userControl.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
         
          // console.log("no");

          swal("Cancelled", "Your content is safe :)", "error");

        }
      })
    })
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