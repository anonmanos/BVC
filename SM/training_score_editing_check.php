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
	$regis_id               =$_POST['course_register_id'];
    $training_unit          =$_POST['training_unit'];
    $training_score         =$_POST['training_score'];
    $course_detail_id       =$_POST['course_detail_id'];

// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($regis_id)||empty($training_unit)||empty($training_score))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');window.location='training_score_add.php?course_detail_id=$course_detail_id&training_unit=$training_unit'</script>";
		exit();
	}
//ตรวจสอบเบอร์โทร เอาเฉพาะตัวเลข
    if (!is_numeric($training_score) )
    {
        echo "<script>alert('กรุณากรอกเฉพาะตัวเลขเท่านั้น!!!');window.location='training_score_add.php?course_detail_id=$course_detail_id&training_unit=$training_unit';</script>";
        exit();
    }
//เช็คคะแนนเกิน
    $ci         = substr($course_detail_id, 0, 3);
    $course_id  = $ci;
    $sql		= "select * from course where course_id='$course_id'";
    $query		= mysql_query($sql) or die("error=$sql");
    $row2		= mysql_fetch_array($query);
    $cs         = $row2['course_score'];
    if($training_score>$cs)
    {
        echo "<script>alert('คะแนนเกินที่กำหนด!!!');window.location='training_score_add.php?course_detail_id=$course_detail_id&training_unit=$training_unit';</script>";
        exit();
    }
    $sqlC	= "select * from trainingscore where regis_id='$regis_id' AND training_unit='$training_unit'";
	$queryC	= mysql_query($sqlC) or die("error=$sqlC");
	$numC	= mysql_num_rows($queryC);
	// ถ้า username มีการใช้งนไปแล้ว จะให้แจ้งเตือนเพื่อให้เปลี่ยน username ที่ต้องการใช้
	if($numC != 1)
	{
		echo "<script>alert('ไม่สามารถแก้ไขได้ เนื่องจากยังไม่มีคะแนน!!!');window.location='training_score_add.php?course_detail_id=$course_detail_id&training_unit=$training_unit'</script>";
		exit();
	}else
	{
        // ข้อมูล member
        $date = date("Y-m-d H:i:s");//วันที่ลงทะเบียน
        $sql= "update trainingscore set
				training_score	= '$training_score'
				where regis_id='$regis_id' AND training_unit='$training_unit'";
		mysql_query($sql) or die("error=$sql");
		echo "<script>window.location='training_score_add.php?course_detail_id=$course_detail_id&training_unit=$training_unit';</script>";//alert(' ++ Complete ++ ');
	}
?>
