<?php
namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\data\Pagination;
use app\models\Account;
class ListsController extends Controller
{
	//公众号列表
	public function actionLists()
	{
		session_start();
		$session = Yii::$app->session;
		$uid = $session['id'];
		$query = Account::find()->where(['uid' => $uid]);
		$pagination = new Pagination([
		'defaultPageSize' => 8,                    //每页的条数
		'totalCount' => $query->count(),
		]);

		$countries = $query
		->offset($pagination->offset)
		    ->limit($pagination->limit)
		    ->all();

		return $this->renderAjax('lists', [               //要遍历的页面
		'countries' => $countries,                  //遍历的数据 
		'pagination' => $pagination,                //分页下面的样式
		]);
	}
	//自定义回复消息
	public function actionMessage()
	{
		$we_id = $_GET['we_id'];
		// echo $we_id;die;
		return $this->renderAjax('message',['we_id'=>$we_id]);
	}
	//添加自定义回复消息
	public function actionAddmessage()
	{
		$connection = \Yii::$app->db;
		$data['we_id'] = $_POST['we_id'];
		$we_id = $data['we_id'];
		$data['keywords'] = $_POST['keywords'];
		$data['backwords'] = $_POST['backwords'];
		$res = $connection->createCommand()->insert('message',$data)->execute();
		if($res)
		{
			echo "<script>alert('添加成功')</script>";
			header("refresh:0;url=index.php?r=lists/message&we_id=$we_id");die;
		}
		else
		{
			echo "<script>alert('添加失败')</script>";
			header("refresh:0;url=index.php?r=lists/message&we_id=$we_id");die;
		}
	}
	//自定义回复消息列表
	public function actionMelists()
	{
		$db = \Yii::$app->db;
		$we_id = $_GET['we_id'];
		$sql = "select * from message where we_id = '2'";
		$command = $db->createCommand($sql)->queryAll();
		// var_dump($command);die;
		// $posts = $command
		// var_dump($posts);die;
		return $this->renderAjax('message_list',['data'=>$command]);

	}
	//添加菜单栏表单
	public function menu()
	{
		$we_id = $_GET['we_id'];
		return $this->renderAjax('menu');
	}


}