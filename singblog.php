<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	echo "<html>";
	echo "<script type=\"text/javascript\"  src=\"https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML\"></script>";
	echo "<body leftmargin=\"0\" topmargin=\"0\">";
	echo "<center>";

	require "header.php";

	//有用户登录
	if(!$_POST['id'])
	{
		echo "<table width=\"100%\" cellspacing=\"0\" bgcolor=\"#ffffff\" border=\"0\">";

		echo "<tr>";
		echo "<td valign=\"top\" width=\"7%\">";
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


		echo "<td width=\"40%\">";
		echo "<table cellpadding=\"15\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<form action=singblog.php method=post>";

		require "conf.php";
		$link=mysql_connect($host,$user,$pass);
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");

		$sql="select * from $table_blog where id='$_GET[id]' and p_id='0' order by id desc";
		$result=mysql_query($sql,$link) or die(mysql_error());
		$rows=mysql_fetch_array($result);

		echo "<tr bgcolor=\"#2196F3\">";
		//标题
		echo "<td>";
		//echo "<font>".$_GET['id']."</font>";
		echo "<center><strong><font color=\"#ffffff\" size = \"4\">".$rows['title']."</font></strong></center>";
		echo "</td>";
		echo "</tr>";


		echo "<tr bgcolor=\"#ffffff\">";
		echo "<td>";
		echo "<center>";
		//echo "<font size=\"6\" color=\"#2196F3\">".$rows['title']."</font><br>";
		echo "<font size=\"3\" color=\"#000000\">".$rows['date']."</font><br>";
		echo "<a href=mainblog.php?sort=".$rows['sort']."><font size=\"3\" color=\"#2196F3\">标签:".$rows['sort']."</font></a>|";
		echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">评论[".$rows['tbcount']."]</font></a>|";
		echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">浏览[".$rows['views']."]</font></a>|";
		echo "<font size=\"3\" color=\"#2196F3\">赞[".$rows['upvote']."]</font><input type=radio name=action value=upvote><br>";
		echo "</center><br>";
		echo "<font color=\"#000000\" size=\"4px\" >&nbsp&nbsp".$rows['content']."</font><br>";


 		echo "<hr color=\"#e3f2fd\" width=\"95%\">";
		echo "<p>";

		//显示评论////////////////////////////////////////////////
		//////////////////////////////////////////////////////////
		echo "<font size=\"4\" color=\"#2196F3\">评论:></font><br>";

		$sql2="select * from $table_blog where p_id='$_GET[id]'";
		$result2=mysql_query($sql2,$link);
		while($row2=mysql_fetch_array($result2))
		{
			echo "<font size=\"4\" color=\"#2196F3\">&nbsp".$row2['author']." <font size=\"3\" color=\"#000000\"> [date: ".$row2['date']."] </font>";
			//cho "<p>";
			echo "<font size=\"4\" color=\"#000000\">:> &nbsp".$row2['content']."</font>";
			echo "<hr color=\"#e3f2fd\" width=\"95%\">";

		}

		/////////////////////////////////////////////
		//更新浏览次数///////////////////////////////
		$sql="update $table_blog set views=views+1 where id='$_GET[id]'";
		mysql_query($sql,$link);
		echo "</td>";
		echo "</tr>";
		echo "</table>";


		echo "<p>";
		echo "<br>";


		//////////////////////////
		//发表评论////////////////
		//echo "<td width=\"70%\">";
		echo "<table cellpadding=\"8\" vlign=\"top\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">我的评论</font></center></td></tr>";
		echo "</table>";
		echo "<p>";

		echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"47%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
		

		echo "<input type=hidden name=id value=".$rows['id'].">";
		echo "<input type=hidden name=sort value=".$rows['sort'].">";
		echo "</td></tr>";

		echo "<tr bgcolor=\"#ffffff\"><td>";
		echo "<center><textarea name=content rows=5 cols=60></textarea></center>";
		echo "</td></tr>";
		echo "</table>";


		echo "<p><table cellpadding=\"8\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" >";
		echo "<tr>";
		echo "<td bgcolor=\"#ffffff\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";
		echo "</tr>";
		echo "</form>";

		echo "</table>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		require "bottom.php";
	}

	else
	{
		$id=$_POST['id'];
		$title=$_POST['title'];
		$sort=$_POST['sort'];
		$content=$_POST['content'];
		$date=$date=date("n/d/Y");
		$upvote=$_POST['upvote'];
		if(!$_COOKIE["username"])
		{
			$username="anonymous";
		}
		else
		{
			$username=$_COOKIE["username"];
		}
		require "conf.php";
		$link=mysql_connect($host,$user,$pass);
		mysql_select_db($db_name,$link);
		mysql_query("SET NAMES utf8");
		if($content)
		{
			$sql="insert into $table_blog(p_id,author,title,content,sort,date)values('$id','$username','$title','$content','$sort','$date')";
			mysql_query($sql,$link);
			$sql="update $table_blog set tbcount=tbcount+1 where id='$id'";
			mysql_query($sql,$link);
		}
		if($_POST['action']=="upvote")
		{
			$sql3="update $table_blog set upvote=upvote+1 where id='$id'";
			mysql_query($sql3,$link);
		}



		echo "<meta http-equiv=\"refresh\" content=\"2; url=singblog.php?id=".$id."\">";
		echo "</head>";
		echo "<body>";
		echo "<font align=\"center\" color=\"#2196F3\" size=\"6\">successfully!</font>";
		echo "</body>";
		echo "</html>";
	}
?>
