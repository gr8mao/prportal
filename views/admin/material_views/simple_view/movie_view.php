<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:45
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