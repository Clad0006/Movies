<?php

declare(strict_types=1);

use Entity\Movie;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

header('Location: ../index.php');

try {
    if (!ctype_digit($_GET["movieId"]) or $_GET["movieId"]=='') {
        throw new ParameterException();
    }
    else if (!(Movie::findById(intval($_GET["artistId"])))){
        throw new EntityNotFoundException();
    }
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

Movie::findById(intval($_GET["artistId"]))->delete();