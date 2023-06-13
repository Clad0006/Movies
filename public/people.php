<?php

use Entity\Collection\MovieCollection;
use Entity\People;
use Html\AppWebPage;

$webpage = new AppWebPage();

if (ctype_digit($_GET['peopleId'])) {
    $peopleId = $_GET['peopleId'];
} else {
    header("Location:/");
}
$people = People::findById(intval($peopleId));
$people_movie = People::findMovies(intval($peopleId));
$role = People::findRoles(intval($peopleId));

$nom = $people->getName();
$webpage->setTitle("Films - $nom");

$webpage->appendContent("<div class='descriptionActeur'>\n");
$webpage->appendContent("                <img class='photo' src='image.php?imageId={$people->getAvatarId()}'>\n");
$webpage->appendContent("                <div class='info'>\n");
$webpage->appendContent("                    <div class='nom'>".$webpage->escapeString("{$people->getName()}")."</div>\n");
$webpage->appendContent("                    <div class='lieu'>".$webpage->escapeString("{$people->getPlaceOfBirth()}")."</div>\n");
$webpage->appendContent("                        <div class='dateActeur'>\n");
$webpage->appendContent("                            <div class='dateNais'>".$webpage->escapeString("{$people->getBirthday()}")."</div>\n");
$webpage->appendContent("                          - <div class='dateMort'>".$webpage->escapeString("{$people->getDeathday()}")."</div>\n");
$webpage->appendContent("                        </div>\n");
$webpage->appendContent("                        <div class='bio'>".$webpage->escapeString("{$people->getBiography()}")."</div>\n");
$webpage->appendContent("                    </div>\n");
$webpage->appendContent("                </div>\n");
$webpage->appendContent("            </div>\n");

$n = 0;
foreach ($people_movie as $ligne) {
    $webpage->appendContent("<div class='film'><a href='movie.php?movieId={$ligne->getId()}'><img class='afficheFilm' src='image.php?imageId={$ligne->getPosterId()}'><div class='infoFilm'><div class='titreFilm'>".$webpage->escapeString("{$ligne->getTitle()}")."<div class='dateFilm'>".$webpage->escapeString("{$ligne->getReleaseDate()}")."<div class='role'>".$role[$n]->getRole()."</div></div></div></a></div></div>\n");
    $n += 1;
}

$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n"."<a href='index.php'> Retourner à l'acceuil</a>");


echo $webpage->toHTML();