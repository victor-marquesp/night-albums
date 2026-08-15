<?php

namespace App\Bootstrap;

use App\Data\DatabaseConnection;

use App\Data\Repositories\ExperienceMemoryRepository;
use App\Data\Repositories\AlbumMemoryRepository;

use App\Domain\Services\ExperienceService;
use App\Domain\Services\AlbumService;

use App\Presentation\Controllers\ExperienceController;
use App\Presentation\Controllers\AlbumController;

use App\Navigation\ScreenFactory;
use App\Navigation\RouteNames;
use App\Navigation\Router;

class Application {

    public function run() : void{

        $this->build();
        Router::init(RouteNames::MAIN_MENU);

    }

    private function build() : void {

        // Seta a conexão com o Banco de Dados

        $databaseConnection = new DatabaseConnection();

        // Instancia as dependências

        // Repositórios
        $experienceRepository = new ExperienceMemoryRepository();
        $albumRepository = new AlbumMemoryRepository();

        // Services
        $experienceService = new ExperienceService(
            experienceRep: $experienceRepository,
            albumRep: $albumRepository
        );
        $albumService = new AlbumService($albumRepository);

        // Controllers
        $experienceController = new ExperienceController($experienceService);
        $albumController = new AlbumController($albumService);

        // Seta o Router

        $screenFactory = new ScreenFactory(
            albumController: $albumController, 
            experienceController: $experienceController
        );

        Router::setFactory($screenFactory);

    }

}
