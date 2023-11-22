<?php
error_reporting(E_ERROR);
@$link = mysql_connect("localhost","root","");
@$db = mysql_select_db("market",$link);

function checkSession()
{

	if($_SESSION['user_id']=='')
	{
		header('Location: index.php');
	}


}
?>