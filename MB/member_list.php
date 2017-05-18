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
        <div role="main" class="ui-content">
            <h1>รายชื่อสมาชิก</h1>
            <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="ตั้งค่าการแสดงผล" data-column-popup-theme="a">
                <thead>
                    <tr class="ui-bar-d">
                        <th data-priority="1">ลำดับ</th>
                        <th data-priority="4">รหัสประจำตัวประชาชน</th>
                        <th>ชื่อสมาชิก</th>
                        <th data-priority="2">หมายเลขโทรศัพท์</th>
                        <th data-priority="3">อีเมลล์</th>
                        <th data-priority="5">วันเดือนปีเกิด</th>
                        <!--<th data-priority="6">ที่อยู่</th>-->
                        <th data-priority="6" >วันขึ้นทะเบียน</th>
                    </tr>
                </thead>
                <tbody>
                <? include("import/dbc_connect.php")?>
                <?
                    $sql = "SELECT * FROM member";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1;$i<=1;$i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                ?>
                    <tr>
                        <td><? echo $i;?></td>
                        <td>
                            <a href="member_profile.php?idcard=<?=$rows['member_idcard']?>" data-ajax="false">
                            <? echo $rows["member_idcard"];?>
                            </a>
                        </td>
                        <td>
                            <a href="member_profile.php?idcard=<?=$rows['member_idcard']?>" data-ajax="false">
                            <?  if($rows['member_nametitle']=="1") echo "นาย";
                                if($rows['member_nametitle']=="2") echo "นาง";
                                if($rows['member_nametitle']=="3") echo "นางสาว";
                                echo $rows["member_fname"]?>
                            <?  echo $rows["member_lname"]?>
                            </a>
                        </td>
                        <td><? echo $rows["member_cnumber"];?></td>
                        <td><? echo $rows["member_email"];?></td>
                        <td><? echo $rows["member_birthday"];?></td>
                        <!--<td><? //echo $rows["member_address"];?></td>-->
                        <td><? echo $rows["member_regisdate"];?></td>
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