
<link href="application/views/pages/css/register.css" rel="stylesheet">

<!---->
<!---->
<!--<div id="bottom-login" class="hide">-->
<!--    <div class="wrp">-->
<!--        <img class="img" src="images/photos.jpg">-->
<!--        <div class="slogan">-->
<!--            <p class="big">登录jianchao'zone</p>-->
<!--            <p class="small">开始你的第一篇博客</p>-->
<!--        </div>-->
<!---->
<!--        <form class="form" method="post" action="https://reg.163.com/logins.jsp">-->
<!--            <input type="hidden" name="url" id="bt-goToCurrentPage" value="http://xue.youdao.com/login.a?back_url=http%3A%2F%2Fxue.youdao.com%2Fw%3Fpage%3D5%26type%3Dall">-->
<!--            <input type="hidden" name="type" value="1">-->
<!--            <input type="hidden" name="savelogin" value="1">-->
<!--            <input id="username" name="username" type="text " class="text username" placeholder="163、126邮箱可直接登录" autocomplete="off">-->
<!--            <input id="password" name="password" type="password" class="text" value="" placeholder="密码">-->
<!--            <input type="submit" class="blue-btn btn login-rlog" data-act="login" value="登录" hidefocus="true" data-rlog="category=OPERATION&amp;page=tinyEnglish&amp;part=footer&amp;position=login">-->
<!--            <a id="bt-register" class="btn register-btn login-rlog" value="注册" hidefocus="true" target="_blank" href="http://reg.163.com/reg/reg.jsp?product=xue&amp;url=%40HOME_PAGE%40">注册</a>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->
<div class="ibody">
    [!--temp.header2--]
    <article>
        <div class="banner">
            <ul class="texts">
                <p>The best life is use of willing attitude, a happy-go-lucky life. </p>
                <p>最好的生活是用心甘情愿的态度，过随遇而安的生活。</p>
            </ul>
        </div>
        <div class="bloglist">
            <h2>
                <?php if( !isset($key) ) {?>
                    <p><span>推荐</span>文章</p>
                <?php } else {?>
                    <p>查询 <span><?php echo $key; ?></span> 文章</p>
                <?php }?>
            </h2>

            <div class="list_item_new">
                <div id="article_toplist" class="list">
                </div>
                <div id="article_list" class="list">
                <?php
                if( !empty( $pages ) ) {
                    foreach ($pages as $page) { ?>
                            <div class="list_item article_item">
                                <div class="article_title">
                                    <span class="ico ico_type_Original"></span>

                                    <h1>
                                        <span class="link_title"><a href="<?php echo site_url('pages/paper/' . $auth . '/' . $page[MYSQL_PAGE_E]); ?>"><?php echo $page[MYSQL_TITLE_E]; ?></a></span>
                                    </h1>
                                </div>

                                <div class="article_description">
                                    <?php echo mb_substr($page[MYSQL_CONTENT_E], 0, 200); ?><a href="<?php echo site_url('pages/paper/' . $auth . '/' . $page[MYSQL_PAGE_E]); ?>">[......更多......]</a>
                                </div>
                                <div class="article_manage" style="border-bottom: #333 1px dashed">
                                    <span class="link_postdate"><?php echo $page[MYSQL_DATE_E]; ?></span>
                                    <?php if( isset($usr) && $usr === $auth ) { ?>
                                        <span class="link_edit"><a href="<?php echo site_url('pages/editor/'.$page[MYSQL_PAGE_E]);?>" title="编辑">编辑</a></span>
                                        <span class="link_delete"><a href="<?php echo site_url('pages/delete/'.$page[MYSQL_PAGE_E]);?>" title="删除">删除</a></span>
                                    <?php }?>
                            </div>

                            </div>
                            <?php }
                            } else {    ?>

                                <ul style="text-align: center">
                                    NO MATCH
                                </ul>
                            <?php
                            }?>
                    </div>
            </div>
                        <!--显示分页-->
                <?php echo $this->pages_model->page_ob->get_html(); ?>

        </div>
    </article>
    <aside>
        <div class="avatar"><a href="<?php echo site_url( 'pages/index/' . $auth); ?>"><span>个人主页</span></a></div>
        <div class="topspaceinfo">
            <h1><?php echo $auth;?>'s Zone</h1>
            <p>Love Code, Code Life....</p>
        </div>
        <div class="about_c">
            <p>Jianchao Xie</p>
            <p>电话: 18061852866</p>
            <p>邮箱：jianchaoxie@anjuke.com</p>
        </div>

        <div class="tj_news">

            <h2>
                <p class="tj_t1"><a href="<?php echo site_url( 'pages/editor/' ); ?>">写文章</a></p>
            </h2>
            <br />
            <br />
            <h2>
                <p class="tj_t2">文章搜索</p>
            </h2>
            </form>
            <div id="side">
                <div class="side">
                    <div class="panel" id="panel_Search">
                        <ul class="panel_body">
                            <?php echo form_open('pages/search/' . $auth . '/', 'class="form_search",id="frmSearch"'); ?>
                                <span><input name="q" id="inputSearch" type="text" class="blogsearch" title="请输入关键字" value="<?php echo isset($key) ? $key : "" ?>" /></span>
                                <input id="btnSubmit" name="search" type="submit" value="搜索" title="search in blog" />
                                <a id="btnSearchBlog" target="_blank"></a>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>



        </div>
        <div class="links">
            <h2>
                <p>友情链接</p>
            </h2>
            <ul>
                <li><a href="http://www.anjuke.com">安居客</a></li>
                <li><a href="http://www.google.com.hk">google</a></li>
            </ul>
        </div>

<?php