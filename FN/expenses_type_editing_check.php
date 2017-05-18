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
    $etype_id          =$_POST['etype_id'];
	$expenses_name     =$_POST['expenses_name'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($expenses_name)||empty($etype_id))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    
	// select ข้อมูล username ว่าเคยมีการใช้งานไปแล้วหรือไม่
	$sqlC	= "select * from expensestype where expenses_type='$expenses_name'";
	$queryC	= mysql_query($sqlC) or die("error=$sqlC");
	$numC	= mysql_num_rows($queryC);
	// ถ้า username มีการใช้งนไปแล้ว จะให้แจ้งเตือนเพื่อให้เปลี่ยน username ที่ต้องการใช้
	if($numC != 0)
	{
		echo "<script>alert('มีรายการประเภทเงินประเภทค่าใช้จ่ายแล้ว!!!');history.back();</script>";
		exit();
	}else
	{
        // เพิ่มข้อมูลหลักสูตร
		$sql= "update expensestype set
				expenses_type  = '$expenses_name'
				where etype_id	= '$etype_id'";
		mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='expenses_type.php';</script>";//alert(' ++ Complete ++ ');
	}
?>
