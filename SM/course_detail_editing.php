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
        <h1>แก้ไขรายละเอียดการอบรม</h1>
            <div role="main" class="ui-content">
                <form method="post" action="course_detail_editing_check.php" data-ajax="false" data-role="fieldcontain">
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
                            <th>รหัสหลักสูตร</th>
                            <td>
                                    <? include("import/dbc_connect.php")?>
                                    <?
                                        $course_detail_id =$_POST['course_detail_id'];
                                        $sql		= "select * from coursedetail where course_detail_id='$course_detail_id'";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        $row		= mysql_fetch_array($query);
                                    ?>
                                    <? echo $row["course_detail_id"];?>
                                    <input type="hidden" name="course_detail_id" value="<?=$course_detail_id?>">
                                    <? $t_id = $row["trainer_id"]?>
                                    <? $start_date = $row["start_date"]?>
                                    <? $end_date = $row["end_date"]?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>หลักสูตร</th>
                            <td>
                                    <?  $cdii	 =  $course_detail_id;
                                        $cdi     =  substr($cdii, 0, 3)?>
                                    <?
                                        $sql = "SELECT * FROM course where course_id='$cdi'";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                        $rows = mysql_fetch_array($row);
                                    ?>
                                    <? echo $rows['course_name']?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ผู้ให้การอบรม</th>
                            <td>
                                <!--<select name="trainer_id" id="" data-native-menu="false">แก้ให้สามารถเปลี่ยนผู้ให้การอบรม
                                    <option>กรุณาเลือกผู้ให้การอบรม</option>
                                    <?
                                        /*$sql = "SELECT * FROM trainer";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                            while($rows = mysql_fetch_array($row))
                                            {
                                    ?>
                                    <option value="<? echo $rows["trainer_id"];?>" <? if($rows['trainer_id']=="$t_id")echo 'selected="selected"';?>>
                                        <?  if($rows['trainer_nametitle']=="1")echo "นาย";?>
                                        <?  if($rows['trainer_nametitle']=="2")echo "นาง";?>
                                        <?  if($rows['trainer_nametitle']=="3")echo "นางสาว";?>
                                        <?  echo $rows["trainer_fname"];?>
                                        <?  echo $rows["trainer_lname"];?>
                                    </option>
                                    <?
                                            }*/
                                    ?>
                                </select>-->
                                <?      
                                            //$trainer_id  =$row['trainer_id'];
                                            $sql		= "select * from trainer where trainer_id='$t_id'";
                                            $query		= mysql_query($sql) or die("error=$sql");
                                            $row3		= mysql_fetch_array($query);
                                ?>
                                <?  if($row3['trainer_nametitle']=="1")echo "นาย";?>
                                <?  if($row3['trainer_nametitle']=="2")echo "นาง";?>
                                <?  if($row3['trainer_nametitle']=="3")echo "นางสาว";?>
                                <?  echo $row3["trainer_fname"];?>
                                <?  echo $row3["trainer_lname"];?>
                                <input type="hidden" name="trainer_id" value="<?=$t_id?>">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>วันที่เริ่มการอบรม</th>
                            <?
                            list($sy,$sm,$sd) = split("-",$start_date);
                            $start	= "$sm/$sd/$sy";
                            ?>
                            <td>
                                <input type="text" data-role="date" name="start_date" value="<?  echo $start?>" placeholder="วันที่เริ่มการอบรม">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>วันที่จบการอบรม</th>
                            <?
                            list($ey,$em,$ed) = split("-",$end_date);
                            $end	= "$em/$ed/$ey";
                            ?>
                            <td>
                                <input type="text" data-role="date" name="end_date" value="<?  echo $end?>" placeholder="วันที่จบการอบรม">
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