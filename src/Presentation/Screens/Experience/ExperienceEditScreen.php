<?php

namespace App\Presentation\Screens\Experience;

use App\Navigation\Router;

use App\Domain\Models\Experience;

use App\Presentation\Screens\Abstracts\Screen;
use App\Presentation\Controllers\ExperienceController;
use App\Presentation\Views\Experience\ExperienceFormView;
use App\Presentation\Views\FeedbackView;

use App\Shared\DTO\ExperienceFormData;

class ExperienceEditScreen extends Screen {

    private Experience $experience;

    public function __construct(
            private ExperienceController $experienceController,
            private int $experienceId
        ) {}

    public function load() : bool {

        $result = $this->experienceController->listById($this->experienceId);

        if(!$this->handle($result)) {
            Router::goBack();
            return false;
        }

        $this->experience = $result->data;
        return true;

    }

    public function render() : void {

        $data = new ExperienceFormData(
            title: $this->experience->getTitle(),
            mood: $this->experience->getMood(),
            stars: $this->experience->getStars(),
            desc: $this->experience->getDesc(),
        );
        
        $form = ExperienceFormView::readOld($data);
        $this->triggerAction($form);

    }

    protected function triggerAction(ExperienceFormData $form) : void {

        $experienceData = new Experience(
            id: $this->experience->getId(),
            albumId: $this->experience->getAlbumId(),
            title: $form->title,
            mood: $form->mood,
            stars: $form->stars,
            desc: $form->desc,
        );
        
        $result = $this->experienceController->edit($experienceData);

        if(!$this->handle($result)) {
            Router::goBack();
            return;
        }

        FeedbackView::success('Experiência atualizada');
        Router::goBack();
    }

}
