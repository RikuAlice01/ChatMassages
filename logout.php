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
    session_start();//session is a way to store information (in variables) to be used across multiple pages.  
    /** 
     * Created by PhpStorm. 
     * User: Ehtesham Mehmood 
     * Date: 11/21/2014 
     * Time: 2:46 AM 
     */  
       			if(!isset($_SESSION["user_session"]) and !isset($_SESSION["admin_name"])){
			exit();
			}
			
	require_once("database/db.php");

	//*** Update Status
	$sql = "UPDATE users SET login_status = '0', last_update = '0000-00-00 00:00:00' WHERE user_id = '".$_SESSION["seson_id"]."' ";
	$query = mysqli_query($db,$sql);
	mysqli_close($db);
    session_destroy();  
    header("Location: index.php");//use for the redirection to some page  
?>
