<?
include("import/dbc_connect.php");
$sa     = $_SESSION['user_id'];
$sql 	= "select * from user where user_id ='$sa' and user_status='11'";
$query 	= mysql_query($sql) or die("error=$sql");
$num	= mysql_num_rows($query);
$row	= mysql_fetch_array($query);
if($num==0)
{
    echo "<script>alert(' !! ไม่มีผู้ใช้งาน !!');/*history.back();*/window.location='login.php'</script>";
    exit();
}
    $gp         = $row['usergroup_id'];//fn;
    $us         = $row['user_status']; //11;
    $m1         = 'sa';
    $m2         = 'mb';
    $m3         = 'sm';
    $m4         = 'fn';
    $m5         = 'am';
if($m1!=$gp||$us!='11')
{
    echo "<script>alert('!! คุณไม่สามารถใช้งานในกลุ่มนี้ได้ !! ');window.location='../index.php';</script>";
    exit();
}
?>
<!DOCTYPE html by Mr.Arnon Manosagoon>