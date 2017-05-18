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
	$course_detail_id	 =$_GET['course_detail_id'];
    $member_idcard       =$_GET['member_idcard'];

    if($idcard!='1509900987075')
    { 
		$sql= "DELETE FROM `courseregis` WHERE course_detail_id='$course_detail_id' AND member_idcard='$member_idcard'";
		$result=mysql_query($sql);
        if ($result)
        {
        echo "<script>window.location='course_register_list_deleting.php?course_detail_id=$course_detail_id';</script>";//alert(' ++ Complete ++ ');
        }
    }
?>
