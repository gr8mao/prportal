<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 30.05.16
 * Time: 17:03
 */
$title = 'Главная | PR-портал';
include_once ROOT . '/templates/header.php'; ?>

<!-- bloc-1 -->
<div class="bloc bg-lines-dl2-bg bg-repeat bloc-fill-screen bgc-white l-bloc" id="bloc-1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <img src="/img/logo-full.svg"
                     class="center-block animLoopInfinite undefined pulse-hvr animated pulse animSpeedSlow mg-sm"
                     height="400"/>
                <h5 class="mg-md  text-center">
                    <i>Инновационный сайт для PR-специалистов</i>
                </h5>
            </div>
        </div>
        <div class="row voffset-lg-sm">
            <div class="col-sm-12">
                <a id="scroll-hero" class="blocs-hero-btn-dwn" href="#"><span class="fa fa-chevron-down icon-1"></span></a>
            </div>
        </div>
    </div>
</div>
<!-- bloc-1 END -->

<!-- bloc-2 -->
<div class="bloc home-menu-bloc hidden-lg hidden-md bloc-fill-screen tc-white bgc-white" id="bloc-2">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="mg-md text-center mg-lg-sm">
                    Выберите раздел
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <div class="text-center">
                    <a href="#"><span class="feather-icon icon-map icon-xl icon-white"></span></a>
                </div>
                <h3 class="text-center mg-md tc-white">
                    События
                </h3>
                <p class="text-center">
                    Самая актуальная информация по предстоящим событиям<br/>Санкт-Петербурга
                </p>
            </div>
            <div class="col-sm-3">
                <div class="text-center">
                    <a href="#"><span class="feather-icon icon-video icon-xl icon-white"></span></a>
                </div>
                <h3 class="text-center mg-md tc-white">
                    Фильмы
                </h3>
                <p class="text-center">
                    Интересные кинофильмы для просмотра
                </p>
            </div>
            <div class="col-sm-3">
                <div class="text-center">
                    <a href="#"><span class="feather-icon icon-book icon-xl icon-white"></span></a>
                </div>
                <h3 class="text-center mg-md tc-white">
                    Книги
                </h3>
                <p class="text-center">
                    Рекомендуемая литература для ознакомления
                </p>
            </div>
            <div class="col-sm-3">
                <div class="text-center">
                    <a href="/articles"><span class="feather-icon icon-paragraph icon-xl icon-white"></span></a>
                </div>
                <h3 class="text-center mg-md tc-white">
                    Статьи
                </h3>
                <p class="text-center">
                    Авторские статьи для PR-специалиста
                </p>
            </div>
        </div>
    </div>
</div>
<!-- bloc-2 END -->

<!-- Bloc Group -->
<div class='bloc-group'>

    <!-- events-menu -->
    <div class="bloc l-bloc bloc-tile-2 events-bloc tc-white bgc-white hidden-sm hidden-xs" id="events-menu">
        <div class="container bloc-md">
            <div class="row voffset-md">
                <div class="col-sm-12">
                    <div class="text-center">
                        <span class="feather-icon icon-map icon-xl icon-white"></span>
                    </div>
                    <h3 class="text-center mg-md tc-white">
                        <a class="ltc-white" href="#">События</a>
                    </h3>
                    <p class="text-center">
                        Самая актуальная информация по предстоящим событиям Санкт-Петербурга
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- events-menu END -->

    <!-- movies-menu -->
    <div class="bloc bloc-tile-2 l-bloc movies-bloc tc-white hidden-sm hidden-xs bgc-white" id="movies-menu">
        <div class="container bloc-md">
            <div class="row voffset-md">
                <div class="col-sm-12">
                    <div class="text-center">
                        <span class="feather-icon icon-video icon-white icon-xl"></span>
                    </div>
                    <h3 class="text-center mg-md tc-white">
                        <a class="ltc-white" href="#">Фильмы</a>
                    </h3>
                    <p class="text-center">
                        Интересные кинофильмы для просмотра
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- movies-menu END -->
</div>
<!-- Bloc Group END -->

<!-- Bloc Group -->
<div class='bloc-group'>

    <!-- books-menu -->
    <div class="bloc bloc-tile-2 l-bloc books-bloc tc-white animDelay08 bgc-white hidden-sm hidden-xs" id="books-menu">
        <div class="container bloc-md">
            <div class="row voffset-md">
                <div class="col-sm-12">
                    <div class="text-center">
                        <span class="feather-icon icon-book icon-xl icon-white"></span>
                    </div>
                    <h3 class="text-center mg-md tc-white">
                        <a class="ltc-white" href="#">Книги</a>
                    </h3>
                    <p class="text-center">
                        Рекомендуемая литература для ознакомления
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- books-menu END -->

    <!-- articles-menu -->
    <div class="bloc bloc-tile-2 articles-bloc tc-white animDelay02 bgc-white hidden-sm hidden-xs" id="articles-menu">
        <div class="container bloc-md">
            <div class="row voffset-md">
                <div class="col-sm-12">
                    <div class="text-center">
                        <span class="feather-icon icon-paragraph icon-xl icon-white"></span>
                    </div>
                    <h3 class="text-center mg-md tc-white">
                        Статьи
                    </h3>
                    <p class="text-center">
                        Авторские статьи для PR-специалиста
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- articles-menu END -->
</div>
<!-- Bloc Group END -->

<!-- login-menu -->
<div class="bloc l-bloc login-bloc bloc-fill-screen hidden-xs bgc-white hidden-lg hidden-md" id="login-menu">
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-xs-offset-4">
                <img src="/img/pr_logo-white.svg" class="img-responsive center-block mg-md" width="100"/>
                <div class="form-group">
                    <input class="form-control" placeholder="Почта" required type="email" id="input_1113"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Пароль" id="input_1359" required/>
                </div>
                <a href="/home" class="a-btn a-block ltc-white">Забыли пароль?</a><a class="btn btn-d pull-right"
                                                                                          onclick="scrollToTarget('#bloc-2')"
                                                                                          data-placement="bottom"
                                                                                          data-toggle="tooltip"
                                                                                          title="Регистрация временно недоступна.">Регистрация</a>
                <a class="btn btn-d pull-left" href="/articles">Войти</a>
            </div>
        </div>
    </div>
</div>
<!-- login-menu END -->

<? include_once ROOT . '/templates/footer.php'; ?>
