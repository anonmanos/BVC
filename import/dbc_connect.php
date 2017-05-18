<?PHP
  	// 1.	เชื่อมต่อเซิร์ฟเวอร์ MySQL
	$conn 	= mysql_connect("localhost","root","vk00mNlo")or die(mysql_error());
	// 2.	เลือกฐานข้อมูลที่ต้องการใช้งาน 
	$db		= mysql_select_db("DBC")or die("cannot select DB");
	mysql_query("SET NAMES UTF8"); 
?>