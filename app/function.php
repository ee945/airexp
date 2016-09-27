<?php
/***************************************
 * 全局函数库
 * 1. 创建文件 app/function.php
 * 2. 修改项目 composer.json
    {
        ...
        "autoload": {
            ...
            "files": [
                "app/function.php"
            ]
            ...
        }
        ...
    }
 * 3. 运行 composer dump-autoload
 *
 **************************************/

/***************************************
 * theme()
 * 将视图view()中的路径加上前缀(模板文件夹)
 * 用于切换主题
 *
 **************************************/
function theme($view_path)
{
	return env('APP_TM', 'default').".".$view_path;
}