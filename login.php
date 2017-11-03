<?php
/*
* Chat Realtime V.2.0 RL
* By Sitthichai 
* 2017/02/02 07:00:00
*/
		echo"<link rel=\"icon\" href=\"img/icon2.png\" type=\"image/x-icon\">";
?>
<title>Chat RealTime</title>
<?php 
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
session_start();  

 include('database/db.php');
if(!$db) {
echo "ไม่สามารถเชื่อมต่อกับ MySQL Server ได้<br>";
exit;}
$x=$_SESSION['user_session'];
        $viewquery= "select ban,login_status from users WHERE id = $x"; 
        $run=mysqli_query($db,$viewquery); 
        
        if (!$viewquery) {
            printf("Error: %s\n", mysqli_error($db));
                exit();
        }
 
//$qcrow=mysqli_fetch_array($run,MYSQLI_ASSOC);
        if($qcrow['ban'] == "1")
        {
            echo "'".$strId."' Exists login!";
                mysqli_close($db);
            session_destroy();  
            header("location:index.php");
            exit();
        }

        if($qcrow['login_status'] == "0")
        {
            echo "'".$strId."' Exists login!";
                mysqli_close($db);
            session_destroy();  
            header("location:index.php");
            
            exit();
        }


    if(isset($_SESSION["seson_id"]))echo "<script>window.open('test2.php','_self')</script>"; 




?>  
       
    <html>  
    <head lang="en">  
        <meta charset="UTF-8">  
        <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">  
        <title>Login</title>  
    </head>  
    <style>  
        .login-panel {  
            margin-top: 150px;  }
    </style>  
      
    <body>  

    <div class="container">  
        <div class="row"> 
<?php if(isset($_REQUEST['register'])){ ?>
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->  
                <div class="login-panel panel panel-success">  
                    <div class="panel-heading">  
                        <h3 class="panel-title">Registration</h3>  
                    </div>  
                    <div class="panel-body">  
                        <form role="form" method="post" action="index.php">  
                            <fieldset> 
								<div class="form-group">  
                                    <input autocomplete="off" class="form-control" placeholder="ID" name="id" type="text" autofocus pattern="(?=.*[BMDbmd])(?=.*\d).{8}" title="Must contain at Student ID">  
                                </div>   
                                
                                <div class="form-group">  
                                    <input autocomplete="off" class="form-control" placeholder="Username" name="name" type="text" autofocus>  
                                </div>  
      
                                <div class="form-group">  
                                    <input autocomplete="off" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>  
                                </div>  
                                <div class="form-group">  
                                    <input class="form-control" placeholder="Password" name="pass" type="password" value="" pattern=".{6,}" title="Six or more characters">  
                                </div>  
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="register" name="register" >  
								<center><br><a id='login'href='index.php'>Back</a><center>
                            </fieldset>  
                        </form>   
                    </div>  
                </div>  
            </div>   <?php } ?>			 
<?php if(!isset($_REQUEST['register'])){ ?><div class="col-md-4 col-md-offset-4">  
                <div class="login-panel panel panel-success">  
                    <div class="panel-heading">  
						<h3 class="panel-title">Sign In</h3>  
                    </div>  
						<div class="panel-body">  
                        <form role="form" method="post" action="check_login.php">  
                            <fieldset>  
                                <div class="form-group"  >  
                                    <input autocomplete="off" class="form-control" placeholder="ID" name="id" type="id" autofocus>  
                                </div>  
                                <div class="form-group">  
                                    <input class="form-control" placeholder="Password" name="pass" type="password" value="">  
                                </div>  
                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >  
      
									<center><br><a id='register'href='index.php?register=y'>Already registered ?</a><center>
                                <!-- Change this to a button or input when using this as a form -->  
                              <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->  
                            </fieldset>  
                        </form>
                    </div>
                </div>  
            </div>   <?php  } ?>
        </div>  
    </div>  
      
      
    </body>  
      
    </html>  
      
    <?php  
    include("database/db.php");  
      
   if(isset($_POST['login']))  
    {  
        $user_id=$_POST['id'];  
        $user_pass=$_POST['pass'];  
		$user_id=strtoupper($user_id);
        $check_user="select * from users WHERE user_id='$user_id'AND user_pass='$user_pass'";  
      
        $run=mysqli_query($db,$check_user);  
      
        if(mysqli_num_rows($run))  
        {  
            echo "<script>window.open('check_login.php','_self')</script>";  
      
            $_SESSION['id']=$user_id;//here session is used and value of $user_id store in $_SESSION.  
      
        }  
        else  
        {  
          echo "<script>alert('ID or password is incorrect!')</script>";  
        }  
    }
    ?>  
    <?php   
    if(isset($_POST['register']))  
    {  	
		$user_id=$_POST['id'];
        $user_name=$_POST['name'];//here getting result from the post array after submitting the form.  
        $user_pass=$_POST['pass'];//same  
        $user_email=$_POST['email'];//same  
      
        if($user_id=='')  
        {  
            //javascript use for input checking  
            echo"<script>alert('Please enter the ID')</script>";  
		exit();//this use if first is not work then other will not show  
        }
        
        if($user_name=='')  
        {  
            //javascript use for input checking  
            echo"<script>alert('Please enter the name')</script>";  
		exit();//this use if first is not work then other will not show  
        }  
      
        if($user_pass=='')  
        {  
            echo"<script>alert('Please enter the password')</script>";  
		exit();  
        }  
      
        if($user_email=='')  
        {  
            echo"<script>alert('Please enter the email')</script>";  
        exit();  
        }  
		//here query check weather if user already registered so can't register again.  
        $check_id_query="select * from users WHERE user_id='$user_id'";  
        $run_query=mysqli_query($db,$check_id_query);  
      
      
        if(mysqli_num_rows($run_query)>0)  
        {  
    echo "<script>alert('ID $user_id is already exist in our database, Please try another one!')</script>";  
    exit();  
        }
		 $user_id=strtoupper($user_id);
         $user_pass=md5("V").md5($user_pass);
		//insert the user into the database.  
        $insert_user="insert into users (user_id,user_name,user_pass,user_email) VALUE ('$user_id','$user_name','$user_pass','$user_email')";  
        if(mysqli_query($db,$insert_user))  
        {  
            echo"<script>window.open('check_login.php?id=$user_id&pass=$user_pass&register=y','_self')</script>";  
        }  
      
      
      
    }  
    ?>  