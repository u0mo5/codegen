<?php

	$result = array();
	include 'conn.php';
$rs = mysql_query(" SET character_set_client = utf8 ;");

echo <<<EOF

EOF;


$sql = "SHOW full columns  FROM ".$db_prefix.$table;
	$rs = mysql_query($sql);
	
	$items = array();
	$i=0;
	echo htmlspecialchars('<li>').'<br>';
	while($row = mysql_fetch_row($rs)){
		
		array_push($items, $row);
		$i++;
$row[3]=$row[3]=="YES"?"false":"true";
//		var_dump ($row);


$str= sprintf('<span class="titi"><i>*</i>%s</span><span><input id="%s" name="%s" class="easyui-textbox"  data-options="required:%s"  style="width:200px; height:28px;"></span> ',$row[8],$row[0],$row[0],$row[3]);
		if($i%2==0){
			$str=''.$str.'</li><li>';
		}
echo htmlspecialchars($str).'<br>';
	}



?>