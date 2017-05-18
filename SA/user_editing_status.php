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
        <h1>แก้ไขผู้ใช้</h1>
            <form method="post" action="user_editing_status_check.php" data-ajax="false" data-role="fieldcontain">
                <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                    <thead>
                        <tr>
                            <th style="width:25%"></th>
                            <th data-priority="1"></th>
                            <th style="width:25%"></th>
                        </tr>
                    </thead>
                    <?  include("import/dbc_connect.php")?>
                    <?
                        $user_id	=$_POST['username'];
                        $sql		= "select * from user where user_id='$user_id'";
                        $query		= mysql_query($sql) or die("error=$sql");
                        $row		= mysql_fetch_array($query);
                    ?>
                    <tbody>
                        <tr>
                            <th>ชื่อผู้ใช้งาน</th>
                            <td>
                                <label for="un" class="ui-hidden-accessible">Username:</label>
                                <input type="text" name="username" id="un" class="ui-state-disabled" value="<?=$row['user_id']?>" placeholder="ชื่อผู้ใช้งาน" data-theme="a"></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>กลุ่มผู้ใช้งาน</th>
                            <td>
                                <select name="usergroup" id="" data-native-menu="false">
                                    <option>กรุณาเลือกกลุ่มผู้ใช้งาน</option>
                                    <option value="sa"<? if($row['usergroup_id']=="sa")echo 'selected="selected"'; ?>>ผู้ดูแลระบบ</option>
                                    <option value="mb"<? if($row['usergroup_id']=="mb")echo 'selected="selected"'; ?>>ผู้ดูแลข้อมูลสมาชิก</option>
                                    <option value="sm"<? if($row['usergroup_id']=="sm")echo 'selected="selected"'; ?>>ผู้จัดการการอบรม</option>
                                    <option value="fn"<? if($row['usergroup_id']=="fn")echo 'selected="selected"'; ?>>ผู้ดูแลการเงิน</option>
                                    <option value="am"<? if($row['usergroup_id']=="am")echo 'selected="selected"'; ?>>ผู้บริหาร</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>สถานนะผู้ใช้งาน</th>
                            <td>
                                <select name="userstatus" id="" data-native-menu="false">
                                    <option>กรุณาเลือกสถานะของผู้ใช้งาน</option>
                                    <option value="11"<? if($row['user_status']=="11")echo 'selected="selected"'; ?>>อนุญาตให้ใช้งาน</option>
                                    <option value="00"<? if($row['user_status']=="00")echo 'selected="selected"'; ?>>ระงับการใช้งาน</option>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>
                            </th>
                            <td>
                                <input type="submit" data-icon="check" value="ยืนยันการแก้ไข" name="submit" data-theme="a" data-ajax="false">
                            </td>
                            <td>
                                <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">ลบผู้ใช้งาน</a>
                                <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                    <div data-role="header" data-theme="a">
                                    <h1>ลบผู้ใช้งาน</h1>
                                    </div>
                                    <div role="main" class="ui-content">
                                        <h3 class="ui-title">คุณต้องการลบผู้ใช้งานชื่อ : <?=$user_id?></h3>
                                    <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบผู้ใช้งาน</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                        <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                        <a href="user_delete_check.php?iduser=fekorgmkemk&user_id=root&user_pass=39ikmefi9aadmwdo83jjmdkdnbhvqmjdjhfb&username=<?=$user_id?>&newuser=rootnew" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>  
                </table>
            </form>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>