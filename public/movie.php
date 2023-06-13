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
$people = PeopleCollection::findByMovieId(intval($movieId));
$role = PeopleCollection::findRolesByMovieId(intval($movieId));

$nom = $movie->getTitle();
$webpage->setTitle("Films - $nom");

$webpage->appendContent("<div class='descriptionFilm'>\n");
$webpage->appendContent("                <img class='affiche' src='image.php?imageId={$movie->getPosterId()}'>\n");
$webpage->appendContent("                <div class='info'>\n");
$webpage->appendContent("                    <div class='titreDate'>\n");
$webpage->appendContent("                        <div class='titre'>".$webpage->escapeString("{$movie->getTitle()}")."</div>\n");
$webpage->appendContent("                        <div class='date'>".$webpage->escapeString("{$movie->getReleaseDate()}")."</div>\n");
$webpage->appendContent("                    </div>\n");
$webpage->appendContent("                    <div class='titreOriginal'>".$webpage->escapeString("{$movie->getOriginalTitle()}")."</div>\n");
$webpage->appendContent("                    <div class='slogan'>".$webpage->escapeString("{$movie->getTagline()}")."</div>\n");
$webpage->appendContent("                    <div class='resume'>".$webpage->escapeString("{$movie->getOverview()}")."</div>\n");
$webpage->appendContent("                </div>\n");
$webpage->appendContent("            </div>\n");

$webpage->appendContent("<div class='lesActeurs'>\n");
$n = 0;
foreach ($people as $ligne) {
    $webpage->appendContent("<div class='acteur'><a href='people.php?peopleId={$ligne->getId()}'><img class='avatar' src='image.php?imageId={$ligne->getAvatarId()}'><div class='infoActeur'><div class='nomActeur'>".$webpage->escapeString("{$ligne->getName()}")."</div><div class='role'>".$role[$n]->getRole()."</div></a></div></div>\n");
    $n += 1;
}
$webpage->appendContent("</div>\n");

$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n"."<a href='index.php'> Retourner à l'acceuil</a>");

echo $webpage->toHTML();