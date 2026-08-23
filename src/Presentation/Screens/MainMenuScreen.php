<?php

namespace App\Presentation\Screens;

use App\Presentation\Screens\Abstracts\Screen;
use App\Presentation\Views\MainMenuView;
use App\Presentation\Views\FeedbackView;

use App\Navigation\Router;
use App\Navigation\RouteNames;

class MainMenuScreen extends Screen {

    public function __construct() {}

    public function render() : void {

        $option = MainMenuView::read();
        $this->triggerOption($option);

    }

    protected function triggerOption(int $option) : void {

        switch($option) {

            case 1:
                Router::goTo(RouteNames::ALBUM_LIST);
                break;

            case 2:
                Router::goTo(RouteNames::EXPERIENCE_LIST);
                break;

            case 0:
                FeedbackView::exit();
                Router::goBack();
                break;

            default:
                FeedbackView::failure('Opção Inválida');
                break;
        }
    }
}
