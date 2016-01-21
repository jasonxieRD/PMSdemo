<?php
/**
 * Created by PhpStorm.
 * User: jianchao
 * Date: 15-12-31
 * Time: 下午2:11
 */

 echo validation_errors();
?>


<link href="application/views/pages/css/index.css" rel="stylesheet">
<link href="application/views/pages/css/style.css" rel="stylesheet">

<link href="application/views/pages/css/editor.css" rel="stylesheet">

<div class="ibody">

    <?php if( !$create_flag ) { ?>
    <article>
        <h2 class="about_h">您现在的位置是：<a href="<?php echo site_url('pages/index/' . $usr . '' ); ?>">首页</a>><a>修改文章</a></h2>
        <?php echo form_open('pages/update/' . $page[MYSQL_PAGE_E]); ?>
            <div style="display:none;"><input type="hidden" name="ck" value="-BeC"/></div>
            <input type="hidden" id="note_id" name="note_id" value="533362318" />
            <div class="row note-title">
                <label class="field" for="note_title">题目:</label>
                <div>
                    <input tabindex="1" id="note_title" name="title" type="text" value="<?php echo $page[MYSQL_TITLE_E]?>" autofocus/>
                </div>
            </div>
            <div class="row note-text">
                <label class="field" for="note_text">正文:</label><br>
                <textarea tabindex="2" id="note_text" name="content" ><?php echo $page[MYSQL_CONTENT_E]?></textarea>
            </div>
            <div class="row footer">
                <input id="publish_note" value="保存" type="submit" class="btn" name="edit" />
                <input id="publish_note" value="取消" type="submit" class="btn" name="cancel" />
            </div>
        </form>
    </article>

    <?php }else { ?>
        <article>
            <h2 class="about_h">您现在的位置是：<a href="<?php echo site_url( ); ?>">首页</a>><a>写新文章</a></h2>
            <?php echo form_open('pages/add'); ?>
                <div style="display:none;"><input type="hidden" name="ck" value="-BeC"/></div>
                <input type="hidden" id="note_id" name="note_id" value="533362318" />
                <div class="row note-title">
                    <label class="field" for="note_title">题目:</label>
                    <div>
                        <input tabindex="1" id="note_title" name="title" type="text" value="" autofocus/>
                    </div>
                </div>
                <div class="row note-text">
                    <label class="field" for="note_text">正文:</label><br>
                    <textarea tabindex="2" id="note_text" name="content"></textarea>
                </div>
                <div class="row footer">
                    <input id="publish_note" value="发表" type="submit" class="btn" name="create" />
                    <input id="publish_note" value="取消" type="submit" class="btn" name="cancel" />
                </div>
            </form>
        </article>

    <?php }?>
    <aside>
        <div class="avatar"><a href="<?php echo site_url( ); ?>"><span>首页</span></a></div>
        <div class="topspaceinfo">
            <h1>jianchao's Zone</h1>
            <p>Love code, code life....</p>
        </div>
        <div class="about_c">
            <p>Jianchao Xie</p>
            <p>电话: 18061852866</p>
            <p>邮箱：jianchaoxie@anjuke.com</p>
        </div>
        <div class="bdsharebuttonbox"><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_more" data-cmd="more"></a></div>


        <div class="links">
            <h2>
                <p>友情链接</p>
            </h2>
            <ul>
                <li><a href="http://www.anjuke.com">安居客</a></li>
                <li><a href="http://www.google.com.hk">google</a></li>
            </ul>
        </div>