<meta http-equiv="Content-Type" content="text/html; charset=utf8" />


<?php
	error_reporting(0);
	if($_COOKIE['username'])						
	{
		require "conf.php";							
		$link=mysql_connect($host,$user,$pass);
		mysql_select_db($db_name,$link);
		$sql="select * from $table_user where username='$_COOKIE[username]'";
		$result=mysql_query($sql,$link);
		$row=mysql_fetch_array($result);				
		if ($row['admin']=="1")							
		{
			if(!$_POST['action'])					
			{
				echo "<center>";
				echo "<strong><center><font color=\"#f44336\" size = \"5\">留言管理</font></center></strong>";
				echo "<br>";

				echo "<table width=\"80%\" cellpadding=\"1\" cellspacing=\"1\" align=\"center\" bgcolor=\"#ffffff\">";

				echo "<form method=\"post\" action=\"$PATH_INFO\">";
				$sql="select * from $table_gbook";
				$result=mysql_query($sql,$link);


				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">留言人</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">标题</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">内容</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"3\">操作</font></center></td>";
				echo "</tr>";

				while($rows=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<input type=hidden name=id[$i] value=".$rows['id'].">";
					echo "<td bgcolor=\"#2196F3\">".$rows['author']."</td><td bgcolor=\"#2196F3\"><input type=text value=".$rows['title']." name=title[$i] size=6></td><td bgcolor=\"#2196F3\"><textarea name=content[$i] rows=3 cols=20>".$rows['content']."</textarea></td>";
					echo "<td bgcolor=\"#2196F3\"><input type=radio name=action[$i] value=del checked>删除<br><input type=radio name=action[$i] value=edit>修改<br></td>";
					echo "</tr>";
					$i++;
				}		


				echo "<tr>";
				echo "<td bgcolor=\"#ffffff\" colspan=\"4\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";

				echo "</center></td>";
				echo "</form>";
				echo "</table>";
				echo "</center>";
				echo "</body>";
				echo "<html>";
			}
			else									
			{
				require "conf.php";
				$link=mysql_connect($host,$user,$pass);
				mysql_select_db($db_name,$link);
				for($i=0;$i<count($_POST['id']);$i++)
				{
					$temp1=$_POST['id'][$i];			
					$temp2=$_POST['title'][$i];
					$temp3=$_POST['content'][$i];
					if($_POST['action'][$i]=="del")		
					{
						$sql="delete from $table_gbook where id='$temp1'";
					}
					else							
					{
						$sql="update $table_gbook set title='$temp2',content='$temp3' where id='$temp1'";
					}
					mysql_query($sql);				
				}
				echo "<html>";
				echo "<head>";
				echo "<title>WeigqBlog</title>";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=ctgchg.php\">";
				echo "</head>";
				echo "<body>";
				echo "Successfully!";
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
		echo "<a href=notechg.php>请先登录</a>";
	}
?>