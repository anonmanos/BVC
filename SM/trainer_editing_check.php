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
	$trainer_id	 =$_POST['trainer_id'];
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
	if(empty($trainer_id)||
       empty($titlename)||
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
// ตรวจสอบ Password และ Comfirm Password ต้องกรอกตรงกัน 
	$birthday	= "$year-$month-$day";
		$sql= "update trainer set
				trainer_nametitle   = '$titlename',
				trainer_fname       = '$fname',
				trainer_lname		= '$lname',
                trainer_cnumber     = '$tel',
				trainer_email  	    = '$email',
				trainer_birthday	= '$birthday',
                trainer_address     = '$address'
				where trainer_id	= '$trainer_id'";
		mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='trainer.php';</script>";//alert(' ++ Complete ++ ');
    }
?>
