<?php

use Entity\Collection\PeopleCollection;
use Entity\People;
use Html\AppWebPage;

$webpage = new AppWebPage();

if (ctype_digit($_GET['peopleId'])) {
    $peopleId = $_GET['peopleId'];
} else {
    header("Location:/");
}
$people = People::findById(intval($peopleId));
$people_movie = PeopleCollection::findByMovieId(intval($peopleId));

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

$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n"."<a href='index.php'> Retourner à l'acceuil</a>");


echo $webpage->toHTML();