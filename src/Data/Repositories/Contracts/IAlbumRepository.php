<?php

namespace App\Data\Repositories\Contracts;

use App\Shared\DTO\NewAlbumData;
use App\Shared\DTO\AlbumPersistedData;

use App\Domain\Models\Album;

interface IAlbumRepository {

    public function save(NewAlbumData $album) : AlbumPersistedData;

    public function findAll() : array;

    public function findById(int $id) : Album;

    public function update(Album $album) : Album;

    public function destroy(int $id) : int;
}
