<?php

namespace App\Data\Repositories\Contracts;

use App\Domain\Models\Experience;
use App\Shared\DTO\ExperienceAlbum;
use App\Shared\DTO\ExperiencePersistedData;
use App\Shared\DTO\NewExperienceData;

interface IExperienceRepository {

    public function save(NewExperienceData $data) : ExperiencePersistedData;
    
    public function findAll() : array;

    public function findById(int $id) : Experience;

    public function findByAlbum(int $albumId) : array;

    public function findWithAlbum(int $id) : ExperienceAlbum;

    public function update(Experience $data) : Experience;

    public function destroy(int $id) : int;
}