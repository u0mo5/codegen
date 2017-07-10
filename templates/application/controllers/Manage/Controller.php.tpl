<?php
/**
 * 动态管理
 * @author GL
 */
class Manage_{&$TABLE_UCFIRST&}Controller extends Ctrl_Nbase {
	/**
	*初始化，为session赋值
	*/
	private $myuser;
	public function init()
	{
		$bid = $_REQUEST['bid'];
		$this->assign('bid',$bid);
		if(!$bid){
			$this->redirect("/Manage_Bulbase/info");
		}
		parent::init();
		$session = Yaf_Session::getInstance();
        $session->start();
		$this->myuser = $session->get("xiaominguser");
	}
	/**
	* 动态列表页
	*/
	public function indexAction(){
		$bid = $_GET["bid"];
		$d_db = new DynamicModel();
		$pageSize = 15;//每页限制
		$where = "";
		$furl = "&bid=$bid";
		$countsql = "SELECT count(id) FROM dynamic where 1=1 AND isvalue = 1 AND bid = $bid $where";
		$count = $d_db->fetchQuery($countsql);
		$pageCurrent = $this->pageAssignAction($pageSize,$count[0][0],$furl);
		$sql = "SELECT * FROM dynamic where 1=1 AND isvalue = 1 AND bid = $bid $where ORDER BY id DESC LIMIT ".(($pageCurrent-1)*$pageSize).",".$pageSize;
		$res = $d_db->fetchQuery($sql);
		$this->assign('res',$res);
	}
	/**
	* 添加详情
	*/
	public function infoAction(){
		
	}
	/**
	* 编辑页面
	*/
	public function modifyAction(){
		$p = $_REQUEST['p'];
		$this->assign('p',$p);
		$id = $_REQUEST['id'];
		$this->assign('id',$id);
		$d_db = new DynamicModel();
		$sql = "SELECT * FROM dynamic where 1=1 AND id = $id";
		$dynres = $d_db->fetchQuery($sql);
		$this->assign('dynres',$dynres[0]);
	}
	/**
	* 编辑功能
	*/
	public function updateAction(){
		$bid = $_POST['bid'];
		$id = $_POST["id"];
		$p = $_POST["p"];
		$d_db = new DynamicModel();
		$data['time'] = time();
		$data['city_id'] = $this->myuser['city_id'];
		$data['user_id'] = $this->myuser['id'];
		$data['bid'] = $bid;
		$data['title'] = $_POST['title'];
		$data['describe'] = $_POST['describe'];
		// $keyword = str_replace("；", ";", $_POST['keyword']);
		// $data['keyword'] = $keyword;
		$data['content'] = $_POST['contents'];
		$condition['id'] = $id;
		$d_db->where($condition)->update($data);
		// $this->redirect("/Manage_Dynamic/index?bid={$bid}&p=$p");
		$this->showMsg('提交成功,您可以完善其它信息项',"/Manage_Dynamic/modify?id={$id}&bid={$bid}&p=$p");
	}
	/**
	* 添加功能
	*/
	public function insertAction(){
		$bid = $_POST['bid'];
		$d_db = new DynamicModel();
		$data['bid'] = $bid;
		$data['time'] = time();
		$data['city_id'] = $this->myuser['city_id'];
		$data['user_id'] = $this->myuser['id'];
		$data['title'] = $_POST['title'];
		$data['describe'] = $_POST['describe'];
		// $keyword = str_replace("；", ";", $_POST['keyword']);
		// $data['keyword'] = $keyword;
		$data['content'] = $_POST['contents'];
		$id = $d_db->insert($data);
		// $this->redirect("/Manage_Dynamic/index?bid={$bid}");
		// $this->showMsg('保存成功','/Manage_Bulbase/modify?id='.$_POST['id']);
		$this->showMsg('提交成功,您可以完善其它信息项',"/Manage_Dynamic/modify?id={$id}&bid={$bid}");

	}
	/**
	* ajax删除动态
	*/
	public function ajaxDelAction(){
		$strid = $_POST['id'];
		$d_db = new DynamicModel();
		$sql = "UPDATE dynamic set isvalue = 0 WHERE id in($strid)";
		$res = $d_db->fetchQuery($sql);
		$this->ajax($res);
	}
}