<?php  

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    
  $loggedin= true;

  
  $sql = " SELECT * FROM member WHERE uid = '$_SESSION[uname]' ";

                    

  $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($result)){

      $username = $row['name'];
      $userid = $row['uid'];
      $useremail = $row['email'];
      $role = $row['role'];
  }

    if($role == 1){
        $role_name = "Admin";
    }
    else{
        $role_name = "Moderator";
    }

   
}
else{
  $loggedin = false;
}



?>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">
                <img src="https://mathhubcombined.vercel.app/_next/image?url=%2FImages%2Flogo2.png&w=96&q=75" alt="LOGO" width="40" height="40" class="img-circle logo">
               
            </a>
            <a href="" class="navbar-brand" style="color: #fff; margin-top:5px;"><b> MATHHUB COMBINED</b></a>

           
        
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <!-- <li style="color: #fff;" class="text-center">
            <a href="#" class="dropdown-toggle"  ><b> MATHHUB COMBINED</b></a>
            </li>             -->
            <li class="dropdown">
            <?php
                if($loggedin){

                   

                  echo '
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome <i class ="fa fa-user-circle"></i> '.$username.' <b class="fa fa-angle-down"></b></a>
                <ul class="dropdown-menu">

                    <li>
                        <a >  <span style="background-color:rgb(8, 187, 8);color:#fff; padding:5px; border-radius:12px;font-weight:bold;"><i class="fa fa-fw fa-user"></i>'.$role_name .'</span> </a>
                    </li>
                  
                    <li><a href="javascript:void(0)"   style="margin-top:3px;" onclick="Logout()"> <span style="background-color:crimson;color:#fff; padding:6px; border-radius:12px;font-weight:bold;"><i class="fa fa-fw fa-power-off"></i> Logout</span></a></li>
                </ul>';
        }
    
    

    ?>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
            <li>
                    <a href="Admin_Dashboard.php"><i class="fa fa-dashboard"></i> DASHBOARD</a>
                </li>

                <?php 
                
if($loggedin){
    if($role == 1){

        echo'
    <li><a href="userControl.php"><i class="fa fa-gears"></i> USER CONTROL</a></li>
    ';

    }
    




                if($role == 2 || $role == 1){

                    echo'

                    <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-2"><i class="fa fa-gear"></i> MANAGE CONTENTS <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-2" class="collapse">
                        <li><a href="addLatestNews.php"><i class="fa fa-plus-circle"></i> ADD NEWS</a></li>
                        <li><a href="viewNews.php"> <i class="fa fa-eye"></i> VIEW NEWS</a></li>

                        <li><a href="addStudyMaterials.php"> <i class="fa fa-plus-square"></i> STUDY MATERIALS</a></li>
                        <li>
                    <a href="addNotice.php"><i class="fa fa-bullhorn"></i>  PUBLIC NOTICE </a>
                </li>
                       


                    </ul>
                </li>
                
                <li>
                    <a href=" javascript:void(0) " onclick="Logout()"><i class="fa fa-fw fa-sign-out"></i>LOGOUT</a>
                </li>


                    ';





                }
            }
            
               

                ?>


<li>
                    <a href=" visits.php " style="font-family:'Times New Roman', Times, serif ; "><i class="fa fa-eye"></i> Total Visitors : <?=  $visit_count; ?> </a>
                </li>

                <!-- <li>
                    <a href="#" data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-group"></i> MANAGE USER <i class="fa fa-fw fa-angle-down pull-right"></i></a>
                    <ul id="submenu-1" class="collapse">
                        <li><a href="addNewUser.php"><i class="fa fa-user-plus"></i> ADD NEW USER</a></li>
                        
                        <li><a href="userControl.php"><i class="fa fa-gears"></i> USER CONTROL</a></li>
                    </ul>
                </li> -->
                
                <!-- <li>
                    <a href="sugerencias"><i class="fa fa-fw fa-paper-plane-o"></i> MENU 4</a>
                </li>
                <li>
                    <a href="faq"><i class="fa fa-fw fa fa-question-circle"></i> MENU 5</a>
                </li> -->
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>