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
	$course_detail_id	 =$_POST['course_detail_id'];
    $trainer_id	 =$_POST['trainer_id'];
    $start_date	 =$_POST['start_date'];
	$end_date    =$_POST['end_date'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($course_detail_id)||
       empty($trainer_id)||
       empty($start_date)||
       empty($end_date))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    list($sm,$sd,$sy) = split("/",$start_date);
    $start	= "$sy-$sm-$sd";
    list($em,$ed,$ey) = split("/",$end_date);
    $end	= "$ey-$em-$ed";
    
		$sql= "update coursedetail set
				trainer_id          = '$trainer_id',
				start_date          = '$start',
                end_date            = '$end'
				where course_detail_id  = '$course_detail_id'";
		mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='course_detail.php';</script>";//alert(' ++ Complete ++ ');
?>
