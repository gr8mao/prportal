<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 14:04
 */

$title = 'Мероприятие | PR-портал';
include_once ROOT . '/templates/header.php'; ?>


    <!-- bloc-20 -->
    <div class="bloc b-parallax d-bloc events-bloc hidden-xs bgc-white" id="bloc-20">
        <div class="container bloc-sm">
            <div class="row">
                <div class="col-sm-12">
                    <a href="/events" class="btn  btn-lg pull-left btn-white"><span
                            class="feather-icon icon-reply icon-spacer"></span>Вернуться</a>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-20 END -->

    <!-- bloc-21 -->
    <div class="bloc bgc-white l-bloc" id="bloc-21">
        <div class="container bloc-md">
            <div class="row voffset">
                <div class="col-sm-4">
                    <img src="<? echo $event['Image']; ?>" class="img-responsive"/>
                    <h4 class="mg-md">
                        <span class="feather-icon icon-bell"></span> <? echo $event['Date_start'];
                        if (isset($event['Date_end'])) {
                            echo ' - ' . $event['Date_end'];
                        }; ?>
                    </h4>
                    <h4 class="mg-md">
                        <span class="feather-icon icon-map"></span> <? echo $event['Place']; ?>
                    </h4>
                </div>
                <div class="col-sm-8">
                    <? if (Users::checkUserAdmin(Users::checkLogged())): ?>

                        <a href="/admin/events/delete<? echo $event['id'] ?>"
                           class="btn btn-sm pull-right btn-white hidden-xs">
                            <span class="feather-icon icon-cross icon-spacer"></span> Удалить событие</a>

                    <? endif; ?>
                    <h6 class="text-right mg-md">
                        <span class="feather-icon icon-square-check"></span>
                        <strong>Добавлено: <? echo $added_by; ?></strong>
                    </h6>
                    <h1 class="mg-md">
                        <strong><? echo $event['Name']; ?></strong><br>
                    </h1>
                    <p class="mg-lg">
                        <? echo $event['Annotation']; ?>
                    </p>
                    <? if ($event['Link']): ?>
                        <div class="text-center">
                            <a href="<? echo $event['Link']; ?>" class="btn  btn-d  btn-xl" target="_blank"><span
                                    class="feather-icon icon-link icon-spacer icon-white"></span>Подробности</a>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- bloc-21 END -->

    <!-- bloc-22 -->
    <div class="bloc l-bloc events-bloc bgc-white" id="bloc-22">
        <div class="container bloc-md">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="mg-md tc-white">
                                <span class="feather-icon icon-speech-bubble"></span> Отзывы о событии
                            </h1>
                        </div>
                        <div class="col-sm-6">
                            <a href="/events/comment<? echo $event['id'] ?>"
                               class="btn  btn-lg pull-right btn-white hidden-xs"><span
                                    class="feather-icon icon-plus icon-spacer"></span>Добавить отзыв</a>
                        </div>
                    </div>
                </div>
            </div>
            <? if (!Users::isGuest()): ?>
                <? if ($Comments): ?>
                    <div class="row voffset">
                        <? foreach ($Comments as $commnet): ?>
                            <div class="col-sm-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <img src="<? echo $commnet['Profile_Photo_Path'] ?>"
                                                     class="img-responsive img-circle hidden-xs"/>
                                            </div>
                                            <div class="col-sm-10">
                                                <form id="form_2572" novalidate>
                                                    <div class="form-g]roup">
                                                        <label>
                                                            <? echo $commnet['Added_By'] ?>
                                                        </label>
                                                    </div>
                                                </form>
                                                <h3 class="mg-clear">
                                                    <? echo $commnet['Title'] ?>
                                                </h3>
                                            </div>
                                            <? if (Users::checkUserAdmin(Users::checkLogged())): ?>
                                                <div class="col-sm-1">
                                                    <a href="/deleteComment<? echo $commnet['id'] ?>/events/<? echo $event['id'] ?>"
                                                       class="btn btn-lg pull-right btn-white hidden-xs">
                                                        <span class="feather-icon icon-cross icon-spacer"></span></a>
                                                </div>
                                            <? endif; ?>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <p> <? echo $commnet['Text'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                <? else: ?>
                    <div class="row voffset-lg">
                        <div class="col-sm-12">
                            <h4 class="mg-md text-center tc-white">
                                <i>Рецензий пока нет...</i>
                            </h4>
                        </div>
                    </div>
                <? endif; ?>
            <? else: ?>
                <div class="row voffset-lg">
                    <div class="col-sm-12">
                        <h4 class="mg-md text-center tc-white">
                            <i>Чтобы просматривать рецензии, нужно войти в систему!</i>
                        </h4>
                    </div>
                </div>
            <? endif; ?>
        </div>
    </div>
    <!-- bloc-22 END -->

<? include_once ROOT . '/templates/footer.php'; ?>