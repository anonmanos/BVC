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
            <h1>ข้อมูลผู้ให้การอบรม</h1>
            <div role="main" class="ui-content">
                <form method="POST" action="trainer_editing.php" data-ajax="false" data-role="fieldcontain">
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
                                $trainer_id =$_GET['trainer_id'];
                                $sql		= "select * from trainer where trainer_id='$trainer_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                            ?> 
                            <tr>
                              <th>รหัสผู้ให้การอบรม</th>
                                <td >
                                    <?=$row['trainer_id']?>
                                    <input type="hidden" name="trainer_id" value="<?=$row['trainer_id']?>">
                                </td>
                              <td></td>
                            </tr>
                            <tr>
                                <th>ชื่อผู้ให้การอบรม</th>
                                <td>
                                <?  if($row['trainer_nametitle']=="1")echo "นาย";?>
                                <?  if($row['trainer_nametitle']=="2")echo "นาง";?>
                                <?  if($row['trainer_nametitle']=="3")echo "นางสาว";?>
                                <?  echo $row["trainer_fname"];?>
                                <?  echo $row["trainer_lname"];?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                              <th>เบอร์โทรศัพท์</th>
                              <td ><?=$row['trainer_cnumber']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>อีเมลล์</th>
                              <td ><?=$row['trainer_email']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>วันเดือนปีเกิด</th>
                              <td ><?=$row['trainer_birthday']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ที่อยู่</th>
                              <td ><?=$row['trainer_address']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th></th>
                              <td ><button type="submit" name="submit" class="ui-btn ui-corner-all ui-btn-b ui-icon-edit ui-btn-icon-left" data-iconpos="notext" data-ajax="false">แก้ไขข้อมูลผู้ให้การอบรม</button></td>
                              <td>
                                  <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">ลบผู้ให้การอบรม</a>
                                    <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                        <div data-role="header" data-theme="a">
                                        <h1>ลบผู้ให้การอบรม</h1>
                                        </div>
                                        <div role="main" class="ui-content">
                                            <h3 class="ui-title">คุณต้องการลบผู้ให้การอบรมชื่อ : <?  if($row['trainer_nametitle']=="1")echo "นาย";?>
                                                                    <?  if($row['trainer_nametitle']=="2")echo "นาง";?>
                                                                    <?  if($row['trainer_nametitle']=="3")echo "นางสาว";?>
                                                                    <?  echo $row["trainer_fname"];?>
                                                                    <?  echo $row["trainer_lname"];?> | <?=$row['trainer_id']?></h3>
                                        <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบผู้ให้การอบรม</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                            <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                            <a href="trainer_delete_check.php?iduser=fekorgmkemk&user_id=root&user_pass=39ikmefi9aadmwdo83jjmdkdnbhvqmjdjhfb&trainer_id=<?=$row['trainer_id']?>&newuser=rootnew" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
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