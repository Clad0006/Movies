<?php

declare(strict_types=1);

use Entity\Collection\PeopleCollection;
use Entity\Movie;
use Html\AppWebPage;

$webpage = new AppWebPage();

if (ctype_digit($_GET['movieId'])) {
    $movieId = $_GET['movieId'];
} else {
    header("Location:/");
}
$movie = Movie::findById(intval($movieId));
$people = PeopleCollection::findAll();

$nom = $movie->getTitle();
$webpage->setTitle("Films - $nom");

$webpage->appendContent("<div class='description'>");
$webpage->appendContent("<img src='image.php?imageId={$movie->getPosterId()}'>");
$webpage->appendContent("<div class='titre'>".$webpage->escapeString("{$movie->getTitle()}"));
$webpage->appendContent("<div class='date'>".$webpage->escapeString("{$movie->getReleaseDate()}"));
$webpage->appendContent("<div class='titreOriginal'>".$webpage->escapeString("{$movie->getOriginalTitle()}"));
$webpage->appendContent("<div class='slogan'>".$webpage->escapeString("{$movie->getTagline()}"));
$webpage->appendContent("<div class='resume'>".$webpage->escapeString("{$movie->getOverview()}")."</div>");

foreach ($people as $ligne) {
    $webpage->appendContent("<div class='acteur'><img src='image.php?imageId={$ligne->getAvatarId()}'>"."<div class='titre'>".$webpage->escapeString("{$ligne->getName()}")."</a></div></div><br>\n");
}

$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n"."<a href='index.php'> Retourner à l'acceuil</a>");

echo $webpage->toHTML();