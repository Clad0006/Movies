<?php

declare(strict_types=1);

use Entity\Collection\GenreCollection;
use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();

$webpage->setTitle('Films');

$webpage->appendContent("<div class='ajouter'><a href='/admin/movie-form.php'>Ajouter</a></div>\n");

$webpage->appendContent("        <div class='listIndex'>");
$selectGenres = $_GET['genres'] ?? [];
$filterMovie = array();

if (!empty($selectGenres)){
    foreach ($selectGenres as $selectGenre){
        $filterMovie = array_merge($filterMovie,MovieCollection::findByGenreName($selectGenre));
    }
}else{
    $filterMovie = MovieCollection::findAll();
}

$listeAntiDoublons=[];
foreach ($filterMovie as $Movie){
    if (!in_array($Movie->getId(),$listeAntiDoublons)){
        $listeAntiDoublons[] = $Movie->getId();
    }
    else{
        unset($filterMovie[array_search($Movie,$filterMovie)]);
        $filterMovie=array_values($filterMovie);
    }
}

$webpage->appendContent("<div class='dropdown'><br>
                <p>Genres :</p>
                    <div class='dropdown-content'>
                    <form>");

$genres = GenreCollection::findAll();
$webpage->appendContent('<select name="genres[]" id="genres" multiple>');
foreach ($genres as $genre) {
    $webpage->appendContent("<option name='genres[]' value='{$genre->getName()}'>{$genre->getName()}\n");
}

$webpage->appendContent("
                        <input name='genreSubmit' type='submit' value='Valider'>
                    </form>
                    <a class='reset' href='index.php'>Reset</a>
            </div>
        </div>
");
$webpage->appendContent("<div class='listFilm'>");
foreach ($filterMovie as $ligne) {
    if ($ligne->getPosterId() != null){
        $webpage->appendContent("<div class='films'><a href='movie.php?movieId={$ligne->getId()}'><div class='afficheAcceuil'><img src='image.php?imageId={$ligne->getPosterId()}'></div>" . "<div class='title'>" . $webpage->escapeString("{$ligne->getTitle()}") . "</a></div></div><br>\n");
    }
    else{
        $webpage->appendContent("<div class='films'><a href='movie.php?movieId={$ligne->getId()}'><img src='https://c8.alamy.com/compfr/ek1c8x/cinema-film-la-cinematographie-annonce-affiche-ou-flyer-avec-arriere-plan-de-l-espace-vide-ek1c8x.jpg'>" . "<div class='title'>" . $webpage->escapeString("{$ligne->getTitle()}") . "</a></div></div><br>\n");
    }
}
$webpage->appendContent("</div>\n");
$webpage->appendContent("</div>\n");
$webpage->appendFooter("<p>Dernière modification : {$webpage->getLastModif()}</p>\n");


echo $webpage->toHTML();
