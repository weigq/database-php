<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	setcookie("username","");							
	echo "<html>";
	
	echo "<head>";
	echo "<title>WeigqBlog</title>";

	echo "<meta http-equiv=\"refresh\" content=\"3; url=mainpage.php\">";
	echo "</head>";

	echo "<body>";



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
				//echo "<strong><center><font color=\"#f44336\" size = \"5\">用户信息</font></center></strong>";

				echo "<td width=\"70%\">";
				echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";
				echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";
				//echo "<form method=\"post\" action=\"$PATH_INFO\" onsubmit=\"return juge(this)\">";

				echo "<tr>";
				echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">已成功退出！</font></strong></center></	td>";
				echo "</tr>";	

				echo "</td>";
				echo "</table>";
				echo "<p>";
				echo "<br>";	

	
	echo "</body>";
?>