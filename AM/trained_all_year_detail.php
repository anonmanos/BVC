<?
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		echo "<script>alert('!! Please Login !! ');
				window.location='../index.php';</script>";
		exit();
	}
?>
<? include("import/dbc_connect.php")?>
            <?
            $year_id    =   $_POST['year_id'];

            ?>
            <?  //นับจำนวนผู้ลงทะบียน
                                $sql1		= "SELECT * FROM courseregis where course_regisdate like '%$year_id%'";
                                $query		= mysql_query($sql1) or die("error=$sql1");
                                $re11111    = mysql_num_rows($query);
            ?>
            <?  //นับจำนวนผู้ลงทะบียน
                                $sql1		= "SELECT * FROM trained where trained_date  like '%$year_id%'";
                                $query		= mysql_query($sql1) or die("error=$sql1");
                                $re11112    = mysql_num_rows($query);
            ?>
            <?
                $re =   $re11111-$re11112;
            
            ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<? include("import.php"); ?>
    <script src="amcharts/amcharts.js" type="text/javascript"></script>
    <script src="amcharts/pie.js" type="text/javascript"></script>
    
    <script>
            var chart;
            var legend;

            var chartData = [{
                traner: "จำนวนผู้ผ่านการอบรม",
                litres: <?=$re11112?>
            }, {
                traner: "จำนวนกำลังเข้ารับอบรม",
                litres: <?=$re?>
            }];

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "traner";
                chart.valueField = "litres";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                chart.balloonText = "<span style='font-size:18px'>[[title]]<br><b>[[value]] คน</b> ([[percents]]%)</span>";


                // WRITE
                chart.write("chartdiv");
            });
        </script>
        
<body>
    <div data-role="page" class="jqm-demos" data-title="ฐานข้อมูลสำหรับคริสตจักรนิมิตบ้านโฮ่ง">
        <?  include("header.php"); ?>
        <div role="main" class="ui-content jqm-content jqm-fullwidth">
           <?  //นับจำนวนผู้ลงทะบียน
                                $sql1		= "SELECT * FROM trained where trained_date like '%$year_id%'";
                                $query		= mysql_query($sql1) or die("error=$sql1");
                                $re11111    = mysql_num_rows($query);
            ?>
            <h1>สรุปผู้ผ่านการอบรมประจำปี <?=$year_id?></h1>
            <div role="main" class="ui-content">
               <div id="chartdiv" style="width: 100%; height: 400px;"></div>
                <ol data-role="listview" data-filter="true" data-filter-placeholder="ค้นหาจากชื่อหลักสูตร" data-inset="true">
                  <li data-role="list-divider">ชื่อหลักสูตร</li>
                  
                   <?
                        $sql = "SELECT * FROM course";
                        $row = mysql_query($sql) or die ("Error Query [".$sql."]");
                        for ($i = 1; $i <= 3; $i++)
                        {
                            while($rows = mysql_fetch_array($row))
                            {
                        ?>
                        <?  //นับจำนวนผู้ลงทะบียน
                                $course_id  = $rows['course_id'];
                                $sql		= "SELECT * FROM trained WHERE course_id like '%$course_id%' and trained_date  like '%$year_id%'";
                                $query		= mysql_query($sql) or die("error=$sql");
                                $row2		= mysql_fetch_array($query);
                                $records    = mysql_num_rows($query);
                        ?>
                    <li><a href="course_profile.php?course_id=<?=$rows['course_id']?>" data-ajax="false"><?=$rows["course_name"]?><span class="ui-li-count"><?=$records?></span></a></li>
                        <?
                            $i++;
                            }
                        }
                        ?>
                </ol>
                <ul data-role="listview" data-inset="true" data-divider-theme="a">
                    <li>จำนวนผู้ผ่านการอบรม <span class="ui-li-count">จำนวน <?=$re11111?> คน</span></li>
                </ul>
            </div>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>