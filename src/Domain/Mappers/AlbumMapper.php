<?php

namespace App\Domain\Mappers;

use App\Domain\Models\Album;

use App\Shared\DTO\NewAlbumData;

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

    public function toInsertParams(NewAlbumData $data) : array {

        return [
            'name' => $data->name,
            'duration' => $data->duration,
            'desc' => $data->desc,
            'artist' => $data->artist,
            'genre' => $data->genre
        ];

    }

}