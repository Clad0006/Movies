<?php
declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Genre;

class GenreCollection
{
    public static function findAll():array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM genre
            SQL
        );
        $stmt->setFetchMode(MyPdo::FETCH_CLASS, Genre::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}