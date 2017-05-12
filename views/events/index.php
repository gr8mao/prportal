<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 05.05.17
 * Time: 23:54
 */
$title = 'События | PR-портал';
include_once ROOT . '/templates/header.php' ?>

<div class="bloc b-parallax events-bloc bgc-white" id="bloc-3">
    <div class="container bloc-md">
        <div class="row hidden-xs">
            <div class="col-sm-6">
                <h1 class="mg-md tc-white">
                    <span class="feather-icon icon-map"></span> События
                </h1>
            </div>
            <?if(!Users::isGuest()):?>
            <div class="col-sm-6">
                <a href="/events/submit" class="btn  btn-lg pull-right btn-white"><span
                        class="feather-icon icon-plus icon-spacer"></span>Добавить событие</a>
            </div>
            <?endif;?>
        </div>
        <div class="row hidden-sm hidden-lg hidden-md">
            <div class="col-sm-12">
                <h1 class="mg-md tc-white text-center">
                    <span class="feather-icon icon-map"></span> События
                </h1>
            </div>
        </div>
        <? if ($events): ?>
        <div class="row voffset">
            <? foreach ($events as $key => $event): ?>
                <? if ($event['Month'] != $currentMonth): ?>
                    <div class="col-sm-12">
                        <h2 class="text-center mg-md tc-white">
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
                <div class="row voffset">
                    <div class="col-sm-12">
                        <h2 class="text-center mg-md tc-white">
                            <i>Событий пока нет...</i>
                        </h2>
                    </div>
                </div>
            <? endif; ?>
        </div>
    </div>
</div>

<? include_once ROOT . '/templates/footer.php'; ?>
