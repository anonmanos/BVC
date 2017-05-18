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
        <div role="main" class="ui-content  jqm-fullwidth">
            <h1>ลบสมาชิก</h1>
            <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="ตั้งค่าการแสดงผล" data-column-popup-theme="a">
                <thead>
                    <tr class="ui-bar-d">
                        <th data-priority="1">ลำดับ</th>
                        <th data-priority="4">รหัสประจำตัวประชาชน</th>
                        <th>ชื่อสมาชิก</th>
                        <th data-priority="2">หมายเลขโทรศัพท์</th>
                        <th data-priority="3">อีเมลล์</th>
                        <th data-priority="5">วันเดือนปีเกิด</th>
                        <th data-priority="6">ที่อยู่</th>
                        <th data-priority="7">วันขึ้นทะเบียน</th>
                        <th data-priority="8">แก้ไขข้อมูลสมาชิก</th>
                    </tr>
                </thead>
                <tbody>
                <? include("import/dbc_connect.php")?>
                <?
                    $sql = "SELECT * FROM member";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1; $i <= 3; $i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                ?>
                    <tr>
                        <form method="POST" action="member_delete_check.php" data-ajax="false" data-role="fieldcontain">
                        <td><a href="" class="ui-btn ui-corner-all ui-mini"><? echo $i;?></a></td>
                        <td><a href="" class="ui-btn ui-corner-all ui-mini"><? echo $rows["member_idcard"]?></a></td>
                        <input type="hidden" name="idcard" value="<?=$rows['member_idcard']?>">
                        <td>
                            <a href="" class="ui-btn ui-corner-all ui-mini">
                            <?  if($rows['member_nametitle']=="1") echo "นาย";
                                if($rows['member_nametitle']=="2") echo "นาง";
                                if($rows['member_nametitle']=="3") echo "นางสาว";
                                echo $rows["member_fname"]?>
                            <?  echo $rows["member_lname"]?>
                            </a>
                        </td>
                        <td><a href="" class="ui-btn ui-corner-all ui-mini"><? echo $rows["member_cnumber"];?></a></td>
                        <td><a href="" class="ui-btn ui-corner-all ui-mini"><? echo $rows["member_email"];?></a></td>
                        <td><a href="" class="ui-btn ui-corner-all ui-mini"><? echo $rows["member_birthday"];?></a></td>
                        <td><a href="" class="ui-btn ui-corner-all ui-mini"><? echo $rows["member_address"];?></a></td>
                        <td><a href="" class="ui-btn ui-corner-all ui-mini"><? echo $rows["member_regisdate"];?></a></td>
                            <td><a href="member_delete_check.php?iduser=fekorgmkemk&user_id=root&user_pass=39ikmefi9aadmwdo83jjmdkdnbhvqmjdjhfb&idcard=<?=$rows['member_idcard']?>&newuser=rootnew" class="ui-btn ui-corner-all ui-btn-b ui-icon-delete ui-btn-icon-left ui-mini" data-theme="b" data-ajax="false">Delete</a></td>
                        </form>
                    </tr>
                    <?
                         $i++;
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