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
                        <?if(!Users::isGuest()):?>
                        <a href="articles/submit" class="btn    btn-lg pull-right btn-white hidden-xs"><span
                                class="feather-icon icon-plus icon-spacer"></span>Добавить статью</a>
                        <?endif;?>
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
                                <img src="<?echo Users::getProfilePhotoById($article['Added_By']);?>"
                                     class="img-responsive img-circle hidden-xs hidden-sm"/>
                            </div>
                            <div class="col-sm-10">
                                <form id="form_2572" novalidate>
                                    <div class="form-group">
                                        <label>
                                            <?echo Users::getUsernameById($article['Added_By']);?>
                                        </label>
                                    </div>
                                </form>
                                <h3 class="mg-clear">
                                    <?echo $article['Title'];?>
                                </h3>
                            </div>
                            <? if (Users::checkUserAdmin(Users::checkLogged())): ?>
                                <div class="col-sm-1">
                                <a href="/admin/article/delete<? echo $article['id'] ?>"
                                   class="btn btn-lg pull-right btn-white hidden-xs">
                                    <span class="feather-icon icon-cross icon-spacer"></span></a>
                                </div>
                            <? endif; ?>
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
