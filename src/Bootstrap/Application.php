<?php

namespace App\Bootstrap;


use App\Data\Repositories\ExperienceMemoryRepository;
use App\Data\Repositories\AlbumMemoryRepository;

use App\Domain\Services\ExperienceService;
use App\Domain\Services\AlbumService;

use App\Presentation\Controllers\ExperienceController;
use App\Presentation\Controllers\AlbumController;

use App\Navigation\ScreenFactory;
use App\Navigation\RouteNames;
use App\Navigation\Router;

use App\Shared\DTO\NewAlbumData;
use App\Shared\DTO\NewExperienceData;

class Application {

    public function run() : void{

        $this->build();
        Router::init(RouteNames::MAIN_MENU);

    }

    private function build() : void {

        // Instancia as dependências as dependências

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

        $this->populate($albumService, $experienceService);

    }

    private function populate($albumService, $experienceService) {


        $albumService->create(new NewAlbumData(
                name: 'The Bends',
                duration: 50,
                desc: 'One of the best of them',
                artist: 'Radiohead',
                genre: 'Alternative Rock'
            )
        );

        $albumService->create(new NewAlbumData(
                name: 'Thriller',
                duration: 60,
                desc: 'Zombies',
                artist: 'Michael Jackson',
                genre: 'Pop'
            )
        );

        $albumService->create(new NewAlbumData(
                name: 'Rust In... Polaris',
                duration: 43,
                artist: 'Megadeth',
                genre: 'Trash Metal'
            )
        );

        $albumService->create(new NewAlbumData(
                name: 'Divino',
                duration: 67,
                artist: 'Venere Vai Venus',
                genre: 'Rock'
            )
        );

        $experienceService->create(new NewExperienceData(
                albumId: 0,
                mood: 'spacefull',
                stars: 5,
                desc: 'It sounds like space',
            )
        );

        $experienceService->create(new NewExperienceData(
                albumId: 1,
                mood: 'assustador',
                stars: 5,
            )
        );

        $experienceService->create(new NewExperienceData(
                albumId: 2,
                mood: 'aggressive',
                stars: 5,
            )
        );

        $experienceService->create(new NewExperienceData(
                albumId: 3,
                mood: 'beautifull',
                stars: 4,
                desc: 'actually didnt listen yet',
            )
        );
    }

}
