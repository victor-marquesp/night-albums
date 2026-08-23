<?php

namespace App\Domain\Services;

use App\Shared\DTO\NewAlbumData;
use App\Domain\Models\Album;

use App\Data\Repositories\Contracts\IAlbumRepository;

final class AlbumService {

    public function __construct(private IAlbumRepository $albumRep) {}

    public function create(NewAlbumData $data) : Album {
        
        $album = new Album(
            id: null,
            name: $data->name,
            duration: $data->duration,
            desc: $data->desc,
            artist: $data->artist,
            genre: $data->genre
        );

        $persisted = $this->albumRep->save($data);

        $album->setId($persisted->id);

        return $album;
    }

    public function listAll(): array {

        return $this->albumRep->findAll();

    }   

    public function listById(int $id) : Album {

        return $this->albumRep->findById($id);

    }

    public function edit(Album $album) : Album {

        $this->albumRep->findById($album->getId());     // Verifica se álbum existe

        return $this->albumRep->update($album);
        
    }

    public function delete(int $id) : int {

        return $this->albumRep->destroy($id);

    }

}
