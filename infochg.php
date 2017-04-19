<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	//////////已无bug///////////
	//////////××××××××××//////
	error_reporting(0);
	if(!$_COOKIE['username'])
	{
		"无用户登录";
	}

	else
	{
		if(!$_POST['nickname'])
		{
			echo "<html>";
			echo "<head>";
			echo "<title>Weigq-Blog</title>";
			echo "</head>";
			echo "<body>";

			echo "<script language=\"javascript\">";
			echo "function juge(theForm)";
			echo "{";
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
			echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";

			echo "<tr><td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">基本信息</font></strong></center></td></tr>";

			echo "</td></table>";
			echo "<p>";
			echo "<br>";


			require "conf.php";
			$link=mysql_connect($host,$user,$pass);
			mysql_select_db($db_name,$link);
			mysql_query("SET NAMES utf8");
			$sql="select * from $table_user where username='$_COOKIE[username]'";
			$result=mysql_query($sql,$link);
			$rows=mysql_fetch_array($result);

			echo "<center>";
			echo "<td width=\"70%\">";
			echo "<table cellpadding=\"8\" cellspacing=\"1\" width=\"95%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
			echo "<form action=infochg.php method=post onsubmit=\"return juge(this)\">";

			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">昵称</font></center></td>";
			echo "<td bgcolor=\"#2196F3\"><center><input type=\"text\" name=\"nickname\" value=\"";
			echo $rows['nickname'];
			echo "\" ></center></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">头像链接</font></center></td>";
			echo "<td bgcolor=\"#2196F3\"><center><input type=\"text\" name=\"photo\" value=\"";
			echo $rows['photo'];
			echo "\" ></center></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">email</font></center></td>";
			echo "<td bgcolor=\"#2196F3\"><center><input type=\"text\" name=\"email\" value=\"";
			echo $rows['email'];
			echo "\" ></center></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">个性签名</font></center></td>";
			echo "<td bgcolor=\"#2196F3\">";
			echo "<center><textarea name=\"description\">".$rows['description']."</textarea></center>";
			echo "</td>";
			echo "</tr>";


			echo "</table>";
			echo "</center>";
			echo "<br>";

			//执行动作必须在<form>作用域内
			echo "<tr>";
			echo "<td bgcolor=\"#ffffff\" colspan=\"2\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";
			echo "</tr>";
			echo "</form>";
		}


		else
		{
			$nickname=$_POST['nickname'];
			$photo=$_POST['photo'];
			$email=$_POST['email'];
			$description=$_POST['description'];

			require("conf.php");
			$link=mysql_connect($host,$user,$pass);
			mysql_select_db($db_name,$link);
			mysql_query("SET NAMES utf8");
			$sql="update $table_user set nickname='$nickname',photo='$photo',email='$email',description='$description' where username='$_COOKIE[username]'";
			$result=mysql_query($sql,$link);

			echo "<html>";
			echo "<head>";
			echo "<title>Weigq-Blog</title>";
			echo "<meta http-equiv=\"refresh\" content=\"2; url=infochg.php\">";
			echo "</head>";
			echo "<body>";
			echo "<font align=\"center\" color=\"#2196F3\" size=\"6\">successfully!</font>";
			echo "</body>";
			echo "</html>";
		}
	}
?>
