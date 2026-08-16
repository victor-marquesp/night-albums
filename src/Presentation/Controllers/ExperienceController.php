<?php

namespace App\Presentation\Controllers;

use App\Domain\Services\ExperienceService;
use App\Shared\DTO\NewExperienceData;
use App\Shared\DTO\ExperienceAlbum;
use App\Domain\Models\Experience;

use App\Shared\Results\Result;
use App\Shared\Results\Success;
use App\Shared\Results\Failure;

use Exception;

class ExperienceController {

    public function __construct(
        private ExperienceService $expService
    ) {}

    public function create(NewExperienceData $expData) : Result {
        try {

            $data = $this->expService->create($expData);
            return new Success(
                data: $data,
                message: 'Experiência criada'
            );

        } catch(Exception $e) {
            return new Failure($e->getMessage());
        }
    }

    public function listAll() : Result {
        try{
            $data = $this->expService->listAll();
            return new Success(
                data: $data,
                message: 'Todas as Experiências retornadas'
            );

        } catch(Exception $e) {
            return new Failure($e->getMessage());
        }
    }

    public function listById(int $id) : Result {
        try {
            $data = $this->expService->listById($id);
            return new Success(
                data: $data,
                message: 'Experiência encontrada'
            );

        } catch(Exception $e) {
            return new Failure($e->getMessage());
        }
    }

    public function listByAlbum(int $albumId) : Result {
        try {
            $data = $this->expService->listByAlbum($albumId);
            return new Success(
                data: $data,
                message: 'Experiências do Álbum encontradas'
            );

        } catch(Exception $e) {
            return new Failure($e->getMessage());
        }
    }

    public function listWithAlbum(int $id) : Result {

        try {
            $data = $this->expService->listWithAlbum($id);
            return new Success(
                data: $data,
                message: 'Experiência e Álbum encontrados'
            );

        } catch(Exception $e) {
            return new Failure($e->getMessage());
        }

    }

    public function edit(Experience $experience) : Result {
        try {
            $data = $this->expService->edit($experience);
            return new Success(
                data: $data,
                message: 'Experiência atualizada'
            );

        } catch(Exception $e) { 
            return new Failure($e->getMessage()); 
        }
    }

    public function delete(int $id) : Result {
        try {
            $data = $this->expService->delete($id);
            return new Success(
                data: $data,
                message: 'Experiência deletada'
            );

        } catch(Exception $e) { 
            return new Failure($e->getMessage());
        }
    }
}