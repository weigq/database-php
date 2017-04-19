<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	////////////y已无bug//////////
	//////////×××××××××××////////

	error_reporting(0);
	require "header.php";
	if(!$_POST['content'])
	{
		echo "<html>";
		echo "<body leftmargin=\"0\" topmargin=\"0\">";
		echo "<center>";


		echo "<table width=\"100%\" cellspacing=\"0\" bgcolor=\"#ffffff\" border=\"0\">";
		//页面主体单元格
		echo "<tr>";

		//左边栏单元格
		echo "<td valign=\"top\" width=\"7%\" >";
		require "rightbar.php";
		echo "</td>";

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

		//博客单元格
		echo "<td valign=\"top\" width=\"40%\">";

		echo "<p>";
		echo "<table cellpadding=\"8\" vlign=\"top\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
		echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">留言</font></center></td></tr>";
		echo "</table>";
		echo "<p>";


		$link=mysql_connect($host,$user,$pass);
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");
		$sql="select id from $table_note";
		$result=mysql_query($sql,$link);
		$msg_count=mysql_num_rows($result);
		$p_count=ceil($msg_count/10);


		echo "<table cellpadding=\"8\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<tr><td bgcolor=\"#ffffff\">";
		echo "<br>";

		if ($_GET['page']==0 && !$_GET['page'])
		$page=1;
		else
		$page=$_GET['page'];
		$s=($page-1)*10+1;
		$s=$s-1;
		$sql="select * from $table_note order by id desc limit $s, 10";
		$result=mysql_query($sql,$link);
		$nums=mysql_num_rows($result);
		if($nums<1) echo "<font color=\"#000000\" size = \"4\">没有留言!</font>";
		else
		{
			while($rows=mysql_fetch_array($result))
			{
				echo "<font size=\"4\" color=\"#2196F3\">&nbsp".$rows['author']." <font size=\"3\" color=\"#000000\"> [date: ".$rows['date']."] </font>";
				echo "<font size=\"4\" color=\"#000000\">:> &nbsp".$rows['content']."</font>";
				echo "<hr color=\"#e3f2fd\" width=\"95%\">";
			}
		}
		echo "</td></tr>";
		echo "</table>";
		echo "<p>";

		/////////////显示分页
		echo "<table cellpadding=\"8\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\">";
		echo "<tr><td bgcolor=\"#ffffff\">";
		echo "<center>";
		$prev_page=$page-1;
		$next_page=$page+1;

		if ($page<=1){
			echo "<font color=\"#2196F3\" size = \"3\">首页 | </font>";
		}
		else{
			echo "<a href='$PATH_INFO?page=1'><font color=\"#2196F3\" size=\"3\">首页</a> | ";
		}
		if ($prev_page<1){
			echo "<font color=\"#2196F3\" size = \"3\">上一页 | </font>";
		}
		else{
			echo "<a href='$PATH_INFO?page=$prev_page'><font color=\"#2196F3\" size = \"3\">上一页</font></a> | ";
		}
		if ($next_page>$p_count){
			echo "<font color=\"#2196F3\" size = \"3\">下一页 | </font>";
		}
		else{
			echo "<a href='$PATH_INFO?page=$next_page'><font color=\"#2196F3\" size = \"3\">下一页</font></a> | ";
		}
		if ($page>=$p_count){
			echo "<font color=\"#2196F3\" size = \"3\">末页</font></p>";
		}
		else{
			echo "<a href='$PATH_INFO?page=$p_count'><font color=\"#2196F3\" size = \"3\">末页</font></a></p>";
		}

		echo "</center>";
		echo "</td></tr>";
		echo "</table>";
		echo "<p>";


		echo "<table cellpadding=\"8\" vlign=\"top\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4	\">我的留言</font></center></td></tr>";
		echo "</table>";
		echo "<p>";

		//我的留言
		echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
		echo "<form action=newnote.php method=post>";

		//输入框
		echo "<tr bgcolor=\"#ffffff\"><td>";
		echo "<center><textarea name=content rows=5 cols=60></textarea></center>";
		echo "</td></tr>";
		echo "</table>";
		echo "<p>";

		//确认按钮
		echo "<table cellpadding=\"8\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" >";
		echo "<tr>";
		echo "<td bgcolor=\"#ffffff\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";
		echo "</tr>";
		echo "</table>";
		echo "</form>";

		echo "</table>";
		echo "</body>";
		require "bottom.php";
		echo "</html>";

	}

	//执行结果
	else
	{
		$content=$_POST['content'];
		$date=$date=date("n/d/Y");
		if(!$_COOKIE['username'])
		{
			$username="annoymous";
		}
		else
		{
			$username=$_COOKIE['username'];
		}


		require "conf.php";
		$link=mysql_connect($host,$user,$pass);
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");
		$sql="insert into $table_note(author,content,date)values('$username','$content','$date')";
		mysql_query($sql,$link);

		echo "<html>";
		echo "<head>";
		echo "<title>Weigq-Blog</title>";
		echo "<meta http-equiv=\"refresh\" content=\"2; url=newnote.php\">";
		echo "</head>";
		echo "<body>";

		echo "<center><p>";
		echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"50%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<form method=\"post\">";
		echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">已成功留言！</font></center></td>";
		echo "</tr></td>";
		echo "</table>";

		echo "</body>";
		echo "</html>";
	}
?>
