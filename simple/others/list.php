<?php

	$result = array();

	include 'conn.php';
$rs = mysql_query(" SET character_set_client = utf8 ;");

/*echo <<<EOF
  $("#Core_User").datagrid({
        title: "",
        singleSelect:true,
        nowrap:true,
        border: false,
        fitColumns: true,
        fit: true,
        toolbar: Core_User.toolbar,
        idField: 'uid',
        rownumbers: true,
        animate: true,
        url: "<{:U('Core/User')}>",
        columns:[[
EOF;
*/
$table="gykj_"."warehouse";
$sql = "SHOW full columns  FROM ".$table;
	$rs = mysql_query($sql);
	
	$items = array();
	while($row = mysql_fetch_row($rs)){
		array_push($items, $row);
//		var_dump ($row);
		
	//	$str= sprintf('<th field="%s" width="60" align="right">%s</th>',$row[0],$row[8]);
	//	echo sprintf("  {field:'%s',title:'%s',width:50},",$row[0],$row[8])."<br>";
	$str= sprintf('<th data-options="field:\'%s\',width:80 ">%s</th> ',$row[0],$row[8]);

echo htmlspecialchars($str).'<br>';
	}

echo <<<EOF
        ]],
        pagination:true,
        pagePosition:'bottom',
        pageNumber:1,
        pageSize:20,
        pageList:[20,30,50],
        /*
         onDblClickRow: function(rowIndex,rowData){
         Core_User.edit(rowData.id);
         },
         */
        onRowContextMenu: function(e, rowIndex,rowData){
            e.preventDefault(); //阻止浏览器捕获右键事件
            $(this).datagrid("unselectAll"); //取消所有选中项
            $(this).datagrid("selectRow",rowIndex); //根据索引选中该行
            $('#Core_User_Menu').menu('show', {//显示右键用户
                left: e.pageX,//在鼠标点击处显示用户
                top: e.pageY
            });
        }
    });
EOF;

?>