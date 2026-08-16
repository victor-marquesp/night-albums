<?php

namespace App\Shared\DTO;

use App\Domain\Models\Experience;
use App\Domain\Models\Album;
use App\Shared\Exceptions\NotRelatedException;

readonly class ExperienceAlbum {

    public function __construct(
        public Experience $experience,
        public Album $album
    ) {
        $this->checkRelationship();
    }

    private function checkRelationship() : void {
        if($this->experience->getAlbumId() !== $this->album->getId()) {
            throw new NotRelatedException('Álbum não relacionado à Experiência');
        }
    }
}