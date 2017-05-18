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
            <h1>รายละเอียดการอบรม</h1>
            <div role="main" class="ui-content">
                <form method="POST" action="course_detail_editing.php" data-ajax="false" data-role="fieldcontain">
                    <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                        <thead>
                            <tr>
                                <th style="width:25%"></th>
                                <th data-priority="50"></th>
                                <th style="width:25%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?  include("import/dbc_connect.php");
                                $course_detail_id =$_GET['course_detail_id'];
                                $sql		= "select * from coursedetail where course_detail_id='$course_detail_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                                $start_date =$row['start_date'];
                                $end_date =$row['end_date'];
                            ?> 
                            <tr>
                              <th>รหัสการอบรม</th>
                                <td >
                                    <?=$row['course_detail_id']?>
                                    <input type="hidden" name="course_detail_id" value="<?=$row['course_detail_id']?>">
                                </td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>หลักสูตร</th>
                                <td >
                                    <?      
                                            $course_id  =$row["course_id"];
                                            $sql		= "select * from course where course_id='$course_id'";
                                            $query		= mysql_query($sql) or die("error=$sql");
                                            $row2		= mysql_fetch_array($query);
                                    ?>
                                    <?=$row2['course_name']?>
                                </td>
                              <td></td>
                            </tr>
                            <tr>
                                <th>ชื่อผู้ให้การอบรม</th>
                                <td>
                                    <?      
                                            $trainer_id  =$row['trainer_id'];
                                            $sql		= "select * from trainer where trainer_id='$trainer_id'";
                                            $query		= mysql_query($sql) or die("error=$sql");
                                            $row3		= mysql_fetch_array($query);
                                    ?>
                                <?  if($row3['trainer_nametitle']=="1")echo "นาย";?>
                                <?  if($row3['trainer_nametitle']=="2")echo "นาง";?>
                                <?  if($row3['trainer_nametitle']=="3")echo "นางสาว";?>
                                <?  echo $row3["trainer_fname"];?>
                                <?  echo $row3["trainer_lname"];?>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                            <th>วันที่เริ่มการอบรม</th>
                            <td>
                                <? echo $start_date; ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>วันที่จบการอบรม</th>
                            <td>
                                <? echo $end_date; ?>
                            </td>
                            <td></td>
                            <tr>
                                <td></td>    
                                <td><button type="submit" name="submit" class="ui-btn ui-corner-all ui-icon-edit ui-btn-icon-left" data-iconpos="notext" data-ajax="false">แก้ไข</button></td>
                                <td>
                                    <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">ลบรายละเอียดการอบรม</a>
                                    <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                        <div data-role="header" data-theme="a">
                                        <h1>ลบรายละเอียดการอบรม</h1>
                                        </div>
                                        <div role="main" class="ui-content">
                                            <h3 class="ui-title">คุณต้องการลบรายละเอียดการอบรม : <?=$row2['course_name']?> | <?=$row['course_detail_id']?></h3>
                                        <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบรายละเอียดการอบรม</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                            <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                            <a href="course_detail_delete_check.php?iduser=fekorgmkemk&user_id=root&user_pass=39ikmefi9aadmwdo83jjmdkdnbhvqmjdjhfb&course_detail_id=<?=$row['course_detail_id']?>&newuser=rootnew" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
                                        </div>
                                    </div>
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