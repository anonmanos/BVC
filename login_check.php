<?
	session_start();
	include("import/dbc_connect.php");
	$username	= $_POST['name'];
	$password	= $_POST['password'];

    //$username = 'test';
    //$password = 'vk00mNap';
	$pass	= "9a".base64_encode($password)."b9".base64_encode($password)."81c=";
	$sql 	= "select * from user where user_id ='$username' and user_password='$pass' and user_status='11'";
	$query 	= mysql_query($sql) or die("error=$sql");
	$num	= mysql_num_rows($query);
    $row	= mysql_fetch_array($query);
	
	if($num==0)
	{
		echo "<script>alert(' !! ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง !!');/*history.back();*/window.location='login.php'</script>";
		exit();
	}else
	{
        $gp         = $row['usergroup_id'];
        $us         = $row['user_status']; 
        $m1         = 'sa';
        $m2         = 'mb';
        $m3         = 'sm';
        $m4         = 'fn';
        $m5         = 'am';
        if($m1==$gp&&$us=='11')
        {
            $_SESSION['user_id'] = $username;
            echo "<script>window.location='SA';</script>";
            exit();
        }
        elseif($m2==$gp&&$us=='11')
        {
            $_SESSION['user_id'] = $username;
            echo "<script>window.location='MB';</script>";
            exit();
        }
        elseif($m3==$gp&&$us=='11')
        {
            $_SESSION['user_id'] = $username;
            echo "<script>window.location='SM';</script>";
            exit();
        }
        elseif($m4==$gp&&$us=='11')
        {
            $_SESSION['user_id'] = $username;
            echo "<script>window.location='FN';</script>";
            exit();
        }
        elseif($m5==$gp&&$us=='11')
        {
            $_SESSION['user_id'] = $username;
            echo "<script>window.location='AM';</script>";
            exit();
        }
        else
        {
            echo "<script>alert(' !! Login Fail !!');/*history.back();*/window.location='login.php'</script>";
        }
	}
?>



