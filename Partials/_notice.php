<?php



$sql = "SELECT * FROM `notices` ORDER BY Date_Time DESC";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if($num>0){


   
while($row = mysqli_fetch_assoc($result)){

 

}
}
?>