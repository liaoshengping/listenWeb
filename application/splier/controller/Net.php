<?php
/**
 * @author liaoshengping@haoxiaec.com
 * @Time: 2018/12/11 -11:01
 * @Version 1.0
 * @Describe:
 * 1:
 * 2:
 * ...
 */

namespace app\splier\controller;


use app\splier\model\Reg;
use app\splier\model\Users;
use app\splier\service\Email;
use app\splier\service\Query;

class Net
{
    public function get($datas){
        $url = $datas['listen'];
        $user_id = $datas['user_id'];
        $website = $datas['website'];
        $res  =Reg::get($website);
        if(empty($res)){
            return false;
        }
//        $url = 'http://www.php.cn/toutiao.html';
       $reg = json_decode($res['content'],true);
//       $reg =  [
//            'title'=>array('.ar-right >h2>a','text'),
//            'url'=>array('.ar-right >h2>a','href')
//        ];
        $data =(new Query())->queryDo($url,$reg,$res['site_url']);
        if(empty($data)){
            return "失败";
        }
        $send =[];
        $sum =0;
        $add = '';
        foreach ($data as $key=>$value){
            $cache = cache($value['title']);
            if($cache){
                continue;
            }
            cache($value['title'],$value['title']);
            $send[] = $value;
            $sum++;
            $add.=$value['title'].'连接：<a href ="'.$value['url'].'">点击查看</a><br><br>';
        }
        if($sum ==0){
            return '没有新增';
        }
        $msg = '关注的网站：'.$sum.'条数据<br>'.$add;
        //发送到邮箱
        $userinfo =Users::where(['id'=>$user_id])->find();
        if(empty($userinfo)){
            return false;
        }
        Email::send($userinfo['email'],$msg,$datas['remark']);
        echo $msg;
    }

}