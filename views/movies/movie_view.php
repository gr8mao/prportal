<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 04.05.17
 * Time: 12:49
 */
$title = $movie['Name'].' | PR-портал';
include ROOT . "/templates/header.php"; ?>


<!-- bloc-20 -->
<div class="bloc bgc-white l-bloc" id="bloc-20">
    <div class="container bloc-lg" style="padding-top: 50px;">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mg-md">
                    <? echo $movie['Name']; ?>
                    <? if (Users::checkUserAdmin(Users::checkLogged())): ?>

                        <a href="/admin/movies/delete<? echo $movie['id'] ?>"
                           class="btn btn-lg pull-right btn-white hidden-xs">
                            <span class="feather-icon icon-cross icon-spacer"></span> Удалить фильм</a>

                    <? endif; ?>
                </h1>
                <h6 class="mg-md author">
                    <span class="feather-icon icon-square-check"></span>
                    <strong>Добавлено: <? echo $Added_By; ?></strong>
                </h6>
                <p class="mg-lg"><? echo $movie['Annotation']; ?></p>
                <? if ($movie['Link']): ?>
                    <div class="text-center">
                        <a href="<? echo $movie['Link']; ?>" class="btn  btn-d  btn-xl" target="_blank"><span
                                class="feather-icon icon-link icon-spacer icon-white"></span>Подробности</a>
                    </div>
                <? endif; ?>
            </div>
            <div class="col-sm-4">
                <img src="<?echo $movie['Image']?>" class="img-responsive"/>
                <?if($movie['Year']):?>
                <h4 class="mg-md">
                    <span class="feather-icon icon-bell"></span> <? echo $movie['Year']; ?>
                </h4>
                <?endif;?>
                <?if($movie['Country']):?>
                <h4 class="mg-md">
                    <span class="feather-icon icon-globe"></span> <? echo $movie['Country']; ?>
                </h4>
                <?endif;?>
                <?if($movie['Genre']):?>
                <h4 class="mg-md">
                    <span class="feather-icon icon-tag"></span> <? echo $movie['Genre']; ?>
                </h4>
                <?endif;?>
            </div>
        </div>
    </div>
</div>

</div>
<!-- bloc-20 END -->

<!-- bloc-21 -->
<div class="bloc l-bloc bgc-white movies-bloc" id="bloc-21">
    <div class="container bloc-lg">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mg-md tc-white">
                            <span class="feather-icon icon-eye"></span> Рецензии на фильм
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <? if (!Users::isGuest()): ?>
                            <a href="/movies/comment<?echo $movie['id'];?>" class="btn btn-lg pull-right btn-white hidden-xs"><span class="feather-icon icon-plus icon-spacer"></span>Добавить рецензию</a>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
        <? if (!Users::isGuest()): ?>
            <?if($Comments):?>
                <div class="row voffset">
                    <? foreach ($Comments as $commnet): ?>
                        <div class="col-sm-12">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <img src="<?echo $commnet['Profile_Photo_Path']?>" class="img-responsive img-circle hidden-xs" />
                                        </div>
                                        <div class="col-sm-10">
                                            <form id="form_2572" novalidate>
                                                <div class="form-g]roup">
                                                    <label>
                                                        <?echo $commnet['Added_By']?>
                                                    </label>
                                                </div>
                                            </form>
                                            <h3 class="mg-clear">
                                                <?echo $commnet['Title']?>
                                            </h3>
                                        </div>
                                        <? if (Users::checkUserAdmin(Users::checkLogged())): ?>
                                            <div class="col-sm-1">
                                                <a href="/deleteComment<? echo $commnet['id'] ?>/movies/<? echo $movie['id'] ?>"
                                                   class="btn btn-lg pull-right btn-white hidden-xs">
                                                    <span class="feather-icon icon-cross icon-spacer"></span></a>
                                            </div>
                                        <? endif; ?>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <p> <?echo $commnet['Text']?></p>
                                </div>
                            </div>
                        </div>
                    <?endforeach;?>
                </div>
            <?else:?>
                <div class="row voffset-lg">
                    <div class="col-sm-12">
                        <h4 class="mg-md text-center tc-white">
                            <i>Рецензий пока нет...</i>
                        </h4>
                    </div>
                </div>
            <?endif;?>
        <?else: ?>
            <div class="row voffset-lg">
                <div class="col-sm-12">
                    <h4 class="mg-md text-center tc-white">
                        <i>Чтобы просматривать рецензии, нужно войти в систему!</i>
                    </h4>
                </div>
            </div>
        <?endif;?>
    </div>
</div>
<!-- bloc-21 END -->

<? include_once ROOT . '/templates/footer.php' ?>
