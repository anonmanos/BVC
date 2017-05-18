        <div data-role="header" data-position="fixed">
            <h1>ฐานข้อมูลสำหรับคริสตจักรนิมิตบ้านโฮ่ง</h1>
                <a href="#popupmenu" data-rel="popup" data-icon="bars" >เมนู</a>
                <a href="#popupsetup" data-rel="popup" data-icon="gear" data-iconpos="right"><?=$_SESSION['user_id']?> | ผู้ดูแลข้อมูลสมาชิก</a>
        </div><!-- /header -->
        <div id="popupmenu" data-role="popup" >
                <ul data-role="listview" data-inset="true">
                    <li data-role="list-divider">เลือกเมนูเพื่อดำเนินการ</li>
                    <li><a href="index.php" class="ui-btn ui-icon-home ui-btn-icon-left ui-btn-inline" data-ajax="false">หน้าหลัก</a></li>
                    <li><a href="member_find.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">ค้นหาสมาชิก</a></li>
                    <li><a href="member_list.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">รายชื่อสมาชิก</a></li>
                    <!--<li><a href="member_edit.php" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline" data-ajax="false">แก้ไขข้อมูลสมาชิก</a></li>-->
                    <li><a href="member_register.php" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline" data-ajax="false">เพิ่มสมาชิก</a></li>
                    <!--<li><a href="member_delete.php" class="ui-btn ui-icon-delete ui-btn-icon-left ui-btn-inline" data-ajax="false">ลบสมาชิก</a></li>-->
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

