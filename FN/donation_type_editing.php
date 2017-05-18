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
        <h1>เพิ่มประเภทเงินถวาย</h1>
            <div role="main" class="ui-content">
                <form method="post" action="donation_type_editing_check.php" data-ajax="false" data-role="fieldcontain">
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
                            <th>ประเถทเงินถวาย</th>
                            <?
                            include("import/dbc_connect.php");
                            $dtype_id     =$_GET['dtype_id'];
                            $sqlC	= "select * from donationtype where dtype_id='$dtype_id'";
	                        $row	= mysql_query($sqlC) or die("error=$sqlC");
                            $rows   = mysql_fetch_array($row)
                            ?>
                            <td>
                                <input type="hidden" name="dtype_id" value="<?=$dtype_id?>">
                                <label for="donation_name" class="ui-hidden-accessible">Donation Name:</label>
                                <textarea cols="40" rows="8" name="donation_name" id="donation_name" placeholder="รายการประเภทเงินถวาย"><?=$rows["donation_type"];?></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <button type="submit" name="submit" class="ui-btn ui-corner-all ui-btn-b">ยืนยันการแก้ไขประเภทเงิน</button>
                            </td>
                            <td>
                                <a href="#popupDelete" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">ลบประเภทเงินถวาย</a>
                                <div data-role="popup" id="popupDelete" data-overlay-theme="b" data-theme="b" data-dismissible="false" data-ajax="false" style="max-width:400px;">
                                    <div data-role="header" data-theme="a">
                                    <h1>ลบประเภทเงินถวาย</h1>
                                    </div>
                                    <div role="main" class="ui-content">
                                        <h3 class="ui-title">คุณต้องการลบประเภทเงินถวาย : <?=$rows["donation_type"];?></h3>
                                    <p>*กรุณา กดปุ่ม "ตกลง" เพื่อลบประเภทเงินถวาย</p><p>หรือ กดปุ่ม "ยกเลิก" เพื่อยกเลิก</p>
                                        <a href="#" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-delete ui-btn-icon-left" data-rel="back">ยกเลิก</a>
                                        <a href="donation_type_delete_check.php?add_id=<?=$dtype_id?>&newuser=rootnew" class="ui-btn ui-corner-all ui-btn-inline ui-btn-b ui-icon-check ui-btn-icon-left" data-transition="flow" data-ajax="false" data-dismissible="false">ตกลง</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>  
                </table>
                </form>
            </div>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>