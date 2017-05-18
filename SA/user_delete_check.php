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
	$username	 =$_GET['username'];

    if($username!='admin')
    { 
		$sql= "DELETE FROM `user` WHERE user_id='$username'";
		$result=mysql_query($sql);
        if ($result)
        {
        echo "<script>window.location='user_status.php';</script>";//alert(' ++ Complete ++ ');
        }
    }
?>