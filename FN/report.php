<?Php
include("mpdf/mpdf.php");
ob_start();
?>
<?
            $week_id    =26;//$_POST['week_id'];
            $year_id    =2015;//$_POST['year_id'];
?>
<h1>คริสตจักรนิมิตบ้านโฮ่ง</h1>
<h2>สรุปยอดเงินคงเหลือ ประจำสัปดาห์ที่ <?=$week_id?> ปี <?=$year_id?></h2>
            <table>
                <thead>
                    <tr class="ui-bar-d">
                        <h3>
                            <th style="width:14%">วันที่</th>
                            <th style="width:46%">รายการ</th>
                            <th style="width:20%"><div class="div2">จำนวนเงิน (บาท)</div></th>
                            <th style="width:15%">หมายเหตุ</th>
                        </h5>
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
                            <td></td>
                            <td><b>ยอดยกมาจากอาทิตย์ที่ <?=$dw=date('W')-1?>/<?=$do=date('o')?></b></td>
                            <td>
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
                            </td>
                            <th></th>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>รวมยอดเงินถวาย</b></td>
                            <td>
                                    <?
                                        $sql		= "SELECT SUM(donation_amount) FROM donation where donation_week=$week";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        while($rowsum=mysql_fetch_array($query))
                                        {
                                            $d=$rowsum['SUM(donation_amount)'];
                                            echo number_format($d,2);
                                        }
                                    ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>รวมยอดค่าใช้จ่าย</b></td>
                            <td>
                                    <?
                                        $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_week=$week";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        while($rowsum=mysql_fetch_array($query))
                                        {
                                            $e=$rowsum['SUM(expenses_amount)'];
                                            echo number_format($e,2);
                                        }
                                    ?>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><b>ยอดเงินคงเหลือ</b></td>
                            <td>
                                    <?
                                        $b          = ($d-$e)+$ob;
                                        echo number_format($b,2);
                                    ?>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
              </table>
<h6>ผู้ดูแลการเงิน</h6>
<p>ผู้ดูแลการเงิน (_____________________)</p><p>หัวหน้าฝ่ายการเงิน (_____________________)</p><p>ผู้บริหาร (_____________________)</p>
<?
$html = ob_get_contents();
ob_end_clean();
$pdf=new mPDF('th','A4','0','THSaraban',32,25,27,25,16,13);

$pdf->SetDisplayMode('fullpage');
$pdf->defaultheaderfontsize = 11;	/* ขนาดตัวหนังสือหัวกระดาษ */
$pdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI รูปแบบตัวหนัวอักษร */
$pdf->defaultheaderline = 12; 	/* 1 to include line below header/above footer */
$pdf->SetHeader('รายงานการเงิน||{DATE D M d Y}');
$pdf->SetFooter('รายงานการเงิน|{PAGENO}|BanHong Vision Church.');	/* defines footer for Odd and Even Pages - placed at Outer margin */

$stylesheet = file_get_contents('mpdf/examples/mpdfstyleA4.css');
$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/tex
$stylesheet2 = file_get_contents('mpdf/examples/mpdfstyletables.css');
$pdf->WriteHTML($stylesheet2,1);	// The parameter 1 tells that this is css/style only and no body/html/tex
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>