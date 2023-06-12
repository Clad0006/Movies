<?php

declare(strict_types=1);

use Entity\Image;
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;

try {
    ctype_digit($_GET["imageId"]);
} catch (ParameterException) {
    http_response_code(400);
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}

$stmt = Image::findById(intval($_GET["imageId"]));
header('Content-Type: image/jpeg');

echo $stmt->getJpeg();
