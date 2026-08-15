<?php

namespace App\Domain\Mappers;

use App\Domain\Models\Album;

class AlbumMapper {

    public function toArray(Album $album) : array {

        return [
            'id' => $album->getId(),
            'name' => $album->getName(),
            'duration' => $album->getDuration(),
            'desc' => $album->getDesc(),
            'artist' => $album->getArtist(),
            'genre' => $album->getGenre()
        ];

    }

    public function fromArray(array $data) : Album {

        return new Album(
            id: $data['id'],
            name: $data['name'],
            duration: $data['duration'],
            desc: $data['desc'] ?? null,
            artist: $data['artist'] ?? null,
            genre: $data['genre'] ?? null
        );

    }

}