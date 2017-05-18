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
	$course_id         =$_POST['course_id'];
	$course_name       =$_POST['course_name'];
	$course_unit       =$_POST['course_unit'];
	$course_hour       =$_POST['course_hour'];
	$course_duration   =$_POST['course_duration'];
	$course_score      =$_POST['course_score'];
	$course_note       =$_POST['course_note'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($course_id)||empty($course_name)||empty($course_unit)||empty($course_hour)||empty($course_duration)||empty($course_score))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    
        // แก้ไขข้อมูลหลักสูตร
        $sql= "update course set
				course_name     = '$course_name',
				course_unit		= '$course_unit',
				course_hour     = '$course_hour',
				course_duration = '$course_duration',
                course_score = '$course_score',
				course_note     = '$course_note'
				where course_id	= '$course_id'";
		mysql_query($sql) or die("error=$sql");
		echo "<script>window.location='course.php';</script>";//alert(' ++ Complete ++ ');
?>
