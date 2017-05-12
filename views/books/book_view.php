<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 03.05.17
 * Time: 15:35
 */

$title = "Книги | PR-портал";
include_once ROOT . '/templates/header.php'; ?>

<!-- bloc-17 -->
<div class="bloc bgc-white l-bloc" id="bloc-17">
    <div class="container bloc-lg" style="padding-top: 0;">
        <div class="row voffset">
            <div class="col-sm-8">
                <h1 class="mg-md">
                    <strong><? echo $book['Title']; ?></strong>
                    <? if (Users::checkUserAdmin(Users::checkLogged())): ?>

                        <a href="/admin/books/delete<? echo $book['id'] ?>"
                           class="btn btn-lg pull-right btn-white hidden-xs">
                            <span class="feather-icon icon-cross icon-spacer"></span> Удалить книгу</a>

                    <? endif; ?>
                </h1>
                <h3 class="mg-md">
                    <strong><? echo $book['Author']; ?></strong>
                </h3>
                <h6 class="mg-md author">
                    <span class="feather-icon icon-square-check"></span>
                    <strong>Добавлено: <? echo $Added_By; ?></strong>
                </h6>
                <p class="mg-lg">
                    <? echo $book['Annotation']; ?>
                </p>
                <? if ($book['Link']): ?>
                    <div class="text-center">
                        <a href="<? echo $book['Link']; ?>" class="btn  btn-d  btn-xl" target="_blank"><span
                                class="feather-icon icon-link icon-spacer icon-white"></span>Подробности</a>
                    </div>
                <? endif; ?>
            </div>
            <div class="col-sm-4">
                <img src="<? echo $book['img']; ?>" class="img-responsive"/>
                <? if ($book['Year']): ?>
                    <h4 class="mg-md">
                        <span class="feather-icon icon-bell"></span> <? echo $book['Year']; ?>
                    </h4>
                <? endif; ?>
                <? if ($book['Genre']): ?>
                    <h4 class="mg-md">
                        <span class="feather-icon icon-tag"></span> <? echo $book['Genre']; ?>
                    </h4>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- bloc-17 END -->

<!-- bloc-18 -->
<div class="bloc l-bloc books-bloc bgc-white b-parallax" id="bloc-18">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mg-md tc-white">
                            <span class="feather-icon icon-eye"></span> Рецензии на книгу
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <? if (!Users::isGuest()): ?>
                            <a href="/books/comment<? echo $book['id']; ?>"
                               class="btn btn-lg pull-right btn-white hidden-xs"><span
                                    class="feather-icon icon-plus icon-spacer"></span>Добавить рецензию</a>
                        <? endif; ?>
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
                                            <img src="<? echo $commnet['Profile_Photo_Path']; ?>"
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
                                                <a href="/deleteComment<? echo $commnet['id'] ?>/books/<? echo $book['id'] ?>"
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
<!-- bloc-18 END -->

<? include_once ROOT . '/templates/footer.php'; ?>
