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
    $etype_id          =$_GET['add_id'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($etype_id))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
	else
    {
        // เพิ่มข้อมูลหลักสูตร
		$sql= "DELETE FROM `expensestype` WHERE etype_id= '$etype_id'";
		mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='expenses_type.php';</script>";//alert(' ++ Complete ++ ');
	}
?>
