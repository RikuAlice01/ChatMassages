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
			exit();
			}
//PHP Code - Inserting Reply
$uid_session=$_SESSION["user_session"];

 
function sensor($word) {
					include('toxic.php');
				return str_replace($word_cut,"***",$word);}

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


if(!empty($retq)){
$str = sensor($retq);
$name2=$_REQUEST['nametwo'];
$reply=mysqli_real_escape_string($db,$str);
$cid=mysqli_real_escape_string($db,$_REQUEST['c_id']);
$uid=mysqli_real_escape_string($db,$uid_session);
$time=time();
$ip=$_SERVER['REMOTE_ADDR'];
$q= mysqli_query($db,"INSERT INTO conversation_reply (user_id_fk,reply,ip,time,c_id_fk,new) VALUES ('$uid','$reply','$ip','$time','$cid','1')");
}
//echo "<br>144 Inserting Reply<br>";
$c_id=$cid;
$user_two=$_GET['user_two'];
?>
