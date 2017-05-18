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
        <h1>ลงทะเบียนการอบรม</h1>
            <div role="main" class="ui-content">
                <form method="post" action="course_register_detail_check.php" data-ajax="false" data-role="fieldcontain">
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
                            <?  $cdii	 =  $_GET['course_detail_id'];?>
                            <td><?=$cdii?></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>หลักสูตร</th>
                            <td>
                                <!--<select name="course_id" id="" data-native-menu="false">
                                    <option>กรุณาเลือกผู้ให้การอบรม</option>
                                    <?  /*include("import/dbc_connect.php")?>
                                    <?  $cdii	 =  $_GET['course_detail_id'];
                                        $cdi     =  substr($cdii, 0, 3)?>
                                    <?  $trainer    =  $_GET['trainer_id'];?>
                                    <?
                                        $sql = "SELECT * FROM course";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                            while($rows = mysql_fetch_array($row))
                                            {
                                    ?>
                                    <option value="<? echo $rows["course_id"];?>" <? if($rows["course_id"]=="$cdi")echo 'selected="selected"';?>><? echo $rows["course_name"];?></option>
                                    <?
                                            }*/
                                    ?>
                                </select>แก้ไข-->
                                <?  include("import/dbc_connect.php")?>
                                <?  $cdi        =  substr($cdii, 0, 3)?>
                                <?  $trainer    =  $_GET['trainer_id'];?>
                                <?
                                    $sql = "SELECT * FROM course where course_id='$cdi'";
                                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                    $rows = mysql_fetch_array($row);
                                ?>
                                <?  echo    $rows["course_name"];?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ผู้ให้การอบรม</th>
                            <td>
                                <!--<select name="trainer_id" id="" data-native-menu="false">
                                    <option>กรุณาเลือกผู้ให้การอบรม</option>
                                    <? /*include("import/dbc_connect.php")?>
                                    <?
                                        $sql = "SELECT * FROM trainer";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                            while($rows = mysql_fetch_array($row))
                                            {
                                    ?>
                                    <option value="<? echo $rows["trainer_id"];?>" <? if($rows["trainer_id"]=="$trainer")echo 'selected="selected"';?>>
                                        <?  if($rows['trainer_nametitle']=="1")echo "นาย";?>
                                        <?  if($rows['trainer_nametitle']=="2")echo "นาง";?>
                                        <?  if($rows['trainer_nametitle']=="3")echo "นางสาว";?>
                                        <?  echo $rows["trainer_fname"];?>
                                        <?  echo $rows["trainer_lname"];?>
                                    </option>
                                    <?
                                            }*/
                                    ?>
                                </select>แกไข้-->
                                <?
                                    $sql = "SELECT * FROM trainer";
                                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                    $rows = mysql_fetch_array($row);
                                ?>
                                <?  if($rows['trainer_nametitle']=="1")echo "นาย";?>
                                <?  if($rows['trainer_nametitle']=="2")echo "นาง";?>
                                <?  if($rows['trainer_nametitle']=="3")echo "นางสาว";?>
                                <?  echo $rows["trainer_fname"];?>
                                <?  echo $rows["trainer_lname"];?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>รหัสประจำตัวประชาชนผู้ลงทะเบียน</th>
                            <td>
                                <form class="ui-filterable">
                                    <input id="inset-autocomplete-input" data-type="search" placeholder="ค้นหาสมาชิก" data-ajax="false">
                                </form>
                                <ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true" data-input="#inset-autocomplete-input" data-ajax="false">
                                    <?
                                    $sql = "SELECT * FROM member";
                                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                    for ($i = 1; $i <= 3; $i++)
                                    {
                                        while($rows = mysql_fetch_array($row))
                                        {
                                    ?>
                                    <li>
                                        <a href="course_register_add_check.php?course_detail_id=<?=$cdii?>&newuser=root&trainer_id=<?=$trainer?>&member_idcard=<?=$rows["member_idcard"];?>" data-ajax="false">ลงทะเบียน
                                        <? echo $rows["member_idcard"];?>
                                        <?  if($rows['member_nametitle']=="1") echo "นาย";
                                            if($rows['member_nametitle']=="2") echo "นาง";
                                            if($rows['member_nametitle']=="3") echo "นางสาว";
                                            echo $rows["member_fname"]?>
                                            <?  echo $rows["member_lname"]?>
                                        </a>
                                    </li>
                                    <?
                                        $i++;
                                        }
                                    }
                                    ?>
                                </ul>
                            </td>
                            <td>e.g. นายอานนท์ หรือ "1656639980098"</td>
                        </tr>
                       
                    </tbody>  
                </table>
            </div>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>