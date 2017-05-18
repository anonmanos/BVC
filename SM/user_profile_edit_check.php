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
	$titlename	 =$_POST['titlename'];
	$fname     	 =$_POST['fname'];
	$lname	     =$_POST['lname'];
	$tel		 =$_POST['tel'];
	$email     	 =$_POST['email'];
	$day		 =$_POST['day'];
	$month		 =$_POST['month'];
	$year		 =$_POST['year'];
	$address	 =$_POST['address'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($titlename)||
       empty($fname)||
       empty($lname)||
       empty($tel)||
       empty($email)||
       empty($day)||
       empty($month)||
       empty($year)||
       empty($address))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
//ตรวจสอบเบอร์โทร เอาเฉพาะตัวเลข
    if (!is_numeric($tel) )
    {
        echo "<script>alert('โปรตรวจสอบเบอร์โทรศัทพ์!!!');history.back();</script>";
        exit();
    }
//ตรวจสอบอีเมลล์
    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
        echo "<script>alert('โปรตรวจสอบ Email!!!!');history.back();</script>";
        exit();
    }
//ตรวจสอบวันเกิด
    if(!checkdate($month,$day,$year))
	{
		echo "<script>alert('Please check Birthday!!!');history.back();</script>";
		exit();
    }else
    {
//แก้ไขข้อมูล
	$birthday	= "$year-$month-$day";
		$sql= "update userpro set
				user_nametitle  = '$titlename',
				user_fname      = '$fname',
				user_lname		= '$lname',
				user_cnumber    = '$tel',
				user_email  	= '$email',
				user_birthday	= '$birthday',
                user_address    = '$address'
				where user_id	= '{$_SESSION['user_id']}'";
		mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='user_profile.php';</script>";//alert(' ++ Complete ++ ');
    }
?>
