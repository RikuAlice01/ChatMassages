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

?>
<title>Chat RealTime</title>
<script src="jquery-lastest.js"></script>

<script>
$(document).ready(function () {
    setInterval(function() {
        $.get("viewuse.php", function (result) {
            $('#show').html(result);
        });
    },1000);
});
</script>




<?php 
 ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/../session'));
			session_start();
			if(!isset($_SESSION["admin_name"])){
					exit();
			}
 include('database/db.php');
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
	echo "<div id='show'></div>"
					
?>
