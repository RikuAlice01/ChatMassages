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

	require_once("database/db.php");
	isset($_REQUEST['id'])?$_REQUEST['id']=$_REQUEST['id']:$_REQUEST['id']='';
	isset($_REQUEST['pass'])?$_REQUEST['pass']=$_REQUEST['pass']:$_REQUEST['pass']='';
	$strId = mysqli_real_escape_string($db,$_REQUEST['id']);
	$strPassword = mysqli_real_escape_string($db,$_REQUEST['pass']);
	$strPassword=md5("V").md5($strPassword);
	$strSQL = "SELECT * FROM users WHERE user_id = '".$strId."' 
	and user_pass = '".$strPassword."'";
	$objQuery = mysqli_query($db,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Id and Password Incorrect!";
		header("location:index.php");
	}
	else
	{
		if($objResult["login_status"] == "1")
		{
			echo "'".$strId."' Exists login!";
			header("location:index.php");
			exit();
		}
		else if($objResult["ban"] == "1")
		{
			echo "'".$strId."' Exists login!";
			header("location:index.php");
			exit();
		}
		
		else
		{
			//*** Update Status Login
			$sql = "UPDATE users SET login_status = '1' , last_update = NOW() WHERE user_id = '".$objResult['user_id']."' ";
			$query = mysqli_query($db,$sql);

			//*** Session
			$_SESSION["seson_id"] = $objResult["user_id"];
			$_SESSION["user_session"] = $objResult["id"];
			$_SESSION["uiname"] = $objResult["user_name"];
			$_SESSION['user_two']='';
			$_SESSION['nametwo']='';
			session_write_close();

			//*** Go to Main page
			header("location:index.php");
		}
	}
	mysqli_close($db);
?>
