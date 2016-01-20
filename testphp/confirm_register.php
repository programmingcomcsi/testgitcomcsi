<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<?php
	include("Config.inc.php");
	if($name==""||$email==""||$username==""||$password==""||$confirm_pass==""){
		echo"<table width=550 align=center>";
		echo"<tr><td align=center bgcolor=‪#‎EAECEA‬><br><b>กรุณากราอกข้อมูลให้ครบ</b><br>";
		echo"<a href=javascripthistory.back()>กลับไปแก้ไข</a><br><br>";
		echo"</td></tr>";
		echo"</table>"; 
	}else{
		$SQL_check_registers="select username from $register_tb where username='$username'";
		$resulf=mysql_query($SQL_check_registers);
		$numrow=mysql_num_rows($result);
	if($numrow=0){
		
		echo"<table width=550 align=center>";
		echo"<tr><td align=center bgcolor=#EAECEA><br>ชื่อผู้ใช้<b><font color=red>/$username</b>ชื่อนี้มีอยู่ในระบบแล้ว<br>";
		echo"<a href=javascript:history.back():>กลับไปแก้ไข</a>";
		echo"</tb></tr>";
		echo"</table>";
		exit();
	}
	else if(check_email($email)){
		if($password<>$confirm_pass){
		echo"<table width=550 align=center>";
		echo"<tr><td align=center bgcolor=#EAECEA><br><b>รหัสผ่านไม่ตรงกันแก้ไขใหม่ครับ";
		echo"</td></tr>";
		echo"</table>";
		exit();
	}
	else{
		$date_register=date('IF,Y');
		$SQL_insert_member="insert into $tbluser(name,username,password,date,status)values ('$name'.'$email'.'$username'.'$password'.'$date_register'.'0')";
		mysql_db_query($db,$SQL_insert_member);
		echo"<table width=550 align=center>";
		echo"<tr><td align=center bgcolor=#EAECEA><b>เพิ่มข้อมูลของคุณ<font color=red>$name</font>เรียบร้อยแล้วครับ</a></td></tr>";
		echo"<tr><td align=center><br>กรุณารอผู้ดูแลระบบตรวจสอบข้อมทูลของคุณ<font color=red>$name</font><br>";
		echo"หลังจากนั้นทางผู้ดูแลระบบได้<font color=red> Active </font>สถานะของคุณแล้ว จะดำเนินการ<br>";
		echo"ติดต่อกลับทางอีเมลล์ โดยให้คุณนำเอา<font color=red>ชื่อเข้าระบบและ รหัสผ่าน</font><br>";
		echo"ที่คุณสมัครไว้ มาใช้เข้าระบบได้ทันที<br><br></td></tr>";
		echo"<tr><td align=center>";
		echo"<font color=red><b>การส่งเมลล์แจ้งเตือน Adminstrator</br></font><br>";
///////////////////////////////ส่งเมลล์แจ้งเตือน admin ผู้ดูแลระบบ/////////////////////////////////////////////
		$html="<html>";
		$html="<head><title>สมาชิก</head>";
		$html="<body>";
		$html="<b>มีสมาชิกใหม่โปรดกรุณาตรสวจสอบข้อมูล<b><br>";
		$html="ชื่อสมาชิก : $name<br>";
		$html="ชื่อเข้าระบบ : $username<br>";
		$html="รหัสผ่าน : $password<br>";
		$html="อีเมลล์ที่ใช้ในหารสมัคร : $email<br>";
		$html="วันที่สมัคร : $date_register<br>";
		$html="สถานะ : รอตรวจสอบ<br>";
		$html="</body>";
		$html="</html>";
		$boundary=uniqid("");
		$header="From $email\n";
		$header="Content-type:multipart/mixed: boundary=\"$boundary\"\n";
		$body="_$boundary\n";
		$body="Content-type:text/html:cherset-windows-874:\n";
		$body="Content-disposition:inline:\n";
		$body="Content-transfer-encoding:8bit\n\n";
		$body="$html\n";
		$body="-boundary-\n";
	if(mail($admin_email,$subject_new_registers,$body,$header)){
		echo"ส่งอีเมลล์แจ้งถึงผู้ดุแลระบบให้ตรวจสอบข้อมูลของคุณ<font color=red>$name</font>เรียบร้อยแล้วครับ";
	}else{
		echo"</td></tr>";
		echo"<tr><td align=center bgcolor=#EAECEA><a href=javascript.windows-close():>ปิดหน้านี้</a></td></tr>";
		echo"</table>";
		mysql_close();
	}
	}
	}else{
		echo"<table width=550 align=center>";
		echo"<tr><td align=center bgcolor=#EAECEA><br><b>";
		echo"รูปแบบ Email ที่คุณป้อนมารูปแบบ<font color=red><b>ไม่ถูกต้องครับ</b></font><br>";
		echo"<a href=javascripthistory.back():>กลับไปแก้ไข</a>";
		echo"<br><br></td></tr>";
		echo"</table>";
	exit();
	}	
}
?>