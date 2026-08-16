<?php

namespace App\Shared\DTO;

class ExperiencePersistedData {
    public function __construct(
        public readonly int $id,
        public readonly int $albumId,
        public readonly string $title,
        public readonly string $mood,
        public readonly float $stars,
        public readonly ?string $desc = null
    ) {}
}
