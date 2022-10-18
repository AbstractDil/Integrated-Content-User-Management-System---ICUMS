<?php


date_default_timezone_set("Asia/Calcutta");
$date = date('Y-m-d H:i:s A');

// existing visitors
$query = " SELECT * FROM `visits`";
  $result = mysqli_query($conn,$query);

  if(!$result){
    die("Retriving Query Error<br>" .$query);
  }
  
  $total_visitors = mysqli_num_rows($result);

  //echo $total_visitors;



function getIPaddress(){

  if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    # code...
$visitor_ip = $_SERVER['HTTP_CLIENT_IP'];

//echo $visitor_ip;

  }

  elseif (!empty ($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $visitor_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

  }
  else {
    # code...
$visitor_ip = $_SERVER['REMOTE_ADDR'];

//echo $visitor_ip;


  }
  return $visitor_ip;

  //echo $visitor_ip;
}

$visitor_ip = getIPaddress ();

//echo $visitor_ip;

// adding new visitor

//checking if visitor is unique
$query = " SELECT * FROM `visits` WHERE visitor_ip = '$visitor_ip'";
  $result = mysqli_query($conn,$query);

  // checking query error 
  
  if(!$result){
    die("Retriving Query Error<br>" .$query);
  }
  
  $total_visitors = mysqli_num_rows($result);
  if($total_visitors < 1){
  $query =   "INSERT INTO visits (`visitor_ip`,`visit_date_time`) VALUES ( '$visitor_ip','$date')";
  $result = mysqli_query($conn,$query);

  }

//echo "<h3>".  $total_visitors . "</h3>";

$sql = "SELECT * FROM `visits` ";
if($result = mysqli_query($conn,$sql)){

  $visit_count = mysqli_num_rows($result);

  // echo "<h3>".  $visit_count . "</h3>";

// printf($visit_count);

mysqli_free_result($result);

}




 
?>





