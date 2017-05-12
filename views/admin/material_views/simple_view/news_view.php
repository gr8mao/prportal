<?php
/**
 * Created by PhpStorm.
 * User: maksimbelov
 * Date: 06.05.17
 * Time: 23:45
 */

$title = 'Все новости | PR-портал';
include_once ROOT . '/templates/header.php'; ?>

    <div class="container bloc-lg">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="mg-clear">
                            <? echo $news['Header']; ?>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <? if ($news['Image']): ?>
                            <img src="<? echo $news['Image'] ?>" class="img-responsive">
                        <? endif; ?>
                        <p>
                            <? echo $news['Text']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<? include_once ROOT . '/templates/footer.php'; ?>