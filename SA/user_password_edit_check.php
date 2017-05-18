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
<?PHP
    include("import/dbc_connect.php");
	$user_id        = $_SESSION['user_id'];
    $o	            = $_POST['current'];
	$n             	= $_POST['newpassword'];
	$r             	= $_POST['renewpassword'];
	$oldpassword	=  "9a".base64_encode($o)."b9".base64_encode($o)."81c=";
	$newpassword	=  "9a".base64_encode($n)."b9".base64_encode($n)."81c=";
	$renewpassword	=  "9a".base64_encode($r)."b9".base64_encode($r)."81c=";   
	
	// check ข้อมูลที่กรอกเข้ามา ต้องตรบทั้ง 3 ตัว
	if(empty($oldpassword)||empty($newpassword)||empty($renewpassword))
	{
		echo "<script>alert('Please refill form !!!');history.back();</script>";
		exit();
	}

	// select ข้อมูล password เดิม ของ member คนนี้ออกมาจาก database
	$sql 	= "select * from user where user_id='$user_id'";
	$query	= mysql_query($sql) or die("error=$sql");
	$row	= mysql_fetch_array($query);
	
	// check password เดิมใน database ว่าตรงกับ password เดิมที่รอกมา($oldpassword)หรือไม่
	if($row['user_password']!=$oldpassword)
	{
		// ถ้าไม่ตรงกลับไปกรอกใหม่
		echo "<script>alert('Please Check Current Password !!!');history.back();</script>";
		exit();
	}
	// ถ้า ตรง check $newpassword และ $renewpassword ต้องตรงกัน
	if($newpassword!=$renewpassword)
	{
		echo "<script>alert('Please Check Your New Password !!!');history.back();</script>";
		exit();
	}
	// แก้ไขข้อมูล password ของ  member คนนี้ใน database 
	$sqlU = "update user set user_password='$newpassword' where user_id='$user_id'";
	mysql_query($sqlU) or die("error=$sqlU");
	echo "<script>window.location='index.php';</script>";//alert(' ++ Complete ++ ');
?>