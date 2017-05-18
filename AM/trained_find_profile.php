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
            <h1>ข้อมูลสมาชิก</h1>
            <div role="main" class="ui-content">
                <form method="POST" action="member_editing.php" data-ajax="false" data-role="fieldcontain">
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
                                $idcard	 =$_GET['idcard'];
                                $sql		= "select * from member where member_idcard='$idcard'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                            ?> 
                            <tr>
                              <th>รหัสบัตรประจำตัวประชาชน</th>
                                <td >
                                    <?=$member_idcard=$row['member_idcard']?>
                                    <input type="hidden" name="idcard" value="<?=$row['member_idcard']?>">
                                </td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ชื่อ-นามสกุล</th>
                              <td >
                                  <? if($row['member_nametitle']=="1") echo "นาย";?>
                                  <? if($row['member_nametitle']=="2") echo "นาง";?>
                                  <? if($row['member_nametitle']=="3") echo "นางสาว";?>
                                  <?=$row['member_fname']?>   
                                  <?=$row['member_lname']?>
                              <td></td>
                            </tr>
                            <tr>
                              <th>เบอร์โทรศัพท์</th>
                              <td ><?=$row['member_cnumber']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>อีเมลล์</th>
                              <td ><?=$row['member_email']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>วันเดือนปีเกิด</th>
                              <td ><?=$row['member_birthday']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>ที่อยู่</th>
                              <td ><?=$row['member_address']?></td>
                              <td></td>
                            </tr>
                            <tr>
                              <th>วันที่ขึ้นทะเบียน</th>
                              <td ><?=$row['member_regisdate']?></td>
                              <td></td>
                            </tr>
                        </tbody>  
                    </table>
                </form>
                <h3>หลักสูตรที่เข้าอบรม</h3>
                <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-popup-theme="a">
                <thead>
                    <tr class="ui-bar-d">
                        <th style="width:5%">ลำดับ</th>
                        <th style="width:15%">รหัสหลักสูตร</th>
                        <th style="width:35%">ชื่อหลักสูตร</th>
                        <th style="width:25%">ผลการอบรม</th>
                    </tr>
                </thead>
                <tbody>
                <? include("import/dbc_connect.php")?>
                <?
                    
                    $sql = "SELECT * FROM courseregis where member_idcard='$member_idcard'";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1; $i <= 3; $i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                            $cdii=$rows["course_detail_id"];
                    ?>
                    <tr>
                        <td><? echo $i;?></td>
                        <td>
                           <a href="course_detail_profile.php?course_detail_id=<?=$cdii?>" data-ajax="false">
                            <?=$cdii?>
                            </a>
                        </td>
                        <td>
                            <?      
                                    $cdi     =  substr($cdii, 0, 3);
                                    $course_id  =$row["course_id"];
                                    $sql		= "select * from course where course_id='$cdi'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $row2		= mysql_fetch_array($query);
                            ?>
                            <a href="course_profile.php?course_id=<?=$cdi?>" data-ajax="false">
                                <?=$row2['course_name']?>
                            </a>
                        </td>
                        <td>
                            <?$regis_id=$rows['regis_id']?>
                            <?
                                $sql		= "select * from trained where register_id='$regis_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $rowte		= mysql_fetch_array($query);
                                $ff         = mysql_num_rows($query);
                                
                                if($ff==1)
                                {
                                    echo '<a href="training_score_all_detail.php?course_detail_id=<?=$cdii?>" data-ajax="false">';
                                    echo "ผ่าน";
                                    echo '</a>';
                                }
                                else
                                {
                                    $sql		= "select * from trained_fail where register_id='$regis_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowte		= mysql_fetch_array($query);
                                    $fff        = mysql_num_rows($query);
                                    
                                    if($fff==1)
                                    {
                                        ?><a href="training_score_all_detail.php?course_detail_id=<?=$cdii?>" data-ajax="false">
                                        <?
                                        echo "ไม่ผ่าน";
                                        echo '</a>';
                                    }else
                                    {
                                        ?><a href="training_score_all_detail.php?course_detail_id=<?=$cdii?>" data-ajax="false">
                                        <?
                                        echo "กำลังเรียน...";
                                        echo '</a>';
                                    }
                                }
                            
                            ?>
                        </td>
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