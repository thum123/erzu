<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class IndexController extends Controller
{

	//添加公众号页面
	public function actionAddwe()
	{
		return $this->renderAjax('add');
	}
	//把接收的公众号信息进行入库
	public function actionAddacc()
	{
		$server = $_SERVER;
		session_start();
		$session = Yii::$app->session;
			//组合随机的四个字母
		$re = '';
        $s = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        while(strlen($re)<4) {
            $re .= $s[rand(0, strlen($s)-1)]; //从$s中随机产生一个字符
        }
        $n=strpos($_SERVER['REQUEST_URI'],'w');//寻找位置
		$url = substr($_SERVER['REQUEST_URI'],0,$n);
		$url1 = 'http://'.$_SERVER['HTTP_HOST'].$url.'ceshi.php';

		$data['we_name'] = $_GET['we_name'];
		$data['we_num'] = $_GET['we_num'];
		$data['we_sta'] = $_GET['we_sta'];
		$data['appid'] = $_GET['appid'];
		$data['appsecret'] = $_GET['appsecret'];
		$data['url'] = $url1.'?tok='.$re;
		$data['tok'] = $re;
		$data['uid'] = $session['id'];
		$data['token'] = md5($re);
		// var_dump($data);
		$connection = \Yii::$app->db;
		$res = $connection->createCommand()->insert('account',$data)->execute();
		if($res)
		{
			echo json_encode($data);
		}
		else
		{
			echo 1;
		}



	}
	//组合随机的四个字母
	 // function makecode($num=4)
	 // {
  //       $re = '';
  //       $s = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  //       while(strlen($re)<$num) {
  //           $re .= $s[rand(0, strlen($s)-1)]; //从$s中随机产生一个字符
  //       }
  //       return $re;
  //   }

}

?>