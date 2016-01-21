
<link href="application/views/pages/css/index.css" rel="stylesheet">

<div class="csdn-toolbar csdn-toolbar-skin-black ">
    <div class="container row center-block ">

        <div class="pull-right login-wrap unlogin">
            <ul class="btns">
                <li class="loginlink">
                    <?php if (!isset($usr)) { ?>
                        <a href="<?php echo site_url( 'pages/login' ); ?>" target="_top">登录&nbsp;</a> | <a target="_top" href="<?php echo site_url('pages/register') ?>">&nbsp;注册</a>
                    <?php } else { ?>
                        <a href="<?php echo site_url( 'pages/index/' . $usr); ?>" target="_top" title="<?php echo $usr . '\' home';?>"><?php echo $usr;?>&nbsp;</a> | <a target="_top" href="<?php echo site_url('pages/logout') ?>">&nbsp;注销</a>
                    <?php } ?>
                </li>
            </ul>
        </div>

    </div>
</div>

