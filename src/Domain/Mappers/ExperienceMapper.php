<?php

namespace App\Domain\Mappers;

use App\Domain\Models\Experience;
use App\Shared\DTO\NewExperienceData;

class ExperienceMapper {

    public function toAray(Experience $experience) : array {

        return [
          'id' => $experience->getId(),
          'album_id' => $experience->getAlbumId(),
          'title' => $experience->getTitle(),
          'mood' => $experience->getMood(),
          'stars' => $experience->getStars(),
          'desc' => $experience->getDesc()  
        ];

    }

    public function fromArray(array $data) : Experience {

        return new Experience(
            id: $data['id'],
            albumId: $data['album_id'],
            title: $data['title'],
            mood: $data['mood'],
            stars: $data['stars'],
            desc: $data['desc'] ?? null
        );

    }

    public function toInsertParams(NewExperienceData $data) : array {

        return [
          'album_id' => $data->albumId,
          'title' => $data->title,
          'mood' => $data->mood,
          'stars' => $data->stars,
          'desc' => $data->desc  
        ];

    }
 
}