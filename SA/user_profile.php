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
            <div role="main" class="ui-content">
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
                          <th>ชื่อผู้ใช้งาน</th>
                          <td><? echo $user_id = $_SESSION['user_id']?></td>
                          <td></td>
                        </tr>
                        <?  include("import/dbc_connect.php");
                            $sql		= "select * from user where user_id='$user_id'";
                            $query		= mysql_query($sql) or die("error=$sql");
                            $row		= mysql_fetch_array($query);
                        ?> 
                        <tr>
                          <th>กลุ่มผู้ใช้งาน</th>
                            <td >
                                <? if($row['usergroup_id']=="sa") echo "ผู้ดูแลระบบ";?>
                                <? if($row['usergroup_id']=="mb") echo "ผู้ดูแลข้อมูสมาชิก";?>
                                <? if($row['usergroup_id']=="sm") echo "ผู้จัดการการอบรม";?>
                                <? if($row['usergroup_id']=="fn") echo "ผู้ดูแลการเงิน";?>
                                <? if($row['usergroup_id']=="am") echo "ผู้บริหาร";?>
                            </td>
                          <td></td>
                        </tr>
                        <tr>
                          <th>วันขึ้นทะเบียน</th>
                          <td ><?=$row['user_regisdate']?></td>
                          <td></td>
                        </tr>
                        <?
                            $user_id	= $row['user_id'];
                            $sql		= "select * from userpro where user_id='$user_id'";
                            $query		= mysql_query($sql) or die("error=$sql");
                            $row		= mysql_fetch_array($query);
                        ?> 
                        <tr>
                          <th>ชื่อ-นามสกุล</th>
                          <td >
                              <? if($row['user_nametitle']=="1") echo "นาย";?>
                              <? if($row['user_nametitle']=="2") echo "นาง";?>
                              <? if($row['user_nametitle']=="3") echo "นางสาว";?>
                              <?=$row['user_fname']?>   
                              <?=$row['user_lname']?>
                          <td></td>
                        </tr>
                        <tr>
                          <th>เบอร์โทรศัพท์</th>
                          <td ><?=$row['user_cnumber']?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <th>อีเมลล์</th>
                          <td ><?=$row['user_email']?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <th>วันเดือนปีเกิด</th>
                          <td ><?=$row['user_birthday']?></td>
                          <td></td>
                        </tr>
                        <tr>
                          <th>ที่อยู่</th>
                          <td ><?=$row['user_address']?></td>
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