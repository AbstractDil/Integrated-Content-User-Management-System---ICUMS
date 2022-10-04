<?php
include '../Partials/_dbconnect.php' ;

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
$update = false;
$delete = false;

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  
  $sql = "DELETE FROM `notices` WHERE `sno` = '$sno' ";
  $result = mysqli_query($conn, $sql);
  if($result){
    $delete = true;
   
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];
    $date = $_POST["Date_Time_Edit"];


  // Sql query to be executed
  $sql = "UPDATE `notices` SET `notice_title` = '$title' , `notice_link` = '$description', `Date_Time` = '$date' WHERE `notices`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $title = $_POST["title"];
    $description = $_POST["description"];
    $date = $_POST["Date_Time"];

  // Sql query to be executed
  $sql = "INSERT INTO `notices` (`notice_title`, `notice_link`, `Date_Time`) VALUES ('$title', '$description', '$date')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
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
                <!-- Edit Modal -->
  <div class="modal fade" id="editModal"  role="dialog" >
    <div class="modal-dialog" >
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="editModal">Edit this Note</h4>
          <button type="button" class="close" data-dismiss="modal" >
            &times;
          </button>
        </div>
        <form action="addNotice.php" method="POST">
<input type="hidden" id="Date_Time" name="Date_Time_Edit" value="<?php echo $dt; ?>">

          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Notice Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" >
            </div>

            <div class="form-group">
              <label for="desc">Notice Link</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div> 
          </div>
          <div class="modal-footer d-block ">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update Notice</button>
          </div>
        </form>
      </div>
    </div>
  </div>



 
  <?php
  if($insert){
    
?>
<script>
  swal({
  title: "Notice Published Succes!sfully",
  // text: "Notice Added Succes!sfully",
  icon: "success",
  button: "Ok",
}).then(function() {
  window.location = "addNotice.php";
});
</script>
<?php
    
   

  
  }
  
  ?>
  <?php
  if($delete){
    
?>
<script>
  swal({
  title: "Notice Deleted Succes!sfully",
  // text: "Notice Added Succes!sfully",
  icon: "success",
  button: "Ok",
}).then(function() {
  window.location = "addNotice.php";
});
</script>

  <?php
  }
  if($update){

?>
<script>
  swal({
  title: "Notice Updated Succes!sfully",
  // text: "Notice Added Succes!sfully",
  icon: "success",
  button: "Ok",
}).then(function() {
  window.location = "addNotice.php";
});
</script>
<?php
  }
 
  ?>
  <div >

  <div class="panel panel-info">

  <div class="panel-heading"> <i class="fa fa-plus-circle"></i>
  Add a Notice to Home Page


  </div>

  <div class="panel-body">
  <form action="addNotice.php" method="POST">
<input type="hidden" id="Date_Time" name="Date_Time" value="<?php echo $dt; ?>">

      <div class="form-group">
        <label for="title">Notice Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>

      <div class="form-group">
        <label for="desc"> <i class="fa fa-external-link"> </i> Enter Url </label>
        <input type="url" class="form-control" id="description" name="description" required>

      </div>
      <button type="submit" class="btn btn-primary btn-block">Add Notice</button>
    </form>

  </div>
  </div>
   
  </div>

  <div >

  <div class="panel panel-warning">

  <div class="panel-heading"> <i class="fa fa-list-ul"></i> See Notices

  </div>

  <div class="panel-body table-responsive">

  <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Published Date</th>

          <th scope="col">Notice Title</th>
          <th scope="col">Notice Link</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `notices`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['Date_Time'] . "</td>
            <td>". $row['notice_title'] . "</td>
            <td>". $row['notice_link'] . "</td>
            <td> <button class='edit btn btn-sm btn-success' id=".$row['sno']."><i class='fa fa-edit'></i></button>";

            if($role == 1){
              echo "

              <button class='delete btn btn-sm btn-danger' id=d".$row['sno']."> <i class='fa fa-trash'></i></button>  </td>
          </tr>
              ";
            }
        } 
          ?>


      </tbody>
    </table>

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


<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
       // console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[1].innerText;
        description = tr.getElementsByTagName("td")[2].innerText;
        //console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        //console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        //console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this notice?")) {
         // console.log("yes");
          window.location = `addNotice.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
         
          // console.log("no");

          swal("Cancelled", "Your notice is safe :)", "error");

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