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




			include('Stlye.css');
		$user_one=$_SESSION["user_session"];
//PHP Code
//Contains PHP code. Displaying username arun conversation results
$query= mysqli_query($db,"SELECT u.id,u.user_id,c.c_id,u.user_name,u.user_email
 FROM conversation c, users u
 WHERE CASE 
 WHEN c.user_one = '$user_one' THEN c.user_two = u.id
 WHEN c.user_two = '$user_one' THEN c.user_one = u.id
 END 
 AND (
 c.user_one ='$user_one' OR c.user_two ='$user_one'
 )
 Order by c.c_id DESC Limit 20");
$reply='';
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$u_id=$row['id'];
$cid=$row['c_id'];
$user_id=$row['user_id'];
$username=$row['user_name'];
$email=$row['user_email'];

$cquery= mysqli_query($db,"SELECT R.cr_id,R.user_id_fk,R.time,R.reply FROM conversation_reply R WHERE R.c_id_fk='$cid' ORDER BY R.cr_id DESC LIMIT 1");

 if (!$cquery) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
$crow=mysqli_fetch_array($cquery,MYSQLI_ASSOC);
$cr_id=$crow['cr_id'];
$reply=$crow['reply'];
$time=$crow['time'];
$user_id_fk=$crow['user_id_fk'];
//HTML Output.
$cquerys= mysqli_query($db,"SELECT user_id FROM users WHERE id='$user_id_fk' ORDER BY user_id DESC LIMIT 1");
		if (!$cquerys) {
			printf("Error: %s\n", mysqli_error($db));
				exit();
		}
$qcrow=mysqli_fetch_array($cquerys,MYSQLI_ASSOC);
$usesen=$qcrow['user_id'];
//while ($row = $cquery->fetch_assoc()) {
//    echo $row['classtype']."<br>";
//} 

//echo"<br>43 $cr_id $time $reply $user_id $username $email<br>";

if($reply!=''){
echo "<a class='containt w3-hover-blue' id='$cid' href='test2.php?user_two=$u_id&nametwo=$username'>";
			echo "<div class='name' id='$cid'>$username";
				$timesender = time_elapsed(time()-$time);
				echo "<div class='timesender' name='$cid'>$timesender";
				echo "</div>";
			echo "</div>";
			if($usesen==$_SESSION["seson_id"])$usesen='You';
			echo "<div class='mas' id='$cid'>$usesen:$reply";
			echo "</div>";				
				
echo"</a>";
}
}
    
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
