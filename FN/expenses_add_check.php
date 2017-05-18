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
	$etype_id   =$_POST['etype_id'];
    $eamount     =$_POST['amount'];
    $note       =$_POST['note'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง

	if($etype_id<=0)
    {
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
    }
//ตรวจสอบเบอร์โทร เอาเฉพาะตัวเลข
    if (!is_numeric($eamount) )
    {
        echo "<script>alert('โปรดตรวจสอบจำนวนเงิน!!!');history.back();</script>";
        exit();
    }
    elseif(empty($etype_id)||empty($eamount))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    else
	{
        // 
        $date   =   date('Y-m-d H:i:s');//"2015-07-18 19:12:27";//date('Y-m-d H:i:s');
        $week   =   date('Wo');//"292015";//date('Wo');
		$sql= "insert into expenses values('','$week','$date','$etype_id','$eamount','$note')";
		mysql_query($sql) or die("error=$sql");
        // บรรทึกเข้า balance
		//$sql= "insert into balance values('','$date','$eamount','','$etype_id','')";
		//mysql_query($sql) or die("error=$sql");
		echo "<script>window.location='expenses.php';</script>";//alert(' ++ Complete ++ ');
	}
?>
