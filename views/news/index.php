<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 05.05.17
 * Time: 1:14
 */
$title = 'Новости | PR-портал';
require_once ROOT . '/templates/header.php'; ?>
    <div class="bloc b-parallax l-bloc books-bloc bgc-white" id="bloc-10">
        <div class="container bloc-lg" style="padding-top: 20px; padding-bottom: 20px;">
            <div class="row hidden-xs">
                <div class="col-sm-6">
                    <h1 class="mg-md tc-white">
                        <span class="feather-icon icon-book"></span> Новости
                    </h1>
                </div>
                <div class="col-sm-6">
                    <? if (!Users::isGuest()): ?>
                        <div class=" mg-md">
                        <a href="/news/submit" class="btn btn-lg pull-right btn-white hidden-xs">
                            <span class="feather-icon icon-plus icon-spacer"></span>Добавить новости</a>
                        </div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>


    <!-- Bloc Group -->
    <div class='bloc-group'>

        <!-- bloc-86 -->
        <div class="bloc bloc-tile-2 l-bloc news-russia-bloc bgc-white" id="bloc-86">
            <div class="container bloc-lg">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="mg-md text-center tc-white">
                            <strong>PR в России</strong>
                        </h1>
                        <? if ($local_news):
                            foreach ($local_news as $local_new):?>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <? if (Users::checkUserAdmin(Users::checkLogged())): ?>

                                            <a href="/admin/news/delete<? echo $local_new['id'] ?>"
                                               class="btn btn-lg pull-right btn-white hidden-xs">
                                                <span class="feather-icon icon-cross icon-spacer"></span></a>

                                        <? endif; ?>
                                        <h3 class="mg-md">
                                            <? echo $local_new['Header']; ?>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <? if ($local_new['Image']): ?>
                                            <img src="<? echo $local_new['Image'] ?>" class="img-responsive">
                                        <? endif; ?>
                                        <p>
                                            <? echo $local_new['Text']; ?>
                                        </p>
                                    </div>
                                </div>
                            <?endforeach;
                        else:?>
                            <h4 class="mg-md text-center tc-white" style="margin-bottom: 20vh;">
                                <i>Новостей пока нет...</i>
                            </h4>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- bloc-86 END -->

        <!-- bloc-87 -->
        <div class="bloc bloc-tile-2 l-bloc news-world-bloc bgc-white" id="bloc-87">
            <div class="container bloc-lg">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="mg-md text-center tc-white">
                            <strong>PR в мире</strong>
                        </h1>
                        <? if ($global_news):
                            foreach ($global_news as $global_new):?>
                                <div class="panel">
                                    <div class="panel-heading">
                                        <? if (Users::checkUserAdmin(Users::checkLogged())): ?>

                                            <a href="/admin/news/delete<? echo $global_new['id'] ?>"
                                               class="btn btn-lg pull-right btn-white hidden-xs">
                                                <span class="feather-icon icon-cross icon-spacer"></span></a>

                                        <? endif; ?>
                                        <h3 class="mg-md">
                                            <? echo $global_new['Header']; ?>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        <? if ($global_new['Image']): ?>
                                            <img src="<? echo $global_new['Image'] ?>" class="img-responsive">
                                        <? endif; ?>
                                        <p>
                                            <? echo $global_new['Text']; ?>
                                        </p>
                                    </div>
                                </div>
                            <?endforeach;
                        else:?>
                            <h4 class="mg-md text-center tc-white">
                                <i>Новостей пока нет...</i>
                            </h4>
                        <? endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- bloc-87 END -->
    </div>
    <!-- Bloc Group END -->

<? require_once ROOT . '/templates/footer.php'; ?>