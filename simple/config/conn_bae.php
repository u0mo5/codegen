<?php
/*
u0mo5
*/
$host="sqld.duapp.com:4050";
$db_user="5a0b6163b8014419b2c9f38d198c7503";
$db_pass="c026fbc397094f42a0d0633bb0991037";
$db_name="xCdjtvthUWnxVbxBnSwD";
$timezone="Asia/Shanghai";

$link=mysql_connect($host,$db_user,$db_pass);
mysql_select_db($db_name,$link);
mysql_query("SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone); //北京时间

