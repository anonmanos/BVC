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
    $etype_id   =$_POST['etype_id'];
    $eamount     =$_POST['amount'];
    $note       =$_POST['note'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
    echo $etype_id;
	if($etype_id<=0)
    {
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
    }
//ตรวจสอบเบอร์โทร เอาเฉพาะตัวเลข
    if (!is_numeric($eamount))
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
        // เพิ่มข้อมูลหลักสูตร
        $date   =   date('Y-m-d H:i:s');
        $sql= "update expenses set
				expenses_date  = '$date',
                etype_id       = '$etype_id',
                expenses_amount  = '$eamount',
                expenses_note  = '$note'
				where expenses_id	= '$edit_id'";
		mysql_query($sql) or die("error=$sql");
        // บรรทึกเข้า balance
        //$sql= "update balance set
				//date                = '$date',
                //etype_id            = '$etype_id',
                //expenses_amount     = '$eamount'
				//where balance_id	= '$edit_id'";
		//mysql_query($sql) or die("error=$sql");
        echo "<script>window.location='expenses.php';</script>";//alert(' ++ Complete ++ ');
    }
?>