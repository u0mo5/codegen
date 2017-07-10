<?php
$host="localhost";
$db_user="root";
$db_pass="root";
$db_name="txywdb";
$timezone="Asia/Shanghai";
$db_prefix="yw_";
$table="info_navi";

$link=mysql_connect($host,$db_user,$db_pass);
mysql_select_db($db_name,$link);
mysql_query("SET names UTF8");
$rs = mysql_query(" SET character_set_client = utf8 ;");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京