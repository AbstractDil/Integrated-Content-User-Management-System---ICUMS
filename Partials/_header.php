
<?php  

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;

  

   
}
else{
  $loggedin = false;
}
?>

<section class="p-3 header " >
        <div class="container-fluid">            
            <div class="row">
                <div class="col-md-2 text-center">
                    <a href="javascript:void(0)">
                	<Image src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Flogo2.png&w=96&q=75" alt="MathHub Combined" height="100" width="100" class=" img-circle logo "/>
                  </a>
                </div>
               <div class="col-md-8 text-center">
                	<h1 class="text-white text-uppercase logo-title" >MATHHUB Combined</h1>
                 
                    <h6 class="text-light">Powered By nandysagar.in</h6>
                </div>
                <div class="col-md-2 mt-3 text-right">

                <?php
                if($loggedin){

                    $sql = " SELECT * FROM member WHERE uid = '$_SESSION[uname]' ";

        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){
            
             $role = $row['role'];
             
             
             
                  echo '

                  <div class="dropdown">
                  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><b></b> Wecome <br> <i class ="fa fa-user-circle"></i> '.$row['name'].'</b>
                  <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                  <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li ><a href="profileInfo.php" ><i class="fa fa-gear"></i> Profile Settings</a> </li>
                    <li><a href="StudyMaterials.php"><i class="fa fa-mortar-board"></i> Study Materials</a></li>
                    <li><a href="javascript:void(0)" onclick="confirm()" ><span class="label label-danger text-white" style="font-size:15px;"> <i class="fa fa-sign-out"></i> Sign out </span></a></li>
                  ';
                  
                   if($role==1 || $role==2){
        
        ?>
        
      <li style="margin-top:3px;">  <a href="Management/Admin_Dashboard.php" >
<span class="label label-primary " style="font-size:15px;">
<i class="fa fa-dashboard"></i>    Go to dashboard
</span>
 </a>
 </li>
  </ul>
                </div>
        
        <?php
    }
        }
                }
                else{
                  echo '<a href="SignIn.php" class="btn btn-warning btn-sm"> <i class="fa fa-mortar-board"></i> StudyMaterials</a>';
                }
                  
                // <a href="StudyMaterials.php" class="btn btn-warning"><i class="fa fa-mortar-board"></i> Study Materials</a>

                ?>
              
                </div>
            </div>
        </div>
    </section>