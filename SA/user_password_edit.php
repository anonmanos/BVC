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
            <h1>แก้ไขรหัสผ่านผู้ใช้งาน</h1>
            <div role="main" class="ui-content">
                <form method="post" action="user_password_edit_check.php" data-ajax="false" data-role="fieldcontain">
                <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                    <thead>
                        <tr>
                            <th style="width:25%"></th>
                            <th data-priority="1"></th>
                            <th style="width:25%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>รหัสผ่านปัจจุบัน</th>
                            <td>
                              <label for="pw" class="ui-hidden-accessible">Current:</label>
                              <input type="password" name="current" id="pw" value="" placeholder="รหัสผ่านปัจจุบัน" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>รหัสผ่านใหม่</th>
                            <td >
                                <label for="pw" class="ui-hidden-accessible">New Password:</label>
                                <input type="password" name="newpassword" id="pw" value="" placeholder="รหัสผ่านใหม่" data-theme="a">
                                <label for="pw" class="ui-hidden-accessible">Re-type New Password:</label>
                                <input type="password" name="renewpassword" id="pw" value="" placeholder="ยืนยันรหัสผ่านใหม่" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        
                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" name="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b">ยืนยันการเปลี่ยนรหัสผ่าน</button>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>  
                </table>
            </div>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>