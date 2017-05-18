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
        <?
            $week_id    =date('W');
            $year_id    =date('o');
        ?>
        <h1>สรุปยอดเงินคงเหลือ ประจำสัปดาห์ที่ <?=$week_id?> ปี <?=$year_id?></h1>
            <div role="main" class="ui-content">
                <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-popup-theme="a">
                    <thead>
                        <tr class="ui-bar-d">
                            <th style="width:14%">วันที่</th>
                            <th style="width:46%">รายการ</th>
                            <th style="width:20%"><div class="div2">จำนวนเงิน (บาท)</div></th>
                            <th style="width:15%">หมายเหตุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            //เงินถวายทั้งหมด
                            include("import/dbc_connect.php");
                            $week   =   $week_id.$year_id;//date('Wo');//252015;
                            $sql = "SELECT * FROM donation where donation_week=$week ORDER BY `donation`.`donation_id` DESC LIMIT 15";
                            $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                            while($rows = mysql_fetch_array($row))
                            {
                            $dtype_id   =   $rows["dtype_id"];
                            $cdat       =   $rows["donation_date"];
                            $cdate      =   substr($cdat, 0, 10);
                            $w          =   $rows["donation_week"];
                        ?>
                        <tr>
                            <td><?=$cdate?></td>
                            <td>
                            <?
                                $sql1 = "SELECT * FROM donationtype where dtype_id=$dtype_id";
                                $row1 = mysql_query($sql1) or die ("Error Query [".$sql."]");
                                $rowss = mysql_fetch_array($row1);
                                echo $rowss["donation_type"];
                            ?>
                            </td>
                            <td><div class="div2"><? echo number_format($rows["donation_amount"], 2);?></div></td>
                            <td><? echo $rows["donation_note"];?></td>
                        </tr>
                                
                        <?
                            }
                        ?>
                        <?
                            //ค่าใช้จ่าย
                            $sql = "SELECT * FROM expenses where expenses_week=$week ORDER BY `expenses`.`expenses_id` DESC LIMIT 15";
                            $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                            while($rows = mysql_fetch_array($row))
                            {
                            $etype_id   =$rows["etype_id"];
                            $edat       =   $rows["expenses_date"];
                            $edate      =   substr($edat, 0, 10);
                            $w          =   $rows["expenses_week"];
                        ?>
                        <tr>
                            <td><?=$edate?></td>
                            <td>
                            <?
                                $sql1 = "SELECT * FROM expensestype where etype_id=$etype_id";
                                $row1 = mysql_query($sql1) or die ("Error Query [".$sql."]");
                                $rowss = mysql_fetch_array($row1);
                                echo $rowss["expenses_type"];
                            ?>
                            </td>
                            <td><div class="div2"><? echo number_format($rows["expenses_amount"],2)?></div></td>
                            <td><? echo $rows["expenses_note"];?></td>
                        </tr>
                        <?
                            }
                        ?>
                        <tr>
                            <th></th>
                            <th>ยอดยกมาจากอาทิตย์ที่ <?=$dw=date('W')-1?>/<?=$do=date('o')?></th>
                            <th>
                                <div class="div2">
                                    <?
                                        $weeek      = $dw.$do;
                                        $sql		= "SELECT * FROM balance where week=$weeek";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        $rowbalance =mysql_fetch_array($query);
                                        {
                                            $ob=$rowbalance['balance'];
                                            echo number_format($ob,2);
                                        }
                                    ?>
                                </div>
                            </th>
                            <th>บาท</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>รวมยอดเงินถวาย</th>
                            <th>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT SUM(donation_amount) FROM donation where donation_week=$week";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        while($rowsum=mysql_fetch_array($query))
                                        {
                                            $d=$rowsum['SUM(donation_amount)'];
                                            echo number_format($d,2);
                                        }
                                    ?>
                                </div>
                            </th>
                            <th>บาท</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>รวมยอดค่าใช้จ่าย</th>
                            <th>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_week=$week";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        while($rowsum=mysql_fetch_array($query))
                                        {
                                            $e=$rowsum['SUM(expenses_amount)'];
                                            echo number_format($e,2);
                                        }
                                    ?>
                                </div>
                            </th>
                            <th>บาท</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>ยอดเงินคงเหลือ</th>
                            <th>
                                <div class="div2">
                                    <?
                                        $b          = ($d-$e)+$ob;
                                        echo number_format($b,2);
                                    ?>
                                </div>
                            </th>
                            <th>บาท</th>
                        </tr>
                    </tbody>
                </table>
                <form method="post" action="balance_report.php" data-ajax="false" data-role="fieldcontain">
                    <input type="hidden" name="week" value="<?=$week_id?>">
                    <input type="hidden" name="year" value="<?=$year_id?>">
                    <button type="submit" name="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b">ออกรายงาน</button>
                </form>
            </div>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>