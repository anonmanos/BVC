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
            <h1>รายการเงินถวาย ประจำอาทิตย์ที่ <?=date('W')?> ปี <?=date('o')?></h1>
            <div role="main" class="ui-content">
                <a href="donation_add.php" class="ui-btn ui-corner-all ui-btn-b" data-ajax="false">เพิ่มรายการเงินถวาย</a>
                <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-popup-theme="a">
                    <thead>
                        <tr class="ui-bar-d">
                            <th style="width:15%">วันที่</th>
                            <th style="width:40%">รายการ</th>
                            <th style="width:15%"><div class="div2">จำนวนเงิน</div></th>
                            <th style="width:25%">หมายเหตุ</th>
                            <th style="width:5%">แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            include("import/dbc_connect.php");
                            $week   =   date('Wo');//252015;
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
                            <td><div class="div2"><? echo number_format($rows["donation_amount"],2);?></div></td>
                            <td><? echo $rows["donation_note"];?></td>
                            <td>
                                <? if($week==$w)
                                    {
                                ?>
                                <a href="donation_editing.php?edit_id=<?=$rows["donation_id"]?>" data-ajax="false">Edit</a></td>
                        </tr>
                                <?  }?>
                        <?
                            }
                        ?>
                        <tr>
                            <th></th>
                            <th>รวมยอดเงินถวายทั้งหมด</th>
                            <th>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT donation_week,SUM(donation_amount) FROM donation where donation_week=$week";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        $rowsum=mysql_fetch_array($query);
                                        
                                        echo number_format($rowsum['SUM(donation_amount)'],2);
                                        
                                    ?>
                                </div>
                            </th>
                            <th>บาท</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>