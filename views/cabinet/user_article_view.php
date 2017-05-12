<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 15:00
 */


$title = 'Мои статьи | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


    <!-- login-bloc -->
    <div class="bloc l-bloc bgc-white " id="login-bloc">
        <div class="container bloc-lg" style="padding-top: 20px;">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mg-md">
                        <strong>Статьи, добавленные Вами</strong>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <div class=" mg-md">
                        <a href="articles/submit" class="btn btn-lg pull-right btn-default hidden-xs"><span
                                class="feather-icon icon-plus icon-spacer"></span>Добавить статью</a>
                    </div>
                </div>
            </div>

            <div class="row voffset">
                <div class="col-sm-3">
                    <h3 class="mg-md">
                        <a href="/cabinet/events"><span class="feather-icon icon-map"></span> Мои события</a>
                    </h3>
                    <h3 class="mg-md">
                        <a href="/cabinet/movies"> <span class="feather-icon icon-video"></span> Мои фильмы</a>
                    </h3>
                    <h3 class="mg-md">
                        <a href="/cabinet/books"><span class="feather-icon icon-book"></span> Мои книги</a>
                    </h3>
                    <h3 class="mg-md">
                        <a href="/cabinet/articles"><span class="feather-icon icon-paragraph"></span> Мои статьи</a>
                    </h3>
                    <h3 class="mg-md">
                        <a href="/cabinet"><span class="feather-icon icon-record"></span> Кабинет </a>
                    </h3>
                </div>
                <div class="col-sm-9">
                    <? if (!$articles): ?>
                        <div class="row voffset-lg">
                            <div class="col-sm-12">
                                <h4 class="mg-md text-center">
                                    <i>Статей пока нет...</i>
                                </h4>
                            </div>
                        </div>
                    <? endif; ?>
                    <!-- Конец блока сообщения -->
                    <!-- Блок статьи -->
                    <? foreach ($articles as $article): ?>
                        <div class="row voffset">
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <img src="<? echo Users::getProfilePhotoById($article['Added_By']); ?>"
                                                     class="img-responsive img-circle hidden-xs hidden-sm"/>
                                            </div>
                                            <div class="col-sm-11">
                                                <form id="form_2572" novalidate>
                                                    <div class="form-group">
                                                        <label>
                                                            <? echo Users::getUsernameById($article['Added_By']); ?>
                                                        </label>
                                                    </div>
                                                </form>
                                                <h3 class="mg-clear">
                                                    <? echo $article['Title']; ?>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            <? echo $article['Content']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                    <!-- Конец блока статьи -->
                </div>
            </div>
        </div>
    </div>
    <!-- login-bloc END -->

<? include_once ROOT . '/templates/footer.php'; ?>