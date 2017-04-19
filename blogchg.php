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
			if(!$_POST['action'])
			{
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

				echo "<td width=\"100%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">博客管理</font></strong></center></td>";
				echo "</tr>";

				echo "</td>";
				echo "</table>";
				echo "<p>";
				echo "<br>";

				echo "<td width=\"100%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"95%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<form method=\"post\" action=\"$PATH_INFO\">";
				$sql="select * from $table_blog";
				$result=mysql_query($sql,$link);


				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">标题</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">标签</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">内容</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">置顶</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">操作</font></center></td>";
				echo "</tr>";


				while($rows=mysql_fetch_array($result))
				{
					if($rows['p_id']=='0')
					{
					echo "<tr>";
					echo "<input type=hidden name=id[$i] value=".$rows['id'].">";
					echo "<td bgcolor=\"#2196F3\"><input type=text value=\"".$rows['title']."\" name=title[$i] size=10></td>";
					echo "<td bgcolor=\"#2196F3\"><input type=text value=\"".$rows['sort']."\" name=st[$i] size=10></td>";
					echo "<td bgcolor=\"#2196F3\"><textarea name=content[$i] rows=3 cols=20>".$rows['content']."</textarea></td>";
					echo "<td bgcolor=\"#2196F3\"><input type=radio name=action[$i] value=top1>置顶<br>";
					echo "<input type=radio name=action[$i] value=top2>取消<br></td>";
					echo "<td bgcolor=\"#2196F3\"><input type=radio name=action[$i] value=remain checked=1>保持<br>";
					echo "<input type=radio name=action[$i] value=edit>修改<br><input type=radio name=action[$i] value=del >删除</td>";
					echo "</tr>";
					$i++;
					}
					
				}




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
				require "conf.php";
				$link=mysql_connect($host,$user,$pass);
				mysql_select_db($db_name,$link);
				mysql_query("SET NAMES utf8");
				for($i=0;$i<count($_POST['action']);$i++)
				{
					$temp1=$_POST['id'][$i];
					$temp2=$_POST['title'][$i];
					$temp3=$_POST['content'][$i];
					$temp4=$_POST['st'][$i];
					if($_POST['action'][$i]=="del")
					{
						$sql1="delete from $table_blog where id='$temp1' or p_id='$temp1'";
						mysql_query($sql1);
						$sql2="update $table_ctg set sortnum=sortnum-1 where sortname='$temp4'";
						mysql_query($sql2);
					}
					if($_POST['action'][$i]=="edit")
					{
						$sql="update $table_blog set title='$temp2',content='$temp3' where id='$temp1'";
						mysql_query($sql);
					}
					if($_POST['action'][$i]=="top1")
					{
						$sql="update $table_blog set top='1' where id='$temp1'";
						mysql_query($sql);
					}
					if($_POST['action'][$i]=="top2")
					{
						$sql="update $table_blog set top='0' where id='$temp1'";
						mysql_query($sql);
					}
				}
				echo "<html>";
				echo "<head>";
				echo "<title>WeigqBlog</title>";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=blogchg.php\">";
				echo "</head>";
				echo "<body>";
				echo "<font color=\"#2196F3\" size=\"6\">successfully!</font>";
				echo "</body>";
				echo "</html>";
			}
		}
		else
		{
			echo "普通用户无权限修改!";
		}
	}
	else
	{
		echo "<a href=blogchg.php>登录</a>";
	}
