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
            <h1>ข้อมูลการอบรม</h1>
            <div role="main" class="ui-content">
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
                            <td>
                                <?      
                                    $course_id  =$row["course_id"];
                                    $sql		= "select * from course where course_id='$course_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $row2		= mysql_fetch_array($query);
                                ?>
                                <?=$row2['course_name']?>
                                <? $unit    =   $row2['course_unit']?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ชื่อผู้ให้การอบรม</th>
                            <td>
                            <?      
                                $trainer_id     =$row['trainer_id'];
                                $sql            = "select * from trainer where trainer_id='$trainer_id'";
                                $query          = mysql_query($sql) or die("error=$sql");
                                $row3           = mysql_fetch_array($query);
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
                        </tr>
                        <?php 
                        for ($x = 1; $x <= $unit; $x++)
                        {
                        ?>
                        <tr>
                            <th></th>
                            <td>
                                <a href="training_score_add.php?course_detail_id=<?=$row['course_detail_id']?>&training_unit=<?=$x?>" class="ui-btn ui-corner-all ui-btn-b" data-ajax="false">ให้คะแนนการอบรมสัปดาห์ที่ <?=$x?></a>

                            </td>
                            <td></td>
                        </tr>
                        <?
                        } 
                        ?>
                    </tbody>  
                </table>
                
            </div>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>