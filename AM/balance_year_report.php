<?Php
include("mpdf/mpdf.php");
ob_start();
?>
<?
            $year_id    =   $_POST['year_id'];
            $weeek      =   $year_id;//date('Wo');//252015;
?>
<h1>คริสตจักรนิมิตบ้านโฮ่ง</h1>
<h2>สรุปยอดเงินคงเหลือ ประจำ ปี <?=$year_id?></h2>
            <table>
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
                                $sql = "SELECT * FROM donation where donation_week like '%$weeek%' AND dtype_id=$i ORDER BY `donation`.`donation_id` ASC LIMIT 15";
                                $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                $rows = mysql_fetch_array($row);
                                //
                                $sql		= "SELECT SUM(donation_amount) FROM donation where donation_week like '%$weeek%' AND dtype_id=$i";
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
                                    $sql		= "SELECT SUM(donation_amount) FROM donation where donation_week like '%$weeek%' AND dtype_id=$i";
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
                                $sql = "SELECT * FROM expenses where expenses_week like '%$weeek%' AND etype_id=$i ORDER BY `expenses`.`expenses_id` ASC LIMIT 15";
                                $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                                $rows = mysql_fetch_array($row);
                                //
                                $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_week like '%$weeek%' AND etype_id=$i";
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
                                    $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_week like '%$weeek%' AND etype_id=$i";
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
                            <td></td>
                            <th>ยอดยกมาจากปี <?=$weeek-1?></th>
                            <td>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT * FROM balance where week like '%$weeek-1%'";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        $rowbalance =mysql_fetch_array($query);
                                        {
                                            $ob=$rowbalance['balance'];
                                            echo number_format($ob,2);
                                        }
                                    ?>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>รวมยอดเงินถวาย</th>
                            <td>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT SUM(donation_amount) FROM donation where donation_week like '%$weeek%'";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        while($rowsum=mysql_fetch_array($query))
                                        {
                                            $d=$rowsum['SUM(donation_amount)'];
                                            echo number_format($d,2);
                                        }
                                    ?>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>รวมยอดค่าใช้จ่าย</th>
                            <td>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_week like '%$weeek%'";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        while($rowsum=mysql_fetch_array($query))
                                        {
                                            $e=$rowsum['SUM(expenses_amount)'];
                                            echo number_format($e,2);
                                        }
                                    ?>
                                </div>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <th>ยอดเงินคงเหลือ</th>
                            <td>
                                <div class="div2">
                                    <?
                                        $b          = ($d-$e)+$ob;
                                        echo number_format($b,2);
                                    ?>
                                </div>
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