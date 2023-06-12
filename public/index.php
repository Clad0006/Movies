<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Entity\Image;
use Html\AppWebPage;

$webpage = new AppWebPage();

$webpage->setTitle('Films');

$stmt = MovieCollection::findAll();
$stmt2 = MovieCollection::findAll();
foreach ($stmt as $ligne) {
    $webpage->appendContent("<img src='image.php?imageId={$ligne->getPosterId()}'>".$webpage->escapeString("{$ligne->getTitle()}")."</a><br>\n");
}
$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n");


echo $webpage->toHTML();
