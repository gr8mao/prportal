<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:45
 */

$title = "Книги | PR-портал";
include_once ROOT . '/templates/header.php'; ?>

<!-- bloc-17 -->
<div class="bloc bgc-white l-bloc" id="bloc-17">
    <div class="container bloc-lg" style="padding-top: 0;">
        <div class="row voffset">
            <div class="col-sm-8">
                <h1 class="mg-md">
                    <strong><?echo $book['Title'];?></strong>
                </h1>
                <h3 class="mg-md">
                    <strong><?echo $book['Author'];?></strong>
                </h3>
                <h6 class="mg-md author">
                    <span class="feather-icon icon-square-check"></span> <strong>Добавлено: <?echo $Added_By;?></strong>
                </h6>
                <p class="mg-lg">
                    <?echo $book['Annotation'];?>
                </p>
                <? if ($book['Link']): ?>
                    <div class="text-center">
                        <a href="<? echo $book['Link']; ?>" class="btn  btn-d  btn-xl" target="_blank"><span
                                class="feather-icon icon-link icon-spacer icon-white"></span>Подробности</a>
                    </div>
                <? endif; ?>
            </div>
            <div class="col-sm-4">
                <img src="<?echo $book['img'];?>" class="img-responsive" />
                <?if ($book['Year']):?>
                    <h4 class="mg-md">
                        <span class="feather-icon icon-bell"></span> <?echo $book['Year'];?>
                    </h4>
                <?endif;?>
                <?if ($book['Genre']):?>
                    <h4 class="mg-md">
                        <span class="feather-icon icon-tag"></span> <?echo $book['Genre'];?>
                    </h4>
                <?endif;?>
            </div>
        </div>
    </div>
</div>
<!-- bloc-17 END -->