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
            <h1>สถานนะผู้ใช้งาน</h1>
            <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive">
                <thead>
                  <tr class="ui-bar-d">
                    <th data-priority="2">ลำดับ</th>
                    <th>ชื่อผู้ใช้งาน</th>
                    <th data-priority="3">กลุ่มผู้ใช้งาน</th>
                    <th data-priority="1">วันที่ขึ้นทะเบียน</th>
                    <th data-priority="5">สถานะผู้ใช้งาน</th>
                  </tr>
                </thead>
                <tbody>
                <? include("import/dbc_connect.php")?>
                <?
                    $sql = "SELECT * FROM user";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1; $i <= 20; $i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                            $username = $rows['user_id'];
                            if($username!='admin')
                            {
                ?>
                    <tr>
                        <td><? echo $i;?></td>
                        <th><? echo $rows["user_id"];?></th>
                        <? if($rows['usergroup_id']=="sa") echo "<td>ผู้ดูแลระบบ</td>";?>
                        <? if($rows['usergroup_id']=="mb") echo "<td>ผู้ดูแลข้อมูลมาชิก</td>";?>
                        <? if($rows['usergroup_id']=="sm") echo "<td>ผู้จัดการการอบรม</td>";?>
                        <? if($rows['usergroup_id']=="fn") echo "<td>ผู้ดูแลการเงิน</td>";?>
                        <? if($rows['usergroup_id']=="am") echo "<td>ผู้บริหาร</td>";?>
                        <td><?=$rows['user_regisdate']?></td>
                        <? if($rows['user_status']=="11") echo "<td>อนุญาตให้ใช้งาน</td>";?>
                        <? if($rows['user_status']=="00") echo "<td>ระงับการใช้งาน</td>";?>
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