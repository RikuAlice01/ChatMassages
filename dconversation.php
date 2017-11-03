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
							
			
//PHP Code
//Contains PHP code, displaying conversation c_id reply results.
$user_one=$_SESSION["user_session"];
isset($_SESSION["c_id"])?$cid=$_SESSION["c_id"]:$cid='';
$query= mysqli_query($db,"SELECT u.user_name
 FROM conversation c, users u
 WHERE CASE 
 WHEN c.user_one = '$user_one' and c.c_id = '$cid' THEN c.user_two = u.id
 WHEN c.user_two = '$user_one' and c.c_id = '$cid' THEN c.user_one = u.id
 END 
 AND (
 c.user_one ='$user_one' OR c.user_two ='$user_one'
 )
 Order by c.c_id DESC Limit 20");
 
if (!$query) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
$nametwo='';
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$nametwo=$row['user_name'];
}

$query= mysqli_query($db,"SELECT R.cr_id,R.time,R.reply,U.id,U.user_id,U.user_name,U.user_email FROM users U, conversation_reply R WHERE R.user_id_fk=U.id and R.c_id_fk='$cid' ORDER BY R.cr_id ASC LIMIT 20");

 if (!$query) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
if($nametwo!=''){
while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
$cr_id=$row['cr_id'];
$time=$row['time'];
$reply=$row['reply'];
$user_id=$row['user_id'];
$username=$row['user_name'];
$email=$row['user_email'];
//HTML Output
//echo "<br>79 Displaying conversation $cr_id $time $reply $user_id $username $email<br>";

	if($user_id==$_SESSION["seson_id"]){
		echo "<div class='d1-3ct' id='$cr_id'>";
			echo "<div class='d1-3-c' id='$cr_id'>";
				echo "<div class='d1-3mm' id='$cr_id'><p align='center'>$reply</p></div>";
			echo "</div>";
		echo "</div>";
	}
	else{
		echo "<div class='d1-3ct' id='$cr_id'>";
			echo "<div class='d1-3-d' id='$cr_id'>";
				echo "<div class='d1-3my' id='$cr_id'><p align='center'>$reply</p></div>";
			echo "</div>";
		echo "</div>";
	}
	
}}

?>
