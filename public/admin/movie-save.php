<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\ParameterException;
use \Html\Form\MovieForm;

header('Location: ../index.php');

try {
    if ($_POST["originalLanguage"]=='' or $_POST["originalTitle"]=='' or $_POST["releaseDate"]=='' or $_POST["runtime"]==''){
        throw new ParameterException();
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (Exception) {
    http_response_code(500);
}

$form= new MovieForm();
$form->setEntityFromQueryString();
$form->getMovie()->save();