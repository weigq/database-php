<meta http-equiv="Content-Type" content="text/html; charset=utf8" />


<?php
	////**无bug****////
	echo "<html>";
	echo "<body leftmargin=\"0\">";
	echo "<table width=\"100%\" valign=\"top\" cellpadding=\"12\" cellspacing=\"0\" align=\"center\" bgcolor=\"#ffffff\" border=\"0\">";
	echo "<tr>";
	echo "<td bgcolor=\"#2196F3\">";


    //css设置
	echo "<style type=\"text/css\">";
	echo "a {  font-size: 20px; text-decoration: none; color: #ffffff}";//超链css定义
	echo "td {text-align: left; text-valign:center; font-size: 18px;}"; //表格css定义
	echo "<!-- ";
	echo ".ss{
		box-shadow: 0 0 8px  3px #b0bec5;}";
	echo "-->";
	echo "</style>";


	require "conf.php";https://raw.githubusercontent.com/weigq/image-raw/master/avatar1.png

	//连接数据库
	$link=mysql_connect($host,$user,$pass);
	mysql_select_db($db_name,$link);
	mysql_query("SET NAMES utf8");
	//mysql_query(SET NAMES utf8);


	$sql="select * from $table_user where admin='1'";
	$result=mysql_query($sql,$link);
	$row=mysql_fetch_array($result);

	echo "<br>";

	if($row['photo']) 
			echo "<center><img src=".$row['photo']." height=\"40\" width=\"40\" />";
	else 
			echo "<center><a href=longin.php><font color=\"#FFFFFF\" size = \"3\">头像</font></a></center>";
	echo "<br>";


	echo "<center><font color=\"#FFFFFF\" size = \"4\">".$row['nickname']."</font></center>";
	echo "<hr color=\"#90caf9\" width=\"30%\">";


	echo "<center><font color=\"#FFFFFF\" size = \"4\">".$row['email']."</font></center>";

	echo "<center><font color=\"#FFFFFF\" size = \"4\">".$row['description']."</font></center><br>";
	echo "<hr color=\"#90caf9\" width=\"100%\">";
	echo "</td></tr>";

	//标签
	echo "<tr>";
	echo "<td bgcolor=\"#2196F3\">";
	echo "<center><font color=\"#ffffff\" size = \"4\">标签云</font></center>";
	echo "<hr color=\"#90caf9\" width=\"30%\">";

	$sql="select sortname,sortnum from $table_ctg";
	$result=mysql_query($sql,$link);
	while($rows=mysql_fetch_array($result))
	{
		echo "<center><a href=mainblog.php?sort=".$rows[0]."><font size=\"4\">".$rows[0]."</font></a><font size=\"4\"> [".$rows[1]."]</font></center>";
	}
	echo "<br>";
	echo "<hr color=\"#90caf9\" width=\"100%\">";
	echo "</td></tr>";


	//归档
	echo "<tr>";
	echo "<td bgcolor=\"#2196F3\">";
	echo "<center><font color=\"#ffffff\" size = \"4\">归档</font></center>";
	echo "<hr color=\"#90caf9\" width=\"30%\">";

	$sql="select date,count(date) from $table_blog where p_id='0' group by date";
	$result=mysql_query($sql,$link);
	while($rows=mysql_fetch_array($result))
	{
		$temp=explode("/", $rows[0]);
		echo "<center><a href=mainblog.php?y=$temp[2]&m=$temp[0]&d=$temp[1]><font size=\"4\">".$rows[0]."</font><font size=\"4\"> [".$rows[1]."]</font></a></center>";
		//echo "<center><font size=\"4\">".$rows[0]."</font><font size=\"4\"> [".$rows[1]."]</font></center>";	
	}
	echo "<br>";
	echo "<hr color=\"#90caf9\" width=\"100%\">";
	echo "</td></tr>";


	echo "</select></form>
	<div id=a1></div>
	<script language=javascript>

	function w_open()
	{
	open(\"newuser.php\");
	}
	</script>";


	echo "<tr><td bgcolor=\"#2196f3\">";

	//显示登录信息
	if(!$_COOKIE['username'])
	{
		echo "<form action=login.php method=post>";
		echo "<div align=center>";
		echo "<font color=\"#FFFFFF\" size = \"4\">用户：</font> <input type=text name=username size=5><br>";
		echo "<font color=\"#FFFFFF\" size = \"4\">密码：</font> <input type=password name=password size=5><br><br>";

		//用户注册转到
		echo "<input type=button style=background-color:#42a5f5;color:#ffffff value=\"注册\" onclick=w_open()>&nbsp&nbsp";
		echo "<input type=submit style=background-color:#42a5f5;color:#ffffff value=\"登录\">";
		echo "</div>";
		echo "</form>";
	}
	else
	{
		echo "<center>$_COOKIE[username]<font color=\"#f4511e\" size = \"2\">&nbsp&nbsp[当前]</font></center>";
		echo "<p font-size=\"5px\" align=\"center\">";
		echo "<center><a href=exit.php><font color=\"#FFFFFF\" size = \"3\">[退出登录]</font></a></center>";
	}
	echo "</td>";
	echo "</tr>";



	echo "</table>";
	echo "</body>";
	echo "<html>";
?>
