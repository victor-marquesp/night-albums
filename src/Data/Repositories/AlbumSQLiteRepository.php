<?php

namespace App\Data\Repositories;

use PDO;

use App\Data\Repositories\Contracts\IAlbumRepository;

use App\Domain\Mappers\AlbumMapper;
use App\Shared\DTO\NewAlbumData;

use App\Domain\Models\Album;
use App\Shared\DTO\AlbumPersistedData;
use App\Shared\Exceptions\AlbumNotFoundException;

final class AlbumSQLiteRepository implements IAlbumRepository {

    public function __construct(
        private PDO $pdo,
        private AlbumMapper $albumMapper
    ) {}

    public function save(NewAlbumData $data) : AlbumPersistedData {

        $params = $this->albumMapper->toInsertParams($data);

        $stmt = $this->pdo->prepare("
                    INSERT INTO albums (name, duration, desc, artist, genre) 
                    VALUES (:name, :duration, :desc, :artist, :genre);
                ");
        $stmt->execute($params);

        $id = (int) $this->pdo->lastInsertId();
        return new AlbumPersistedData(
            id: $id,
            name: $data->name,
            duration: $data->duration,
            desc: $data->desc,
            artist: $data->artist,
            genre: $data->genre
        );

    }

    public function findAll() : array {
        
        $query = $this->pdo->query("SELECT * FROM albums;");
        
        $albums = $query->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            fn ($album) => $this->albumMapper->fromArray($album),
            $albums
        );

    }

    public function findById(int $id) : Album {
        
        $stmt = $this->pdo->prepare("SELECT * FROM albums WHERE id = :id;");
        $stmt->execute(['id' => $id]);

        $albumArray = $stmt->fetch(PDO::FETCH_ASSOC);

        if($albumArray === false) {
            throw new AlbumNotFoundException('Álbum Não encontrado');
        }

        return $this->albumMapper->fromArray($albumArray);
    }

    public function update(Album $data) : Album {
        
        $albumArray = $this->albumMapper->toArray($data);

        $stmt = $this->pdo->prepare("
                UPDATE albums
                SET name = :name, duration = :duration, desc = :desc, artist = :artist, genre = :genre 
                WHERE id = :id;
            ");
        $stmt->execute($albumArray);

        return $data;

    }

    public function destroy(int $id) : int {
        
        $stmt = $this->pdo->prepare("DELETE FROM albums WHERE id = :id;");
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount() === 0) {
            throw new AlbumNotFoundException('Álbum não encontrado');
        }

        return $id;

    }

}