<?php
/*
* Chat Realtime V.2.0 RL
* By Sitthichai 
* 2017/02/02 07:00:00
*/$thislink=$_SERVER["PHP_SELF"];
		echo"<link rel=\"icon\" href=\"img/icon2.png\" type=\"image/x-icon\">";
?>
<title>Chat RealTime</title>
<?php



 ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
			session_start();
 			if(!isset($_SESSION["user_session"])){
			exit();
			}
			
	include('database/db.php'); 
	
	$x=$_SESSION['user_session'];

        $viewquery= "select ban,login_status from users WHERE id = $x"; 
        $run=mysqli_query($db,$viewquery); 
        
        if (!$viewquery) {
			printf("Error: %s\n", mysqli_error($db));
				exit();
		}
 
$qcrow=mysqli_fetch_array($run,MYSQLI_ASSOC);			
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
	
	
	$x=$_SESSION['user_session']; 
    $changes_pass_query="select user_pass from users
	WHERE id = $x";
	
	
    $run=mysqli_query($db,$changes_pass_query);
       if (!$run) {
			printf("Error: %s\n", mysqli_error($db));
				exit();
		}
	$row=mysqli_fetch_array($run);
	
if(isset($_REQUEST['changes_passq'])){

        if($_REQUEST['opass']=='')  
        {  
            //javascript use for input checking  
            echo"<script>alert('Please enter the Old Password')</script>";
            header("Location: changes_password.php?1");  
        }
        
        else if($_REQUEST['npass']=='')  
        {  
            //javascript use for input checking  
            echo"<script>alert('Please enter the New Password')</script>";  
            header("Location: changes_password.php?2");
        }  
      
        else if($_REQUEST['vpass']=='')  
        {  
            echo"<script>alert('Please enter the Verify New Password')</script>"; 
            header("Location: changes_password.php?3");  
        }  
        
else if(($user_pass=md5("V").md5($_REQUEST['opass']))!=$row['user_pass'])
{
	         echo"<script>alert('Old Password is Wrong')</script>"; 
	          header("Location: changes_password.php?4");
	}

else if($_REQUEST['npass']!=$_REQUEST['vpass'])
{
		         echo"<script>alert('Not Match Verify New Password')</script>";
			header("Location: changes_password.php?5");
	}
else{
	$p=(($user_pass=md5("V").md5($_REQUEST['npass'])));

			$sql = "UPDATE users SET user_pass = '$p' , last_update = NOW() WHERE id = '".$x."' ";
			$query = mysqli_query($db,$sql);

	$sql = "UPDATE users SET login_status = '0', last_update = '0000-00-00 00:00:00' WHERE user_id = '".$_SESSION["seson_id"]."' ";
	$query = mysqli_query($db,$sql);
	mysqli_close($db);
    session_destroy();  
    header("Location: index.php?");//use for the redirection to some page  
}}
?>


    <head lang="en">  
        <meta charset="UTF-8">  
        <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">  
        <title>Changes Password</title>  
    </head> 
     <div class="container">  
        <div class="row">    
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->  
                <div class="login-panel panel panel-success">     
                    <div class="panel-heading"> 
					<h3 class="panel-title">Changes Password</h3>  
                    </div>  
                    <div class="panel-body">  
                        <form role="form" method="post" action="changes_password.php?changes_pass=y">  
                            <fieldset> 
                                <div class="form-group">  
                                   <input class="form-control" placeholder="Old Password" name="opass" type="password" value="">  
                                </div>  
                                <div class="form-group">  
                                   <input class="form-control" placeholder="New Password" name="npass" type="password" value="" pattern=".{6,}" title="Six or more characters">  
                                </div>  
                                <div class="form-group">  
                                    <input class="form-control" placeholder="Verify New Password" name="vpass" type="password" value="" pattern=".{6,}" title="Six or more characters">  
                                </div>  
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Done" name="changes_passq" >  
								<center><br><a id='back'href='test2.php'>Back</a><center>
                            </fieldset>  
                        </form>  
					</div>
				</div>
			</div>
		</div>
	</div>
