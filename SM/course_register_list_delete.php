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
            <h1>เลือก หรือ ค้นหา ลบผู้ลงทะเบียน</h1>
            <form class="ui-filterable">
                <input id="inset-autocomplete-input" data-type="search" placeholder="ค้นหาหลักสูตร" data-ajax="false">
            </form>
            <ul data-role="listview" data-filter="true" data-inset="true" data-input="#inset-autocomplete-input">
            <? include("import/dbc_connect.php")?>
                <?
                $sql = "SELECT * FROM coursedetail";
                $roww = mysql_query($sql) or die ("Error Query [".$sql."]");
                for ($i = 1; $i <= 3; $i++)
                {
                    while($rows = mysql_fetch_array($roww))
                    {
                ?>
                <li>
                    <a href="course_register_list_deleting.php?course_detail_id=<?=$rows['course_detail_id']?>" data-ajax="false">
                        รหัสการอบรม
                        <?=$rows['course_detail_id']?>
                        <?      
                                $course_id  =$rows["course_id"];
                                $sql		= "select * from course where course_id='$course_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row		= mysql_fetch_array($query);
                        ?>
                        หลักสูตร
                        <?=$row['course_name']?>
                        <?      
                                $trainer_id  =$rows['trainer_id'];
                                $sql		= "select * from trainer where trainer_id='$trainer_id'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row3		= mysql_fetch_array($query);
                        ?>
                        ผู้ให้การอบรม
                        <?  if($row3['trainer_nametitle']=="1")echo "นาย";?>
                        <?  if($row3['trainer_nametitle']=="2")echo "นาง";?>
                        <?  if($row3['trainer_nametitle']=="3")echo "นางสาว";?>
                        <?=$row3['trainer_fname']?>
                        <?=$row3['trainer_lname']?>
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