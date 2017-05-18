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
	$trainer_id        =$_GET['trainer_id'];
    $course_detail_id  =$_GET['course_detail_id'];
    $member_idcard     =$_GET['member_idcard'];
    //echo $trainer_id; echo $course_detail_id; echo $member_idcard;

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($trainer_id)||empty($course_detail_id)||empty($member_idcard))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
	// select ข้อมูล username ว่าเคยมีการใช้งานไปแล้วหรือไม่
	$sqlC	= "select * from courseregis where trainer_id='$trainer_id' AND course_detail_id='$course_detail_id' AND member_idcard='$member_idcard'";
	$queryC	= mysql_query($sqlC) or die("error=$sqlC");
	$numC	= mysql_num_rows($queryC);
	// ถ้า username มีการใช้งนไปแล้ว จะให้แจ้งเตือนเพื่อให้เปลี่ยน username ที่ต้องการใช้
	if($numC != 0)
	{
		echo "<script>alert('ลงทะเบียนแล้ว!!!');history.back();</script>";
		exit();
	}else
	{
        // ข้อมูล member
        $regisdate = date("Y-m-d H:i:s");//วันที่ลงทะเบียน
        $sql= "insert into courseregis values('','$course_detail_id','$trainer_id','$member_idcard','$regisdate','')";
		mysql_query($sql) or die("error=$sql");
		echo "<script>window.location='course_register_list_detail.php?course_detail_id=$course_detail_id';</script>";//alert(' ++ Complete ++ ');
	}
?>
