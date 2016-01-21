<?php
/**
 * Created by PhpStorm.
 * User: jianchao
 * Date: 15-12-31
 * Time: 下午6:34
 */


define("P_COUNTS", 5);
class Page{
    private $pcount;            //count of paper list
    private $now;               //the index of cur-page    0: home page
    private $pages;             //count of page
    private $url;

    public function __construct($count = 1, $n=0, $u) {
        $this->now = $n;
        $this->pcount = $count;
        $this->pages = (int)($this->pcount/P_COUNTS) + ($this->pcount % P_COUNTS > 0 ? 1 : 0);
        //echo "now: $this->now, pcount: $this->pcount, pages: $this->pages<br>";
        $this->url = $u;
    }

    public function get_html() {


        $str = '<link href="application/views/pages/css/page_np.css" rel="stylesheet">';

        $str = $str . '<div id="papelist" class="pagelist">';
        $str = $str . '<span> ' . $this->pcount . '条数据  共' . $this->pages  . '页</span>' . '<strong>' . ($this->now+1) . '</strong>';

        if( ($this->now - 1) >= 0 ) {
            $str = $str . "<a href=\"" .  site_url($this->url . ($this->now - 1)) . "\">上一页</a>";
        } else {
            $str = $str . "<a href=\"" .  site_url($this->url . ($this->pages-1) ) . "\">尾页</a>";
        }

        if( ($this->now + 1) < $this->pages ) {
            $str = $str . "<a style=\"margin-left: 12px\" href=\" ". site_url( $this->url . (1 + $this->now) )."\">下一页</a>";
        } else {
            $str = $str . "<a style=\"margin-left: 12px\" href=\" ". site_url( $this->url . '0' )."\">首页</a>";
        }

        $str = $str . '</div>';

        return $str;
    }

    public function get_sql_limit( ) {

        $offbeg = $this->now * 5;
        $offend = ( $this->now + 1 ) * 5;
        $sql = "limit $offbeg,".P_COUNTS;
        return $sql;
    }

    public function get_now( ) {
        return $this->now;
    }

}