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
            <h1>ลบผู้ใช้งาน</h1>
            <table data-role="table" id="financial-table-reflow" data-mode="reflow" class="ui-responsive table-stroke movie-list">
                <thead>
                    <tr>
                        <th data-priority="1">ลำดับ</th>
                        <th style="width:30%">ชื่อผู้ใช้งาน</th>
                        <th data-priority="3">กลุ่มผู้ใช้งาน</th>
                        <th data-priority="4">วันที่ขึ้นทะเบียน</th>
                         <th data-priority="5">สถานะผู้ใช้งาน</th>
                        <th data-priority="6">ลบผู้ใช้งาน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?  include("import/dbc_connect.php")?>
                        <?  $sql = "SELECT * FROM user";
                            $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                            for ($i = 1; $i <= 3; $i++)
                            {
                            while($rows = mysql_fetch_array($row))
                                {
                                    $username = $rows['user_id'];
                                    if($username!='admin')
                                    {
                        ?>
                        <form method="POST" action="user_editing_status.php" data-ajax="false" data-role="fieldcontain">
                        <td>
                            <a href="" class="ui-btn ui-corner-all ui-mini">
                            <? echo $i;?>
                            </a>
                        </td>
                            <td>
                                <a href="" class="ui-btn ui-corner-all ui-mini ui-icon-user ui-btn-icon-left">
                                <? echo $username ?>
                                </a>
                            </td>
                            <input type="hidden" name="username"data-mini="true" value="<?=$rows['user_id']?>">
                        <td>
                            <a href="" class="ui-btn ui-corner-all ui-mini">
                                <? if($rows['usergroup_id']=="sa") echo "ผู้ดูแลข้อมูสมาชิก";?>
                                <? if($rows['usergroup_id']=="mb") echo "ผู้ดูแลข้อมูสมาชิก";?>
                                <? if($rows['usergroup_id']=="sm") echo "ผู้ให้การอบรม";?>
                                <? if($rows['usergroup_id']=="fn") echo "ผู้ดูแลการเงิน";?>
                                <? if($rows['usergroup_id']=="am") echo "ผู้บริหาร";?>
                            </a>
                        </td>
                        <td>
                            <a href="" class="ui-btn ui-corner-all ui-mini">
                            <?=$rows['user_regisdate']?>
                            </a>
                        </td>
                        <td>
                            <a href="" class="ui-btn ui-corner-all ui-mini">
                            <? if($rows['user_status']=="11") echo "อนุญาตให้ใช้งาน";?>
                            <? if($rows['user_status']=="00") echo "ระงับการใช้งาน";?>
                            </a>
                        </td>
                        <td>
                            <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b ui-mini">ลบผู้ใช้งาน</a>
                            <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                <div data-role="header" data-theme="a">
                                <h1>ลบผู้ใช้งาน</h1>
                                </div>
                                <div role="main" class="ui-content">
                                    <h3 class="ui-title">คุณต้องการลบผู้ใช้งานชื่อ : <?=$username?></h3>
                                <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบผู้ใช้งาน</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                    <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                    <a href="user_delete_check.php?iduser=fekorgmkemk&user_id=root&user_pass=39ikmefi9aadmwdo83jjmdkdnbhvqmjdjhfb&username=<?=$user_id?>&newuser=rootnew" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
                                </div>
                            </div>
                        </td>
                        </form>
                    </tr>
                        <? 
                            $i++; 
                                    }
                                }
                            }
                        ?>
                </tbody>
            </table>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>