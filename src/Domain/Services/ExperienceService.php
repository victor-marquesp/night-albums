<?php

namespace App\Domain\Services;

use App\Domain\Models\Experience;
use App\Shared\DTO\NewExperienceData;
use App\Data\Repositories\Contracts\IExperienceRepository;
use App\Shared\DTO\ExperienceAlbum;

final class ExperienceService {

    public function __construct(
        private IExperienceRepository $experienceRep, 
    ) {}

    public function create(NewExperienceData $data) : Experience {

        $experience = new Experience(
            id: null,
            albumId: $data->albumId,
            title: $data->title,
            mood: $data->mood,
            stars: $data->stars,
            desc: $data->desc
        );

        $persisted = $this->experienceRep->save($data);

        $experience->setId($persisted->id);

        return $experience;
    }

    public function listAll(): array {
        
        return $this->experienceRep->findAll();

    }   

    public function listById(int $id) : Experience {

        return $this->experienceRep->findById($id);

    }

    public function listByAlbum(int $albumId) {

        return $this->experienceRep->findByAlbum($albumId);

    }   

    public function listWithAlbum(int $id) : ExperienceAlbum {
        return $this->experienceRep->findWithAlbum($id);
    }

    public function edit(Experience $experience) : Experience {

        $this->experienceRep->findById($experience->getId());

        return $this->experienceRep->update($experience);
    }

    public function delete(int $id) : int {
        $this->experienceRep->destroy($id);

        return $id;
    }

}
