<?php

namespace App\Presentation\Views\Album;

use App\Presentation\CLI\Output;
use App\Presentation\CLI\Render;
use App\Presentation\CLI\Input;

use App\Domain\Models\Album;

use App\Shared\DTO\ListScreenData;

final class AlbumListView {

    private function __construct() {}

    static public function read(array $albums) : ListScreenData {
        
        Output::title();
        Output::header('Álbuns');

        if (empty($albums)) {

            Output::empty('Sem Álbuns');
            $menu = [
                0 => 'Voltar'
            ];

        } else {

            $array = [];
            foreach($albums as $album) {
                $array[$album->getId()] = $album; 
            }

            Render::list(
                $array,
                fn (Album $a) => $a->getName()
            );

            $menu = [
                1 => 'Ver Álbum',
                0 => 'Voltar'
            ];
        }

        Output::separator();
        Render::menu($menu);
        Output::separator();

        $option = Input::number('> ');
        $albumId = 0;

        if ($option == 1) {
            $albumId = Input::number('Selecione o Álbum (ID) > ');
        }

        return new ListScreenData(option: $option, id: $albumId);
    }

}
