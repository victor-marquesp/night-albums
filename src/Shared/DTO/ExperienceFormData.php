<?php

namespace App\Shared\DTO;

class ExperienceFormData {

    public function __construct(
        public readonly string $title,
        public readonly string $mood,
        public readonly float $stars,
        public readonly ?string $desc
    ) {}

}