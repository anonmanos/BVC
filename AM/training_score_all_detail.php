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
            <h1>คะแนนผู้เข้าอบรม</h1>
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
                               <a href="course_detail_profile.php?course_detail_id=<?=$course_detail_id?>" data-ajax="false">
                                <?=$course_detail_id?>
                                </a>
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
                                <a href="course_detail_profile.php?course_detail_id=<?=$course_detail_id?>" data-ajax="false">
                                <?=$row2['course_name']?>
                                </a>
                                
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                          <th>จำนวนบนเรียน</th>
                            <td >
                                <?=$unit=$row2['course_unit']?> บท 
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
                            <a href="trainer_profile.php?trainer_id=<?=$trainer_id?>" data-ajax="false">
                                <?  if($row3['trainer_nametitle']=="1")echo "นาย";?>
                                <?  if($row3['trainer_nametitle']=="2")echo "นาง";?>
                                <?  if($row3['trainer_nametitle']=="3")echo "นางสาว";?>
                                <?  echo $row3["trainer_fname"];?>
                                <?  echo $row3["trainer_lname"];?>
                            </a>
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
                    </tbody>  
                </table>
                <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-popup-theme="a">
                <thead>
                    <tr class="ui-bar-d">
                        <th data-priority="4">ลำดับ</th>
                        <th data-priority="1">รายชื่อ</th>
                        <?
                        for($i = 1; $i <=$unit; $i++)
                        {
                        ?>
                        <th data-priority="4" >U<?=$i?></th>
                        <?
                        }
                        ?>
                        <th data-priority="1">เต็ม</th>
                        <th data-priority="1">ได้</th>
                        <th data-priority="1">ผล</th>
                    </tr>
                </thead>
                <tbody>
                <? include("import/dbc_connect.php")?>
                <?
                    $sql = "SELECT * FROM courseregis where course_detail_id='$course_detail_id'";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1; $i <= 3; $i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                            $regis_id=$rows['regis_id'];
                    ?>
                    <tr>
                        <td>
                            <? echo $i;?>
                        </td>
                        <? $member_idcard   =   $rows["member_idcard"];?>
                        <? $member_idcard//ไม่แสดง?>
                        <?
                            $sqlm = "SELECT * FROM member where member_idcard='$member_idcard'";
                            $rowmm = mysql_query($sqlm) or die ("Error Query [".$sqlm."]");
                            $rowm = mysql_fetch_array($rowmm)
                                
                        ?>
                        <td>
                           <a href="trained_find_profile.php?idcard=<?=$member_idcard?>" data-ajax="false">
                           <?   if($rowm['member_nametitle']=="1") echo "นาย";
                                if($rowm['member_nametitle']=="2") echo "นาง";
                                if($rowm['member_nametitle']=="3") echo "นางสาว";
                                echo $rowm["member_fname"]?>
                            <?  echo $rowm["member_lname"]?>
                           </a>
                        </td>
                        <?
                        for($x = 1; $x <=$unit; $x++)
                        {
                        ?>
                        <td>
                            <?
                                    $sql		= "select * from trainingscore where regis_id='$regis_id' AND training_unit='$x'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowtu		= mysql_fetch_array($query);
                            ?>
                            <?=$uc=$rowtu['training_score']?>
                        </td>
                        <?
                        }$x++;
                        ?>
                        <td>
                            <?
                                    $sql		= "SELECT regis_id,SUM(training_tscore) FROM trainingscore GROUP BY regis_id='$regis_id';";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowtu		= mysql_fetch_array($query);
                                    while($rowsum=mysql_fetch_array($query))
                                    {
                                    echo $t=$rowsum['SUM(training_tscore)'];
                                    }
                            ?>
                        </td>
                        <td>
                            <?
                                    $sql		= "SELECT regis_id,SUM(training_score) FROM trainingscore GROUP BY regis_id='$regis_id';";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowtu		= mysql_fetch_array($query);
                                    while($rowsum=mysql_fetch_array($query))
                                    {
                                    echo $s=$rowsum['SUM(training_score)'];
                                    }
                            ?>
                        </td>
                        <td>
                            <?
                                    $sql		= "select * from trainingscore where regis_id='$regis_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowtu		= mysql_fetch_array($query);
                                    $n          = mysql_num_rows($query);
                            ?>
                            <?
                            if($n>=$unit)
                            {
                                $avg=$s/$t;
                                if($avg>='0.6')
                                {
                                    echo "ผ่าน";
                                    $sql		= "select * from trained where register_id='$regis_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowte		= mysql_fetch_array($query);
                                    $td         = mysql_num_rows($query);
                                    if($td==0)
                                    {
                                        $traned_date = date("Y-m-d");//วันที่ลงทะเบียน
                                        $sqlt= "insert into trained values('$regis_id','$member_idcard','$course_detail_id','$trainer_id','$traned_date','$t','$s')";
                                        mysql_query($sqlt) or die("error=$sqlt");
                                        echo "<script>alert(' ++ Complete ++ ');";
                                        $sqlt= "DELETE FROM trained_fail WHERE register_id = '$regis_id'";
                                        mysql_query($sqlt) or die("error=$sqlt");
                                        echo "<script>alert(' ++ Complete ++ ');";
                                    }
                                }
                                else
                                {
                                    echo "ไม่ผ่าน";
                                    $sql		= "select * from trained_fail where register_id='$regis_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowte		= mysql_fetch_array($query);
                                    $td         = mysql_num_rows($query);
                                    if($td==0)
                                    {
                                        $traned_date = date("Y-m-d");//วันที่ลงทะเบียน
                                        $sqlt= "insert into trained_fail values('$regis_id','$member_idcard','$course_detail_id','$trainer_id','$traned_date','$t','$s')";
                                        mysql_query($sqlt) or die("error=$sqlt");
                                        echo "<script>alert(' ++ Complete ++ ');";
                                    }
                                }
                            }
                            ?>
                        </td>
                        <!--<td>
                            <?
                                //$sql		= "select * from trained where register_id='$regis_id'";
                                //$query		= mysql_query($sql) or die("error=$sql");
                                //$rowte		= mysql_fetch_array($query);
                                //$ff         = mysql_num_rows($query);
                                //if($ff>=1)
                                //{
                                    //echo "ส่งแล้ว";
                                //}
                            ?>
                        </td>-->
                    </tr>
                    <?
                        $i++;
                        }
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