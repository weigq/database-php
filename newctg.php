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
			if(!$_POST['sortname'])
			{
				echo "<script language=\"javascript\">\n";
				echo "function juge(theForm)\n";
				echo "{\n";
				echo "\tif (theForm.sortname.value == \"\")\n";
				echo "\t{\n";
				echo "\t\talert(\"分类名不能为空！\");\n";
				echo "\t\ttheForm.sortname.focus();\n";
				echo "\t\treturn (false);\n";
				echo "\t}\n";
				echo "}\n";
				echo "</script>\n";


				echo "<style type=\"text/css\">";
				echo "a:hover { color: #F44336; text-decoration: underline}";
				echo "</style>";


				echo "<style type=\"text/css\">";
				echo "<!-- ";
				echo ".ss{
						box-shadow: 0 0 8px  3px #b0bec5;}";
				echo "-->";
				echo "</style>";


				echo "<center>";

				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">新建标签</font></strong></center></	td>";
				echo "</tr>";

				echo "</td>";
				echo "</table>";
				echo "<p>";
				echo "<br>";


				echo "<center>";

				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"95%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";


				echo "<tr  bgcolor=\"#2196F3\">";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">名称</font></center></td>";
				echo "<td><center><input type=\"text\" name=\"sortname\"></center></td>";
				echo "</tr>";



				echo "</table>";
				echo "</center>";
				echo "<br><tr>";
				echo "<td bgcolor=\"#ffffff\" colspan=\"2\"><center><input type=submit style=background-color:#2196F3;color:#ffffff 	value=\"确认\"></center></td>";
				echo "</tr>";
				echo "</form>";

				echo "</body>";
				echo "<html>";
			}
			else									//执行操作
			{
				$sortname=$_POST['sortname'];
				$description=$_POST['description'];
				require "conf.php";
				$link=mysql_connect($host,$user,$pass);
				mysql_select_db($db_name,$link);
				mysql_query("SET NAMES utf8");

				$sql="insert into $table_ctg(sortname)values('$sortname')";
				mysql_query($sql,$link);			
				echo "<html>\n";
				echo "<head>\n";
				echo "<title>Weigq-Blog</title>";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=newblog.php\">";
				echo "</head>";
				echo "<body>";
				echo "<font color=\"#2196F3\" size=\"6\">successfully!</font>";
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
		echo "<a href=newctg.php>登录</a>";
	}
?>
