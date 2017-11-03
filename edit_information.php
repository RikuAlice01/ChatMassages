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
 			if(!isset($_SESSION["user_session"])){
					mysqli_close($db);
    session_destroy();  
			exit();
			}
include('database/db.php');
if(!$db) {
echo "ไม่สามารถเชื่อมต่อกับ MySQL Server ได้<br>";
exit;
}			
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

$qcrow=mysqli_fetch_array($run,MYSQLI_ASSOC);
		if($qcrow['login_status'] == "0")
		{
			echo "'".$strId."' Exists login!";
				mysqli_close($db);
    session_destroy();  
			header("location:index.php");
			
			exit();
		}
		
	
if(isset($_REQUEST['editinforq'])){

        if($_REQUEST['name']=='')  
        {  
            //javascript use for input checking  
            echo"<script>alert('Please enter your name')</script>";  
			header("edit_information.php");
        }
        
       else if($_REQUEST['mail']=='')  
        {  
            //javascript use for input checking  
            echo"<script>alert('Please enter your E-mail')</script>";  
           header("edit_information.php");
        }
else{
			$name=$_REQUEST['name'];
			$email=$_REQUEST['mail'];

	  $sql = "UPDATE users SET user_name = '$name' , user_email = '$email' ,last_update = NOW() WHERE user_id = '".$_SESSION["seson_id"]."' ";
	$query = mysqli_query($db,$sql);			
		header("Location: index.php");//use for the redirection to some page  
}}
?>


    <head lang="en">  
        <meta charset="UTF-8">  
        <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">  
        <title>Edit Information</title>  
    </head> 
     <div class="container">  
        <div class="row">    
            <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->  
                <div class="login-panel panel panel-success">     
                    <div class="panel-heading"> 
					<h3 class="panel-title">Changes Password</h3>  
                    </div>  
                    <div class="panel-body">  
                        <form role="form" method="post" action="edit_information.php?changes_pass=y">  
                            <fieldset> 
                                <div class="form-group">  
                                   <input autocomplete="off" class="form-control" placeholder="Name" name="name" type="text" value="">  
                                </div>  
                                <div class="form-group">  
                                   <input autocomplete="off" class="form-control" placeholder="E-mail" name="mail" type="text" value="" >  
                                </div>  
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Done" name="editinforq" >  
								<center><br><a id='back'href='test2.php'>Back</a><center>
                            </fieldset>  
                        </form>  
					</div>
				</div>
			</div>
		</div>
	</div>
