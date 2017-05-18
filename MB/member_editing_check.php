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
	$member_idcard     =$_POST['idcard'];
	$member_nametitle  =$_POST['titlename'];
	$member_fname      =$_POST['fname'];
	$member_lname      =$_POST['lname'];
	$member_cnumber    =$_POST['tel'];
	$member_email      =$_POST['email'];
	$day               =$_POST['day'];
	$month             =$_POST['month'];
	$year              =$_POST['year'];
	$member_address    =$_POST['address'];

	// ตรวจสอบการกรอกข้อมูลที่ไม่ควรให้มีการเว้นว่าง
	if(empty($member_idcard)||
       empty($member_nametitle)||
       empty($member_fname)||
       empty($member_lname)||
       empty($member_cnumber)||
       empty($member_email)||
       empty($day)||
       empty($month)||
       empty($year)||
       empty($member_address))
	{
		echo "<script>alert('กรุณากรอกข้อมูลให้ครบครับ !!!');history.back();</script>";
		exit();
	}
    //ตรวจสอบเบอร์โทร เอาเฉพาะตัวเลข
    if (!is_numeric($member_cnumber) )
    {
        echo "<script>alert('โปรตรวจสอบเบอร์โทรศัทพ์!!!');history.back();</script>";
        exit();
    }
//ตรวจสอบอีเมลล์
    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $member_email)){
        echo "<script>alert('โปรตรวจสอบ Email!!!!');history.back();</script>";
        exit();
    }
//ตรวจสอบวันเกิด
    if(!checkdate($month,$day,$year))
	{
		echo "<script>alert('Please check Birthday!!!');history.back();</script>";
		exit();
    }else
    {
        $birthday	= "$year-$month-$day";// วันเดือนปีเกิด
		$sql= "update member set
				member_nametitle    = '$member_nametitle',
                member_fname        = '$member_fname',
				member_lname        = '$member_lname',
                member_cnumber      = '$member_cnumber',
				member_email        = '$member_email',
                member_birthday     = '$birthday',
				member_address      = '$member_address'
				where member_idcard = '$member_idcard'";
		mysql_query($sql) or die("error=$sql");
    }
    echo "<script>window.location='member_list.php';</script>";//alert(' ++ Complete ++ ');
?>