<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 10.06.16
 * Time: 19:40
 */
$title = 'Вход | PR-портал';
include_once ROOT.'/templates/header.php'; ?>

<!-- login-menu -->
<div class="bloc l-bloc login-bloc bloc-fill-screen bgc-white" id="login-menu">
    <div class="container">
        <div class="row">
            <img src="/img/pr_logo-white.svg" class="img-responsive center-block mg-md" width="100" />
            <form class="col-xs-4 col-xs-offset-4" action="#" method="post">
                <div class="form-group">
                    <input class="form-control" placeholder="Почта" required type="email" name="email" />
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Пароль" name="password" required />
                </div>
<!--                <a href="/" class="a-btn a-block ltc-white">Забыли пароль?</a>-->
                <a class="btn btn-d pull-right" href="/registration">Регистрация</a>
                <input class="btn btn-d pull-left" type="submit" name="submit" value="Войти">
            </form>
        </div>
    </div>
</div>
<!-- login-menu END -->

<?include_once ROOT.'/templates/footer.php';?>
