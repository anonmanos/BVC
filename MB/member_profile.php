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
            <h1>ข้อมูลสมาชิก</h1>
            <div role="main" class="ui-content">
                <form method="POST" action="member_editing.php" data-ajax="false" data-role="fieldcontain">
                    <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                        <thead>
                            <tr>
                                <th style="width:25%"></th>
                                <th data-priority="1"></th>
                                <th style="width:25%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?  include("import/dbc_connect.php");
                                $idcard	 =$_GET['idcard'];
                                $sql		= "select * from member where member_idcard='$idcard'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                            ?> 
                            <tr>
                              <th>รหัสบัตรประจำตัวประชาชน</th>
                                <td >
                                    <?=$row['member_idcard']?>
                                    <input type="hidden" name="idcard" value="<?=$row['member_idcard']?>">
                                </td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ชื่อ-นามสกุล</th>
                              <td >
                                  <? if($row['member_nametitle']=="1") echo "นาย";?>
                                  <? if($row['member_nametitle']=="2") echo "นาง";?>
                                  <? if($row['member_nametitle']=="3") echo "นางสาว";?>
                                  <?=$row['member_fname']?>   
                                  <?=$row['member_lname']?>
                              <td></td>
                            </tr>
                            <tr>
                              <th>เบอร์โทรศัพท์</th>
                              <td ><?=$row['member_cnumber']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>อีเมลล์</th>
                              <td ><?=$row['member_email']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>วันเกิด</th>
                              <td ><?=$row['member_birthday']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ที่อยู่</th>
                              <td ><?=$row['member_address']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>วันที่ขึ้นทะเบียน</th>
                              <td ><?=$row['member_regisdate']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th></th>
                              <td ><button type="submit" name="submit" class="ui-btn ui-corner-all ui-icon-edit ui-btn-icon-left" data-iconpos="notext" data-ajax="false">แก้ไขข้อมูลสมาชิก</button></td>
                              <td>
                                    <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">ลบสมาชิก</a>
                                    <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                        <div data-role="header" data-theme="a">
                                        <h1>ลบสมาชิก</h1>
                                        </div>
                                        <div role="main" class="ui-content">
                                            <h3 class="ui-title">คุณต้องการลบสมาชิกชื่อ : <? if($row['member_nametitle']=="1") echo "นาย";?>
                                                                                      <? if($row['member_nametitle']=="2") echo "นาง";?>
                                                                                      <? if($row['member_nametitle']=="3") echo "นางสาว";?>
                                                                                      <?=$row['member_fname']?>   
                                                                                      <?=$row['member_lname']?></h3>
                                        <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบสมาชิก</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                            <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                            <a href="member_delete_check.php?iduser=fekorgmkemk&user_id=root&user_pass=39ikmefi9aadmwdo83jjmdkdnbhvqmjdjhfb&idcard=<?=$row['member_idcard']?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
                                        </div>
                                    </div>
                               </td>
                            </tr>
                        </tbody>  
                    </table>
                </form>
            </div>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>