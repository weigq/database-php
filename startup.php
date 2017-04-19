<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	error_reporting(0);
	if(!$_POST['admin'])					
	{
		echo "<html>";
		echo "<head>";
		echo "<title>Weigq-Blog</title>";
		echo "</head>";


		echo "<body>";

		echo "<script language=\"javascript\">";
		echo "function juge(theForm)";
		echo "{";
		echo "if (theForm.admin.value == \"\")";
		echo "{";
		echo "alert(\"博主名不能为空\");";
		echo "theForm.admin.focus();";
		echo "return (false);";
		echo "}";
		echo "if (theForm.pass.value == \"\")";
		echo "{";
		echo "alert(\"密码不能为空\");";
		echo "theForm.pass.focus();";
		echo "return (false);";
		echo "}";
		echo "if (theForm.pass.value.length < 6 )";
		echo "{";
		echo "alert(\"密码至少要6位！\");";
		echo "theForm.pass.focus();";
		echo "return (false);";
		echo "}";
		echo "if (theForm.re_pass.value !=theForm.pass.value)";
		echo "{";
		echo "alert(\"确认密码与密码不一致！\");";
		echo "theForm.re_pass.focus();";
		echo "return (false);";
		echo "}";
		echo "if (theForm.nickname.value == \"\")";
		echo "{";
		echo "alert(\"博客名不能为空\");";
		echo "theForm.nickname.focus();";
		echo "return (false);";
		echo "}";
		echo "}";
		echo "</script>";


		echo "<style type=\"text/css\">";
		echo "a:hover { color: #F44336; text-decoration: underline}";
		echo "<!-- ";
		echo ".ss{
			box-shadow: 0 0 9px  4px #b0bec5;}";
		echo "-->";
		echo "<!-- ";
		echo ".ss2{
			box-shadow: 0 0 7px  3px #b0bec5;}";
		echo "-->";
		echo "</style>";

		echo "<center>";

		echo "<td width=\"70%\">";
		echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"60%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">博客安装</font></strong></center></td>";
		echo "</tr>";

		echo "</td>";
		echo "</table>";
		echo "<p>";
		echo "<br>";


		echo "<td width=\"70%\">";
		echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"57%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";


		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">博主(后台登录用)</font></center></td>";
		echo "<td bgcolor=\"#2196F3\"><center><input type=\"text\" name=\"admin\"></center></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">博客名(前台显示)</font></center></td>";
		echo "<td bgcolor=\"#2196F3\"><center><input type=\"text\" name=\"nickname\"></center></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">密码(至少6位)</font></center></td>";
		echo "<td bgcolor=\"#2196F3\"><center><input type=\"password\" name=\"pass\"></center></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">确认密码</font></center></td>";
		echo "<td bgcolor=\"#2196F3\"><center><input type=\"password\" name=\"re_pass\"></center></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">email</font></center></td>";
		echo "<td bgcolor=\"#2196F3\"><center><input type=\"text\" name=\"email\"></center></td>";
		echo "</tr>";

		echo "</center></td>";
	   	echo "</table>";
		echo "</center>";
		echo "<tr>";
		echo "<td bgcolor=\"#ffffff\" colspan=\"3\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";
		echo "</form>";
		echo "</body>";
		echo "<html>";
	}



	else									
	{
		$username=$_POST['admin'];			
		$password=md5($_POST['pass']);
		$nickname=$_POST['nickname'];
		$email=$_POST['email'];
		require "conf.php";
		$link=mysql_connect($host,$user,$pass) or die(mysql_error());
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");

		
		$sql="create table $table_blog(
		id int(5) not null auto_increment primary key,
		p_id int(5) not null default 0,
		title varchar(40) not null default '',
		content text,
		sort varchar(20) not null default '',
		views int(5) not null default 0,
		tbcount int(5) not null default 0,
		author varchar(40) not null default '',
		date varchar(20) not null default ''
		)character set = utf8";
		mysql_query($sql,$link) or die(mysql_error());	


		$sql="create table $table_user(
		id int(5) not null auto_increment primary key,
		username varchar(40) not null default '',
		password varchar(40) not null default '',
		admin enum('1','0') not null default '0',
		nickname varchar(20) not null default '',
		photo varchar(80) not null default '',
		email varchar(60) not null default '',
		description varchar(60) not null default ''
		)character set = utf8";
		mysql_query($sql,$link) or die(mysql_error());	

		$sql="create table $table_note(
		id int(5) not null auto_increment primary key,
		content text,
		author varchar(40) not null default '',
		date varchar(30) not null default ''
		)character set = utf8";
		mysql_query($sql,$link) or die(mysql_error());	


		$sql="create table $table_ctg(
		id int(5) not null auto_increment primary key,
		sortname varchar(20) not null default '',
		sortnum int(5) not null default 0
		)character set = utf8";
		mysql_query($sql,$link) or die(mysql_error());	
		$sql="insert into $table_ctg(sortname)values('default')";
		mysql_query($sql,$link) or die(mysql_error());	
		$sql="insert into $table_user(username,password,admin,nickname,email,description)values('$username','$password','1','$nickname','$email','这是博主的个性签名')";
		mysql_query($sql,$link) or die(mysql_error());	


		echo "<html>";
		echo "<head>";
		echo "<title>Weigq-Blog</title>";
		echo "</head>";

		echo "<body>";
		echo "<style type=\"text/css\">";
		echo "a:hover { color: #F44336; text-decoration: underline}";
		echo "<!-- ";
		echo ".ss{
			box-shadow: 0 0 9px  4px #b0bec5;}";
		echo "-->";
		echo "<!-- ";
		echo ".ss2{
			box-shadow: 0 0 7px  3px #b0bec5;}";
		echo "-->";
		echo "</style>";

		echo "<center>";

		echo "<td width=\"70%\">";
		echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"60%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">安装成功</font></strong></center></td>";
		echo "</tr>";

		echo "</td>";
		echo "</table>";
		echo "<p>";
		echo "<br>";


		echo "<td width=\"70%\">";
		echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"57%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";

		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><a href=\"mainpage.php\">登录</a></center></td>";
		echo "</tr>";

		echo "</table>";
		echo "</center>";
		echo "</body>";
		echo "</html>";
	}
?>
