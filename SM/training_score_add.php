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
            <h1>คะแนนการอบรม</h1>
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
                            $tu         =$_GET['training_unit'];
                            $course_detail_id =$_GET['course_detail_id'];
                            $sql		= "select * from coursedetail where course_detail_id='$course_detail_id'";
                            $query		= mysql_query($sql) or die("error=$sql");
                            $row1		= mysql_fetch_array($query);
                            $start_date =$row1['start_date'];
                            $end_date =$row1['end_date'];
                        ?> 
                        <tr>
                          <th>รหัสการอบรม</th>
                            <td >
                                <?=$row1['course_detail_id']?>
                                <input type="hidden" name="course_detail_id" value="<?=$row1['course_detail_id']?>">
                            </td>
                          <td></td>
                        </tr>
                        <tr>
                          <th>หลักสูตร</th>
                            <td>
                                <?      
                                    $course_id  =$row1["course_id"];
                                    $sql		= "select * from course where course_id='$course_id'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $row2		= mysql_fetch_array($query);
                                ?>
                                <?=$row2['course_name']?>
                                <?$course_score=$row2['course_score']?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>ชื่อผู้ให้การอบรม</th>
                            <td>
                            <?      
                                $trainer_id     =$row1['trainer_id'];
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
                <h2>คะแนนการอบรมสัปดาห์ที่ <?=$tu?></h2>
                <table data-role="table" id="movie-table-custom" data-mode="reflow" class="ui-body-d ui-shadow table-stripe ui-responsive">
                    <thead>
                        <tr>
                            <th style="width:5%"><center>ลำดับ</center></th>
                            <th data-priority="50">ชื่อผู้เข้าอบรม</th>
                            <th style="width:15%"><center>คะแนนเต็ม</center></th>
                            <th style="width:15%"><center>คะแนนที่ได้</center></th>
                            <th style="width:3%"><center>เพิ่ม</center></th>
                            <th style="width:3%"><center>แก้ไข</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        

                        <?
                        $sql    = "SELECT * FROM courseregis where course_detail_id='$course_detail_id'";
                        $row44  = mysql_query($sql) or die ("Error Query [".$sql."]");
                        for ($i = 1; $i <= 1; $i++)
                        {
                            while($row4 = mysql_fetch_array($row44))
                            {
                                $regis_id=$row4['regis_id']
                        ?>
                        <tr>
                            <th><h4><center><?=$i?></center></h4></th>
                            <input type="hidden" name="course_register_id" value="<?=$row4['regis_id']?>">
                            <input type="hidden" name="training_unit" value="<?=$tu?>">
                            <td>
                                <? $member_idcard   =   $row4["member_idcard"];?>
                                <?
                                    $sqlm = "SELECT * FROM member where member_idcard='$member_idcard'";
                                    $rowmm = mysql_query($sqlm) or die ("Error Query [".$sqlm."]");
                                    $rowm = mysql_fetch_array($rowmm)

                                ?>
                                <h4>
                                <?  if($rowm['member_nametitle']=="1") echo "นาย";
                                    if($rowm['member_nametitle']=="2") echo "นาง";
                                    if($rowm['member_nametitle']=="3") echo "นางสาว";
                                    echo $rowm["member_fname"]?>
                                <?  echo $rowm["member_lname"]?>
                                </h4>
                            </td>
                            <td>
                                <?
                                    $sql		= "select * from trainingscore where regis_id='$regis_id' AND training_unit='$tu'";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    $rowtu		= mysql_fetch_array($query);
                                ?>
                                <h4><center><?=$course_score?></center></h4>
                            </td>
                            <td>
                                <h4><center><?=$rowtu['training_score']?></center></h4>
                            </td>
                            <td>
                                <h1>
                                <a href="#popupPlus<?=$i?>" data-rel="popup" data-position-to="window" class="ui-btn ui-icon-plus ui-btn-icon-notext ui-corner-all" data-transition="pop">ให้คะแนน</a>
                                <div data-role="popup" id="popupPlus<?=$i?>" data-theme="a" class="ui-corner-all">
                                    <form method="POST" action="training_score_add_check.php" data-ajax="false" data-role="fieldcontain">
                                        <div style="padding:10px 20px;">
                                            <h3>ให้คะแนน</h3>
                                            <input type="hidden" name="course_register_id" value="<?=$row4['regis_id']?>">
                                            <input type="hidden" name="training_unit" value="<?=$tu?>">
                                            <input type="hidden" name="course_detail_id" value="<?=$row1['course_detail_id']?>">
                                            <label for="un" class="ui-hidden-accessible">คะแนน:</label>
                                            <input type="text" name="training_score" id="un" value="" placeholder="คะแนน" data-theme="a">
                                            <button type="submit" class="ui-btn ui-corner-all ui-btn-b ui-btn-icon-left ui-icon-plus" data-ajax="false">ให้คะแนน</button>
                                        </div>
                                    </form>
                                </div>
                                </h1>
                            </td>
                            <td>
                                <h1>
                                <a href="#popupEdit<?=$i?>" data-rel="popup" data-position-to="window" class="ui-btn ui-icon-gear ui-btn-icon-notext ui-corner-all" data-transition="pop">แก้ไขคะแนน</a>
                                <div data-role="popup" id="popupEdit<?=$i?>" data-theme="a" class="ui-corner-all">
                                    <form method="POST" action="training_score_editing_check.php" data-ajax="false" data-role="fieldcontain">
                                        <div style="padding:10px 20px;">
                                            <h3>แก้ไขคะแนน</h3>
                                            <input type="hidden" name="course_register_id" value="<?=$row4['regis_id']?>">
                                            <input type="hidden" name="training_unit" value="<?=$tu?>">
                                            <input type="hidden" name="course_detail_id" value="<?=$row1['course_detail_id']?>">
                                            <label for="un" class="ui-hidden-accessible">คะแนน:</label>
                                            <input type="text" name="training_score" id="un" value="<?=$rowtu['training_score']?>" placeholder="คะแนน" data-theme="a">
                                            <button type="submit" class="ui-btn ui-corner-all ui-btn-b ui-btn-icon-left ui-icon-gear" data-ajax="false">แก้ไขคะแนน</button>
                                        </div>
                                    </form>
                                </div>
                                </h1>
                            </td>
                        </tr>
                        <?
                                $i++;
                            }
                        }
                        ?>
                         <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>