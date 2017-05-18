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
            <h1>สรุปผู้ลงทะเบียนเข้ารับการอบรมประจำปี</h1>
            <div role="main" class="ui-content">
                <form method="post" action="course_all_year_detail.php" data-ajax="false" data-role="fieldcontain">
                <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                    <thead>
                        <tr>
                            <th style="width:25%"></th>
                            <th data-priority="1"></th>
                            <th style="width:25%"></th>
                        </tr>
                    </thead>
                    
                        <tr>
                            <th></th>
                            <td>
                            <select name="year_id" id="year_id" data-native-menu="false">
                                <? for($i=date("Y");$i>=date("Y")-10;$i--){ ?>
                                <option value="<?=$i?>">ปี <?=$i?></option>
                                <? } ?>
                            </select> 
                            </td>
                          <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                            <button type="submit" name="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b">ยืนยัน</button>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>  
                </table>
            </div>
        </div><!-- /panel -->
    <?  include("footer.php"); ?>
    </div>
</body>
</html>