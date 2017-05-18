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
        <h1>แก้ไขผู้ให้การอบรม</h1>
            <div role="main" class="ui-content">
                <form method="post" action="trainer_editing_check.php" data-ajax="false" data-role="fieldcontain">
                <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                    <thead>
                        <tr>
                            <th style="width:25%"></th>
                            <th data-priority="1"></th>
                            <th style="width:25%"></th>
                        </tr>
                    </thead>
                    <?  include("import/dbc_connect.php");
                                $trainer_id  =$_POST['trainer_id'];
                                $sql		= "select * from trainer where trainer_id='$trainer_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                    ?>
                    <tbody>
                        <tr>
                            <th>รหัสผู้ใช้การอบรม</th>
                            <td>
                                <label for="trainer_id" class="ui-hidden-accessible">Trainer_ID:</label>
                                <input type="text" name="trainer_id" id="trainer_id" class="ui-state-disabled" value="<?=$row['trainer_id']?>" placeholder="รหัสผู้ใช้การอบรม" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                          <th>ชื่อ-สกุล</th>
                          <td>
                                <select name="titlename" id="" data-native-menu="false">
                                    <option>กรุณาเลือกคำนำหน้านาม</option>
                                    <option value="1" <? if($row['trainer_nametitle']=="1")echo 'selected="selected"';?>>นาย</option>
                                    <option value="2" <? if($row['trainer_nametitle']=="2")echo 'selected="selected"';?>>นาง</option>
                                    <option value="3" <? if($row['trainer_nametitle']=="3")echo 'selected="selected"';?>>นางสาว</option>
                                </select>
                                <label for="fname" class="ui-hidden-accessible">firstname:</label>
                              <input type="text" name="fname" id="fname" value="<?=$row['trainer_fname']?>" placeholder="ชื่อ" data-theme="a">
                              <label for="lname" class="ui-hidden-accessible">lastname:</label>
                              <input type="text" name="lname" id="lname" value="<?=$row['trainer_lname']?>" placeholder="นามสกุล" data-theme="a">
                            <td></td>
                        </tr>
                        <tr>
                            <th>เบอร์โทรศัทพ์</th>
                            <td>
                                <label for="tel" class="ui-hidden-accessible">Tel:</label>
                                <input type="tel" name="tel" id="tel" value="<?=$row['trainer_cnumber']?>" placeholder="เบอร์โทรศัพท์" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>อีเมลล์</th>
                            <td>
                                <label for="email" class="ui-hidden-accessible">email:</label>
                                <input type="email" name="email" id="email" value="<?=$row['trainer_email']?>" placeholder="อีเมลล์" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>วันเดือนปีเกิด</th>
                            <td>
                                <?
                                list($y,$m,$d) = split("-",$row['trainer_birthday']);
                            ?>
                            <select name="day" id="day" id="" data-native-menu="false">
                                <option>กรุณาเลือก "วันเกิด"</option>
                                <? for($i=1;$i<=31;$i++){ ?>
                                <option value="<?=$i?>" <? if($i==$d){echo 'selected="selected"';} ?>>วันที่ <?=$i?></option>
                                <? } ?>
                            </select>
                            <select name="month" id="month" id="" data-native-menu="false">
                                <option>กรุณาเลือก "เดือนเกิด"</option>
                                <? 
                                    $mname = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');	  
                                  for($i=1;$i<=12;$i++)
                                  { 
                                ?>
                                <option value="<?=$i?>" <? if($i==$m){echo 'selected="selected"';} ?>>เดือน <?=$mname[$i]?></option>
                                <? } ?>
                            </select>
                            <select name="year" id="year" id="" data-native-menu="false">
                                <? for($i=date("Y");$i>=date("Y")-80;$i--){ ?>
                                <option value="<?=$i?>" <? if($i==$y){echo 'selected="selected"';} ?>>ปี <?=$i?></option>
                                <? } ?>
                            </select> 
                            </td>
                          <td></td>
                        </tr>
                        <tr>
                            <th>ที่อยู่</th>
                            <td>
                                <label for="address" class="ui-hidden-accessible">Address:</label>
                                <textarea cols="40" rows="8" name="address" id="address" placeholder="ที่อยู่"><?=$row['trainer_address']?></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" name="submit" class="ui-btn ui-corner-all ui-btn-b">ยืนยันการแก้ไขผู้ให้การอบรม</button>
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