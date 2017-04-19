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
				echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">所有用户</font></strong></center></	td>";
				echo "</tr>";

				echo "</td>";
				echo "</table>";
				echo "<p>";
				echo "<br>";


				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"1\" width=\"95%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<form method=\"post\" action=\"$PATH_INFO\">";

				$sql="select * from $table_user";
				$result=mysql_query($sql,$link);

				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">序号</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">用户</font></center></td>";
				echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">个性签名</font></center></td>";
				echo "</tr>";


				while($rows=mysql_fetch_array($result))
				{
					echo "<tr>";
					echo "<input type=hidden name=id[$i] value=".$rows['id'].">";
					echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size=\"4\">".$rows['id']."</font></center></td>";
					echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size=\"4\">".$rows['nickname']."</font></center></td>";
					echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size=\"4\">".$rows['description']."</font></center></td>";
					echo "</tr>";
					$i++;
				}


				echo "</center></td>";
				echo "</form>";
				echo "</table>";
				echo "</center>";
				echo "</body>";
				echo "<html>";
	
		}
?>
