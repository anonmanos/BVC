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
	$idcard      =$_POST['idcard'];
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
	if(empty($idcard)||empty($titlename)||empty($fname)||empty($lname)||empty($tel)||empty($email)||empty($day)||empty($month)||empty($year)||empty($address))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
//ตรวจสอบเลขบัตรประจำตัวประชาชน เอาเฉพาะตัวเลข
    if (!is_numeric($idcard) )
    {
        echo "<script>alert('โปรตรวจสอบหมายเลขบัตรประจำตัวประชาชน!!!');history.back();</script>";
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
    }
	// select ข้อมูล username ว่าเคยมีการใช้งานไปแล้วหรือไม่
	$sqlC	= "select * from member where member_idcard='$idcard'";
	$queryC	= mysql_query($sqlC) or die("error=$sqlC");
	$numC	= mysql_num_rows($queryC);
	// ถ้า username มีการใช้งนไปแล้ว จะให้แจ้งเตือนเพื่อให้เปลี่ยน username ที่ต้องการใช้
	if($numC != 0)
	{
		echo "<script>alert('Please change idcard!!!');history.back();</script>";
		exit();
	}else
	{
        // ข้อมูล member
        $dateregis = date("Y-m-d");//วันที่ลงทะเบียน
        $birthday	= "$year-$month-$day"; // เตรียมข้อมูลจาก list/menu ทั้ง 3 มาจัดเพื่อเตรียมเก็บลงตาราง
		$sql= "insert into member values('','$idcard','$titlename','$fname'
		,'$lname','$tel','$email','$birthday','$address','$dateregis','')";
		mysql_query($sql) or die("error=$sql");
		echo "<script>window.location='member_list.php';</script>";//alert(' ++ Complete ++ ');
	}
?>
