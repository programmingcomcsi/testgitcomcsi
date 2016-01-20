
<meta http-equiv=Content-Type content="text/html; charset=utf-8"><?php
$host="localhost";
$user="root";
$pass="123456";
$db="registers";
$tbluser="register_tb";
	mysql_connect($host,$user,$pass)or die("ติดต่อ Database Server ไม่ได้");
	mysql_select_db($db)or die("เลือกใช้ฐานข้อมูลไม่ได้");
	function check_email($input_email){
	if(eregi("^".
		"[a-z0-9]+([_\\.-][a-z0-9]+)*".
		"@".
		"([a-z0-9]+([\.-][a-z0-9]+)*)+".
		"\\.[a-z]{2,}".
		"$",$input_email,$regs)
	){return TRUE;}else{return FALSE;}
}
	$admin_email="poomlike36@gmail.com";
	$subject_new_registers="กรุณาตรวจสอบ รายละเอียดของสมาชิกใหม่";
?>