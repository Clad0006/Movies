<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\People;

class PeopleCollection
{
    /**
     * Fais une requête SQL qui tris les artists par film.
     *
     * @return array Le tableau contenant tous les artists dans chaque film
     */
    public static function findAll():array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM people p JOIN cast c ON p.id = c.peopleId
                              JOIN movie m ON c.movieId = m.id;
            SQL
        );

        $stmt->setFetchMode(MyPdo::FETCH_CLASS, People::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}