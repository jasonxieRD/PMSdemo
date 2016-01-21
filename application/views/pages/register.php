
<link href="application/views/pages/css/mobileregister.css" rel="stylesheet">
<link href="application/views/pages/css/register.css" rel="stylesheet">
<link href="application/views/pages/css/bootstrap.css" rel="stylesheet">

<div class="main">
    <div class="container container-custom">
        <div class="register-progress clearfix hidden-xs hidden-sm">
            <div class="pross pross-ok"><span class="index">@</span>用户注册
                <div class="pross-dir pross-dir-bg"><span class="outside"></span><span class="inside"></span></div>
            </div>
        </div>
        <div class="register-info">
            <h3><span class="icon"></span></h3>
            <div class="bind-mobile clearfix">
                <form id="form" class="clearfix" method="post" action="<?php echo site_url('pages/register')?>">
                    <ul class="info">
                        <li><span class="err" style="font-size:14px;color:red;"></span></li>
                        <li><span class="tit">用户名：</span><span class="input">
	                  <input type="text" name="username" placeholder="请输入用户名" class="mobile-num" value="">
                                <?php if( isset($hasusr) ) {?>
                                    用户名已存在
                                <?php }?>
                            </span></li>

                        <li><span class="tit">密码：</span><span class="input">
	                  <input type="#" name="password" class="code"></span>

                        </li>
                        <li><input type="submit" class="submit" value="提交"></li>
                    </ul>
                </form>
            </div>
        </div>
</div>