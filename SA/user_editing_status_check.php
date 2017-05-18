<?
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		echo "<script>alert('!! Please Login !! ');
				window.location='../index.php';</script>";
		exit();
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?
	include("import/dbc_connect.php");
	$username	 =$_POST['username'];
	$usergroup 	 =$_POST['usergroup'];
	$userstatus	 =$_POST['userstatus'];


	echo $username;
	echo $usergroup;
	echo $userstatus;
	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($username)||
       empty($usergroup)||
       empty($userstatus))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    
	// ตรวจสอบ Password และ Comfirm Password ต้องกรอกตรงกัน 
		$sql= "update user set
				usergroup_id    = '$usergroup',
				user_status     = '$userstatus'
				where user_id	= '$username'";
		mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='user_edit_status.php';</script>";//alert(' ++ Complete ++ ');
?>