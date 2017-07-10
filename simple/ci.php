<?php
include 'conn.php';
$sql = "SHOW full columns  FROM ".$db_prefix.$table;
//$rs = mysql_query($sql);


property($table,$sql);
create($table,$sql);
select($table,$sql);
input($table,$sql);




	
//例子：    public $warehouse_id ;
function property($table,$sql){
		$rs = mysql_query($sql);
		$items = array();
	while($row = mysql_fetch_row($rs)){
		array_push($items, $row);
		$str1= sprintf('        public $%s ; ',$row[0]);
		echo htmlspecialchars($str1).'<br>';
	}
}	
	
//例子：	        $this->db->set ( 'category_name', $this->category_name );
function create($table,$sql){
		$rs = mysql_query($sql);
		$items = array();
		while($row = mysql_fetch_row($rs)){
		array_push($items, $row);
		$str= sprintf('        $this->db->set ( "%s", $this->%s ); ',$row[0],$row[0]);
		echo htmlspecialchars($str).'<br>';
		}
}


//例子：select warehouse_id,company_id,name,address,city_id from table
function select($table,$sql){
		$rs = mysql_query($sql);
		$items = array();
		while($row = mysql_fetch_row($rs)){
		$items[]=$row[0];
		}
		$array=implode(",",$items);
		echo "select ".$array." from ".$table.'<br>';	
}

function input($table,$sql){
			$rs = mysql_query($sql);
		$items = array();
		while($row = mysql_fetch_row($rs)){
		array_push($items, $row);
		$str= sprintf(" \$this->".ucfirst($table)."_model->%s = \$%s  = \$this->input->post('%s');   ",$row[0],$row[0],$row[0]);
		echo htmlspecialchars($str).'<br>';
		}
}	
		
	
function echo_eof(){
echo <<<EOF

EOF;
}	
//----------------------------------------


?>