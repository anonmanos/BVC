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
        <h1>บันทึกรายการเงินถวาย</h1>
            <div role="main" class="ui-content">
                <form method="POST" action="donation_add_check.php" data-ajax="false" data-role="fieldcontain">
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
                                    <option>กรุณาเลือกประเภทเงินถวาย</option>
                                    <?
                                        include("import/dbc_connect.php");
                                        $sql = "SELECT * FROM donationtype";
                                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                        while($rows = mysql_fetch_array($row))
                                        {
                                    ?>
                                    <option value="<?=$rows["dtype_id"]?>">
                                        <? echo $rows["donation_type"];?>
                                    </option>
                                    <?
                                        }
                                    ?>
                                </select>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>จำนวนเงิน</th>
                            <td>
                                <label for="amount" class="ui-hidden-accessible">Amount:</label>
                                <input type="number" name="amount" id="amount" value="" placeholder="e.g. 1023.75" data-theme="a">
                            </td>
                            <th>หน่วย : บาท</th>
                        </tr>
                        <tr>
                            <th>หมายเหตุ</th>
                            <td>
                                <label for="note" class="ui-hidden-accessible">Note:</label>
                                <textarea cols="40" rows="8" name="note" id="note" placeholder="หมายเหตุ"></textarea>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
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