<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Collection\PeopleCollection;
use Entity\Exception\EntityNotFoundException;

class Movie
{
    private ?int $id;
    private ?int $posterId;
    private string $originalLanguage;
    private string $originalTitle;
    private ?string $overview;
    private string $releaseDate;
    private int $runtime;
    private ?string $tagline;
    private string $title;

    private function __construct()
    {

    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }/**
     * @param ?int $id
     * @return Movie
     */
    public function setId(?int $id): Movie
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return ?int
     */
    public function getPosterId(): ?int
    {
        return $this->posterId;
    }

    /**
     * @param int $posterId
     * @return Movie
     */
    public function setPosterId(int $posterId): Movie
    {
        $this->posterId = $posterId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    /**
     * @param string $originalLanguage
     * @return Movie
     */
    public function setOriginalLanguage(string $originalLanguage): Movie
    {
        $this->originalLanguage = $originalLanguage;
        return $this;
    }

    /**
     * @return string
     */
    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    /**
     * @param string $originalTitle
     * @return Movie
     */
    public function setOriginalTitle(string $originalTitle): Movie
    {
        $this->originalTitle = $originalTitle;
        return $this;
    }

    /**
     * @return string
     */
    public function getOverview(): string
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     * @return Movie
     */
    public function setOverview(string $overview): Movie
    {
        $this->overview = $overview;
        return $this;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     * @return Movie
     */
    public function setReleaseDate(string $releaseDate): Movie
    {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @return int
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }

    /**
     * @param ?int $runtime
     * @return Movie
     */
    public function setRuntime(?int $runtime): Movie
    {
        $this->runtime = $runtime;
        return $this;
    }

    /**
     * @return string
     */
    public function getTagline(): string
    {
        return $this->tagline;
    }

    /**
     * @param string $tagline
     * @return Movie
     */
    public function setTagline(string $tagline): Movie
    {
        $this->tagline = $tagline;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    public static function findById(int $id): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        SELECT *
        FROM movie
        WHERE id= ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Movie::class);
        $stmt->execute([$id]);
        if (!($movie = $stmt->fetch())) {
            throw new EntityNotFoundException('Id invalide');
        } else {
            return $movie;
        }
    }

    public function getPeople()
    {
        return PeopleCollection::findByMovieId($this->id);
    }

    public function delete(): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        DELETE FROM movie
        WHERE id= ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Movie::class);
        $stmt->execute([$this->id]);
        $this->setId(null);
        return $this;
    }

    protected function update(): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        UPDATE movie
        SET posterId= ?,originalLanguage= ?,originalTitle= ?,overview= ?,releaseDate= ?,runtime= ?,tagline= ?,title= ?
        WHERE id= ?
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Movie::class);
        $stmt->execute([$this->posterId,$this->originalLanguage,$this->originalTitle,$this->overview,$this->releaseDate,$this->runtime,$this->tagline,$this->title,$this->id]);
        return $this;
    }

    protected function insert(): Movie
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
        INSERT INTO movie(id,posterId,originalLanguage,originalTitle,overview,releaseDate,runtime,tagline,title)
        VALUES(?,?,?,?,?,?,?,?,?)
       SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Movie::class);
        $this->id=intval(MyPdo::getInstance()->lastInsertId()+1);
        $stmt->execute([$this->id,$this->posterId,$this->originalLanguage,$this->originalTitle,$this->overview,$this->releaseDate,$this->runtime,$this->tagline,$this->title]);
        return $this;
    }

    public function save(): Movie
    {
        if ($this->id==null) {
            $this->insert();
        } else {
            $this->update();
        }
        return $this;
    }

    public static function create($posterId,$originalLanguage,$originalTitle,$overview,$releaseDate,$runtime,$tagline,$title,$id=null,): Movie
    {
        $movie=new Movie();
        $movie->setId($id);
        $movie->setPosterId($posterId);
        $movie->setOriginalLanguage($originalLanguage);
        $movie->setOriginalTitle($originalTitle);
        $movie->setOverview($overview);
        $movie->setReleaseDate($releaseDate);
        $movie->setRuntime($runtime);
        $movie->setTagline($tagline);
        $movie->setTitle($title);
        return $movie;
    }

}
