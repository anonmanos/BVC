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
            <h1>รายชื่อผู้ลงทะเบียนเข้าอบรม</h1>
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
                    </tbody>  
                </table>
                <h3>รายชื่อผู้ลงทะเบียนที่สามารถลบได้</h3>
                <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive">

                <thead>
                    <tr class="ui-bar-d">
                        <th data-priority="2">ลำดับ</th>
                        <th data-priority="1">รหัสประจำตัวประชาชน</th>
                        <th>ชื่อผู้ลงทะเบียน</th>
                        <th data-priority="3">หมายเลขโทรศัพท์</th>
                        <th data-priority="4" >วันที่ลงทะเบียน</th>
                        <th data-priority="4" >ลบ</th>
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
                    ?>
                    <tr>
                        <td><h4><center><? echo $i;?></center></h4></td>
                        <td>
                            <? $member_idcard   =   $rows["member_idcard"];?>
                            <h4><? echo $member_idcard;?></h4>
                        </td>
                        <?
                            $sqlm = "SELECT * FROM member where member_idcard='$member_idcard'";
                            $rowmm = mysql_query($sqlm) or die ("Error Query [".$sqlm."]");
                            $rowm = mysql_fetch_array($rowmm)
                                
                        ?>
                        <td>
                            <h4>
                            <?  if($rowm['member_nametitle']=="1") echo "นาย";
                                if($rowm['member_nametitle']=="2") echo "นาง";
                                if($rowm['member_nametitle']=="3") echo "นางสาว";
                                echo $rowm["member_fname"]?>
                            <?  echo $rowm["member_lname"]?>
                            </h4>
                        </td>
                        <td><h4><? echo $rowm["member_cnumber"];?></h4></td>
                        <td><h5><? echo $rows["course_regisdate"];?></h5></td>
                        <td>
                            <h4>
                                <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all">No text</a>
                                <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                    <div data-role="header" data-theme="a">
                                    <h1>ลบผู้ลงทะเบียน</h1>
                                    </div>
                                    <div role="main" class="ui-content">
                                        <h3 class="ui-title">คุณต้องการลบผู้ลงทะเบียนชื่อ : <?  if($rowm['member_nametitle']=="1") echo "นาย";
                                                                                        if($rowm['member_nametitle']=="2") echo "นาง";
                                                                                        if($rowm['member_nametitle']=="3") echo "นางสาว";
                                                                                        echo $rowm["member_fname"]?>
                                                                                    <?  echo $rowm["member_lname"]?></h3>
                                    <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบผู้ใช้งาน</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                        <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                        <a href="course_register_list_deleting_check.php?course_detail_id=<? echo $course_detail_id;?>&member_idcard=<? echo $member_idcard;?>" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
                                    </div>
                                </div>
                            </h4>
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