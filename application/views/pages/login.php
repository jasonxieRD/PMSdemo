<?php
/**
 * Created by PhpStorm.
 * User: jianchao
 * Date: 16-1-8
 * Time: 上午9:59
 */
?>
<link href="application/views/pages/css/login.css" rel="stylesheet">
<link href="application/views/pages/css/bootstrap.css" rel="stylesheet">
<div class="main">
    <div class="container container-custom">
        <div class="row wrap-login">
            <div class="login-banner col-sm-6 col-md-7 col-lg-7 hidden-xs"><a href="http://www.csdn.net" target="_blank"><img src="../application/views/pages/images/login-banner.png" class="img-responsive"></a></div>
            <div class="login-user col-xs-12 col-sm-6 col-md-5 col-lg-5">
                <div class="login-part">
                    <h3>帐号登录</h3>
                    <div class="user-info">
                        <div class="user-pass">

                            <form id="fm1" action="<?php echo site_url('pages/login') ?>" method="post">

                                <input id="username" name="username" tabindex="1" placeholder="输入用户名/邮箱/手机号" value=" " class="user-name" type="text">

                                <input id="password" name="password" tabindex="2" placeholder="输入密码" class="pass-word" type="password" value="" autocomplete="off">
                                <?php if( isset($login_error) && $login_error ) {?>
                                    <div class="error-mess">
                                        <span class="error-icon"></span><span id="error-message">帐户名或登录密码不正确，请重新输入</span>
                                    </div>
                                <?php } else { ?>
                                    <div class="error-mess" style="display:none;">
                                        <span class="error-icon"></span><span id="error-message"></span>
                                    </div>
                                <?php }?>

<!--                                <div class="row forget-password">-->
<!--                                    <span class="col-xs-6 col-sm-6 col-md-6 col-lg-6">-->
<!--                                        <input type="checkbox" name="rememberMe" id="rememberMe" value="true" class="auto-login" tabindex="3">-->
<!--                                        <label for="rememberMe">下次自动登录</label>-->
<!--                                    </span>-->
<!--                                    <span class="col-xs-6 col-sm-6 col-md-6 col-lg-6 forget tracking-ad" data-mod="popu_26">-->
<!--                                        <a href="/account/fpwd?action=forgotpassword&amp;service=http%3A%2F%2Fso.csdn.net%2Fso%2Fsearch%2Fs.do%3Fq%3D123%26u%3Dv_JULY_v%26t%3Dblog" tabindex="4">忘记密码</a>-->
<!--                                    </span>-->
<!--                                </div>-->
                                <!-- 该参数可以理解成每个需要登录的用户都有一个流水号。只有有了webflow发放的有效的流水号，用户才可以说明是已经进入了webflow流程。否则，没有流水号的情况下，webflow会认为用户还没有进入webflow流程，从而会重新进入一次webflow流程，从而会重新出现登录界面。 -->
<!--                                <input type="hidden" name="lt" value="LT-168679-NINMLz0idIRDLpoOvEZ0wYjSUrZr3c">-->
<!--                                <input type="hidden" name="execution" value="e7s1">-->
<!--                                <input type="hidden" name="_eventId" value="submit">-->
                                <input class="logging" accesskey="l" value="登 录" tabindex="5" type="submit">

                            </form>
                        </div>
                    </div>
                    <div class="line"></div>
                    <div class="third-part tracking-ad" data-mod="popu_27">
                        <div class="register-now"><span>还没有帐号？</span>
	                <span class="register tracking-ad" data-mod="popu_28">
	                	<a href="<?php echo site_url('pages/register') ?>">立即注册</a>
	                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<aside>