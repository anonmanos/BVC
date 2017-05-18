<?Php
include("mpdf/mpdf.php");
ob_start();
?>
<h1>รายชื่อผู้ใช้งาน</h1>
            <table>
                <thead>
                    <tr class="ui-bar-d">
                        <th data-priority="1">ลำดับ</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th data-priority="2">เบอร์โทรศัพท์</th>
                        <th data-priority="3">อีเมลล์</th>
                        <th data-priority="5">วันเกิด</th>
                        <!--<th data-priority="6">ที่อยู่</th>-->
                        <th data-priority="6" >ที่อยู่</th>
                    </tr>
                </thead>
                <tbody>
                <? include("import/dbc_connect.php")?>
                <?
                    $sql = "SELECT * FROM userpro";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1;$i<=1;$i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                ?>
                    <tr>
                        <td><? echo $i;?></td>
                        <td>
                            <?  if($rows['user_nametitle']=="1") echo "นาย";
                                if($rows['user_nametitle']=="2") echo "นาง";
                                if($rows['user_nametitle']=="3") echo "นางสาว";
                                echo $rows["user_fname"]?>
                            <?  echo $rows["user_lname"]?>
                        </td>
                        <td><? echo $rows["user_cnumber"];?></td>
                        <td><? echo $rows["user_email"];?></td>
                        <td><? echo $rows["user_birthday"];?></td>
                        <!--<td><? //echo $rows["user_address"];?></td>-->
                        <td><? echo $rows["user_address"];?></td>
                    </tr>
                    <?
                        $i++;
                        }
                    }
                    ?>
                </tbody>
              </table>

<?
$html = ob_get_contents();
ob_end_clean();
$pdf=new mPDF('th','A4','0','THSaraban',32,25,27,25,16,13);
$pdf->defaultheaderfontsize = 14;	/* ขนาดตัวหนังสือหัวกระดาษ */
$pdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI รูปแบบตัวหนัวอักษร */
$pdf->defaultheaderline = 12; 	/* 1 to include line below header/above footer */
$pdf->SetDisplayMode('fullpage');
$stylesheet = file_get_contents('mpdf/examples/mpdfstyletables.css');
$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
$pdf->SetHeader('คริสตจักรนิมิตบ้านโฮ่ง||{DATE j-m-Y}');
$pdf->SetFooter('|{PAGENO}|');	/* defines footer for Odd and Even Pages - placed at Outer margin */
$pdf->WriteHTML($html, 2);
$pdf->Output();
?>