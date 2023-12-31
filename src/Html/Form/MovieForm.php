<?php

declare(strict_types=1);

namespace Html\Form;

use Entity\Artist;
use Entity\Exception\ParameterException;
use Entity\Movie;
use Html\StringEscaper;

class MovieForm
{
    use StringEscaper;
    private ?Movie $movie;

    /**
     * @param Movie|null $movie
     */
    public function __construct(?Movie $movie=null)
    {
        $this->movie = $movie;
    }

    /**
    * @return ?Movie
    */
    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function getHtmlForm(string $action): string
    {
        $originalLanguage=$this->escapeString($this->movie?->getOriginalLanguage());
        $originalTitle=$this->escapeString($this->movie?->getOriginalTitle());
        $overview=$this->escapeString($this->movie?->getOverview());
        $releaseDate=$this->escapeString($this->movie?->getReleaseDate());
        $runtime=$this->movie?->getRuntime();
        $tagline=$this->escapeString($this->movie?->getTagline());
        $title=$this->escapeString($this->movie?->getTitle());
        return "
        <form name=\"ArtistForm\" action='$action' method='post'>
            <div class='ajout'>
                <label for='originalLanguage'>Langue originale :</label>
                <input type='text' name='originalLanguage' id='originalLanguage' value='$originalLanguage' required> 
            </div>
            <div class='ajout'>
                <label for='originalTitle'>Titre original :</label>
                <input type='text' name='originalTitle' id='originalTitle' value='$originalTitle' required> 
            </div>
             <div class='ajout'>
                <label for='overview'>Résumé :</label>
                    <textarea class='overwiew' name='overview' id='overview'>$overview</textarea>          
            </div>
            <div class='ajout'>
                <label for='releaseDate'>Date de sortie :</label>
                <input type='text' name='releaseDate' id='releaseDate' value='$releaseDate' required> 
            </div>
            <div class='ajout'>
                <label for='runtime'>Durée :</label>
                <input type='text' name='runtime' id='runtime' value='$runtime' required> 
            </div>
            <div class='ajout'>
                <label for='tagline'>Slogan :</label>
                <input type='text' name='tagline' id='tagline' value='$tagline'> 
            </div>
            <div class='ajout'>
                <label for='title'>Titre :</label>
                <input type='text' name='title' id='title' value='$title'> 
            </div>
            <div>
                <input type='hidden' name='id' id='id' value='{$this->movie?->getId()}'>
            </div>
            <div>
                <input type='hidden' name='posterId' id='posterId' value='{$this->movie?->getPosterId()}'>
            </div>
            <div class='button'>
                <button type='submit'>Enregistrer</button>
            </div>

        </form>
        ";
    }

    public function setEntityFromQueryString():void
    {
        if (ctype_digit(intval($_POST["id"]))){
            $id=intval($_POST["id"]);
        }
        else{
            $id=null;
        }
        if($_POST['originalLanguage']=='' or $_POST['originalTitle']=='' or $_POST['releaseDate']=='' or $_POST['runtime']==''){
            throw new ParameterException("Paramètre invalide");
        }
        $originalLanguage=$this->stripTagsAndTrim($_POST['originalLanguage']);
        $originalTitle=$this->stripTagsAndTrim($_POST['originalTitle']);
        $overview=$this->stripTagsAndTrim($_POST['overview']);
        $releaseDate=$this->stripTagsAndTrim($_POST['releaseDate']);
        $runtime=intval($this->stripTagsAndTrim($_POST['runtime']));
        $tagline=$this->stripTagsAndTrim($_POST['tagline']);
        $title=$this->stripTagsAndTrim($_POST['title']);
        $this->movie=Movie::create(intval($_POST['posterId']),$originalLanguage,$originalTitle,$overview,$releaseDate,$runtime,$tagline,$title,$id);
    }

}
