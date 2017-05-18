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
    //เชื่อมต่อกับฐานข้อมูล
	include("import/dbc_connect.php");
    //รับข้อมูล
	$username	 =$_POST['username'];
	$password	 =$_POST['password'];
    $confirm	 =$_POST['confirm'];
	$usergroup	 =$_POST['usergroup'];
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
    if(empty($username)||empty($password)||empty($confirm)||empty($usergroup)||empty($titlename)||
    empty($fname)||empty($lname)||empty($tel)||empty($email)||empty($day)||empty($month)||empty($year)||empty($address))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
//ตรวจสอบ username เฉพราะตัวเลข (_a-z0-9-)
    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*$", $username)){
        echo "<script>alert('โปรตรวจสอบ ชื่อผู้ใช้งาน!!!!');history.back();</script>";
        exit();
    }
// select ข้อมูล username ว่าเคยมีการใช้งานไปแล้วหรือไม่
	$sqlC	= "select * from user where user_id='$username'";
	$queryC	= mysql_query($sqlC) or die("error=$sqlC");
	$numC	= mysql_num_rows($queryC);
	// ถ้า username มีการใช้งานไปแล้ว จะให้แจ้งเตือนเพื่อให้เปลี่ยน username ที่ต้องการใช้
	if($numC != 0)
	{
		echo "<script>alert('Please change USERNANE!!!');history.back();</script>";
		exit();
	}
// ตรวจสอบ Password และ Comfirm Password ต้องกรอกตรงกัน 
	if($password  != $confirm)
	{
		echo "<script>alert('Please check password!!!');history.back();</script>";
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
// เพิ่มข้อมูลลง ตาราง "user"
		$pass	= "9a".base64_encode($password)."b9".base64_encode($password)."81c="; // เข้ารหัสข้อมูล ก่อนจัดเก็บข้อมูลลงตาราง
        $date = date("Y-m-d H:i:s"); 
		$sql= "insert into user values('$username','$pass','$usergroup','11','$date')";
		mysql_query($sql);
        // ข้อมูล userpro
        $user        =$username;
        $birthday	= "$year-$month-$day"; // เตรียมข้อมูลจาก list/menu ทั้ง 3 มาจัดเพื่อเตรียมเก็บลงตาราง
		$sql= "insert into userpro values('$user','$titlename','$fname'
		,'$lname','$tel','$email','$birthday','$address')";
		mysql_query($sql) or die("error=$sql");
		echo "<script>alert(' ++ Complete ++ ');window.location='user_status.php';</script>";
    }
?>
