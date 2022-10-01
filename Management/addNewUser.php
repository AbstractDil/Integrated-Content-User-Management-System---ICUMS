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
                <div class="panel panel-primary ">
                  
                   <div class="panel-heading"> <div class=" panel-title font-weight-bold"> <i class="fa fa-user-plus"></i> Add New User</div></div>
                   <div class="panel-body">
                        <form method = "POST">
                        <div class="form-group">
                                <label for="uname" class="font-weight-bold"><i class="fa fa-user-circle"></i> Full Name:</label>
                                <input type="text" class="form-control" id="uname" name="uname" required>
                                <span class="nameCheck"></span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold"><i class="fa fa-envelope"></i> Email address:</label>
                                <input type="email" class="form-control" id="email" name="uemail" required> 
                                <span class="emailCheck"></span>
                            </div>
                            <div class="form-group">
                                <label for="pwd" class="font-weight-bold"> <i class="fa fa-lock"></i> Password:</label>
                                <input type="password" class="form-control" id="pwd" name="upwd" required>
                                <span class="pwdCheck"></span>
                            </div>
                           
                            <div class="text-center">
                                <input type="submit" class="btn  btn-block btn-success" value="Create Account">
                            </div>

                        </form>
                        <br>

                        <p class="text-center pt-1 font-weight-bold">
                            Already have an account? <a href="index.php " class="text-danger">Login</a>
                        </p>

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
                <script>

                    $(document).ready(function(){


                        $(".nameCheck").hide();
                        $(".emailCheck").hide();
                        $(".pwdCheck").hide();


                        var error_name = true;
                        var error_email = true;
                        var error_pwd = true;

                        $("#uname").keyup(function(){
                            check_name();
                        });

                        $("#email").keyup(function(){
                            check_email();
                        });

                        $("#pwd").keyup(function(){
                            check_pwd();
                        });

                        function check_name(){
                            var name = $("#uname").val().length;
                            if(name < 5){
                                $(".nameCheck").show();
                                $(".nameCheck").html("Name should be atleast 5 characters");
                                $(".nameCheck").css("color","red");
                                error_name = false;
                                return false;
                            }else{
                                $(".nameCheck").hide();
                            }

                            var name_val = $("#uname").val();
                            var reg = /^[a-zA-Z ]+$/;
                           
                            if(reg.test(name_val)){
                                $(".nameCheck").hide();
                            }else{
                                $(".nameCheck").show();
                                $(".nameCheck").html("Name should contain only alphabets");
                                $(".nameCheck").css("color","red");
                                error_name = false;
                                return false;
                            }

                            var name_empty = $("#uname").val();
                            if(name_empty.length == ""){
                                $(".nameCheck").show();
                                $(".nameCheck").html("Name should not be empty");
                                $(".nameCheck").css("color","red");
                                error_name = false;
                                return false;
                            }else{
                                $(".nameCheck").hide();
                            }
                        }

                        function check_email(){
                            var email = $("#email").val().length;
                            if(email < 14){
                                $(".emailCheck").show();
                                $(".emailCheck").html("Invalid email");
                                $(".emailCheck").css("color","red");
                                error_email = false;
                                return false;
                            }
                            else{
                                $(".emailCheck").hide();
                            }
                         var email_val = $("#email").val();
                            var reg = /^([a-zA-Z0-9]+)@([a-z]+).([a-z]{3,5})(.[a-z]{3,5})?$/;
                            if(reg.test(email_val)){
                                $(".emailCheck").hide();
                            }else{
                                $(".emailCheck").show();
                                $(".emailCheck").html("Invalid email");
                                $(".emailCheck").css("color","red");
                                error_email = false;
                                return false;
                            }

                            var email_empty = $("#email").val();

                            if(email_empty.length == "" ){
                                $(".emailCheck").show();
                                $(".emailCheck").html("Email should not be empty");
                                $(".emailCheck").css("color","red");
                                error_email = false;
                                return false;
                            }else{
                                $(".emailCheck").hide();
                            }


                        }

                        function check_pwd(){
                            var pwd = $("#pwd").val().length;

                           
                            if(pwd < 8){
                                $(".pwdCheck").show();
                                $(".pwdCheck").html("Please enter at least 8 characters");
                                $(".pwdCheck").css("color","red");
                                error_pwd = false;
                                return false;
                            }else{
                                $(".pwdCheck").hide();
                            }

                            var pwd_empty = $("#pwd").val();
                            if(pwd_empty.length == "" ){
                                $(".pwdCheck").show();
                                $(".pwdCheck").html("Password should not be empty");
                                $(".pwdCheck").css("color","red");
                                error_pwd = false;
                                return false;
                            }else{
                                $(".pwdCheck").hide();
                            }

                            var pwd_val = $("#pwd").val();
                            var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
                            if(reg.test(pwd_val)){
                                $(".pwdCheck").hide();
                            }else{
                                $(".pwdCheck").show();
                                $(".pwdCheck").html("Password should contain atleast one uppercase, one lowercase and one digit");
                                $(".pwdCheck").css("color","red");
                                error_pwd = false;
                                return false;
                            }
                        }


                    });

                </script>
    
</body>
</html>