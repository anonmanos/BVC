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
            <h1>ข้อมูลผู้ใช้งาน</h1>
            <table data-role="table" id="table-custom-2" data-mode="columntoggle" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-btn-theme="b" data-column-btn-text="ตั้งค่าการแสดงผล" data-column-popup-theme="a">
                <thead>
                    <tr class="ui-bar-d">
                        <th data-priority="1">ลำดับ</th>
                        <th style="width:35%">ชื่อ-นามสกุล</th>
                        <th data-priority="2">เบอร์โทรศัพท์</th>
                        <th data-priority="3">อีเมลล์</th>
                        <th style="width:15%" data-priority="3">วันเกิด</th>
                        <th style="width:30%" data-priority="0" >ที่อยู่</th>
                    </tr>
                </thead>
                <tbody>
                <? include("import/dbc_connect.php")?>
                <?
                    $sql = "SELECT * FROM userpro";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1;$i<=1;$i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                ?>
                    <tr>
                        <td><? echo $i;?></td>
                        <th>
                            <?  if($rows['user_nametitle']=="1") echo "นาย";
                                if($rows['user_nametitle']=="2") echo "นาง";
                                if($rows['user_nametitle']=="3") echo "นางสาว";
                                echo $rows["user_fname"]?>
                            <?  echo $rows["user_lname"]?>
                        </th>
                        <td><? echo $rows["user_cnumber"];?></td>
                        <td><? echo $rows["user_email"];?></td>
                        <td><? echo $rows["user_birthday"];?></td>
                        <!--<td><? //echo $rows["user_address"];?></td>-->
                        <td><? echo $rows["user_address"];?></td>
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