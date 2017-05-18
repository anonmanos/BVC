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
	$delete	 =$_GET['trainer_id'];

    if($idcard!='1509900987075')
    { 
		$sql= "DELETE FROM `trainer` WHERE trainer_id='$delete'";
		$result=mysql_query($sql);
        if ($result)
        {
        echo "<script>window.location='trainer.php';</script>";//alert(' ++ Complete ++ ');
        }
    }
?>