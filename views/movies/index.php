<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 04.05.17
 * Time: 12:26
 */
$title = 'Фильмы | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


<!-- bloc-9 -->
<div class="bloc b-parallax l-bloc movies-bloc bgc-white" id="bloc-9">
    <div class="container bloc-lg">
        <div class="row hidden-xs">
            <div class="col-sm-6">
                <h1 class="mg-md tc-white">
                    <span class="feather-icon icon-video"></span> Фильмы
                </h1>
            </div>
            <div class="col-sm-6">
                <?if(!Users::isGuest()):?>
                <a href="/movies/submit" class="btn    btn-lg pull-right btn-white hidden-xs"><span
                        class="feather-icon icon-plus icon-spacer"></span>Добавить фильм</a>
                <?endif;?>
            </div>
        </div>
        <div class="row voffset hidden-sm hidden-lg hidden-md">
            <div class="col-sm-12">
                <h1 class="mg-md tc-white text-center">
                    <span class="feather-icon icon-video"></span> Фильмы
                </h1>
            </div>
        </div>
        <?
        if ($movies): ?>
            <div class="row voffset">
                <? foreach ($movies as $movie): ?>
                    <div class="col-sm-3">
                        <div class="panel" id="movie1">
                            <div class="panel-heading">
                                <a href="/movies/id<? echo $movie['id'] ?>"><img src=" <? echo $movie['image_path']; ?>"
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
                    <h4 class="mg-md text-center tc-white">
                        <i>Фильмов пока нет...</i>
                    </h4>
                </div>
            </div>
        <? endif; ?>
    </div>
</div>
<!-- bloc-9 END -->

<? include_once ROOT . '/templates/footer.php'; ?>
