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
	$dtype_id   =$_POST['dtype_id'];
    $damount    =$_POST['amount'];
    $note       =$_POST['note'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
    echo $dtype_id;

	if($dtype_id<=0)
    {
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
    }
//ตรวจสอบเบอร์โทร เอาเฉพาะตัวเลข
    if (!is_numeric($damount) )
    {
        echo "<script>alert('โปรดตรวจสอบจำนวนเงิน!!!');history.back();</script>";
        exit();
    }
    elseif(empty($dtype_id)||empty($damount))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    else
	{
        // 
        $date   =   date('Y-m-d H:i:s');//"2015-07-18 19:12:27";//date('Y-m-d H:i:s');
        $week   =   date('Wo');//"292015";//date('Wo');
		$sql= "insert into donation values('','$week','$date','$dtype_id','$damount','$note')";
		mysql_query($sql) or die("error=$sql");
        // บรรทึกเข้า balance
		//$sql= "insert into balance values('','$date','','$damount','','$dtype_id')";
		//mysql_query($sql) or die("error=$sql");
		echo "<script>window.location='donation.php';</script>";//alert(' ++ Complete ++ ');
	}
?>
