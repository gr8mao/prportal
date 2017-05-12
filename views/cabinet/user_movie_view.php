<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 14:48
 */

$title = 'Мои фильмы | PR-портал';
include_once ROOT . '/templates/header.php'; ?>



    <!-- login-bloc -->
    <div class="bloc l-bloc bgc-white " id="login-bloc">
        <div class="container bloc-lg" style="padding-top: 20px;">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mg-md">
                        <strong>Фильмы, добавленные Вами</strong>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <div class=" mg-md">
                        <a href="/movies/submit" class="btn btn-lg pull-right btn-default hidden-xs"><span
                                class="feather-icon icon-plus icon-spacer"></span>Добавить фильм</a>
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
                    <? if ($movies): ?>
                        <div class="row voffset">
                            <? foreach ($movies as $movie): ?>
                                <div class="col-sm-3">
                                    <div class="panel" id="movie1">
                                        <div class="panel-heading">
                                            <a href="/movies/id<? echo $movie['id'] ?>"><img src="<? echo $movie['image_path'];?>"
                                                                                             class="mg-sm center-block img-responsive"
                                                                                             id="movie1cover"/></a>
                                            <form id="form_1200" novalidate>
                                                <div class="form-group">
                                                    <label>
                                                        <? echo $movie['Country']; ?>, <? echo $movie['Year']; ?>
                                                    </label>
                                                </div>
                                            </form>
                                            <h3 class="mg-clear text-center" id="movie1name">
                                                <? echo $movie['Name']; ?>
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="text-center">
                                                <a href="/movies/id<? echo $movie['id'] ?>" class="btn  btn-d btn-rd"
                                                   id="movie1button">Подробнее...</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    <? else: ?>
                        <div class="row voffset-lg">
                            <div class="col-sm-12">
                                <h4 class="mg-md text-center">
                                    <i>Фильмов, добавленных выми, пока нет...</i>
                                </h4>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- login-bloc END -->

<? include_once ROOT . '/templates/footer.php'; ?>