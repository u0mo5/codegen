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
	$i=0;

	while($row = mysql_fetch_row($rs)){
		
//		var_dump ($row);

// $data['supplier_id'] = $supplier_id = (int)$this->input->post('supplier_id');
$str= sprintf(" \$data['%s'] = \$%s = \$this->input->post('%s');",$row[0],$row[0],$row[0]);

echo htmlspecialchars($str).'<br>';
	}



?>