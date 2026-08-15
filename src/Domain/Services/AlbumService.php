<?php

namespace App\Domain\Services;

use App\Shared\DTO\NewAlbumData;
use App\Domain\Models\Album;

use App\Data\Repositories\Contracts\IAlbumRepository;

final class AlbumService {

    public function __construct(private IAlbumRepository $albumRep) {}

    public function create(NewAlbumData $data) : Album {

        $persisted = $this->albumRep->save($data);
        
        return new Album(
            id: $persisted->id,
            name: $persisted->name,
            duration: $persisted->duration,
            desc: $persisted->desc,
            artist: $persisted->artist,
            genre: $persisted->genre
        );
    }

    public function listAll(): array {

        return $this->albumRep->findAll();

    }   

    public function listById(int $id) : Album {

        return $this->albumRep->findById($id);

    }

    public function edit(Album $album) : Album {

        return $this->albumRep->update($album);
        
    }

    public function delete(int $id) : int {

        return $this->albumRep->destroy($id);

    }

}
