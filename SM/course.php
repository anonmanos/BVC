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
        <div role="main" class="ui-content  jqm-fullwidth jqm-content">
            <h1>เลือก หรือ ค้นหาข้อมูลหลักสูตรการอบรม</h1>
            <form class="ui-filterable">
                <input id="inset-autocomplete-input" data-type="search" placeholder="ค้นหาหลักสูตร" data-ajax="false">
            </form>
            <ul data-role="listview" data-filter="true" data-inset="true" data-input="#inset-autocomplete-input" data-ajax="false">
            <? include("import/dbc_connect.php")?>
                <?
                $sql = "SELECT * FROM course";
                 $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                for ($i = 1; $i <= 3; $i++)
                {
                    while($rows = mysql_fetch_array($row))
                    {
                ?>
                <li>
                    <a href="course_profile.php?course_id=<?=$rows['course_id']?>" data-ajax="false">
                    <?  echo $rows["course_id"];?>
                    <?  echo $rows["course_name"]?>
                    </a>
                </li>
                <?
                    $i++;
                    }
                }
                ?>
            </ul>
        </div><!-- /panel -->
        <?  include("footer.php"); ?>
    </div>
</body>
</html>