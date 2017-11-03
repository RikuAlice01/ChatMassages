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
		//	session_start();
 			if(!isset($_SESSION["user_session"])){
			exit();
			}
// Creating Conversation
if (!isset($_REQUEST['user_two'])) {
	$c_id='';
    return;
}
 			if(!isset($_SESSION["user_session"])){
			exit();
			}

$user_one=mysqli_real_escape_string($db,$_SESSION['user_session']);
$user_two=mysqli_real_escape_string($db,$_REQUEST['user_two']);
if($user_one!=$user_two)
{
$q= mysqli_query($db,"SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ");
if (!$q) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}

$time=time();
$ip=$_SERVER['REMOTE_ADDR'];
if(mysqli_num_rows($q)==0)
{
$query = mysqli_query($db,"INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')");

		if (!$query) {
			printf("Error: %s\n", mysqli_error($db));
				exit();
		}

$q=mysqli_query($db,"SELECT c_id FROM conversation WHERE user_one ='$user_one' ORDER BY c_id DESC limit 1");

		if (!$q) {
			printf("Error: %s\n", mysqli_error($db));
				exit();
		}

$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
$_SESSION['c_id']=$v['c_id'];
$_SESSION['user_two']=$user_two;
isset($_REQUEST['nametwo'])?$_SESSION['nametwo']=$_REQUEST['nametwo']:$_SESSION['nametwo']='';
}
else
{
$v=mysqli_fetch_array($q,MYSQLI_ASSOC);
$_SESSION['c_id']=$v['c_id'];
$_SESSION['user_two']=$user_two;
isset($_REQUEST['nametwo'])?$_SESSION['nametwo']=$_REQUEST['nametwo']:$_SESSION['nametwo']='';
}
}
?>
