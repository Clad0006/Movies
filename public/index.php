<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();

$webpage->setTitle('Films');

$webpage->appendContent('<a href="/admin/movie-form.php">Ajouter</a>');

$webpage->appendContent("<div class='list'>");
$stmt = MovieCollection::findAll();
foreach ($stmt as $ligne) {
    if ($ligne->getPosterId() != null){
        $webpage->appendContent("<div class='films'><a href='movie.php?movieId={$ligne->getId()}'><img src='image.php?imageId={$ligne->getPosterId()}'>" . "<div class='title'>" . $webpage->escapeString("{$ligne->getTitle()}") . "</a></div></div><br>\n");
    }
    else{
        $webpage->appendContent("<div class='films'><a href='movie.php?movieId={$ligne->getId()}'><img src='https://c8.alamy.com/compfr/ek1c8x/cinema-film-la-cinematographie-annonce-affiche-ou-flyer-avec-arriere-plan-de-l-espace-vide-ek1c8x.jpg'>" . "<div class='title'>" . $webpage->escapeString("{$ligne->getTitle()}") . "</a></div></div><br>\n");
    }
}
$webpage->appendContent("</div>\n");
$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n");


echo $webpage->toHTML();
