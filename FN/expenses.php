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
        <h1>รายการค่าใช้จ่าย ประจำอาทิตย์ที่ <?=date('W')?> ปี <?=date('o')?></h1>
            <div role="main" class="ui-content">
                <a href="expenses_add.php" class="ui-btn ui-corner-all ui-btn-b" data-ajax="false">เพิ่มรายการค่าใช้จ่าย</a>
                <table data-role="table" id="table-custom-2" class="ui-body-d ui-shadow table-stripe ui-responsive" data-column-popup-theme="a">
                    <thead>
                        <tr class="ui-bar-d">
                            <th style="width:15%">วันที่</th>
                            <th style="width:45%">รายการ</th>
                            <th style="width:10%"><div class="div2">จำนวน</div></th>
                            <th style="width:25%">หมายเหตุ</th>
                            <th style="width:5%">แก้ไข</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                            include("import/dbc_connect.php");
                            $week   =   date('Wo');
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
                            <td><? if($week==$w)
                                    {
                                ?>
                                <a href="expenses_editing.php?edit_id=<?=$rows["expenses_id"]?>" data-ajax="false">Edit</a></td>
                        </tr>
                                <?  }?>
                        </tr>
                        <?
                            }
                        ?>
                        <tr>
                            <th></th>
                            <th>รวมยอดค่าใช้จ่ายทั้งหมด</th>
                            <th>
                                <div class="div2">
                                    <?
                                        $sql		= "SELECT SUM(expenses_amount) FROM expenses where expenses_week=$week";
                                        $query		= mysql_query($sql) or die("error=$sql");
                                        while($rowsum=mysql_fetch_array($query))
                                        {
                                        echo number_format($rowsum['SUM(expenses_amount)'],2);
                                        }
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