<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use \Html\Form\MovieForm;


if (!$_GET){
    $id_present=false;
}
else {

    try {
        if (!ctype_digit($_GET["movieId"]) or $_GET["movieId"]==''){
            throw new ParameterException();
        }
        else if (!(Movie::findById(intval($_GET["movieId"])))){
            throw new EntityNotFoundException();
        }
    } catch (ParameterException) {
        http_response_code(400);
    } catch (EntityNotFoundException) {
        http_response_code(404);
    } catch (Exception) {
        http_response_code(500);
    }
    $id_present=true;
}

if ($id_present){
    $movie=Movie::findById(intval($_GET["movieId"]));
    $form=new MovieForm($movie);
}
else{
    $form=new MovieForm();
}

echo $form->getHtmlForm("movie-save.php");