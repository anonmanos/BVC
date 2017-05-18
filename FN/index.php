<?
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		echo "<script>alert('!! Please Login !! ');
				window.location='../index.php';</script>";
		exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<? include("import.php"); ?>
<body>
    <div data-role="page" class="jqm-demos" data-title="ฐานข้อมูลสำหรับคริสตจักรนิมิตบ้านโฮ่ง">
        <?  include("header.php"); ?>
        <div role="main" class="ui-content jqm-content jqm-fullwidth">
            <br><h1>Database System for BanHong Vision Church.</h1><br>
            <h1>ผู้ดูแลการเงิน</h1>
            <a href="donation.php" data-ajax="false"><img src="menu.images/fn1.png"></a>
            <a href="expenses.php" data-ajax="false"><img src="menu.images/fn2.png"></a>
            <a href="balance.php" data-ajax="false"><img src="menu.images/fn3.png"></a>
        </div><!-- /content -->
        <?  include("footer.php"); ?>
    </div><!-- /panel -->
</body>
</html>