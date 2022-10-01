<?php

include 'Partials/_dbconnect.php';

session_start();

$update_activity = "UPDATE member SET activity = '0' WHERE uid = '$_SESSION[uname]' ";
$result = mysqli_query($conn, $update_activity);

session_unset();
session_destroy();


?>
<script>

  window.location.href="SignIn.php";
</script>
  
<?php

exit;
    
   

?>