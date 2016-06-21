<?php
// var_dump($_SERVER);die;
/**
  * wechat php test
  */

//define your token
//http://***/we-test.php?echostr=123?signature=ebb2f8651e4619c6ca5c943817564a5868f0cd74&timestamp=bb&nonce=cc
$tok = $_GET['tok'];
include 'pdo.php';
$data = $pdo -> query("select * from account where tok = '$tok'") -> fetch(PDO::FETCH_ASSOC);
//var_dump($data['we_id']);die;
//var_dump($data);die;
//if(empty($data))
//{
//return false;die;
//}
$sql = "select * from message where we_id = '$data[we_id]'";
//echo $sql;die;
//查询出自定义回复的消息
$arr = $pdo -> query($sql) -> fetchAll(PDO::FETCH_ASSOC);
//查询出自定义的菜单
$sql1 = "select * from menu where we_id = '$data[we_id]'";
//echo $sql1;die;
$info = $pdo -> query($sql1) -> fetchAll(PDO::FETCH_ASSOC);
//var_dump($info);die;
$con = array();
foreach($info as $k=>$v)
{
    if($v['type']==0&&$v['f_id']==0)
    {
        $con[0] = $v;
    }
    elseif($v['type']==1&&$v['f_id']==0)
    {
        $con[1] = $v;
    }
}

foreach($con as $k=>$v)
{
    // $me_id = $v[' me_id'];
     $sqls = "select * from menu where f_id = '$v[me_id]' and type = '$v[type]'";
    //echo $sqls;die;
    $con[$k]['son'] = $pdo -> query($sqls) -> fetchAll(PDO::FETCH_ASSOC);  

}
define("TOKEN", "$data[token]");
define("APPID", "$data[appid]");
define("APPSECRET", "$data[appsecret]");

$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid($arr,$con);

class wechatCallbackapiTest
{
	public function valid($arr,$info)	
    {
        //echo $arr[0]['backwords'];die;
        $echoStr = $_GET["echostr"];
        //valid signature , option
        $arrs = $arr;
        $infos = $info;
        if($this->checkSignature()){
			echo $echoStr;
            $this->createMenu($infos);
		    $this->responseMsg($arrs);
        	exit;
        }
    }

	private function getAccesstoken(){
		/*
		$redis = new redis();
		$result = $redis->pconnect('127.0.0.1',"6379");
		$access_token = $redis->get("1408f_weixinaccesstoken");
		if($access_token){
			return $access_token;
		}else{
			$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
			$json=file_get_contents($url);
			$arr=json_decode($json,true);
			$redis->setex("1408f_weixinaccesstoken",7000,$arr['access_token']);
			return $arr['access_token'];
		}
		*/
		$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
		$json=file_get_contents($url);
		$arr=json_decode($json,true);
		return $arr['access_token'];
		
	}
	
	public function createMenu($info){
        // echo 123;die;
        $accessToken=$this->getAccesstoken(); 
        //return $info;die;
        //$accessToken = "RIsY004XJScwRfq4UEUykmXB9JfCqr5Dm67U4gtIH42lnOnxoyrmuGHAi36Zp3OsThNzAFINgeHOiEhvzPNMxlznhbcXaw5w08f0tcggHC_hdnTY1qqFamZLVUkDIjLOLJUdABAUSD";
		$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accessToken;
        // return $url;die;
        $data = "";
        $str = "";
		  $data .= '
               {';
        $data .= '
                  "button": [';
              foreach($info as $k=>$v){
                  if($v['type']==0)
                  {    
                    $data.='{
                            "name": "'.$v['data'].'", ';
                     
                          if(empty($v['son']))
                     {
                     	$data.='"sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "  ", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }]';
                     }
                      else
                      {
                       $data.='
                            "sub_button": [';
                       foreach($v['son'] as $key=>$val){
                          $str.='
                                {
                                    "type": "scancode_waitmsg", 
                                    "name": "'.$val['data'].'", 
                                    "key": "rselfmenu_0_0", 
                                    "sub_button": [ ]
                                },';
                            }
                      $data.=substr($str,0,strlen($str)-1); 
                          $data.='
                            ]
                        }, 
                    ';
                      }
                    
                  }elseif($v['type']==1){
                  
                  $data.='{
                            "name": "'.$v['data'].'", ';
                     if(empty($v['son']))
                     {
                     	$data.='"sub_button": [
                {
                    "type": "scancode_waitmsg", 
                    "name": "  ", 
                    "key": "rselfmenu_0_0", 
                    "sub_button": [ ]
                }]';
                     }
                      else
                      {
                       $data.='
                            "sub_button": [';
                       foreach($v['son'] as $key=>$val){
                          $str.='
                                {
                                    "type": "scancode_waitmsg", 
                                    "name": "'.$val['data'].'", 
                                    "key": "rselfmenu_0_0", 
                                    "sub_button": [ ]
                                },';
                            }
                      $data.=substr($str,0,strlen($str)-1); 
                          $data.='
                            ]
                        }, 
                    ';
                      }
                     
                  }
         
                 }
      $data.=' }';
        // return $data;die;
		 $json=$this->curlPost($url,$data,'POST');
        return $json;
        //echo $json;
	}
	
	

    public function responseMsg($arr)
    {
        // return $arr[0]['backwords'];die;
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
				/*if($postObj->MsgType=="event"){
					
				}*/
				$time = time();
                if($postObj->Event=="CLICK"){
					$textTpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<Image>
								<MediaId><![CDATA[%s]]></MediaId>
								</Image>
								</xml>";  
					$msgType = "image";
					$contentStr = "JbnMpXkMbaN6lNT8yXEqUI33tdflzHil1OXH5WCym25TE1PLDnDHeSLdoGw4jU_z";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
					echo $resultStr;
				}else{
					$keyword = trim($postObj->Content);

					$textTpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<Content><![CDATA[%s]]></Content>
								<FuncFlag>0</FuncFlag>
								</xml>";             
					if(!empty( $keyword ))
					{	
		
                        foreach($arr as $k=>$v)
                        {
                        	 if($keyword==$v[keywords]){
							$msgType = "text";
							$contentStr = $v[backwords];
							$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
							echo $resultStr;
                            }
                        }
                        //else
                        //{
                        //       $msgType = "text";
                        //        $contentStr = "无法识别";
                        //      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        //       echo $resultStr;
                        //   }
                    
						
						
					}else{
						
						
						
						$msgType = "text";
						$contentStr = $postObj->Event;
						$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
						echo $resultStr;
						//echo "Input something...";
					}
				}
				

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
		//$signature = "ebb2f8651e4619c6ca5c943817564a5868f0cd74";
        //$timestamp = "bb";
        //$nonce = "cc";
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
        return true;
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	public function curlPost($url,$data,$method){  
		$ch = curl_init();   //1.初始化  
		curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式  
		//4.参数如下  
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);  
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器  
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);  
			curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容  
			curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');  
		  
		if($method=="POST"){//5.post方式的时候添加数据  
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
		}  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		$tmpInfo = curl_exec($ch);//6.执行  
	  
		if (curl_errno($ch)) {//7.如果出错  
			return curl_error($ch);  
		}  
		curl_close($ch);//8.关闭  
		return $tmpInfo;  
	}
}

?>
