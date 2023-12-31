<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Cast;
use Entity\Exception\EntityNotFoundException;
use Entity\People;

class PeopleCollection
{
    /**
     * Fais une requête SQL qui tris les acteurs par film.
     *
     * @return array Le tableau contenant tous les acteurs dans chaque film
     */
    public static function findByMovieId(int $movieID): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT p.*
        FROM people p JOIN cast c ON p.id = c.peopleId
        WHERE movieId = ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, People::class);
        $stmt->execute([$movieID]);
        return $stmt->fetchAll();
    }
    public static function findRolesByMovieId(int $movieID): array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT c.role
        FROM cast c JOIN people p ON p.id = c.peopleId
        WHERE movieId = ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Cast::class);
        $stmt->execute([$movieID]);
        return $stmt->fetchAll();
    }
}