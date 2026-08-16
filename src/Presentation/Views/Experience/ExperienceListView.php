<?php

namespace App\Presentation\Views\Experience;

use App\Presentation\CLI\Output;
use App\Presentation\CLI\Render;
use App\Presentation\CLI\Input;

use App\Domain\Models\Experience;

use App\Shared\DTO\ListScreenData;

final class ExperienceListView {

    private function __construct() {}

    static public function read(array $experiences) : ListScreenData {
        
        Output::title();
        Output::header('Suas Experiências');

        if (empty($experiences)) {

            Output::empty('Sem Experiências');
            $menu = [
                0 => 'Voltar'
            ];

        } else {

            Render::list(
                $experiences,
                fn (Experience $e) =>
                    $e->getTitle()
                    . ' | '
                    . substr($e->getDesc(), 0, 20) . '...'
                    . ' | '
                    . $e->getMood()
            );

            $menu = [
                1 => 'Ver Experiência',
                0 => 'Voltar'
            ];
        }

        Output::separator();
        Render::menu($menu);
        Output::separator();

        $option = Input::number('> ');
        $experienceId = 0;

        if ($option == 1) {
            $experienceId = Input::number('Selecione a Experiência (ID) > ');
        }

        return new ListScreenData(option: $option, id: $experienceId);
    }

}
