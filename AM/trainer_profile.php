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
                            <?  //นับจำนวนผู้ลงทะบียน
                                $sql		= "SELECT * FROM courseregis WHERE trainer_id = '$trainer_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row2		= mysql_fetch_array($query);
                                $records    = mysql_num_rows($query);
                            ?>
                            <tr>
                              <th>จำนวนผู้ลงทะบียนรับอบรม</th>
                              <td ><?=$records?></td>
                              <td></td>
                            </tr>
                            <?  //นับจำนวนจบหลักสูตร
                                $sql		= "SELECT * FROM trained WHERE trainer='$trainer_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row2		= mysql_fetch_array($query);
                                $records2   = mysql_num_rows($query);
                            ?>
                            <tr>
                              <th>จำนวนผ่านการอบรม</th>
                              <td ><?=$records2?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ผู้จบหลักสูตรคิดเป็น</th>
                              <td >
                                <?
                                if($records<1||$records2<1)
                                {
                                    echo "0";
                                }else{
                                    $sss=($records2/$records)*100;
                                    echo number_format($sss,2);
                                }
                                ?> %
                              </td>
                              <td></td>
                            </tr>
                        </tbody>  
                    </table>
                </form>
                <h1>เลือก หรือ ค้นหารายละเอียดการอบรม</h1>
                <form class="ui-filterable">
                    <input id="inset-autocomplete-input" data-type="search" placeholder="ค้นหาหลักสูตร" data-ajax="false">
                </form>
                <ol data-role="listview" data-filter="true" data-inset="true" data-input="#inset-autocomplete-input" data-ajax="false">
                <? include("import/dbc_connect.php")?>
                    <?
                    $sql = "SELECT * FROM coursedetail where trainer_id='$trainer_id'";
                    $roww = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1; $i <= 3; $i++)
                    {
                        while($rows = mysql_fetch_array($roww))
                        {
                    ?>
                    <li>
                        <a href="course_detail_profile.php?course_detail_id=<?=$rows['course_detail_id']?>" data-ajax="false">

                            <?=$rows['course_detail_id']?>
                            <?      
                                    $course_id  =$rows["course_id"];
                                    $sql		= "select * from course where course_id='$course_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $row		= mysql_fetch_array($query);
                            ?>
                            หลักสูตร
                            <?=$row['course_name']?>
                            <?      
                                    $trainer_id  =$rows['trainer_id'];
                                    $sql		= "select * from trainer where trainer_id='$trainer_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $row3		= mysql_fetch_array($query);
                            ?>
                        </a>
                    </li>
                    <?
                        $i++;
                        }
                    }
                    ?>
                </ol>
            </div>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>