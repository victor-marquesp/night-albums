<?php

namespace App\Data\Repositories;

use PDO;

use App\Data\Repositories\Contracts\IExperienceRepository;

use App\Domain\Mappers\ExperienceMapper;
use App\Domain\Models\Experience;
use App\Shared\DTO\ExperienceAlbum;
use App\Shared\DTO\NewExperienceData;
use App\Shared\DTO\ExperiencePersistedData;
use App\Shared\Exceptions\ExperienceNotFoundException;

final class ExperienceSQLiteRepository implements IExperienceRepository {

    public function __construct(
        private PDO $pdo,
        private ExperienceMapper $experienceMapper
    ){}

    public function save(NewExperienceData $data) : ExperiencePersistedData {
       
        $params = $this->experienceMapper->toInsertParams($data);

        $stmt = $this->pdo->prepare("
                INSERT INTO experiences (album_id, title, mood, stars, desc) 
                VALUES (:album_id, :title, :mood, :stars, :desc);
            ");
        $stmt->execute($params);

        $id = (int) $this->pdo->lastInsertId();
        return new ExperiencePersistedData(
            id: $id,
            albumId: $data->albumId,
            title: $data->title,
            mood: $data->mood,
            stars: $data->stars,
            desc: $data->desc
        );

    }

    public function findAll() : array {
        
        $query = $this->pdo->query('SELECT * FROM experiences;');
        $experiences = $query->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            fn ($experience) => $this->experienceMapper->fromArray($experience),
            $experiences
        );

    }

    public function findById(int $id) : Experience {
        
        $stmt = $this->pdo->prepare("SELECT * FROM experiences WHERE id = :id;");

        $stmt->execute(['id' => $id]);
        $experienceArray = $stmt->fetch(PDO::FETCH_ASSOC);

        if($experienceArray === false) {
            throw new ExperienceNotFoundException('Experiência não encontrada');
        }

        return $this->experienceMapper->fromArray($experienceArray);

    }

    public function findByAlbum(int $albumId) : array {
    
        $stmt = $this->pdo->prepare("SELECT * FROM experiences WHERE album_id = :album_id");
        $stmt->execute(['album_id' => $albumId]);

        $experiences = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(
            fn ($experience) => $this->experienceMapper->fromArray($experience),
            $experiences
        );

    }

    public function findWithAlbum(int $id) : ExperienceAlbum {
        $stmt = $this->pdo->prepare("
            SELECT
                e.id       AS experience_id,
                e.album_id AS experience_album_id,
                e.title    AS experience_title,
                e.mood     AS experience_mood,
                e.stars    AS experience_stars,
                e.desc     AS experience_desc,

                a.id       AS album_id,
                a.name     AS album_name,
                a.duration AS album_duration,
                a.desc     AS album_desc,
                a.artist   AS album_artist,
                a.genre    AS album_genre

            FROM experiences e

            INNER JOIN albums a
                ON a.id = e.album_id

            WHERE e.id = :id
        ");

        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data === false) {
            throw new ExperienceNotFoundException('Experiência não encontrada');
        }

        return $this->experienceMapper->fromJoinedArray($data);
    }

    public function update(Experience $data) : Experience {

        $experienceArray = $this->experienceMapper->toAray($data);
        
        $stmt = $this->pdo->prepare("
            UPDATE experiences
            SET album_id = :album_id, title = :title, mood = :mood, stars = :stars, desc = :desc
            WHERE id = :id;
        ");
        $stmt->execute($experienceArray);
        
        return $data;

    }

    public function destroy(int $id) : int {
        
        $stmt = $this->pdo->query("DELETE FROM experiences WHERE id = :id;");
        $stmt->execute(['id' => $id]);

        if ($stmt->rowCount() === 0) {
            throw new ExperienceNotFoundException('Experiência não encontrada');
        }

        return $id;

    }

}