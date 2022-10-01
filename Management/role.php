<?php



                    


include '../partials/_dbconnect.php';

$id = $_GET['uid'];

$role = $_GET['role'];

$status = false;
$errMsg = false;

$sql = "UPDATE `member` SET `role` = '$role' WHERE `member`.`uid` = '$id' ";

$result = mysqli_query($conn, $sql);

if($result){
    
    $status = true;

}else{
    $errMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php include '../Partials/_admin_link.php' ?>
    <title>Change Role</title>
</head>
<body>

<?php 

if($status){
    echo '<script>
    swal({
        title: "Role Updated Successfully",
        text: " ",
        icon: "success",
        button: "Ok",
      }).then(function() {
        window.location = "userControl.php";
    });
    </script>';
}

if($errMsg){
  ?>
   
  <!-- <script>
    swal({
        title: "Error",
        text: "<?php echo $errMsg ?>",
        icon: "error",
        button: "Ok",
      }).then(function() {
        window.location = "userControl.php";
    });
   
  </script> -->

  <?php
}


?>
    
</body>
</html>