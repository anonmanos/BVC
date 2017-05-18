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
            <h1>ข้อมูลหลักสูตรการอบรม</h1>
            <div role="main" class="ui-content">
                <form method="POST" action="course_editing.php" data-ajax="false" data-role="fieldcontain">
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
                                $course_id  =$_GET['course_id'];
                                $sql		= "select * from course where course_id='$course_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                            ?> 
                            <tr>
                              <th>รหัสหลักสูตร</th>
                                <td >
                                    <?=$row['course_id']?>
                                    <input type="hidden" name="course_id" value="<?=$row['course_id']?>">
                                </td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ชื่อหลักสูตร</th>
                              <td >
                                  <?=$row['course_name']?>
                              <td></td>
                            </tr>
                            <tr>
                              <th>จำนวนบทเรียน</th>
                              <td ><?=$row['course_unit']?> บท</td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>จำนวนชั่วโมงเรียน</th>
                              <td ><?=$row['course_hour']?> ชั่วโมง</td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ระยะเวลาที่เรียน</th>
                              <td ><?=$row['course_duration']?> สัปดาห์</td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>คะแนน</th>
                              <td ><?=$row['course_score']?> คะแนน/ครั้ง</td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>หมายเหตุ</th>
                              <td ><?=$row['course_note']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th></th>
                              <td ><button type="submit" name="submit" class="ui-btn ui-corner-all ui-icon-edit ui-btn-icon-left" data-iconpos="notext" data-ajax="false">แก้ไขหลักสูตร</button></td>
                              <td>
                                  <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">ลบหลักสูตร</a>
                                    <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                        <div data-role="header" data-theme="a">
                                        <h1>ลบหลักสูตร</h1>
                                        </div>
                                        <div role="main" class="ui-content">
                                            <h3 class="ui-title">คุณต้องการลบหลักสูตรชื่อ : <?=$row['course_name']?> | <?=$row['course_id']?></h3>
                                        <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบผู้ใช้งาน</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                            <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                            <a href="course_delete_check.php?iduser=fekorgmkemk&user_id=root&user_pass=39ikmefi9aadmwdo83jjmdkdnbhvqmjdjhfb&course_id=<?=$row['course_id']?>&newuser=rootnew" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
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