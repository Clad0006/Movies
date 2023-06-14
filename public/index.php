<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();

$webpage->setTitle('Films');

$webpage->appendContent('<a href="/admin/movie-form.php">Ajouter</a>');

$webpage->appendContent("<div class='list'>");
$selectGenres = $_GET['genres'] ?? [];
$filterMovie = array();

if (!empty($selectGenres)){
    foreach ($selectGenres as $selectGenre){
        $filterMovie = array_merge($filterMovie,MovieCollection::findByGenreName($selectGenre));
    }
}else{
    $filterMovie = MovieCollection::findAll();
}

$webpage->appendContent("<div class='dropdown'><br>
                <p>Genres :</p>
                    <div class='dropdown-content'>
                    <form>");

$genres = GenreCollection::findAll();

foreach ($genres as $genre) {
    $webpage->appendContent("<input type='checkbox' name='genres[]' value='{$genre->getName()}'>{$genre->getName()}<br>");
}

$webpage->appendContent("
                        <input type='submit' value='Submit'>
                    </form>
            </div>
        </div>
");

foreach ($filterMovie as $ligne) {
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
