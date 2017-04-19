<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	//*********已无bug************//
	error_reporting(0);
	echo "<html>";
	echo "<script type=\"text/javascript\"  src=\"https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML\"></script>";
	echo "<body leftmargin=\"0\" topmargin=\"0\">";
	echo "<center>";

	require "conf.php";
	require "header.php";

	echo "<table width=\"100%\" cellspacing=\"0\" bgcolor=\"#ffffff\" border=\"0\">";
	//页面主体单元格
	echo "<tr>";

	//左边栏单元格
	echo "<td valign=\"top\" width=\"7%\" >";
	require "rightbar.php";
	echo "</td>";
	//css
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
	echo "<table cellpadding=\"8\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
	echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">博客</font></center></td></tr>";
	echo "</table>";
	echo "<p>";





	//显示置顶博客
	$sql="select * from $table_blog where p_id=0 and top=1";
 	$result=mysql_query($sql,$link);
 	$nums=mysql_num_rows($result);
 	if($nums=1)
 	{
 			$rows=mysql_fetch_array($result);
 			//$flag=1;
 			echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
			echo "<tr><td bgcolor=\"#ffffff\">";

 			echo "<center><a href=singblog.php?id=".$rows['id']."><font size=\"6\" color=\"#2196F3\">".$rows['title']."&nbsp</font><font size=\"3\" color=\"#e91e63\">&nbsp[置顶]</font></a></center>";
 			echo "<center><font size=\"3\" color=\"#000000\">".$rows['date']."</font></center>";
 			echo "<center><a href=mainblog.php?sort=".$rows['sort']."><font size=\"3\" color=\"#2196F3\">标签:".$rows['sort']."</font></a>|";
 			echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">评论[".$rows['tbcount']."]</font></a>|";
 			echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">浏览[".$rows['views']."]</font></a>|";
 			echo "<font size=\"3\" color=\"#2196F3\">赞[".$rows['upvote']."]</font></center>";
 			echo "<center><font color=\"#000000\" size=\"4px\" >&nbsp&nbsp".$rows['content']."</font></center>";
 			echo "<center><a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">阅读全文>></font></a></center>";

			echo "</td></tr>";
			echo "</table>";
			echo "<p>";
 	}
	//显示两条最新博客
	$sql="select * from $table_blog where p_id=0 and top=0 order by id desc limit 2";
 	$result=mysql_query($sql,$link);
 	$nums=mysql_num_rows($result);
 	if($nums<1) echo "<center><font color=\"#2196F3\" size = \"4\">该博主还没更新博客！</font></center>";
 	else
 	{
 		while($rows=mysql_fetch_array($result))
 		{
			echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
			echo "<tr><td bgcolor=\"#ffffff\">";

 			echo "<center><a href=singblog.php?id=".$rows['id']."><font size=\"6\" color=\"#2196F3\">".$rows['title']."</font></a></center>";
 			echo "<center><font size=\"3\" color=\"#000000\">".$rows['date']."</font></center>";
 			echo "<center><a href=mainblog.php?sort=".$rows['sort']."><font size=\"3\" color=\"#2196F3\">标签:".$rows['sort']."</font></a>|";
 			echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">评论[".$rows['tbcount']."]</font></a>|";
 			echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">浏览[".$rows['views']."]</font></a>|";
 			echo "<font size=\"3\" color=\"#2196F3\">赞[".$rows['upvote']."]</font></center>";
 			echo "<center><font color=\"#000000\" size=\"4px\" >&nbsp&nbsp".$rows['content']."</font></center>";
 			echo "<center><a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">阅读全文>></font></a></center>";

			echo "</td></tr>";
			echo "</table>";
			echo "<p>";
 		}
 	}

	echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
	echo "<tr><td bgcolor=\"#ffffff\">";
	echo "<center><a href=mainblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">查看更多>></font></a></center>";
	echo "</td></tr>";
	echo "</table>";
	echo "<p><br>";






	//留言
	echo "<table cellpadding=\"8\" vlign=\"top\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
	echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">留言</font></center></td></tr>";
	echo "</table>";
	echo "<p>";


	echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
	echo "<tr><td bgcolor=\"#ffffff\">";

	$sql="select * from $table_note order by id desc limit 5";
	$result=mysql_query($sql,$link);
	$nums=mysql_num_rows($result);
	if($nums<1) echo "<center><font color=\"#2196F3\" size = \"4\">该博主还没留言！</font></center>";
	else
	{
		while($rows=mysql_fetch_array($result))
		{
			echo "<font size=\"4\" color=\"#2196F3\">&nbsp".$rows['author']." </font><font size=\"3\" color=\"#000000\"> [date: ".$rows['date']."] </font>";
			echo "<font size=\"4\" color=\"#000000\">:> ".$rows['content']."</font>";
			echo "<hr color=\"#e3f2fd\" width=\"95%\">";

		}
	}
	echo "</td></tr>";
	echo "</table>";
	echo "<p>";
	
	echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
	echo "<tr><td bgcolor=\"#ffffff\">";
	echo "<center><a href=newnote.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">查看更多>></font></a></center>";
	echo "</td></tr>";
	echo "</table>";
	echo "<p><br>";


	echo "</td>";
	echo "</tr>";
	echo "</table>";

	require "bottom.php";

	echo "</center>";
	echo "</body>";
	echo "</html>";
?>
