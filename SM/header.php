        <div data-role="header" data-position="fixed">
            <h1>ฐานข้อมูลสำหรับคริสตจักรนิมิตบ้านโฮ่ง</h1>
                <a href="#popupmenu" data-rel="popup" data-icon="bars" >เมนู</a>
                <a href="#popupsetup" data-rel="popup" data-icon="gear" data-iconpos="right"><?=$_SESSION['user_id']?> | ผู้จัดการการอบรม</a>
        </div><!-- /header -->
        <div id="popupmenu" data-role="popup" >
                <ul data-role="listview" data-inset="true">
                    <li data-role="list-divider">หลักสูตร</li>
                    <li><a href="course_add.php" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline" data-ajax="false">เพิ่มหลักสูตรการอบรม</a></li>
                    <li><a href="course.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">หลักสูตรการอบรม</a></li>
                    <li data-role="list-divider">การอบรม</li>
                    <li><a href="course_detail_register.php" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline" data-ajax="false">เพิ่มการอบรม</a></li>
                    <li><a href="course_detail.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">รายละเอียดการอบรม</a></li>
                    <li><a href="course_register_list.php" class="ui-btn ui-icon-user ui-btn-icon-left ui-btn-inline" data-ajax="false">รายชื่อผู้ลงทะเบียน</a></li>
                    <li><a href="course_register_list_delete.php" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline" data-ajax="false">ลบรายชื่อผู้ลงทะเบียน</a></li>
                    <li data-role="list-divider">ผลการอบรม</li>
                    <li><a href="training_score.php" class="ui-btn ui-icon-heart ui-btn-icon-left ui-btn-inline" data-ajax="false">ให้คะแนนการอบรม</a></li>
                    <li><a href="training_score_all.php" class="ui-btn ui-icon-star ui-btn-icon-left ui-btn-inline" data-ajax="false">ผลการอบรม</a></li>
                    <li data-role="list-divider">ตรวจสอบ</li>
                    <li><a href="trained_find.php" class="ui-btn ui-icon-search ui-btn-icon-left ui-btn-inline" data-ajax="false">ตรวจสอบผู้เข้าอบรม</a></li>
                    <li data-role="list-divider">ผู้ให้การอบรม</li>
                    <li><a href="trainer_register.php" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline" data-ajax="false">เพิ่มผู้ให้การอบรม</a></li>
                    <li><a href="trainer.php" class="ui-btn ui-icon-home ui-btn-icon-left ui-btn-inline" data-ajax="false">ผู้ให้การอบรม</a></li>
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

