<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;

class Image
{
    private int $id;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    public static function findById(int $id): Image
    {
        $stmt = MyPDO::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM image
            WHERE id= ?
        SQL
        );
        $stmt->setFetchMode(MyPDO::FETCH_CLASS, Image::class);
        $stmt->execute([$id]);
        if (!($image = $stmt->fetch())) {
            throw new EntityNotFoundException('Id invalide');
        } else {
            return $image;
        }
    }
}
