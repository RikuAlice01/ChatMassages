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
			if(!isset($_SESSION["admin_name"])){
					exit();
			}
    include("database/db.php");  
    $ban_id=$_GET['ban'];  
    $ban_query="UPDATE users SET ban = !ban,login_status = 0 WHERE id = $ban_id";//delete query  
    $run=mysqli_query($db,$ban_query);  
    if($run)  
    {  
    //javascript function to open in the same window   
        echo "<script>window.open('view_users.php?deleted=user has been banned','_self')</script>";  
    }  
      
?>  
