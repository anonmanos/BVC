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
        <h1>แก้ไขรายการเงินถวาย</h1>
            <div role="main" class="ui-content">
                <form method="POST" action="donation_editing_check.php" data-ajax="false" data-role="fieldcontain">
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
                            <td>
                                <select name="dtype_id" id="dtype_id" data-native-menu="false">
                                    <?
                                        $edit_id    =   $_GET['edit_id'];
                                        $date       =   $_GET['date'];
                                        
                                        include("import/dbc_connect.php");
                                        $sql = "SELECT * FROM donation where donation_id=$edit_id";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                        $rows = mysql_fetch_array($row)
                                    ?>
                                    <option>กรุณาเลือกประเภทเงินถวาย</option>
                                    <?
                                        $sql = "SELECT * FROM donationtype";
                                        $rowi = mysql_query($sql) or die ("Error Query [".$sql."]");
                                        while($rowii = mysql_fetch_array($rowi))
                                        {
                                        $d  =   $rows['dtype_id'];
                                    ?>
                                    <option value="<?=$rowii['dtype_id']?>" <? if("$d"==$rowii['dtype_id'])echo 'selected="selected"';?>>
                                        <? echo $rowii["donation_type"];?>
                                    </option>
                                    <?
                                        }
                                    ?>
                                </select>
                                <? echo $date;?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>จำนวนเงิน</th>
                            <td>
                                <label for="amount" class="ui-hidden-accessible">Amount:</label>
                                <input type="number" name="amount" id="amount" value="<? echo $rows['donation_amount']?>" placeholder="e.g. 1023.75" data-theme="a">
                            </td>
                            <th>หน่วย : บาท</th>
                        </tr>
                        <tr>
                            <th>หมายเหตุ</th>
                            <td>
                                <label for="note" class="ui-hidden-accessible">Note:</label>
                                <textarea cols="40" rows="8" name="note" id="note" placeholder="หมายเหตุ"><? echo $rows['donation_note'];?></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input type="hidden" name="edit_id" value="<?=$edit_id?>">
                                <button type="submit" name="submit" class="ui-btn ui-corner-all ui-btn-b">บันทึกการเงิน</button>
                            </td>
                            <td></td>
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