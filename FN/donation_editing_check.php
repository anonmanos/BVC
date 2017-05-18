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
	$edit_id   =$_POST['edit_id'];
    $dtype_id   =$_POST['dtype_id'];
    $damount     =$_POST['amount'];
    $note       =$_POST['note'];


// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
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
        // เพิ่มข้อมูลหลักสูตร
        $date   =   date('Y-m-d H:i:s');
        $sql= "update donation set
				donation_date       = '$date',
                dtype_id            = '$dtype_id',
                donation_amount     = '$damount',
                donation_note       = '$note'
				where donation_id	= '$edit_id'";
		mysql_query($sql) or die("error=$sql");
        // บรรทึกเข้า balance
        //$sql= "update balance set
		//		date                = '$date',
        //      dtype_id            = '$dtype_id',
        //      donation_amount     = '$damount'
        //      where balance_id	= '$edit_id'";
		//mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='donation.php';</script>";//alert(' ++ Complete ++ ');
    }
?>