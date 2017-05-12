<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:47
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
                            <span class="feather-icon icon-paragraph"></span> Статья
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <? if (!Users::isGuest()): ?>
                            <a href="/admin/articles" class="btn    btn-lg pull-right btn-white hidden-xs">Назад</a>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Конец блока сообщения -->
        <!-- Блок статьи -->
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
        <!-- Конец блока статьи -->
    </div>
</div>
<!-- bloc-11 END -->

<? include_once ROOT . '/templates/footer.php'; ?>
