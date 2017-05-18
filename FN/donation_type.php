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
        <h1>จัดการประเภทเงินถวาย</h1>
            <div role="main" class="ui-content">
                <a href="donation_type_add.php" class="ui-btn ui-corner-all ui-btn-b" data-ajax="false">เพิ่มประเภทเงินถวาย</a>
                <form class="ui-filterable">
                    <input id="inset-autocomplete-input" data-type="search" placeholder="ค้นหาประเภทเงินถวาย" data-ajax="false">
                </form>
                <ul data-role="listview" data-inset="true" data-filter-reveal="true" data-input="#inset-autocomplete-input" data-ajax="false">
                <?
                    include("import/dbc_connect.php");
                    $sql = "SELECT * FROM donationtype";
                    $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                    for ($i = 1; $i <= 3; $i++)
                    {
                        while($rows = mysql_fetch_array($row))
                        {
                ?>
                    <li>
                        <a href="donation_type_editing.php?dtype_id=<?=$rows["dtype_id"];?>&newuser=root" data-ajax="false">
                        <?=$i?>
                        <? echo $rows["donation_type"];?>
                                        
                        </a>
                    </li>
                <?
                        $i++;
                        }
                    }
                ?>
                </ul>
            </div>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>