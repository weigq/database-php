<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	error_reporting(0);
	if($_COOKIE['username'])
	{
		require "conf.php";
		$link=mysql_connect($host,$user,$pass);
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");
		$sql="select * from $table_user where username='$_COOKIE[username]'";
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_array($result);
		if ($row['admin']=="1")
		{
			if(!$_POST['content'])
			{
				echo "<script language=\"javascript\">";
				echo "function juge(theForm)";
				echo "{";
				echo "if (theForm.title.value == \"\")";
				echo "{";
				echo "alert(\"标题不能为空！\");";
				echo "theForm.title.focus();";
				echo "return (false);";
				echo "}";
				echo "if (theForm.content.value == \"\")";
				echo "{";
				echo "alert(\"内容不能为空！\");";
				echo "theForm.content.focus();";
				echo "return (false);";
				echo "}";
				echo "}";
				echo "</script>";



				echo "<style type=\"text/css\">";
				//echo "a {text-decoration: none; color: #2196F3}";//超链css定义
				echo "a:hover { color: #F44336; text-decoration: underline}";
				echo "</style>";


				echo "<style type=\"text/css\">";
				echo "<!-- ";
				echo ".ss{
						box-shadow: 0 0 8px  3px #b0bec5;}";
				echo "-->";
				echo "</style>";


				echo "<center>";
				//echo "<strong><center><font color=\"#f44336\" size = \"5\">用户信息</font></center></strong>";

				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				//echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";

				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">写博客</font></strong></center></	td>";
				echo "</tr>";

				echo "</td>";
				echo "</table>";
				echo "<p>";
				echo "<br>";


				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"95%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";


				echo "<tr  bgcolor=\"#2196F3\">";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">标题</font></center></td>";
				echo "<td><center><input type=\"text\" name=\"title\" size=\"30\"></center></td>";
				echo "</tr>";

				echo "<tr  bgcolor=\"#2196F3\">";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">标签</font></center></td>";
				echo "<td><center><select name=\"sort\" size=\"1\">";


				$sql="select sortname from $table_ctg";
				$result=mysql_query($sql,$link);
				while($rows=mysql_fetch_array($result))
				{
					echo "<option value=\"";
					echo $rows[0];
					echo "\">";
					echo $rows[0];
				}
				echo "</select></center></td>";
				echo "</tr>";

				echo "<tr bgcolor=\"#2196F3\">";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">内容</font></center></td>";
				echo "<td><center><textarea rows=\"20\" cols=\"40\" name=\"content\"></textarea></center></td>";
				echo "</tr>";

				echo "</table>";
				echo "</center>";
				echo "<tr>";
				echo "<td bgcolor=\"#ffffff\" colspan=\"2\"><center><input type=submit style=background-color:#2196F3;color:#ffffff 	value=\"确认\"></center></td>";
				echo "</tr>";
				echo "</form>";

				echo "</body>";
				echo "<html>";
			}

			else
			{
				$title=$_POST['title'];
				$content=$_POST['content'];
				//$hide=$_POST['hide'];
				$sort=$_POST['sort'];
				$date=date("n/d/Y");
				require "conf.php";
				$link=mysql_connect($host,$user,$pass);
				mysql_select_db($db_name,$link);
				mysql_query("SET NAMES utf8");
				$sql="insert into $table_blog(title,content,sort,author,date)values('$title','$content','$sort','$_COOKIE[username]','$date')";
				mysql_query($sql,$link);
				$sql2="update $table_ctg set sortnum=sortnum+1 where sortname='$sort'";
				mysql_query($sql2,$link);
				echo "<html>";
				echo "<head>";
				echo "<title>WeigqBlog</title>";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=newblog.php\">";
				echo "</head>";
				echo "<body>";
				echo "<font align=\"center\" color=\"#2196F3\" size=\"6\">successfully!</font>";
				echo "</body>";
				echo "</html>";
			}
		}
		else
		{
			echo "普通用户无权限操作!";
		}
	}
	else
	{
		echo "<a href=longin.php>登录</a>";
	}
?>
