<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;

class MovieCollection
{
    /**
     * Fais une requête SQL qui tris tous les films.
     *
     * @return array Le tableau contenant tous les film triés par genre
     */
    public static function findAll():array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM movie
                ORDER BY title;
            SQL
        );

        $stmt->setFetchMode(MyPdo::FETCH_CLASS, Movie::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}