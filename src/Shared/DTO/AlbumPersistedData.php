<?php

namespace App\Shared\DTO;

readonly class AlbumPersistedData {

    public function __construct(
        public int $id,
        public string $name,
        public int $duration,
        public ?string $desc,
        public ?string $artist,
        public ?string $genre
    ) {}

}