<?php

session_start();

include '../Partials/_dbconnect.php';
$update_activity = "UPDATE member SET activity = '0' WHERE uid = '$_SESSION[uname]' ";
$result = mysqli_query($conn, $update_activity);


session_unset();
session_destroy();
?>
<script>

  window.location.href="../SignIn.php";
</script>
  
<?php

exit;
    
   

?>