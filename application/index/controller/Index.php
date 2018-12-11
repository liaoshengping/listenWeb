<?php
namespace app\index\controller;

use app\splier\controller\Net;
use app\splier\model\Listen;

class Index
{
    public function index()
    {
        $data=Listen::order('update_time','asc')->find();
        if(empty($data)){
            return '失败';
        }
        $res =(new Net())->get($data);
        Listen::where(['id'=>$data['id']])->update(['update_time'=>time()]);
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
