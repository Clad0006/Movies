<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Movie;
use Entity\Cast;

class People
{
    private int $id;
    private ?int $avatarId;
    private ?string $birthday;
    private ?string $deathday;
    private string $name;
    private ?string $biography;
    private ?string $placeOfBirth;

    /**
 * @return int
 */
    public function getId(): int
    {
        return $this->id;
    }/**
 * @return int
 */
    public function getAvatarId(): ?int
    {
        return $this->avatarId;
    }/**
 * @return string
 */
    public function getBirthday(): string
    {
        return $this->birthday;
    }/**
 * @return string
 */
    public function getDeathday(): ?string
    {
        return $this->deathday;
    }/**
 * @return string
 */
    public function getName(): string
    {
        return $this->name;
    }/**
 * @return string
 */
    public function getBiography(): string
    {
        return $this->biography;
    }/**
 * @return string
 */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    public static function findById(int $id): People
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM people
        WHERE id = ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, People::class);
        $stmt->execute([$id]);
        if (!($people = $stmt->fetch())) {
            throw new EntityNotFoundException('Id invalide');
        } else {
            return $people;
        }
    }

    public function findMovies(int $peopleId):array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT m.movieId,m.posterId,m.title,m.releaseDate
        FROM people p JOIN cast c ON p.id = c.peopleId JOIN movie m on c.movieId=m.id
        WHERE peopleId = ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Movie::class);
        $stmt->execute([$peopleId]);
        return $stmt->fetchAll();
    }

    public function findRoles(int $peopleId):array
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT c.role
        FROM people p JOIN cast c ON p.id = c.peopleId JOIN movie m on c.movieId=m.id
        WHERE peopleId = ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Cast::class);
        $stmt->execute([$peopleId]);
        return $stmt->fetchAll();
    }

}
