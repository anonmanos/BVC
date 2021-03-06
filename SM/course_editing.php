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
        <h1>แก้ไขหลักสูตรการอบรม</h1>
            <div role="main" class="ui-content">
                <form method="post" action="course_editing_check.php" data-ajax="false" data-role="fieldcontain">
                <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                    <thead>
                        <tr>
                            <th style="width:25%"></th>
                            <th data-priority="1"></th>
                            <th style="width:25%"></th>
                        </tr>
                    </thead>
                    <?  include("import/dbc_connect.php");
                                $course_id  =$_POST['course_id'];
                                $sql		= "select * from course where course_id='$course_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                    ?>
                    <tbody>
                        <tr>
                            <th>รหัสหลักสูตร</th>
                            <td>
                                <label for="course_id" class="ui-hidden-accessible">Course No:</label>
                                <input type="text" name="course_id" id="course_id" class="ui-state-disabled" value="<?=$row['course_id']?>" placeholder="รหัสหลักสูตร" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ชื่อหลักสูตร</th>
                            <td>
                                <label for="course_name" class="ui-hidden-accessible">Course Name:</label>
                                <input type="text" name="course_name" id="course_name" value="<?=$row['course_name']?>" placeholder="ชื่อหลักสูตร" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>จำนวนบทเรียน</th>
                            <td>
                                <label for="course_unit" class="ui-hidden-accessible">Units:</label>
                                <input type="text" name="course_unit" id="course_unit" value="<?=$row['course_unit']?>" placeholder="จำนวนบทเรียน" data-theme="a">
                            </td>
                            <td>*บท</td>
                        </tr>
                        <tr>
                            <th>จำนวนชั่วโมงเรียน</th>
                            <td>
                                <label for="course_hour" class="ui-hidden-accessible">Hour:</label>
                                <input type="text" name="course_hour" id="course_hour" value="<?=$row['course_hour']?>" placeholder="จำนวนชั่วโมงเรียน" data-theme="a">
                            </td>
                            <td>*ชั่วโมง</td>
                        </tr>
                        <tr>
                            <th>ระยะเวลาเรียน</th>
                            <td>
                                <label for="course_duration" class="ui-hidden-accessible">Duration:</label>
                                <input type="text" name="course_duration" id="course_duration" value="<?=$row['course_duration']?>" placeholder="ระยะเวลาเรียน" data-theme="a">
                            </td>
                            <td>*สัปดาห์</td>
                        </tr>
                        <tr>
                            <th>คะแนน</th>
                            <td>
                                <label for="course_duration" class="ui-hidden-accessible">Score:</label>
                                <input type="text" name="course_score" id="course_score" value="<?=$row['course_score']?>" placeholder="คะแนน" data-theme="a">
                            </td>
                            <td>*ต่อครั้ง</td>
                        </tr>
                        <tr>
                            <th>หมายเหตุ</th>
                            <td>
                                <label for="course_note" class="ui-hidden-accessible">Note:</label>
                                <textarea cols="40" rows="8" name="course_note" id="course_note" placeholder="หมายเหตุ"><?=$row['course_note']?></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" name="submit" class="ui-btn ui-corner-all ui-btn-b">ยืนยันการแก้ไขหลักสูตร</button>
                            </td>
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