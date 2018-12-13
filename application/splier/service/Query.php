<?php
/**
 * @author liaoshengping@haoxiaec.com
 * @Time: 2018/12/11 -11:04
 * @Version 1.0
 * @Describe:
 * 1:
 * 2:
 * ...
 */

namespace app\splier\service;


use QL\QueryList;

class Query
{
    public function queryDo($url ='',$reg=[],$site=''){
        if(empty($url) || empty($reg)){
            return false;
        }
        if($site ==''){
            $data = QueryList::get($url)
                // 设置采集规则
                ->rules($reg)
                ->queryData();
            return $data;
        }else{
            $data = QueryList::get($url)
                // 设置采集规则
                ->rules($reg)
                ->queryData(function ($item)use ($site){
                    $item['url'] = $site.$item['url'];
                    return $item;
                });
            return $data;
        }

    }

}