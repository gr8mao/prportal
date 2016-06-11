<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 30.05.16
 * Time: 17:11
 */

$title = "Ошибка сервера";
include_once ROOT . '/templates/header.php';
?>

<!-- bloc-87 -->
<div class="bloc b-parallax l-bloc home-menu-bloc bgc-white bloc-fill-screen" id="bloc-87">
    <div class="container fill-bloc-top-edge">
        <div class="row voffset-md">
            <div class="col-sm-12">
                <h1 class="tc-white text-center mg-lg">
                    Внутренняя ошибка сервера
                </h1>
                <div class="text-center">
                    <a href="/" class="btn  btn-d  btn-lg">Вернуться к разделам</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row voffset-lg">
            <div class="col-sm-12">
                <img src="/img/pr_logo-white.svg" class="center-block animLoopInfinite undefined mg-sm animSpeedSlow"
                     height="200"/>
            </div>
        </div>
    </div>
</div>
<!-- bloc-87 END -->

<?
include_once ROOT . '/templates/footer.php';
?>
