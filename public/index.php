<?php

declare(strict_types=1);

use Entity\Collection\MovieCollection;
use Html\AppWebPage;

$webpage = new AppWebPage();

$webpage->setTitle('Films');

$stmt = MovieCollection::findAll();

foreach ($stmt as $ligne) {
    $webpage->appendContent($webpage->escapeString("{$ligne->getTitle()}")."<br>\n");
}

echo $webpage->toHTML();
