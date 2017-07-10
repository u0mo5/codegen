<?php
include 'config/conn.php';

$sql = "SHOW full columns  FROM ".$db_prefix.$table;
//$rs = mysql_query($sql);

table_name($table,$sql);
dategrid($table,$sql);
input($table,$sql);




function table_name($table,$sql){
	echo "表名：".$table."<br>"."<br>";
}
	
//例子：    public $warehouse_id ;
function dategrid($table,$sql){
		$rs = mysql_query($sql);
		$items = array();
	while($row = mysql_fetch_row($rs)){
		array_push($items, $row);
	$str= sprintf('<th data-options="field:\'%s\',width:80 %s">%s</th> ',$row[0],filter($row[0]),$row[8]);
		echo htmlspecialchars($str).'<br>';
	}
}	
	
//例子：	        $this->db->set ( 'category_name', $this->category_name );
function input($table,$sql){
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
}

function filter($obj){
	if($obj=="is_delete"||$obj=="created_at"||$obj=="updated_at"){
		return ",hidden:true";
	}
	
}

		
	
function echo_eof(){
echo <<<EOF

EOF;
}	
//----------------------------------------


?>