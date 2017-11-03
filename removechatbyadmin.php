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
			
	$removec=$_GET['removechatbyadmin'];
 	
	include('database/db.php');
	
    $delete_query="select  c_id_fk  from conversation,conversation_reply 
	WHERE conversation_reply.user_id_fk = $removec and conversation.c_id = conversation_reply.c_id_fk GROUP BY conversation_reply.c_id_fk"; 
    
    $run=mysqli_query($db,$delete_query);
    
    
    while($row=mysqli_fetch_array($run)){
	isset($row['c_id_fk'])?$aa=$row['c_id_fk']:$aa=''; 
	}
	if($aa!=''){
        echo "<script>window.open(view_users.php?,'_self')</script>";  
	}
	
    $delete_query="delete  from conversation_reply WHERE c_id_fk = '$aa'";
    $run=mysqli_query($db,$delete_query);
    
    $delete_query="delete  from conversation WHERE c_id = '$aa'";
    $run=mysqli_query($db,$delete_query);

    {  
    //javascript function to open in the same window   
         echo "<script>window.open('view_users.php?removed=chat has been deleted','_self')</script>";  
    }  
    ?>  
