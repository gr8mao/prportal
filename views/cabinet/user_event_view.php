<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 15:00
 */


$title = 'Мои события | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


    <!-- login-bloc -->
    <div class="bloc l-bloc bgc-white " id="login-bloc">
        <div class="container bloc-lg" style="padding-top: 20px;">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="mg-md">
                        <strong>События, добавленные Вами</strong>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <div class=" mg-md">
                        <a href="/events/submit" class="btn btn-lg pull-right btn-default hidden-xs"><span
                                class="feather-icon icon-plus icon-spacer"></span>Добавить событие</a>
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
                    <? if ($events): ?>
                        <div class="row voffset">
                        <? foreach ($events as $key => $event): ?>
                            <? if ($event['Month'] != $currentMonth): ?>
                                <div class="col-sm-12">
                                    <h2 class="text-center mg-md">
                                        <i><? echo $event['Month_name'] ?></i>
                                    </h2>
                                </div>
                                <? $currentMonth = $event['Month']; endif; ?>
                            <div class="col-sm-4">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="mg-clear">
                                            <a href="/events/id<? echo $event['id']; ?>"><? echo $event['Date_start'];
                                                if (isset($event['Date_end'])) {
                                                    echo ' - ' . $event['Date_end'];
                                                } ?></a><br>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>
                                            <? echo $event['Name']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    <? else: ?>
                        <div class="row voffset-lg">
                            <div class="col-sm-12">
                                <h4 class="mg-md text-center">
                                    <i>Событий, добавленных выми, пока нет...</i>
                                </h4>
                            </div>
                        </div>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- login-bloc END -->

<? include_once ROOT . '/templates/footer.php'; ?>