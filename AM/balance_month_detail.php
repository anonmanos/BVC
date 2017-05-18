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
            $month_idd  =   $_POST['month_id'];
            $year_id    =   $_POST['year_id'];
            if($month_idd<=9)
            {
                $month_id   =   '0'.$month_idd;
                $ym         =   $year_id.'-'.$month_id;//date('Wo');//252015;
            }else
            {
                $ym         =   $year_id.'-'.$month_idd;//date('Wo');//252015;
            }
            $mname = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
        ?>
        <h1>สรุปยอดเงินคงเหลือ ประจำเดือน <?=$mname[$month_idd]?> ปี <?=$year_id?></h1>
            <div role="main" class="ui-content">
                <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-popup-theme="a">
                    <thead>
                        <tr class="ui-bar-d">
                            <th style="width:3%">ประเภท</th>
                            <th style="width:40%">รายการ</th>
                            <th style="width:20%"><div class="div2">จำนวนเงิน (บาท)</div></th>
                            <th style="width:15%">หมายเหตุ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            //เงินถวายทั้งหมด
                            include("import/dbc_connect.php");
                            $sql		= "SELECT MAX(dtype_id) AS max_dtype_id FROM donation";
                            $query		= mysql_query($sql) or die("error=$sql");
                            $rowmax     = mysql_fetch_array($query);
                            $maxdtype_id=$rowmax['max_dtype_id'];
                            //
                            for ($i = 1; $i <= $maxdtype_id; $i++)
                            {
                                $sql = "SELECT * FROM donation where donation_date like '%$ym%' AND dtype_id=$i ORDER BY `donation`.`donation_id` ASC LIMIT 15";
                                $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                $rows = mysql_fetch_array($row);
                                //
                                $sql		= "SELECT SUM(donation_amount) FROM donation where donation_date like '%$ym%' AND dtype_id=$i";
                                $query		= mysql_query($sql) or die("error=$sql");
                                while($rowty=mysql_fetch_array($query))
                                {
                                    $dty=$rowty['SUM(donation_amount)'];
                                }
                                    if(empty($dty)||$dty=="")
                                    {
                                    }else{
                        ?>
                        <tr>
                            <td><?='D'.$i?></td>
                            <td>
                            <?
                                    $sql1 = "SELECT * FROM donationtype where dtype_id=$i";
                                    $row1 = mysql_query($sql1) or die ("Error Query [".$sql."]");
                                    $rowss = mysql_fetch_array($row1);
                                    echo $rowss["donation_type"];
                            ?>
                            </td>
                            <?
                                    $sql		= "SELECT SUM(donation_amount) FROM donation where donation_date like '%$ym%' AND dtype_id=$i";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    while($rowdty=mysql_fetch_array($query))
                                    {
                                                $dty=$rowdty['SUM(donation_amount)'];
                                    }
                            ?>
                            <td><div class="div2"><? echo number_format($dty,2);?></div></td>
                            <td></td>
                        </tr>
                        <?
                                }
                            }
                        ?>
                        <?
                            //ค่าใช้จ่าย
                            $sql		= "SELECT MAX(etype_id) AS max_etype_id FROM expenses";
                            $query		= mysql_query($sql) or die("error=$sql");
                            $rowmaxe     = mysql_fetch_array($query);
                            $maxetype_id=$rowmaxe['max_etype_id'];
                            //
                            for ($i = 1; $i <= $maxetype_id; $i++)
                            {
                                $sql = "SELECT * FROM expenses where expenses_date like '%$ym%' AND etype_id=$i ORDER BY `expenses`.`expenses_id` ASC LIMIT 15";
                                $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                $rows = mysql_fetch_array($row);
                                //
                                $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_date like '%$ym%' AND etype_id=$i";
                                $query		= mysql_query($sql) or die("error=$sql");
                                while($rowety=mysql_fetch_array($query))
                                {
                                    $ety=$rowety['SUM(expenses_amount)'];
                                }
                                    if(empty($ety)||$ety=="")
                                    {
                                    }else{
                        ?>
                        <tr>
                            <td><?='E'.$i?></td>
                            <td>
                            <?
                                    $sql1 = "SELECT * FROM expensestype where etype_id=$i";
                                    $row1 = mysql_query($sql1) or die ("Error Query [".$sql."]");
                                    $rowss = mysql_fetch_array($row1);
                                    echo $rowss["expenses_type"];
                            ?>
                            </td>
                            <?
                                    $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_date like '%$ym%' AND etype_id=$i";
                                    $query		= mysql_query($sql) or die("error=$sql");
                                    while($rowety=mysql_fetch_array($query))
                                    {
                                                $ety=$rowety['SUM(expenses_amount)'];
                                    }
                            ?>
                            <td><div class="div2"><? echo number_format($ety,2);?></div></td>
                            <td></td>
                        </tr>
                        <?
                                }
                            }
                        ?>
                        <tr>
                            <th></th>
                            <?
                                if ($month_idd<='1')
                                {
                                    $y          = $year_id-'1';
                                    $m          = '12';
                                    $ymm        = $y.'-'.$m.'-';
                                }else
                                {
                                    $y          = $year_id;
                                    $m          = $month_idd-1;
                                    if($month_idd>='10')
                                    {
                                        $ymm        = $y.'-'.$m.'-';
                                    }
                                    else
                                    {
                                        $ymm        = $y.'-'.'0'.$m.'-';
                                    }
                                }
                            ?>
                            <th>ยอดยกมาจากเดือน <?=$mname[$m]?> ปี <?=$y?></th>
                            <th>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT * FROM balance where date like '%$ymm%' ORDER BY `date` DESC LIMIT 1";
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
                                        $sql		= "SELECT SUM(donation_amount) FROM donation where donation_date like '%$ym%'";
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
                                        $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_date like '%$ym%'";
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
                <form method="post" action="balance_month_report.php" data-ajax="false" data-role="fieldcontain">
                    <input type="hidden" name="month" value="<?=$month_idd?>">
                    <input type="hidden" name="year" value="<?=$year_id?>">
                    <button type="submit" name="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b">ออกรายงาน</button>
                </form>
            </div>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>