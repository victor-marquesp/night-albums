<?php

namespace App\Presentation\Screens\Experience;

use App\Presentation\Screens\Abstracts\Screen;
use App\Presentation\Controllers\ExperienceController;
use App\Presentation\Views\Experience\ExperienceView;
use App\Presentation\Views\FeedbackView;

use App\Domain\Models\Experience;
use App\Domain\Models\Album;

use App\Navigation\Router;
use App\Navigation\RouteNames;

class ExperienceScreen extends Screen {

    private Experience $experience;
    private Album $album;

    public function __construct(
            private ExperienceController $experienceController,
            private int $experienceId
        ) {}

    public function load() : bool {

        $result = $this->experienceController->listWithAlbum($this->experienceId);

        if(!$this->handle($result)) {
            Router::goBack();
            return false;
        }

        $this->experience = $result->data->experience;
        $this->album = $result->data->album;
        return true;
    }

    public function render() : void {
        
        $option = ExperienceView::read($this->experience, $this->album);
        $this->triggerOption($option);

    }

    private function triggerOption(int $option) : void {

        switch($option) {

            case 1:
                Router::goTo(RouteNames::ALBUM, $this->experience->getAlbumId());
                break;

            case 2:
                Router::goTo(RouteNames::EXPERIENCE_EDIT, $this->experience->getId());
                break;

            case 3:
                $this->triggerAction($this->experience->getId());
                break;

            case 0:
                Router::goBack();
                break;

            default:
                FeedbackView::failure('Opção Inválida');
                break;
        }
    }

    private function triggerAction(int $id) : void {

        if(!FeedbackView::confirm('Confirmar deleção?')) {
            return;
        }
            
        $result = $this->experienceController->delete($id);

        if(!$this->handle($result)) {
            Router::goBack();
            return;
        }

        FeedbackView::success('Experiência deletada');
        Router::goBack();
    }

}
