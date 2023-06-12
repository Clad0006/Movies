<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();

$webpage->setTitle('Films');

$stmt = MovieCollection::findAll();
foreach ($stmt as $ligne) {
    $webpage->appendContent("<div class='film'><a href='movie.php?movieId={$ligne->getId()}'><img src='image.php?imageId={$ligne->getPosterId()}'>"."<div class='titre'>".$webpage->escapeString("{$ligne->getTitle()}")."</a></div></div><br>\n");
}
$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n");


echo $webpage->toHTML();
