<?php
/*
* Chat Realtime V.2.0 RL
* By Sitthichai 
* 2017/02/02 07:00:00
*/
		echo"<link rel=\"icon\" href=\"img/icon2.png\" type=\"image/x-icon\">";
?>
<title>Chat RealTime</title>

<script src="jquery-lastest.js"></script>

<script>
	
$(document).ready(function () {
    setInterval(function() {
        $.get("dconversation.php", function (result) {
            $('#massid').html(result);
        });
    },1000);
});
$(document).ready(function () {
	
    setInterval(function() {
        $.get("Checkonline.php", function (result) {
            $('#useonlineid').html(result);
        });
    },1000);
});
$(document).ready(function () {
    setInterval(function() {
        $.get("getLatestData.php", function (result) {
            $('#massagesid').html(result);
        });
    },1000);
});
</script>
<script async src=\"$('.d1-3').scrollTop($('.d1-3')[0].scrollHeight);\"></script>

<?php
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
		session_start();
 			if(!isset($_SESSION["user_session"])){
			exit();
			}
		
		$thislink=$_SERVER["PHP_SELF"]; // index.php
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

		if($qcrow['login_status'] == "0")
		{
			echo "'".$strId."' Exists login!";
				mysqli_close($db);
            session_destroy();  
			header("location:index.php");
			
			exit();
		}
 
isset($_REQUEST['reply'])?$retq=$_REQUEST['reply']:$retq='';
isset($_REQUEST['user_two'])?$_SESSION['user_two']=$_REQUEST['user_two']:$_SESSION['user_two']=$_REQUEST['user_two']='';
$user_one=$_SESSION["user_session"];
include('Stlye.css');
include('creating_conversation.php');
$uname=$_SESSION['seson_id'];
$uiname=$_SESSION['uiname'];
echo "<div id='d1-1' na=nameuq><p align='center'>Chat Raeltime ID : $uname  $uiname <a href=\"logout.php\">Logout here</a></p></div>";    
if(isset($_REQUEST['reply'])){include('reply.php');}   
echo "<div id='d1-2t'><p align='center' na=nameuq>Massages</p></div>";
echo "<div class='massages' id='massagesid'>";
echo "</div>";
$cid=$_SESSION['c_id'];
isset($_SESSION['nametwo'])?$nametwo = $_SESSION['nametwo']:$nametwo='';
echo "<div class='d1-3t' id='$cid'><p align='center'na=nameuq>$nametwo</p></div>";
echo "<div class='d1-3' name='$cid' id='massid'>";
echo "</div>";	
echo "<div class='edittitle' na=nameuq><p align='left'>Edit</p></div>";


echo "<center><div class='editmanager' na=nameu>";
echo"<a href=\"edit_information.php?editinfor=$cid\"><button class=\"btn btn-danger\">Edit Information</button></a><br>";
echo "<a href=\"changes_password.php?changes_pass=$cid\"><button class=\"btn btn-danger\">Changes Password</button></a><br>";
echo" <a href=\"removechat.php?removechat=$cid\"><button onclick=\"return confirm('คุณต้องการลบข้อมูลใช่หรือไม่?')\" class=\"btn btn-danger\">Clear Chat</button></a></div>";

echo "<div class='useronline' id='useonlineid' na=nameuq>";
echo "</div>";
$user_two=$_SESSION['user_two'];
echo "<div class='inpute'>";
echo"<form autocomplete=\"off\" class=\"w3-container\" action=\"$thislink?user_two=$user_two&nametwo=$nametwo\" method=\"post\">";
echo "<input name=\"c_id\" value=\"$cid\"type=\"hidden\">";
echo "<input name=\"reply\" class='w3-input w3-border w3-hover-blue' type=\"text\" placeholder=\"Type massages...\">";
echo"</form>"; 
echo "</div>";

function time_elapsed($secs){
   
  if($secs>59){  $bit = array(
        ' year'        => $secs / 31556926 % 12,
        ' week'        => $secs / 604800 % 52,
        ' day'        => $secs / 86400 % 7,
        ' hr'        => $secs / 3600 % 24,
        ' min'    => $secs / 60 % 60,
        ' sec'    => $secs % 60
        );
       
    foreach($bit as $k => $v){
        if($v > 1)$ret[] = $v . $k . 's';
        if($v == 1)$ret[] = $v . $k;
        }
        
        $ret = join('q', $ret);
        
        $ret = substr($ret,0,strpos($ret,'q'));}else{ 
			
			if($secs>1)$ret = $secs . ' secs'; 
			else $ret = $secs . ' sec';
			}
   
    return $ret;
    }
    
?>


