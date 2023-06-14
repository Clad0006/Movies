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
                SELECT DISTINCT m.*
                FROM movie m JOIN movie_genre mg on m.id=mg.movieId JOIN genre g on mg.genreId=g.id
                ORDER BY g.name,m.title
            SQL
        );

        $stmt->setFetchMode(MyPdo::FETCH_CLASS, Movie::class);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function findByGenreName(string $genreName):array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
                SELECT DISTINCT m.*
                FROM movie m JOIN movie_genre mg on m.id=mg.movieId JOIN genre g on mg.genreId=g.id
                WHERE g.name= ?
                ORDER BY g.name,m.title
            SQL
        );

        $stmt->setFetchMode(MyPdo::FETCH_CLASS, Movie::class);
        $stmt->execute([$genreName]);
        return $stmt->fetchAll();
    }


}