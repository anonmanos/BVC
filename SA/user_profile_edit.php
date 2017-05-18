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
            <h1>แก้ไขข้อมูลผู้ใช้งาน</h1>
            <div role="main" class="ui-content">
                <form method="post" action="user_profile_edit_check.php" data-ajax="false" data-role="fieldcontain">
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
                          <th>ชื่อผู้ใช้งาน</th>
                          <td><? echo $user_id = $_SESSION['user_id']?></td>
                          <td></td>
                        </tr>
                        <?  include("import/dbc_connect.php");
                            $sql		= "select * from user where user_id='$user_id'";
                            $query		= mysql_query($sql) or die("error=$sql");
                            $row		= mysql_fetch_array($query);
                        ?> 
                        <tr>
                          <th>กลุ่มผู้ใช้งาน</th>
                            <td>
                                <? if($row['usergroup_id']=="sa") echo "ผู้ดูแลระบบ";?>
                                <? if($row['usergroup_id']=="mb") echo "ผู้ดูแลข้อมูสมาชิก";?>
                                <? if($row['usergroup_id']=="sm") echo "ผู้จัดการการอบรม";?>
                                <? if($row['usergroup_id']=="fn") echo "ผู้ดูแลการเงิน";?>
                                <? if($row['usergroup_id']=="am") echo "ผู้บริหาร";?>
                            </td>
                          <td></td>
                        </tr>
                        <tr>
                          <th>วันขึ้นทะเบียน</th>
                          <td><?=$row['user_regisdate']?></td>
                          <td></td>
                        </tr>
                        <?
                            $user_id	= $row['user_id'];
                            $sql		= "select * from userpro where user_id='$user_id'";
                            $query		= mysql_query($sql) or die("error=$sql");
                            $row		= mysql_fetch_array($query);
                        ?> 
                        <tr>
                          <th>ชื่อ-สกุล</th>
                          <td>
                                <select name="titlename" id="" data-native-menu="false">
                                    <option>กรุณาเลือกคำนำหน้านาม</option>
                                    <option value="1" <? if($row['user_nametitle']=="1")echo 'selected="selected"';?>>นาย</option>
                                    <option value="2" <? if($row['user_nametitle']=="2")echo 'selected="selected"';?>>นาง</option>
                                    <option value="3" <? if($row['user_nametitle']=="3")echo 'selected="selected"';?>>นางสาว</option>
                                </select>
                                <label for="fname" class="ui-hidden-accessible">firstname:</label>
                              <input type="text" name="fname" id="fname" value="<?=$row['user_fname']?>" placeholder="ชื่อ" data-theme="a">
                              <label for="lname" class="ui-hidden-accessible">lastname:</label>
                              <input type="text" name="lname" id="lname" value="<?=$row['user_lname']?>" placeholder="นามสกุล" data-theme="a">
                            <td></td>
                        </tr>
                        <tr>
                            <th>เบอร์โทรศัพท์</th>
                            <td>
                                <label for="tel" class="ui-hidden-accessible">Tel:</label>
                                <input type="tel" name="tel" id="tel" value="<?=$row['user_cnumber']?>" placeholder="เบอร์โทรศัพท์" data-theme="a">
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>อีเมลล์</th>
                            <td>
                                <label for="email" class="ui-hidden-accessible">email:</label>
                                <input type="email" name="email" id="email" value="<?=$row['user_email']?>" placeholder="อีเมลล์" data-theme="a">
                            </td>
                          <td></td>
                        </tr>
                        <tr>
                            <th>วันเดือนปีเกิด</th>
                            <td>
                                <?
                                list($y,$m,$d) = split("-",$row['user_birthday']);
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
                                <textarea cols="40" rows="8" name="address" id="address" placeholder="ที่อยู่"><?=$row['user_address']?></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                            <button type="submit" name="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b">ยืนยันการแก้ไข</button>
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