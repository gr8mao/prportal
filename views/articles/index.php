<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 30.05.16
 * Time: 18:13
 */
$title = 'Статья | PR-портал';
include_once ROOT . '/templates/header.php'; ?>

<!-- Блок добавления статья -->
<div class="bloc d-bloc articles-bloc bgc-1" id="bloc-11">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mg-md tc-white">
                            <span class="feather-icon icon-paragraph"></span> Статьи
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="articles/submit" class="btn    btn-lg pull-right btn-white hidden-xs"><span
                                class="feather-icon icon-plus icon-spacer"></span>Добавить статью</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Конец блока добавления статья -->
        <!-- Блок сообщения -->
        <?if (!$articles):?>
            <div class="row voffset-lg">
                <div class="col-sm-12">
                    <h4 class="mg-md text-center tc-white">
                        <i>Статей пока нет...</i>
                    </h4>
                </div>
            </div>
        <?endif;?>
        <!-- Конец блока сообщения -->
        <!-- Блок статьи -->
        <?foreach($articles as $article): ?>
        <div class="row voffset">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-sm-1">
                                <img src="img/placeholder-user.png"
                                     class="img-responsive img-circle hidden-xs hidden-sm"/>
                            </div>
                            <div class="col-sm-11">
                                <form id="form_2572" novalidate>
                                    <div class="form-group">
                                        <label>
                                            <?echo $article['Author'];?>
                                        </label>
                                    </div>
                                </form>
                                <h3 class="mg-clear">
                                    <?echo $article['Title'];?>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p>
                            <?echo $article['Content'];?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?endforeach;?>
        <!-- Конец блока статьи -->
    </div>
</div>
<!-- bloc-11 END -->

<? include_once ROOT . '/templates/footer.php'; ?>
