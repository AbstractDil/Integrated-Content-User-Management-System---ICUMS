
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


$update = false;
$errorMSG = false;

$delete = false;

if(isset($_GET['delete'])){

  $sno = $_GET['delete'];
  
  $sql = "DELETE FROM `news` WHERE `news`.`nid` = '$sno' ";
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
        $start_dateEdit = $_POST["start_dateEdit"];
        $end_dateEdit = $_POST["end_dateEdit"];
        $edit_dateEdit = $_POST["edit_dateEdit"];
        $feesEdit = $_POST["feesEdit"];
        $application_linkEdit = $_POST["ApplyLinkEdit"];
        $notification_linkEdit = $_POST["NoticeEdit"];
        $otherEdit = $_POST["otherEdit"];
        $dateEdit = $_POST["Date_Time_Edit"];

 // Sql query to be executed

        $sql = "UPDATE `news` SET `title` = '$title' , `start_date` = '$start_dateEdit', `end_date` = '$end_dateEdit', `edit_date` = '$edit_dateEdit', `fees` = '$feesEdit', `application_link` = '$application_linkEdit', `notification_link` = '$notification_linkEdit', `other` = '$otherEdit', `Date_Time` = '$dateEdit' WHERE `news`.`nid` = $sno";
    
    
        $result = mysqli_query($conn, $sql);
     
   
      if($result){

        $update = true;
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
            title: "Record Updated Successfully",
            // text: "Your record has been updated successfully!",
            icon: "success",
            button: "Ok",
        }).then(function() {
            window.location = "viewNews.php";
        });
    </script>
<?php
}

if($delete){
    ?> 
    
        <script>
        swal({
            title: 'Latest News Deleted Successfully',
            // text: 'Your data has been inserted successfully',
            icon: 'success',
            button: 'Ok',
          }).then(function() {
            window.location = "viewNews.php";
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
    <div class="modal-dialog modal-lg" >
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h4 class="modal-title" id="editModal"><b><i class="fa fa-edit"></i> Edit Window</b> </h4>
          <button type="button" class="close" data-dismiss="modal" >
            &times;
          </button>
        </div>
        <form action="viewNews.php" method="POST">
<input type="hidden" id="Date_Time" name="Date_Time_Edit" value="<?php echo $dt; ?>">

          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="titleEdit"> Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" >
            </div>

            <div class="form-group">
                                <label for="start_dateEdit" class="font-weight-bold"><span class="glyphicon glyphicon-calendar"></span> Start Date</label>
                                <input type="text" class="form-control" id="start_dateEdit" minlength="5" maxlength="255" name="start_dateEdit" required> 
                                
                            </div>
                            <div class="form-group">
                                <label for="end_dateEdit" class="font-weight-bold"> <span class="glyphicon glyphicon-calendar"></span> End Date</label>
                                <input type="text" class="form-control" id="end_dateEdit" minlength="5"  maxlength="255"name="end_dateEdit" required> 
                                
                            </div>
                            <div class="form-group">
                                <label for="edit_dateEdit" class="font-weight-bold"> <span class="glyphicon glyphicon-calendar"></span> Edit Date</label>
                                <input type="text" class="form-control" id="edit_dateEdit" minlength="5" maxlength="255" name="edit_dateEdit" required> 
                                
                          </div>
                          <div class="form-group">
                                <label for="feesEdit" class="font-weight-bold"> <i class="fa fa-money"></i> Application Fees</label>
                                <input type="text" class="form-control" id="feesEdit" name="feesEdit" minlength="5" maxlength="255" required>
                               
                            </div>

                            <div class="form-group">
                                <label for="otherEdit" class="font-weight-bold"><i class="fa fa-info-circle"></i> Other Information</label>
                                <input type="text" class="form-control" id="otherEdit" name="otherEdit" minlength="5" maxlength="255">
                               
                            </div>

            <div class="form-group">
              <label for="NoticeEdit">Notice Link</label>
              <input class="form-control" id="NoticeEdit" name="NoticeEdit" >
            </div> 
            <div class="form-group">
              <label for="ApplyLinkEdit">Apply Link</label>
              <input class="form-control" id="ApplyLinkEdit" name="ApplyLinkEdit" >
            </div>
          </div>
          <div class="modal-footer d-block ">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>




<div class="panel panel-warning">
                <div class="panel-heading "> <b><i class="fa fa-list-ul"></i> See Latest News</b>
                    </div> 
                <div class="panel-body table-responsive">

<table class="table table-bordered" id="newsTable">
    <thead class="bg-primary">
      <tr>
        <th scope="col">S.No</th>
        <th scope="col">Published Date</th>

        <th scope="col">Title</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Edit Date</th>

        <th scope="col">Application Fees</th>
        <th scope="col">Other Info</th>



        <th scope="col">Apply Link</th>
        <th scope="col">Notification Link</th>

        

        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        $sql = "SELECT * FROM `news`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while($row = mysqli_fetch_assoc($result)){
          $sno = $sno + 1;
          echo "<tr>
          <th scope='row'>". $sno . "</th>
          <td>". $row['Date_Time'] . "</td>
          <td>". $row['title'] . "</td>
          <td>". $row['start_date'] . "</td>
          <td>". $row['end_date'] . "</td>
          <td>". $row['edit_date'] . "</td>
          <td>". $row['fees'] . "</td>
          <td>". $row['other'] . "</td>


          <td> " .  $row['application_link']  . "</td>
          <td>" .  $row['notification_link']  . " </td>
         
 


          <td> <button class='edit btn btn-sm btn-success' id=".$row['nid']."><i class='fa fa-edit'></i></button>";

          if($role == 1){

            echo"

            <button class='delete btn btn-sm btn-danger' id=d".$row['nid']."> <i class='fa fa-trash'></i></button>  </td>
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

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
</div><!-- /#wrapper -->
</section>


<script src="../js/loader.js"></script>

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
        title = tr.getElementsByTagName("td")[1].innerText;
        startDate = tr.getElementsByTagName("td")[2].innerText;
        endDate = tr.getElementsByTagName("td")[3].innerText;
        editDate = tr.getElementsByTagName("td")[4].innerText;
      fees = tr.getElementsByTagName("td")[5].innerText;
      otherInfo = tr.getElementsByTagName("td")[6].innerText;

      applyLink = tr.getElementsByTagName("td")[7].innerText;
     NotificationLink = tr.getElementsByTagName("td")[8].innerText;





        //console.log(title, description);
        titleEdit.value = title;
        start_dateEdit.value = startDate;
        end_dateEdit.value = endDate;

        edit_dateEdit.value = editDate;

        feesEdit.value = fees;
        otherEdit.value = otherInfo;

        ApplyLinkEdit.value = applyLink;
        NoticeEdit.value = NotificationLink;



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

        if (confirm("Are you sure, you want to delete this ?")) {
         // console.log("yes");
          window.location = `viewNews.php?delete=${sno}`;
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