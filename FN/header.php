        <div data-role="header" data-position="fixed">
            <h1>ฐานข้อมูลสำหรับคริสตจักรนิมิตบ้านโฮ่ง</h1>
                <a href="#popupmenu" data-rel="popup" data-icon="bars" >เมนู</a>
                <a href="#popupsetup" data-rel="popup" data-icon="gear" data-iconpos="right"><?=$_SESSION['user_id']?> | ผู้ดูแลการเงิน</a>
        </div><!-- /header -->
        <div id="popupmenu" data-role="popup" >
                <ul data-role="listview" data-inset="true">
                    <li data-role="list-divider">เลือกเมนูเพื่อดำเนินการ</li>
                    <li><a href="donation.php" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline" data-ajax="false">บันทึกเงินถวาย</a></li>
                    <li><a href="expenses.php" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline" data-ajax="false">บันทึกรายจ่าย</a></li>
                    <li><a href="balance.php" class="ui-btn ui-icon-bullets ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปยอดเงินคงเหลือ</a></li>
                    <li><a href="balance_week.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการเงินประจำสัปดาห์</a></li>
                    <li><a href="balance_month.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการเงินประจำเดือน</a></li>
                    <li><a href="balance_year.php" class="ui-btn ui-icon-info ui-btn-icon-left ui-btn-inline" data-ajax="false">สรุปการเงินประจำปี</a></li>
                    <li><a href="donation_type.php" class="ui-btn ui-icon-gear ui-btn-icon-left ui-btn-inline" data-ajax="false">จัดการประเภทเงินถวาย</a></li>
                    <li><a href="expenses_type.php" class="ui-btn ui-icon-gear ui-btn-icon-left ui-btn-inline" data-ajax="false">จัดการประเภทค่าใช้จ่าย</a></li>
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

