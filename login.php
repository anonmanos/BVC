<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<? include("import.php"); ?>
<body>
    <div data-role="page" class="jqm-demos" data-title="ฐานข้อมูลสำหรับคริสตจักรนิมิตบ้านโฮ่ง">
        <div data-role="header" data-position="fixed"><!-- style="overflow:hidden;"-->
        <h1>ระบบฐานข้อมูลคริสตจักรนิมิตบ้านโฮ่ง</h1>
        </div><!-- /header -->
        <div role="main" class="ui-content jqm-content jqm-fullwidth">
            <br><h1>Database System for BanHong Vision Church.</h1><br>
            <table data-role="table" id="movie-table-custom" data-mode="reflow" class="movie-list ui-responsive table-stroke">
                    <thead>
                        <tr>
                            <th style="width:25%"></th>
                            <th data-priority="1"></th>
                            <th style="width:25%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <th></th>
                          <td>
                              <form method="post" action="login_check.php" data-ajax="false" data-role="fieldcontain">
                                <div style="padding:10px 30px;">
                                    <h3>กรุณา กรอกข้อมูลผู้ใช้งานเพื่อเข้าสู่ระบบ</h3>
                                    <label for="un" class="ui-hidden-accessible">Username:</label>
                                    <input type="text" name="name" id="un" value="" placeholder="ชื่อผู้ใช้งาน" data-theme="a">
                                    <label for="pw" class="ui-hidden-accessible">Password:</label>
                                    <input type="password" name="password" id="pw" value="" placeholder="รหัสผ่าน" data-theme="a">
                                    <button type="submit" name="submit" class="ui-btn ui-corner-all ui-shadow ui-btn-b">เข้าสู่ระบบ</button>
                                </div>
                            </form>
                          </td>
                          <td></td>
                        </tr>
                </tbody>
            </table>
        </div><!-- /content -->
        <div data-role="footer" data-position="fixed">
            <h4>Development of database system for BanHong Vision Church.</h4>
        </div><!-- /footer -->
    </div><!-- /panel -->
</body>
</html>