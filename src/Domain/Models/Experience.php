<?php

namespace App\Domain\Models;

use App\Shared\Exceptions\InvalidExperienceDataException;

class Experience {
    private readonly int $id;
    private readonly int $albumId;

    private string $title;
    private string $mood;
    private float $stars;
    
    private ?string $desc;

    public function __construct(
        int $id, 
        int $albumId, 
        string $title,
        string $mood, 
        float $stars, 
        ?string $desc = null) {
        
        $this->setTitle($title);
        $this->setId($id);
        $this->setAlbumId($albumId);
        $this->setDesc($desc);
        $this->setMood($mood);  
        $this->setStars($stars);
        
    }

    // ===========================================================================================================
    // GETTERS E SETTERS
    // ===========================================================================================================  

    private function setId(int $id) : void {
        $this->id = $id;
    }

    private function setAlbumId(int $albumId) : void {
        $this->albumId = $albumId;
    }

    private  function setTitle(string $title) : void {
        if(mb_strlen($title) > 120 ) {
            throw new InvalidExperienceDataException("Palavra Muito Grande (Mood de Experience)");
        }

        $this->title = $title;
    }

    private function setMood(string $mood) : void {
        if(mb_strlen($mood) > 120 ) {
            throw new InvalidExperienceDataException("Palavra Muito Grande (Mood de Experience)");
        }

        $this->mood = $mood;
    }

    private function setStars(float $stars) : void {
        if($stars < 0 || $stars > 5) {
            throw new InvalidExperienceDataException("Estrelas devem estar no intervalo de 0 - 5");
        }

        $this->stars = $stars;
    }

    private function setDesc(?string $desc) : void {

        if($desc != null && mb_strlen($desc) > 10000) {
            throw new InvalidExperienceDataException('Descrição desmasiada longa');
        }

        $this->desc = $desc;
    }

    public function getId() : int {
        return $this->id;
    }   
     
    public function getAlbumId() : int {
        return $this->albumId;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getMood() : string {
        return $this->mood;
    }

    public function getStars() : float {
        return $this->stars;
    }

    public function getDesc() : ?string {
        return $this->desc;
    }
}

