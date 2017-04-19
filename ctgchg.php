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
			if(!$_POST['action'])						//如果没有发送表单变量显示HTML
			{
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

				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<form method=\"post\" action=\"$PATH_INFO\">";

				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">标签管理</font></strong></center></	td>";
				echo "</tr>";

				echo "</td>";
				echo "</table>";
				echo "<p>";
				echo "<br>";

				echo "<center>";
				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"8\" cellspacing=\"1\" width=\"95%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<form action=infochg.php method=post onsubmit=\"return juge(this)\">";


				$sql="select * from $table_ctg";
				$result=mysql_query($sql,$link);

				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">标签</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">操作</font></center></td>";
				echo "</tr>";

				while($rows=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<input type=hidden name=id[$i] value=".$rows[id].">";
					echo "<input type=hidden name=o_sort[$i] value=".$rows[sortname].">";
					echo "<td bgcolor=\"#2196F3\"><center><input type=text value=".$rows[sortname]." name=sortname[$i]></center></td>";
					echo "<td bgcolor=\"#2196F3\"><center><input type=radio name=action[$i] value=remain checked=1>保持&nbsp&nbsp";
					echo "<input type=radio name=action[$i] value=edit >修改&nbsp&nbsp<input type=radio name=action[$i] value=del>删除<br></center></td>";
					echo "</tr>";
					$i++;
				}

				echo "</center></td>";

				echo "</table>";
				echo "</center>";

				echo "<br><tr>";
				echo "<td bgcolor=\"#ffffff\" colspan=\"2\"><center><input type=submit style=background-color:#2196F3;color:#ffffff 	value=\"确认\"></center></td>";
				echo "</tr>";
				echo "</form>";

				echo "</body>";
				echo "<html>";
			}

			else									//如果变量
			{
				require "conf.php";
				$link=mysql_connect($host,$user,$pass);
				mysql_select_db($db_name,$link);
				mysql_query("SET NAMES utf8");

				for($i=0;$i<count($_POST['id']);$i++)
				{
					$temp1=$_POST['id'][$i];
					$temp2=$_POST['sortname'][$i];
					$temp4=$_POST['o_sort'][$i];
					if($_POST['action'][$i]=="del")
					{
						$sql="delete from $table_ctg where id='$temp1'";
						$sql2="delete from $table_blog where sort='$temp2'";
						mysql_query($sql);
						mysql_query($sql2);
					}
					if($_POST['action'][$i]=="edit")
					{
						$sql="update $table_ctg set sortname='$temp2' where id='$temp1'";
						$sql2="update $table_blog set sort='$temp2' where sort='$temp4'";
						mysql_query($sql);
						mysql_query($sql2);
					}
				}

				echo "<html>";
				echo "<head>";
				echo "<title>WeigqBlog</title>";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=ctgchg.php\">";
				echo "</head>";
				echo "<body>";
				echo "<font align=\"center\" color=\"#2196F3\" size=\"6\">successfully!</font>";
				echo "</body>";
				echo "</html>";
			}
		}
		else
		{
			echo "你是普通用户，无权限修改!";
		}
	}
	else
	{
		echo "<a href=login.php>请先登录</a>";
	}
?>
