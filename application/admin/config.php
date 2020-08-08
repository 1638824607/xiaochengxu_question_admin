<?php


return [
    'extra_file_list'        => [THINK_PATH . 'helper' . EXT,'function.php' ],
    // 模板参数替换
     'view_replace_str' => [
         '__ADMIN__'    => '/public/static/admin',
     ],

    'paginate'               => [

        'type'      => 'page\Page',//分页类

        'var_page'  => 'page',

        'list_rows' => 15,

    ],

];