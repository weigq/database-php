<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	///////////////已无bug//////////////////
	//////////*********************.///////

	echo "<html>";
	echo "<script type=\"text/javascript\"  src=\"https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML\"></script>";
	echo "<body leftmargin=\"0\" topmargin=\"0\">";
	echo "<center>";
	require "conf.php";
	require "header.php";

	echo "<table valign=\"top\" width=\"100%\" cellspacing=\"0\" bgcolor=\"#ffffff\" border=\"0\">";
	//页面主体
	echo "<tr>";
	//左边
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

	//显示栏
	echo "<td valign=\"top\" width=\"40%\">";
	//echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";

	$link=mysql_connect($host,$user,$pass);
	mysql_select_db($db_name,$link);
	mysql_query("SET NAMES utf8");

	////没有选择日期
	if(!($_GET['y']and$_GET['m']and$_GET['d']))
	{
		if($_GET['sort'])
		{
			///*****************************?///
			////////按分类显示博客//////////////
			$sort=$_GET['sort'];
			$sql="select * from $table_ctg where sortname='$sort'";
			$result=mysql_query($sql,$link);
			$rows=mysql_fetch_array($result);
			echo "<p>";
			echo "<table cellpadding=\"10\" vlign=\"top\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
			echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">".$sort." [".$rows['sortnum']."]</font></center></td></tr>";
			echo "</table>";
			echo "<p>";

			if($rows['sortnum']>0)
			{
				$sql2="select * from $table_blog where sort='$sort' and p_id=0 order by id desc";
				$result2=mysql_query($sql2,$link);

				while($rows2=mysql_fetch_array($result2))
				{
					echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
					echo "<tr><td bgcolor=\"#ffffff\">";

		 			echo "<center><a href=singblog.php?id=".$rows2['id']."><font size=\"6\" color=\"#2196F3\">".$rows2['title']."</font></a></center>";
		 			echo "<center><font size=\"3\" color=\"#000000\">".$rows2['date']."</font></center>";
		 			echo "<center><a href=mainblog.php?sort=".$rows2['sort']."><font size=\"3\" color=\"#2196F3\">标签:".$rows2['sort']."</font></a>|";
		 			echo "<a href=singblog.php?id=".$rows2['id']."><font size=\"3\" color=\"#2196F3\">评论[".$rows2['tbcount']."]</font></a>|";
		 			echo "<a href=singblog.php?id=".$rows2['id']."><font size=\"3\" color=\"#2196F3\">浏览[".$rows2['views']."]</font></a>|";
		 			echo "<font size=\"3\" color=\"#2196F3\">赞[".$rows2['upvote']."]</font></center>";
		 			echo "<center><font color=\"#000000\" size=\"4px\" >&nbsp&nbsp".$rows2['content']."</font></center>";
		 			echo "<center><a href=singblog.php?id=".$rows2['id']."><font size=\"3\" color=\"#2196F3\">阅读全文>></font></a></center>";

					echo "</td></tr>";
					echo "</table>";
					echo "<p>";
				}
			}
		}

		//没有选日期和分类，显示全部博客
		else
		{
			echo "<p>";
			echo "<table cellpadding=\"10\" vlign=\"top\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
			echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">全部博客</font></center></td></tr>";
			echo "</table>";
			echo "<p>";

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


			$sql="select id from $table_blog where p_id=0 and top=0";
			$result=mysql_query($sql,$link);
			$msg_count=mysql_num_rows($result);
			$p_count=ceil($msg_count/10);	//页数


			
			if ($_GET['page']==0 || !$_GET['page'])
				$page=1;
			else
				$page=$_GET['page'];
			$s=($page-1)*10+1;
			$s=$s-1;
			$sql="select * from $table_blog where p_id=0 and top=0 order by id desc limit $s, 10";//每页显示四个
			$result=mysql_query($sql,$link);
			$nums=mysql_num_rows($result);

			if($nums<1) echo "<font color=\"#000000\" size = \"4\">该博主还没更新博客！</font>";//没有任何博客
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
		}
	}


	//按日期显示
	else
	{
		$y=$_GET['y'];
		$m=$_GET['m'];
		$d=$_GET['d'];
		$date=$m."/".$d."/".$y;

		echo "<p>";
		echo "<table cellpadding=\"10\" vlign=\"top\" cellspacing=\"0\" width=\"55%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
		echo "<tr><td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"5\">date: [".$date."]</font></center></td></tr>";
		echo "</table>";
		echo "<p>";

		$sql="select * from $table_blog where date like '$date'and p_id=0 order by id desc";
		$result=mysql_query($sql,$link);
		$nums=mysql_num_rows($result);
		if($nums<1) echo "<font size=\"4\" color=\"#000000\">没有任何博客！";
		else
		{
			while($rows=mysql_fetch_array($result))		//循环显示
			{
				echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss2\" >";
				echo "<tr><td bgcolor=\"#ffffff\">";

				echo "<center><a href=singblog.php?id=".$rows['id']."><font size=\"6\" color=\"#2196F3\">".$rows['title']."</font></a></center>";
				echo "<center><font size=\"3\" color=\"#000000\">".$rows['date']."</font></center>";
				echo "<center><a href=mainblog.php?sort=".$rows['sort']."><font size=\"3\" color=\"#2196F3\">标签:".$rows['sort']."</font></a>|";
				echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">评论[".$rows['tbcount']."]</font></a>|";
				echo "<a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">浏览[".$rows['views']."]</font></a></center>";
				echo "<center><font color=\"#000000\" size=\"4px\" >&nbsp&nbsp".$rows['content']."</font></center>";
				echo "<center><a href=singblog.php?id=".$rows['id']."><font size=\"3\" color=\"#2196F3\">阅读全文>></font></a></center>";

				echo "</td></tr>";
				echo "</table>";
				echo "<p>";
			}
		}
	}


	// //分页
	// if(!($_GET['y']and$_GET['m']and$_GET['d'])&&!($_GET['sort']))
	// {
	// 	echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"52%\" align=\"center\" bgcolor=\"#ffffff\">";
	// 	echo "<tr><td bgcolor=\"#ffffff\">";
	// 	echo "<center>";

	// 	$prev_page=$page-1;
	// 	$next_page=$page+1;
	// 	if ($page<=1){
	// 		echo "<font color=\"#2196F3\" size = \"3\">首页 | </font>";
	// 	}
	// 	else{
	// 		echo "<a href='$PATH_INFO?page=1'>首页</a> | ";
	// 	}
	// 	if ($prev_page<1){
	// 		echo "<font color=\"#2196F3\" size = \"3\">上一页 | </font>";
	// 	}
	// 	else{
	// 		echo "<a href='$PATH_INFO?page=$prev_page'><font color=\"#2196F3\" size = \"3\">上一页</font></a> | ";
	// 	}
	// 	if ($next_page>$p_count){
	// 		echo "<font color=\"#2196F3\" size = \"3\">下一页 | </font>";
	// 	}
	// 	else{
	// 		echo "<a href='$PATH_INFO?page=$next_page'><font color=\"#2196F3\" size = \"3\">下一页</font></a> | ";
	// 	}
	// 	if ($page>=$p_count){
	// 		echo "<font color=\"#2196F3\" size = \"3\">末页</font></p>";
	// 	}
	// 	else{
	// 		echo "<a href='$PATH_INFO?page=$p_count'><font color=\"#2196F3\" size = \"3\">末页</font></a></p>";
	// 	}
	// 	echo "</center>";
	// 	echo "</td></tr>";
	// 	echo "</table>";
	// 	echo "<p>";
	// }

	echo "</table>";
	echo "</td></tr>";
	require "bottom.php";
	echo "</table>";
?>
