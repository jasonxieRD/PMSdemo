<link href="application/views/pages/css/style.css" rel="stylesheet">
<div class="ibody">
    <article>
        <h2 class="about_h">您现在的位置是：<a href="<?php echo site_url(); ?>">首页</a>><a
                href="<?php echo site_url('pages/' . $usr); ?>"><?php echo $page['title']; ?></a></h2>

        <div class="index_about">
            <h2 class="c_titile"><?php echo $page['title']; ?></h2>

            <p class="box_c">
                <span class="d_time">发布时间：<?php echo $page[MYSQL_DATE_E]; ?></span>
                <span class="d_time">上次修改：<?php echo $page[MYSQL_LASTMODIFY_E]; ?></span>
                <?php if ($usr === $auth) { ?>
                    <?php if (!$isdelete) { ?>
                        <span class="link_edit"><a href="<?php echo site_url('pages/editor/' . $page[MYSQL_PAGE_E]); ?>"
                                                   title="编辑">编辑</a></span>
                        <span class="link_delete"><a
                                href="<?php echo site_url('pages/delete/' . $page[MYSQL_PAGE_E]); ?>" title="删除" onclick="delete_confirm()">删除</a></span>
                    <?php } else { ?>
                        <span style="color: #ff0000">已删除</span>
                    <?php } ?>
                <?php } ?>
            </p>
            <ul class="infos">
                <?php echo $page[MYSQL_CONTENT_E]; ?>
                <br/>
            </ul>
            <div class="nextinfo">
                <?php if (!empty($pre)) { ?>
                    <p>
                        <a href="<?php echo site_url('pages/paper/' . $auth . '/' . $pre[MYSQL_PAGE_E]); ?>">上一篇：<?php echo $pre[MYSQL_TITLE_E]; ?></a>
                    </p>
                <?php }
                if (!empty($next)) { ?>
                    <p>
                        <a href="<?php echo site_url('pages/paper/' . $auth . '/' . $next[MYSQL_PAGE_E]); ?>">下一篇：<?php echo $next[MYSQL_TITLE_E]; ?></a>
                    </p>

                <?php } ?>
            </div>
        </div>
    </article>
    <script type="text/javascript"
            src="<?= 'application/views/pages/js/delete.js'?>">
    </script>
    <aside>
        <div class="rnav">
            [showclasstemp]'selfinfo',14,0,0[/showclasstemp]
        </div>
        <div class="ph_news">
            <h2>
                <p>点击排行</p>
            </h2>
            <ul class="ph_n">
                [ecmsinfo]'selfinfo',9,0,0,1,10,0[/ecmsinfo]
            </ul>
            <h2>
                <p>最后更新</p>
            </h2>
            <ul>
                [ecmsinfo]'selfinfo',9,0,0,0,2,0[/ecmsinfo]
            </ul>
            <h2>
                <p>最新评论</p>
            </h2>
            <ul class="pl_n">
                <dl>
                    <dt><img src="application/views/pages/images/s8.jpg"></dt>
                    <dt></dt>
                    <dd>DanceSmile
                        <time>49分钟前</time>
                    </dd>
                    <dd><a href="/">文章非常详细，我很喜欢.前端的工程师很少，我记得几年前yahoo花高薪招聘前端也招不到</a></dd>
                </dl>
                <dl>
                    <dt><img src="application/views/pages/images/s7.jpg"></dt>
                    <dt></dt>
                    <dd>yisa
                        <time>2小时前</time>
                    </dd>
                    <dd><a href="/">我手机里面也有这样一个号码存在</a></dd>
                </dl>
                <dl>
                    <dt><img src="application/views/pages/images/s6.jpg"></dt>
                    <dt></dt>
                    <dd>小林博客
                        <time>8月7日</time>
                    </dd>
                    <dd><a href="/">博客色彩丰富，很是好看</a></dd>
                </dl>
                <dl>
                    <dt><img src="application/views/pages/images/003.jpg"></dt>
                    <dt></dt>
                    <dd>DanceSmile
                        <time>49分钟前</time>
                    </dd>
                    <dd><a href="/">文章非常详细，我很喜欢.前端的工程师很少，我记得几年前yahoo花高薪招聘前端也招不到</a></dd>
                </dl>
                <dl>
                    <dt><img src="application/views/pages/images/002.jpg"></dt>
                    <dt></dt>
                    <dd>yisa
                        <time>2小时前</time>
                    </dd>
                    <dd><a href="/">我手机里面也有这样一个号码存在</a></dd>
                </dl>
            </ul>
            <h2>
                <p>最近访客</p>
                <ul>
                    <img src="application/views/pages/images/vis.jpg"><!-- 直接使用“多说”插件的调用代码 -->
                </ul>
            </h2>
        </div>

