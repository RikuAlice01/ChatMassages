<?php
/*
* Chat Realtime V.2.0 RL
* By Sitthichai 
* 2017/02/02 07:00:00
*/
		echo"<link rel=\"icon\" href=\"img/icon2.png\" type=\"image/x-icon\">";

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



?>
<title>Chat RealTime</title>
<?php
//PHP Code 
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
			session_start();
 			if(!isset($_SESSION["user_session"])){
			exit();
			}
			//include('Stlye.css');
if(!$db) {
echo "ไม่สามารถเชื่อมต่อกับ MySQL Server ได้<br>";
exit;
}
            $query="SELECT COUNT(*) AS `count` from users WHERE login_status=1";//select query for viewing users.  
			$result=mysqli_query($db,$query);//here run the sql query.  
            $rowq = mysqli_fetch_assoc($result);
			$count = $rowq['count'];
 echo "Online : $count";

$query= mysqli_query($db,"SELECT user_name,id
 FROM users
 WHERE login_status=1
 Order by user_name DESC Limit 20");
 
 while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
{
	$usernameon=$row['user_name'];
	$iduser=$row['id'];
	if($iduser!=$_SESSION["user_session"])
		 echo "<a class='useronlinecontaint w3-hover-blue' id='$iduser'href='test2.php?user_two=$iduser&nametwo=$usernameon'><font class='useronlinecontaint w3-hover-blue' ><img src='img/online.png' height='10px' width='10px'>";
	else echo "<a na='nameu' class='useronlinecontaint w3-hover-blue' id='$iduser'><font class='useronlinecontaint w3-hover-blue' ><img src='img/online2.png' height='10px' width='10px'>";
	echo "  $usernameon</font></a>";
	}
	echo "</p>";
?>


