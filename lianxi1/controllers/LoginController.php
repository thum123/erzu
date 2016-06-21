<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class LoginController extends Controller
{
	public function actionLogin()
	{
		//判断是否安装如果没有则进行安装
		$filename = '../config/install.php';
		if(!file_exists($filename))
		{
			//安装页面
			// var_dump($_SERVER);die;
			$n=strpos($_SERVER['REQUEST_URI'],'w');//寻找位置
			$url = substr($_SERVER['REQUEST_URI'],0,$n);
			 $url1 = 'http://'.$_SERVER['HTTP_HOST'].$url.'yanzheng.php';
			 // echo $url1;die;
			return $this->renderAjax('install_1',['url'=>$url1]);die;
		}
		else
		{
				session_start();
				$session = Yii::$app->session;
				// session_destroy();die;

				// if(isset($session['name'])){
					
				// }
				// else
				// {
					 return $this->renderAjax('login');
				// }
		}

	}
//进行安装2
	public function actionAnzhuang()
	{
		return $this->renderAjax('install_2');
	}
//进行安装3
	public function actionAnzhuang3()
	{
		$n=strpos($_SERVER['REQUEST_URI'],'w');//寻找位置
		$url = substr($_SERVER['REQUEST_URI'],0,$n);
		 $url1 = 'http://'.$_SERVER['HTTP_HOST'].$url.'yanzheng.php';

		$db = \Yii::$app->db;
		$filename = '../config/install.php';
		$connection = \Yii::$app->db;
		$data['name'] = $_POST['name'];
		$data['pass'] = $_POST['pass'];
		$pass2 = $_POST['pass2'];
		if($pass2 == $data['pass'])
		{
			$res = $db->createCommand()->insert('user', $data)->execute();
			if($res)
			{
				$time = time();
				file_put_contents($filename, "$time");
				echo "<script>alert('恭喜你,成了!')</script>";
				header('refresh:0;url=index.php?r=login/login');die;
			}
		}
		else
		{
			echo "<script>alert('密码与确认密码不一致!')</script>";
			header('refresh:0;url=index.php?r=login/anzhuang');die;
		}
	}
	public function actionDologin()
	{
		$db = \Yii::$app->db;
		$session = Yii::$app->session;
		$name = $_POST['username'];
		$pass = $_POST['password'];
		$sql = "select * from user where name='$name' and pass='$pass'";
		// echo $sql;die;
		$command = $db->createCommand($sql);
		$res = $command->queryAll();
		// var_dump($res);die;
		if($res)
		{
			$session->set('name', $name);
			$session->set('id', $res[0]['uid']);
			header('refresh:0;url=index.php?r=login/index');die;
		}
	}
	public function actionIndex()
	{
		$this->layout = false;
		session_start();
		$session = Yii::$app->session;
		if(isset($session['name'])){
			return $this->render('index');
		}
		else
		{
			echo "<script>alert('请先登录')</script>";
			header('refresh:0;url=index.php?r=login/login');die;
		}
		
	}


}

?>