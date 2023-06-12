<?php

namespace Entity\Collection;

use Database\MyPdo;
use Entity\People;

class PeopleCollection
{
    public static function findByPeopleId(int $artistId):array{

        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT *
                FROM people
                ORDER BY name;
            SQL
        );

        $stmt->setFetchMode(MyPdo::FETCH_CLASS, People::class);
        $stmt->execute([$artistId]);
        return $stmt->fetchAll();
    }
}