<?php
// var_dump($_SERVER);die;
$n=strpos($_SERVER['REQUEST_URI'],'y');//寻找位置
$url = substr($_SERVER['REQUEST_URI'],0,$n);

// echo $url1;die;
header('content-type:text/html;charset=utf-8');
error_reporting(0);
		$name = $data['name'] = $_POST['name'];
		$shujuku = $data['shujuku'] = $_POST['shujuku'];
		$duankou = isset($_POST['duankou'])?$_POST['duankou']:1;
		// echo $shujuku;die;
		$pass = $data['pass'] = $_POST['pass'];
		$ku_name = $data['ku_name'] = $_POST['ku_name'];
		$cn = mysql_connect("$data[shujuku]","$data[name]","$data[pass]");
		if(!$cn)
		{
			$url1 = 'http://'.$_SERVER['HTTP_HOST'].'/'.$url.'web/index.php?r=login/login';
				echo "<script>alert('数据库地址或用户名密码填写错误!')</script>";
				 header("refresh:0;url=web/index.php?r=login/login");die;
		}
		else
		{
			$url2 = 'http://'.$_SERVER['HTTP_HOST'].$url.'web/index.php?r=login/anzhuang';
			//var_dump($url2);die;
			$url1 = 'http://'.$_SERVER['HTTP_HOST'].'/'.$url.'web/index.php?r=login/login';
			//创建表和库
			$database="$ku_name";
			$sqlDatabase = 'create database '.$database; 
			mysql_query($sqlDatabase, $cn);
			mysql_select_db("$ku_name",$cn); 
			$sqlTable1="create table account (
				we_id int unsigned not null auto_increment primary key,
				we_name varchar(255),
				we_sta varchar(33),
				appid varchar(111),
				appsecret varchar(44),
				we_num varchar(111),
				token varchar(111),
				url varchar(111),
				tok varchar(111),
				uid int(11)
				)"; 
			$sqlTable2="create table menu (
				me_id int unsigned not null auto_increment primary key,
				data varchar(255),
				url varchar(33),
				f_id varchar(111),
				type varchar(44),
				we_id varchar(111)
				)";
			$sqlTable3="create table message (
				m_id int unsigned not null auto_increment primary key,
				keywords varchar(255),
				we_id varchar(33),
				backwords varchar(111)
				)"; 
			$sqlTable4="create table user (
				uid int unsigned not null auto_increment primary key,
				name varchar(255),
				pass varchar(33)
				)"; 
			//执行创建表的语句
			mysql_query($sqlTable1);
			mysql_query($sqlTable2);
			mysql_query($sqlTable3);
			$res = mysql_query($sqlTable4);
			if($res)
			{
						$str = "<?php
							return [
							    'class' => 'yii\db\Connection',
							    'dsn' => 'mysql:host=".$data['shujuku'].";dbname=".$data['ku_name']."',
							    'username' => '".$data['name']."',
							    'password' => '".$data['pass']."',
							    'charset' => 'utf8',
							];";
						$res = file_put_contents('./config/db.php', $str);
						if($duankou==1)
						{
							$reg = '<?php
							$pdo = new PDO("mysql:host='.$data['shujuku'].';dbname='.$data['ku_name'].'","'.$data['name'].'","'.$data['pass'].'");
							$pdo -> exec("set names utf8");
							';
						}else
						{
							$reg = '<?php
							$pdo = new PDO("mysql:host='.$data['shujuku'].';port='.$duankou.';dbname='.$data['ku_name'].'","'.$data['name'].'","'.$data['pass'].'");
							$pdo -> exec("set names utf8");
							';
						}

						file_put_contents('pdo.php', $reg);
						if($res)
						{
							header("refresh:2;url=web/index.php?r=login/anzhuang");die;

						}
						else
						{
							 header("refresh:0;url=web/index.php?r=login/login");die;
						}
			}
			else
			{
				// echo '创建数据库错误'.mysql_error();
				echo "<script>alert('创建数据库错误".mysql_error()."')</script>";
				 header("refresh:0;url=web/index.php?r=login/login");die;
			}



		}

?>
