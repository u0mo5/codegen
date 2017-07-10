<?php

/**
 * 优惠团购 控制器
 * @author
 */
class {&$TABLE_UCFIRST&}Controller extends Ctrl_Base {

	/**
	 * 优惠团购
	 */
	public function indexAction() {
		$city_id = $this->cityId;


		$bid=$_REQUEST['bid'];//todo
        $this->assign('direction_res',$GLOBALS['DIRECTION']);

        //实例化
        $db=$building_db = new BuildingModel();//楼盘基础
        $apartment_db= new ApartmentsModel();//楼盘基础
//        $temp=$apartment_db->getRoom(1);
//        $this->console_log($temp);exit;
        //轮播图
		$banner_sql = "SELECT  img_url,link_url FROM purchase WHERE city_id = $city_id and link_url!='' ORDER BY content_id ASC LIMIT 5";
        $banner_res = $building_db->fetchQuery($banner_sql);
        $this->assign('banner_res',$banner_res);
        //楼盘基础信息
        $pageSize = 20;//每页限制

/*
 * leavemsg  type=2   是报名类留言
 * promotetype  1  是 楼盘优惠 2 户型优惠 即   yhtype
 */
$where="";
if($bid){
    $where.=" and t1.id={$bid}  ";
}

		$building_sql =
"
SELECT
	t1.`name`,
	t1.id,
	t1.id as bid,
	t2.youhui,
	t2.youhui_content,
	t2.id AS yhid,
	1 as yhtype,
    0+CAST(IFNULL(l.num,0) AS signed)+CAST(IFNULL(t2.minger,0) AS signed) as total
FROM
	building t1
INNER JOIN selling t2 ON t1.id = t2.bid 

LEFT  JOIN (
	SELECT
		leavemsg.promote_id,
		leavemsg.promote_type,
		count(*) as num
	FROM
		leavemsg
	WHERE
		type = 2
	GROUP BY
		promote_id,
		promote_type
) l ON l.promote_id = t2.id AND l.promote_type = 1

WHERE
	t1.isvalue = 1
AND t1.publish = 2
AND t2.youhui != ''
AND t1.city_id = {$city_id} 
{$where}
";
		$building_res = $building_db->fetchQuery($building_sql);
//        $this->console_log ("debug:".$building_sql);




        $apartment_sql =
"
SELECT
	t1.`name`,
	t1.id,
	t2.bid,
	t2.youhui,
	t2.id AS yhid,
	t2.youhui_content,
	2 as yhtype,
    0+CAST(IFNULL(l.num,0) AS signed)+CAST(IFNULL(t2.minger,0) AS signed) as total
FROM
	building t1
INNER JOIN apartments t2 ON t1.id = t2.bid 

LEFT  JOIN (
	SELECT
		leavemsg.promote_id,
		leavemsg.promote_type,
		count(*) as num
	FROM
		leavemsg
	WHERE
		type = 2
	GROUP BY
		promote_id,
		promote_type
) l ON l.promote_id = t2.id AND l.promote_type = 2

WHERE
	t1.isvalue = 1
AND t1.publish = 2
AND t2.youhui != ''
AND t2.isvalue = 1 
AND t1.city_id = {$city_id} 
{$where}

";
        $apartment_res = $building_db->fetchQuery($apartment_sql);

        $data=array_merge($building_res,$apartment_res);
        $count=count($data);

        foreach ( $data as $key => $row ){
            $num1[$key] = $row ['total'];
            $num2[$key] = $row ['id'];
        }

        array_multisort($num1, SORT_DESC, $num2, SORT_DESC, $data);
//$this->console_log ($data);
//        $this->console_log ("debug:".$apartment_sql);

//echo $apartment_sql;exit;


        $pageCurrent = $this->pageAssignAction($pageSize,$count);
        $out=array_slice($data,($pageCurrent-1)*$pageSize,$pageSize);

        foreach($out as $k=>$val)
        {
            if($val['yhtype']==1){
                $db= new BuildingModel();
                $out[$k]['info']=$db->getBuilding($val['id']);
            }elseif ($val['yhtype']==2){
                $db= new ApartmentsModel();
                $out[$k]['info']=$db->getRoom($val['yhid']);
            }
        }
        $this->assign('res',$out);
//$this->console_log($out);

        $this->assign('pricetype_res',array('1'=>'均价','2'=>'起价'));
        $this->assign('unittype_res',array('1'=>'元/㎡','2'=>'元/㎡·月','3'=>'元/㎡·天','4'=>'元/月','5'=>'万元','6'=>'万元/年','7'=>'元/套','8'=>'万元/套'));


}



}
