<?php

namespace App\Presentation\Views\Experience;

use App\Presentation\CLI\Output;
use App\Presentation\CLI\Input;

use App\Shared\DTO\ExperienceFormData;

final class ExperienceFormView {

    private function __construct() {}

    static public function readNew() {
        
        Output::title();
        Output::header('Nova Experiência');

        $title = Input::word('Dê um título à sua experiência > ');
        $mood = Input::word('Se você pudesse descrever esse Álbum em  uma palavra... qual seria > ');
        $stars = Input::decimal('Quantas estrelas você dá para esse Álbum (0 - 5) > ');
        $desc = Input::text('Descreva sua experiência com esse Álbum (opcional) > ');

        return new ExperienceFormData(
            title: $title,
            mood: $mood,
            stars: $stars,
            desc: $desc 
        );

    }

    static public function readOld(ExperienceFormData $data) {
        
        Output::title();
        Output::header('Editar');

        $title = Input::word(
            'Dê um título à sua experiência (' 
            . $data->title .') > ',
            default: $data->title
        );
        
        $mood = Input::word(
            'Se você pudesse descrever esse Álbum em  uma palavra... qual seria (' 
            . $data->mood .') > ',
            default: $data->mood
        );

        $stars = Input::decimal(
            display: 'Quantas estrelas você dá para esse Álbum (0 - 5) ('
            . $data->stars .') > ',
            default: $data->stars,
        );

        $desc = Input::text(
            display: 'Descreva sua experiência com esse Álbum (opcional) ('
            . $data->desc .') > ',
            default: $data->desc,
            hasPassed: true
        );

        return new ExperienceFormData(
            title: $title,
            mood: $mood,
            stars: $stars,
            desc: $desc 
        );
    }

}
