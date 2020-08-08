<?php
namespace page;

// +----------------------------------------------------------------------

// | ThinkPHP [ WE CAN DO IT JUST THINK ]

// +----------------------------------------------------------------------

// | Copyright (c) 2006~2017 http://thinkphp.cn All rights reserved.

// +----------------------------------------------------------------------

// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )

// +----------------------------------------------------------------------

// | Author: zhangyajun <448901948@qq.com>

// +----------------------------------------------------------------------



use think\Paginator;



class Page extends Paginator

{



    //首页

    protected function home() {

        if ($this->currentPage() > 1) {

            return "首页";

        } else {

            return "首页";

        }

    }



    //上一页

    protected function prev() {

        if ($this->currentPage() > 1) {

            return "上一页";

        } else {

            return "上一页";

        }

    }



    //下一页

    protected function next() {

        if ($this->hasMore) {

            return "下一页";

        } else {

            return "下一页";

        }

    }



    //尾页

    protected function last() {

        if ($this->hasMore) {

            return "尾页";

        } else {

            return "尾页";

        }

    }



    //统计信息

    protected function info(){

        return "共" . $this->lastPage ."页" . $this->total . "条数据";

    }



    /**

     * 页码按钮

     * @return string

     */

    protected function getLinks()

    {



        $block = [

            'first'  => null,

            'slider' => null,

            'last'   => null

        ];



        $side   = 3;

        $window = $side * 2;



        if ($this->lastPage < $window + 6) {

            $block['first'] = $this->getUrlRange(1, $this->lastPage);

        } elseif ($this->currentPage <= $window) {

            $block['first'] = $this->getUrlRange(1, $window + 2);

            $block['last']  = $this->getUrlRange($this->lastPage - 1, $this->lastPage);

        } elseif ($this->currentPage > ($this->lastPage - $window)) {

            $block['first'] = $this->getUrlRange(1, 2);

            $block['last']  = $this->getUrlRange($this->lastPage - ($window + 2), $this->lastPage);

        } else {

            $block['first']  = $this->getUrlRange(1, 2);

            $block['slider'] = $this->getUrlRange($this->currentPage - $side, $this->currentPage + $side);

            $block['last']   = $this->getUrlRange($this->lastPage - 1, $this->lastPage);

        }



        $html = '';



        if (is_array($block['first'])) {

            $html .= $this->getUrlLinks($block['first']);

        }



        if (is_array($block['slider'])) {

            $html .= $this->getDots();

            $html .= $this->getUrlLinks($block['slider']);

        }



        if (is_array($block['last'])) {

            $html .= $this->getDots();

            $html .= $this->getUrlLinks($block['last']);

        }



        return $html;

    }



    /**

     * 渲染分页html

     * @return mixed

     */

    public function render()

    {

        if ($this->hasPages()) {

            if ($this->simple) {

                return sprintf('%s %s %s %s',

                    $this->css(),

                    $this->prev(),

                    $this->getLinks(),

                    $this->next()

                );

            } else {

                return sprintf('%s %s %s %s %s %s %s',
                    $this->css(),

                    $this->home(),

                    $this->prev(),

                    $this->getLinks(),

                    $this->next(),

                    $this->last(),

                    $this->info()

                );

            }

        }

    }



    /**

     * 生成一个可点击的按钮

     *

     * @param  string $url

     * @param  int    $page

     * @return string

     */

    protected function getAvailablePageWrapper($url, $page)

    {

        return '' . $page . '';

    }



    /**

     * 生成一个禁用的按钮

     *

     * @param  string $text

     * @return string

     */

    protected function getDisabledTextWrapper($text)

    {

        return '' . $text . '';

    }



    /**

     * 生成一个激活的按钮

     *

     * @param  string $text

     * @return string

     */

    protected function getActivePageWrapper($text)

    {

        return '' . $text . '';

    }



    /**

     * 生成省略号按钮

     *

     * @return string

     */

    protected function getDots()

    {

        return $this->getDisabledTextWrapper('...');

    }



    /**

     * 批量生成页码按钮.

     *

     * @param  array $urls

     * @return string

     */

    protected function getUrlLinks(array $urls)

    {

        $html = '';



        foreach ($urls as $page => $url) {

            $html .= $this->getPageLinkWrapper($url, $page);

        }



        return $html;

    }



    /**

     * 生成普通页码按钮

     *

     * @param  string $url

     * @param  int    $page

     * @return string

     */

    protected function getPageLinkWrapper($url, $page)

    {

        if ($page == $this->currentPage()) {

            return $this->getActivePageWrapper($page);

        }



        return $this->getAvailablePageWrapper($url, $page);

    }



    /**

     * 分页样式

     */

    protected function css(){

        return '  ';


    }

}
