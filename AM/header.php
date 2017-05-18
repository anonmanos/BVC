        <div data-role="header" data-position="fixed">
            <h1>ฐานข้อมูลสำหรับคริสตจักรนิมิตบ้านโฮ่ง</h1>
                <a href="#popupmenu" data-rel="popup" data-icon="bars" >เมนู</a>
                <a href="#popupsetup" data-rel="popup" data-icon="gear" data-iconpos="right"><?=$_SESSION['user_id']?> | ผู้บริหาร</a>
        </div><!-- /header -->
        <div id="popupmenu" data-role="popup" >
                <ul data-role="listview" data-inset="true">
                    <li data-role="list-divider">การอบรม</li>
                    <li><a href="course.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">หลักสูตรการอบรม</a></li>
                    <li><a href="course_detail.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">รายละเอียดการอบรม</a></li>
                    <li><a href="course_register_list.php" class="ui-btn ui-icon-user ui-btn-icon-left ui-btn-inline" data-ajax="false">รายชื่อผู้ลงทะเบียน</a></li>
                    <li><a href="training_score_all.php" class="ui-btn ui-icon-star ui-btn-icon-left ui-btn-inline" data-ajax="false">ผลการอบรม</a></li>
                    <li><a href="trained_find.php" class="ui-btn ui-icon-search ui-btn-icon-left ui-btn-inline" data-ajax="false">ตรวจสอบผู้เข้าอบรม</a></li>
                    <li><a href="trainer.php" class="ui-btn ui-icon-home ui-btn-icon-left ui-btn-inline" data-ajax="false">ผู้ให้การอบรม</a></li>
                    <li data-role="list-divider">สรุปการอบรม</li>
                    <li><a href="course_regis_all.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการลงทะเบียนเข้าอบรมแต่ละหลักสูตร</a></li>
                    <li><a href="trained_all.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปผู้ผ่านการอบรม</a></li>
                    <li><a href="course_all_year.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการลงทะเบียนเข้าอบรมแต่ละหลักสูตรประจำปี</a></li>
                    <li><a href="trained_all_year.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปผู้ผ่านการอบรมประจำปี</a></li>
                    <li data-role="list-divider">การเงิน</li>
                    <li><a href="balance.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปยอดเงินคงเหลือ</a></li>
                    
                    <li><a href="balance_week.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการเงินประจำสัปดาห์</a></li>
                    <li><a href="balance_month.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการเงินประจำเดือน</a></li>
                    <li><a href="balance_year.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการเงินประจำปี</a></li>
                </ul>
        </div>
        <div id="popupsetup" data-role="popup" >
                <ul data-role="listview" data-inset="true">
                    <li data-role="list-divider">เลือกเมนูเพื่อดำเนินการ</li>
                    <li><a href="user_profile.php" class="ui-btn ui-icon-user ui-btn-icon-left ui-btn-inline" data-transition="pop" data-ajax="false">ข้อมูลส่วนตัว</a></li>
                    <li><a href="user_profile_edit.php" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline" data-transition="pop" data-ajax="false">แก้ไขข้อมูลส่วนตัว</a></li>
                    <li><a href="user_password_edit.php" class="ui-btn ui-icon-recycle ui-btn-icon-left ui-btn-inline" data-transition="pop" data-ajax="false">เปลี่ยนรหัสผ่าน</a></li>
                    <li><a href="logout.php" class="ui-btn ui-icon-power ui-btn-icon-left ui-btn-inline" data-transition="pop" data-ajax="false">ออกจากระบบ</a></li>
                </ul>
        </div>

