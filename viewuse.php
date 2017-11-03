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
?>

<html>  
<head lang="en">  
    <meta charset="UTF-8">  
    <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css"> 
    <title>View Users</title>  
</head>  
<style>  
    .login-panel {  
        margin-top: 150px;  
    }  
    .table {  
        margin-top: 50px;  
  
    }  
  
</style>  
  
<body>  
  
<div class="table-scrol">  
    <h1 align="center">All the Users</h1>  
  
<div class="table-responsive">
  
  
    <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">  
        <thead>  
  
        <tr>  
			<th algin=center>No.</th> 
            <th algin=center>User Id</th>  
            <th algin=center>User Name</th>  
            <th algin=center>User E-mail</th>  
            <th algin=center>User Pass</th>  
            <th algin=center>User Status</th> 
            <th algin=center>Update Time</th>
             <th algin=center>Ban</th>
             <th algin=center>Chat cnt</th>
            <th algin=center>Edit User</th>   
        </tr>  
        </thead>  
  
        <?php  
        include("database/db.php");  
        $view_users_query="select * from users";//select query for viewing users.  
        $run=mysqli_query($db,$view_users_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
        {  
            $id=$row[0];
            $user_id=$row[1];  
            $user_name=$row[2];  
            $user_pass=$row[3];  
            $user_email=$row[4];
            $user_status=$row[5];  
            $user_time=$row[6];
            $user_ban=$row[7];      
            
            $query="SELECT COUNT(*) AS `count` from conversation_reply WHERE user_id_fk = '$id'";//select query for viewing users.  
			$result=mysqli_query($db,$query);//here run the sql query.  
            $rowq = mysqli_fetch_assoc($result);
			$count = $rowq['count'];
            
        ?>  
  
        <tr>  
<!--here showing results in the table -->
			<td><?php echo $id;  ?></td>
            <td><?php echo $user_id;  ?></td>  
            <td><?php echo $user_name;  ?></td>
            <td><?php echo $user_email;  ?></td>  
            <td><div style='word-wrap:break-word;'><?php echo $user_pass;  ?></div></td>  
            <td><center><?php echo $user_status;  ?></center></td>  
            <td><?php echo $user_time;  ?></center></td>  
            <td><center><?php echo $user_ban;  ?></td> 
            <td><center><?php echo $count;  ?></td>  
            <td><center><a href="delete.php?del=<?php echo $id ?>"><button onclick="return confirm('คุณต้องการลบข้อมูลที่เลือก?')" class="btn btn-danger">Delete</button></a>
   <?php       if($user_ban == '0')
					echo" <a href=\"ban.php?ban=$id\"><button onclick=\"return confirm('คุณต้องการแบนข้อมูลที่เลือก?')\" class=\"btn btn-danger\">Ban</button></a>";
				else
					echo" <a href=\"ban.php?ban=$id\"><button onclick=\"return confirm('คุณต้องการยกเลิกแบนข้อมูลที่เลือก?')\" class=\"btn btn-danger\">Unban</button></a>";
				echo" <a href=\"removechatbyadmin.php?removechatbyadmin=$id\"><button onclick=\"return confirm('คุณต้องการสนทนาของคนที่เลือก?')\" class=\"btn btn-danger\">Remove Chat</button></a>";
				//echo" <a href=\"view_users.php?savechat=$id\"><button class=\"btn btn-danger\">Save Chat</button></a>";
				echo"</center></td>";
	  
	  ?>		
        </tr>  
  
        <?php }
    /*    if(isset($_REQUEST['savechat'])){
			$sid=$_REQUEST['savechat'];
			$query="SELECT * from conversation_reply WHERE user_id_fk = '$sid'";//select query for viewing users.  
			$result=mysqli_query($db,$query);//here run the sql query.  
            $tables = mysqli_fetch_assoc($result);
            
            //$myfile = fopen("testfile.txt", "w") 
			$handle = fopen('savechat-'.time().'-'.$sid.'.txt','w+');
			$txt = "John Doe\n";
			fwrite($myfile, $txt);
			$txt = "Jane Doe\n";
			fwrite($myfile, $txt);
			fclose($myfile);
			}*/
         ?>  
  
    </table>  
        </div>  
</div>  
  
<h1><a href="logoutadmin.php">Logout here</a> </h1>   
</body>  
  
</html>
