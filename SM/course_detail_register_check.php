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
	$course_id   =$_POST['course_id'];
    $trainer_id  =$_POST['trainer_id'];
	$start_date	 =$_POST['start_date'];
	$end_date    =$_POST['end_date'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($course_id)||empty($trainer_id)||empty($start_date)||empty($end_date))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    
    $sql = "SELECT * FROM course where course_id = '$course_id'";
    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
    while($rows = mysql_fetch_array($row))
    {
        $cdww   = $rows["course_duration"];
    }
    
    // ข้อมูล
    list($sm,$sd,$sy) = split("/",$start_date);
    $start	= "$sy-$sm-$sd";
    $smo    = $sm+$cdww;
    if($smo>'12')
    {
        $ssy=$sy+'1';
        $ssm=$smo-'12';
        $starto	= "$ssy-$ssm-$sd";
    }else
    {
        $starto	= "$sy-$smo-$sd";
    }
    list($em,$ed,$ey) = split("/",$end_date);
    $end	= "$ey-$em-$ed";
    
	$startt    = date("oW", strtotime("$starto"));
	$endd      = date("oW", strtotime("$end"));
    
    if($startt>$endd)
    {
        echo "<script>alert('กรุณาตรวจสอบวันที่การอบรม');history.back();</script>";
		exit();
    }

    $ssy    = substr($sy, 2, 4);
    $cdi =  "$course_id"."$sm"."$ssy";//รหัสรายละเอียดการอบรม
	$sqlC	= "select * from coursedetail where course_detail_id='$cdi'";
	$queryC	= mysql_query($sqlC) or die("error=$sqlC");
	$numC	= mysql_num_rows($queryC);
	// ถ้า username มีการใช้งนไปแล้ว จะให้แจ้งเตือนเพื่อให้เปลี่ยน username ที่ต้องการใช้
	if($numC != 0)
	{
		echo "<script>alert('รหัสรายละเอียดการอบรมซ้ำ! กรุณาเปลี่ยนช่วงเวลาการอบรมใหม่!!');history.back();</script>";
		exit();
	}else
	{
		$sql= "insert into coursedetail values('$cdi','$course_id','$trainer_id'
		,'$start','$end','')";
		mysql_query($sql) or die("error=$sql");
		echo "<script>window.location='course_detail.php';</script>";//alert(' ++ Complete ++ ');
	}
?>
