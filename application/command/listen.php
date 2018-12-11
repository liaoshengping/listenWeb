<?php

namespace app\command;

use app\index\controller\Index;
use think\console\Command;
use think\console\Input;
use think\console\Output;

class listen extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('listen');
        // 设置参数
        
    }

    protected function execute(Input $input, Output $output)
    {
        (new Index())->index();
    	// 指令输出
    	$output->writeln('成功');
    }
}
