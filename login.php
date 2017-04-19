<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	//////////////已无bug//////////
	////////×××××××××××××××××/////
	error_reporting(0);
	//用户登陆
	if(!$_POST['username'])
	{
		echo "<html>";
		echo "<body leftmargin=\"0\" topmargin=\"0\">";
		echo "<center>";
		require "header.php";

		echo "<script language=\"javascript\">";
		echo "function juge(theForm)";
		echo "{";
		echo "if (theForm.username.value == \"\")";
		echo "{";
		echo "alert(\"请输入用户名！\");";
		echo "theForm.admin.focus();";
		echo "return (false);";
		echo "}";
		echo "if (theForm.password.value == \"\")";
		echo "{";
		echo "alert(\"请输入密码！\");";
		echo "theForm.pass.focus();";
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

		echo "<tr><td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">博主/用户登录</font></strong></center></	td></tr>";
		echo "</td></table>";
		echo "<p>";
		echo "<br>";

		echo "<td width=\"70%\">";
		echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"47%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";


		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">用户名</font></center></td>";
		echo "<td bgcolor=\"#2196F3\"><center><input type=\"text\" name=\"username\"></center></td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">密码</font></center></td>";
		echo "<td bgcolor=\"#2196F3\"><center><input type=\"password\" name=\"password\"></center></td>";
		echo "</tr>";

		echo "</table>";
		echo "</center>";

		echo "<tr><td bgcolor=\"#ffffff\" colspan=\"3\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";
		echo "</form>";
		echo "</body>";
		echo "<html>";
	}


	//用户已登陆
	else
	{
		$username=$_POST['username'];
		$password=md5($_POST['password']);
		require "conf.php";
		$link=mysql_connect($host,$user,$pass);
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");

		$sql="select * from $table_user where username='$username' and password='$password'";
		$result=mysql_query($sql,$link) or die(mysql_error());
		$row=mysql_num_rows($result);

		//没有用户存在
		if($row<1)
		{
			require "header.php";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=login.php\">";
			echo "<font align=\"center\" color=\"#2196F3\" size=\"6\">用户名或密码错误!</font>";
		}


		else
		{
			setcookie("username",$username);	//设置cookie

			echo "<html>";
			echo "<body leftmargin=\"0\" topmargin=\"0\">";
			echo "<center>";
			require "header.php";
			echo "<table width=\"100%\" cellspacing=\"0\" bgcolor=\"#ffffff\" border=\"0\">";

			//左边兰
			echo "<tr><td valign=\"top\" width=\"33%\">";
			$rows=mysql_fetch_array($result);
			echo "<table cellpadding=\"7\" cellspacing=\"1\" align=\"left\" bgcolor=\"#ffffff\">";

			echo "<tr><td bgcolor=\"#2196F3\">";
			echo "<a href=\"infochg.php\" target=\"fram\"><font size=\"4\">用户信息>></font></a>";
			echo "</td></tr>";

			//管理员选项
			if($rows['admin']=="1")
			{
				echo "<tr><td bgcolor=\"#2196F3\"><a href=newblog.php target=\"fram\"><font size=\"4\">发表博客>></font></a></td></tr>";
				echo "<tr><td bgcolor=\"#2196F3\"><a href=blogchg.php target=\"fram\"><font size=\"4\">博客管理>></font></a></td></tr>";
				echo "<tr><td bgcolor=\"#2196F3\"><a href=newctg.php target=\"fram\"><font size=\"4\">添加标签>></font></a></td></tr>";
				echo "<tr><td bgcolor=\"#2196F3\"><a href=ctgchg.php target=\"fram\"><font size=\"4\">标签管理>></font></a></td></tr>";
				echo "<tr><td bgcolor=\"#2196F3\"><a href=userchg.php target=\"fram\"><font size=\"4\">用户管理>></font></a></td></tr>";
			}
			echo "<tr><td bgcolor=\"#2196F3\">";
			echo "<a href=\"pwdchg.php\" target=\"fram\"><font size=\"4\">帐号安全>></font></a>";
			echo "</td></tr>";


			echo "</table></td>";

			echo "<td width=\"90%\">";
			//第一次进入页面自动调用"基本信息"
			echo "<iframe name=\"fram\" src=\"infochg.php\" width=\"65%\" height=\"400\" frameBorder=\"0\">";
			echo "</td></tr>";
			echo "</table>";
			echo "</body>";
			echo "</html>";
		}
	}
?>
