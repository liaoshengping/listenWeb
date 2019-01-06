<?php

namespace app\index\controller;

use app\splier\controller\Net;
use app\splier\model\Listen;

class Index
{
    public function index()
    {

        $data = Listen::order('update_time', 'asc')->find();
        dump($data);
        exit;
        if (empty($data)) {
            return '失败';
        }
        $res = (new Net())->get($data);
        Listen::where(['id' => $data['id']])->update(['update_time' => time()]);
    }

    /**
     *  获取上证指数的接口
     */
    public function test()
    {
        $data = file_get_contents('http://nufm.dfcfw.com/EM_Finance2014NumericApplication/JS.aspx?type=CT&cmd=0000011,3990012,3990052,3990062,hsi5,djia7&sty=MPNSBAS&st=&sr=1&p=1&ps=1000&token=44c9d251add88e27b65ed86506f6e5da&cb=callback07352083796460351&callback=callback07352083796460351&_=1545112071463');
        $data2 = $this->f3($data); //返回爱
//        echo $data;
        dump(json_decode($data2));
        exit;
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    function f1($str)
    {
        $result = array();
        preg_match_all("/^(.*)(?:<)/i", $str, $result);
        return $result[1][0];
    }

    function f2($str)
    {
        $result = array();
        preg_match_all("/(?:<)(.*)(?:>)/i", $str, $result);
        return $result[1][0];
    }

    function f3($str)
    {
        $result = array();
        preg_match_all("/(?:\()(.*)(?:\))/i", $str, $result);
        return $result[1][0];
    }

    function f4($str)
    {
        $result = array();
        preg_match_all("/(?:\[)(.*)(?:\])/i", $str, $result);
        return $result[1][0];
    }

    function f5($str)
    {
        $result = array();
        preg_match_all("/(?:\{)(.*)(?:\})/i", $str, $result);
        return $result[1][0];
    }
}
