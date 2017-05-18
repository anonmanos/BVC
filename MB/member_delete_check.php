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
	$idcard	 =$_GET['idcard'];

    if($idcard!='1509900987075')
    { 
		$sql= "DELETE FROM `member` WHERE member_idcard='$idcard'";
		$result=mysql_query($sql);
        if ($result)
        {
        echo "<script>window.location='member_list.php';</script>";//alert(' ++ Complete ++ ');
        }
    }
?>