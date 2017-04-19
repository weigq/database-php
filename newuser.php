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
		echo "alert(\"用户名不能为空！\");";
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
		echo "alert(\"昵称不能为空\");";
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
		echo "<table cellpadding=\"8\" cellspacing=\"0\" width=\"53%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<p>";

		echo "<tr><td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">新用户注册</font></strong></center></	td></tr>";
		echo "</td></table>";
		echo "<p>";
		echo "<br>";

		echo "<td width=\"70%\">";
		echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"47%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";


		echo "<tr  bgcolor=\"#2196F3\">";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">用户名</font></center></td>";
		echo "<td><center><input type=\"text\" name=\"admin\"></center></td>";
		echo "</tr>";

		echo "<tr bgcolor=\"#2196F3\">";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">显示昵称</font></center></td>";
		echo "<td><center><input type=\"text\" name=\"nickname\"></center></td>";
		echo "</tr>";


		echo "<tr bgcolor=\"#2196F3\">";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">密码</font></center></td>";
		echo "<td><center><input type=\"password\" name=\"pass\" size=\"20\"></center></td>";
		echo "</tr>";

		echo "<tr bgcolor=\"#2196F3\">";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">再次输入密码</font></center></td>";
		echo "<td><center><input type=\"password\" name=\"re_pass\" size=\"20\"></center></td>";
		echo "</tr>";

		echo "<tr bgcolor=\"#2196F3\">";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">email</font></center></td>";
		echo "<td><center><input type=\"text\" name=\"email\"></center></td>";
		echo "</tr>";

		echo "<tr bgcolor=\"#2196F3\">";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">个性签名</font></center></td>";
		echo "<td><center><textarea rows=\"5\" cols=\"30\" name=\"description\"></textarea></center></td>";
		echo "</tr>";

		echo "</table>";
		echo "</center>";

		echo "<tr><td bgcolor=\"#ffffff\" colspan=\"3\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";
		echo "</form>";
		echo "</table>";
		echo "</center>";
		echo "</body>";
		echo "<html>";
	}
	else
	{
		$username=$_POST['admin'];
		$password=md5($_POST['pass']);
		$nickname=$_POST['nickname'];
		$email=$_POST['email'];
		$description=$_POST['description'];
		require "conf.php";
		$link=mysql_connect($host,$user,$pass) or die(mysql_error());
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");
		$sql="select username from $table_user where username='$username'";
		$result=mysql_query($sql,$link);
		$nums=mysql_num_rows($result);

		//验证是否存在同名用户
		if($nums!=0) echo "用户名已经存在!点<a href='#' onclick=history.go(-1)>请返回</a>";
		else
		{
			$sql="insert into $table_user(username,password,nickname,email,description)values('$username','$password','$nickname','$email','$description')";
			mysql_query($sql,$link) or die(mysql_error());
			echo "<html>";
			echo "<head>";

			echo "<style type=\"text/css\">";
			echo "a {  font-size: 20px; text-decoration: none; color: #ffffff}";//超链css定义
			echo "a:hover { color: #F44336; text-decoration: underline}";
			echo "</style>";

			echo "<title>WeigqBlog</title>";
			echo "</head>";


			echo "<body>";
			echo "</center>";
			//echo "<strong><center><font color=\"#f44336\" size = \"5\">注册新用户</font></center></strong>";
			echo "<br>";

			echo "<table width=\"50%\" cellpadding=\"5	\" cellspacing=\"5\" align=\"center\" bgcolor=\"#ffffff\">";

			echo "<tr bgcolor=\"#2196F3\">";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">已成功注册，请</font><a href=\"login.php\" >登录</a></center></td>";
			echo "</tr>";

			echo "</table>";
			echo "</center>";
			echo "</body>";
			echo "</html>";
		}
	}
?>
