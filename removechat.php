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
 include('database/db.php');
if(!$db) {
echo "ไม่สามารถเชื่อมต่อกับ MySQL Server ได้<br>";
exit;
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

 
 ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
			session_start();
 			if(!isset($_SESSION["user_session"])){
			exit();
			}
	isset($_REQUEST['removechat'])?$aa=$_REQUEST['removechat']:$aa='';
	$x=$_SESSION['user_session']; 
	
    $delete_query="select  conversation.c_id  from conversation,conversation_reply 
	WHERE conversation_reply.user_id_fk = $x
	and conversation.c_id = conversation_reply.c_id_fk 
	GROUP BY conversation_reply.c_id_fk";
	include('database/db.php'); 
    $run=mysqli_query($db,$delete_query);
    while($row=mysqli_fetch_array($run)){
	$y=$row['c_id'];
	
	if($y!='')break;
        echo "<script>window.open('index.php?','_self')</script>";  
	}
		
    $delete_query="delete  from conversation_reply WHERE c_id_fk = '$aa'";
    $run=mysqli_query($db,$delete_query);
    
    $delete_query="delete  from conversation WHERE c_id = '$aa'";
    $run=mysqli_query($db,$delete_query);
    if($run)  
    {  
    //javascript function to open in the same window   
   echo "<script>window.open('index.php?','_self')</script>";  
    }  
    ?>  
