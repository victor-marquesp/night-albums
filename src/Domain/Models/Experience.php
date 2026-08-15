<?php

namespace App\Domain\Models;

use App\Domain\Models\Album;

use App\Shared\Exceptions\InvalidExperienceDataException;

class Experience {
    private readonly int $id;
    private readonly Album $album;

    private string $mood;
    private float $stars;
    
    private ?string $desc;

    public function __construct(
        int $id, 
        Album $album, 
        string $mood, 
        float $stars, 
        ?string $desc = null) {
        
        $this->setId($id);
        $this->setAlbum($album);
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

    private function setAlbum(Album $album) : void {
        $this->album = $album;
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
     
    public function getAlbum() : Album {
        return $this->album;
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

