<meta http-equiv="Content-Type" content="text/html; charset=utf8" />

<?php
	error_reporting(0);
	if(!$_COOKIE['username'])						
	{
		"无用户登录！";
	}
	else											
	{
		if(!$_POST['old_pass'])						
		{
			echo "<html>";
			echo "<head>";
			echo "<title>Weigq-Blog</title>";
			echo "</head>";

			echo "<body>";


			echo "<script language=\"javascript\">";
			echo "function juge(theForm)";
			echo "{";
			echo "if (theForm.old_pass.value == \"\")";
			echo "{";
			echo "alert(\"原始密码不能为空\");";
			echo "theForm.old_pass.focus();";
			echo "return (false);";
			echo "}";
			echo "if (theForm.new_pass.value == \"\")";
			echo "{";
			echo "alert(\"新密码不能为空\");";
			echo "theForm.new_pass.focus();";
			echo "return (false);";
			echo "}";
			echo "if (theForm.new_pass.value.length < 6 )";
			echo "{";
			echo "alert(\"密码至少要6位！\");";
			echo "theForm.new_pass.focus();";
			echo "return (false);";
			echo "}";
			echo "if (theForm.re_pass.value !=theForm.new_pass.value)";
			echo "{";
			echo "alert(\"确认密码与密码不一致！\");";
			echo "theForm.re_pass.focus();";
			echo "return (false);";
			echo "}";
			echo "}";
			echo "</script>";


		echo "<style type=\"text/css\">";
		echo "a:hover { color: #F44336; text-decoration: underline}";
		echo "<!-- ";
		echo ".ss{
			box-shadow: 0 0 8px  3px #b0bec5;}";
		echo "-->"; 	
		echo "</style>";


			echo "<center>";
			

			echo "<td width=\"70%\">";
			echo "<table cellpadding=\"10\" cellspacing=\"0\" width=\"100%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";

			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><strong><font color=\"#ffffff\" size = \"4\">基本信息</font></strong></center></td>";
			echo "</tr>";

			echo "</td>";
			echo "</table>";
			echo "<p>";
			echo "<br>";


			echo "<center>";
			echo "<td width=\"70%\">";
			echo "<table cellpadding=\"8\" cellspacing=\"1\" width=\"95%\" align=\"center\" bgcolor=\"#ffffff\" class=\"ss\" >";	
			echo "<form action=pwdchg.php method=post onsubmit=\"return juge(this)\">";
			
			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">原密码</font></center></td>";
			echo "<td bgcolor=\"#2196F3\"><center><input type=\"password\" name=\"old_pass\" value=\"\" ></center></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">新密码</font></center></td>";
			echo "<td bgcolor=\"#2196F3\"><center><input type=\"password\" name=\"new_pass\" value=\"\" ></center></td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td bgcolor=\"#2196F3\"><center><font color=\"#ffffff\" size = \"4\">确认密码</font></center></td>";
			echo "<td bgcolor=\"#2196F3\"><center><input type=\"password\" name=\"re_pass\" value=\"\" ></center></td>";
			echo "</tr>";

		
			echo "</table></td></center><br>";

			echo "<tr>";
			echo "<td bgcolor=\"#ffffff\" colspan=\"2\"><center><input type=submit style=background-color:#2196F3;color:#ffffff value=\"确认\"></center></td>";
			echo "</tr>";
			echo "</form>";
		}

		else										
		{
			$old_pass=md5($_POST['old_pass']);		
			$new_pass=md5($_POST['new_pass']);
			require "conf.php";
			$link=mysql_connect($host,$user,$pass);
			mysql_select_db($db_name,$link);
			mysql_query("SET NAMES utf8");

			$sql="select * from $table_user where username='$_COOKIE[username]' and password='$old_pass'";
			$result=mysql_query($sql,$link);
			$row=mysql_fetch_array($result);
		
			if(!$row)								
			{
				echo "<html>";
				echo "<head>";
				echo "<title>WeigqBlog</title>";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=pwdchg.php\">";
				echo "</head>";
				echo "<body>";
				echo "error!";
				echo "</body>";
				echo "</html>";
			}
			else									
			{
				$sql="update $table_user set password='$new_pass' where username='$_COOKIE[username]' and password='$old_pass'";
				$result=mysql_query($sql,$link);		
				echo "<html>";
				echo "<head>";
				echo "<title>WeigqBlog</title>";
				echo "<meta http-equiv=\"refresh\" content=\"2; url=pwdchg.php\">";
				echo "</head>";
				echo "<body>";
				echo "<font align=\"center\" color=\"#2196F3\" size=\"6\">successfully!</font>";
				echo "</body>";
				echo "</html>";
			}
		}
	}
?>