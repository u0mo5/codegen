<?php

	$result = array();

	include 'conn.php';
$rs = mysql_query(" SET character_set_client = utf8 ;");

echo <<<EOF

EOF;

$table="gykj_"."purchase_pay";
$sql = "SHOW full columns  FROM ".$table;
	$rs = mysql_query($sql);
	
	$items = array();
	while($row = mysql_fetch_row($rs)){
		array_push($items, $row);
//		var_dump ($row);

	//编辑器例子：	<th field="productid" width="100" editor="text">Product ID</th>
//	$str= sprintf('<th field="%s" width="100" editor="text">%s</th> ',$row[0],$row[8]);

	
	
	
	//js
//	$str= sprintf('<th data-options="field:\'%s\',width:80 ">%s</th> ',$row[0],$row[8]);
//$str= sprintf("   %s: '<input type=\"text\" name=\"%s[]\" value=\"'+obj.%s+'\"/>',",$row[0],$row[0],$row[0]);



echo htmlspecialchars($str).'<br>';
	}

echo <<<EOF

EOF;

?>