




<nav class="navbar navbar-inverse border-0">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand text-white" href="index.php"> <i class="fa fa-home"></i> Home </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      
        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-graduation-cap"></i> Study Materials<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="https://mathhubcombined.vercel.app/">Free Study Materials</a></li>
            <li><a href="StudyMaterials.php">Study Materials for Pro User</a></li>
           
          </ul>
        </li>


      </ul>
     
      <ul class="nav navbar-nav navbar-right">
      
        <?php 

        if($loggedin){

          ?>

<li class="dropdown">
          <a href="#" class="dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user-circle"></i> <?php echo $uname; ?>  <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li ><a href="profileInfo.php" ><i class="fa fa-gear"></i> Profile Settings</a> </li>
                    <li><a href="javascript:void(0)" onclick="confirm()" ><span class="label label-danger text-white" style="font-size:15px;"> <i class="fa fa-sign-out"></i> Sign out </span></a></li>


<?php 

        }

        else{
          ?>

<li><a href="SignIn.php" class="text-white"><i class="fa fa-sign-in"></i> Signin</a></li>
        <li><a href="SignUp.php" class="text-white"><i class="fa fa-user"></i> Create Account</a></li>

          <?php

        }


?>

       
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>