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
        <h1>เพิ่มการอบรม</h1>
            <div role="main" class="ui-content">
                <form method="post" action="course_detail_register_check.php" data-ajax="false" data-role="fieldcontain">
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
                            <th>หลักสูตร</th>
                            <td>
                                <select name="course_id" id="" data-native-menu="false">
                                    <option>กรุณาเลือกหลักสูตร</option>
                                    <? include("import/dbc_connect.php")?>
                                    <?
                                        $sql = "SELECT * FROM course";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                            while($rows = mysql_fetch_array($row))
                                            {
                                    ?>
                                    <option value="<? echo $rows["course_id"];?>"><? echo $rows["course_name"];?></option>
                                    <?
                                            }
                                    ?>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ผู้ให้การอบรม</th>
                            <td>
                                <select name="trainer_id" id="" data-native-menu="false">
                                    <option>กรุณาเลือกผู้ให้การอบรม</option>
                                    <? include("import/dbc_connect.php")?>
                                    <?
                                        $sql = "SELECT * FROM trainer";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                            while($rows = mysql_fetch_array($row))
                                            {
                                    ?>
                                    <option value="<? echo $rows["trainer_id"];?>">
                                        <?  if($rows['trainer_nametitle']=="1")echo "นาย";?>
                                        <?  if($rows['trainer_nametitle']=="2")echo "นาง";?>
                                        <?  if($rows['trainer_nametitle']=="3")echo "นางสาว";?>
                                        <?  echo $rows["trainer_fname"];?>
                                        <?  echo $rows["trainer_lname"];?>
                                    </option>
                                    <?
                                            }
                                    ?>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>วันที่เริ่มการอบรม</th>
                            <td>
                                <input type="text" data-role="date" name="start_date" value="" placeholder="วันที่เริ่มการอบรม">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>วันที่จบการอบรม</th>
                            <td>
                                <input type="text" data-role="date" name="end_date" value="" placeholder="วันที่จบการอบรม">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" name="submit" class="ui-btn ui-corner-all ui-btn-b">ยืนยันการเพิ่มรายละเอียดการอบรม</button>
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