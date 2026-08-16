<?php

namespace App\Domain\Mappers;

use App\Domain\Models\Album;
use App\Domain\Models\Experience;
use App\Shared\DTO\ExperienceAlbum;
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

    public function fromJoinedArray(array $data) : ExperienceAlbum {

        return new ExperienceAlbum(

            experience: new Experience(
                id: $data['experience_id'],
                albumId: $data['experience_album_id'],
                title: $data['experience_title'],
                mood: $data['experience_mood'],
                stars: $data['experience_stars'],
                desc: $data['experience_desc']
            ),

            album: new Album(
                id: $data['album_id'],
                name: $data['album_name'],
                duration: $data['album_duration'],
                desc: $data['album_desc'],
                artist: $data['album_artist'],
                genre: $data['album_genre']
            )
        );

    }
 
}