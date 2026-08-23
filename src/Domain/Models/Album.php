<?php

namespace App\Domain\Models;

use App\Shared\Exceptions\InvalidAlbumDataException;

class Album {
    
    private readonly ?int $id;      // Nulo pois o ID é gerado pela persistência (SQLite)

    private string $name;
    private int $duration;
    
    private ?string $desc;
    private ?string $artist;
    private ?string $genre;

    public function __construct(
        ?int $id,
        string $name, 
        int $duration,
        ?string $desc = null, 
        ?string $artist = null, 
        ?string $genre = null) {

        if($id !== null) {
            $this->setId($id);
        }

        $this->setName($name);
        $this->setDesc($desc);
        $this->setArtist($artist);
        $this->setGenre($genre);
        $this->setDuration($duration);

    }

    // ===========================================================================================================
    // GETTERS E SETTERS
    // ===========================================================================================================    

    public function setId(int $id) : void {
        $this->id = $id;
    }

    private function setName(string $name) {

        if(trim($name) === '') {
            throw new InvalidAlbumDataException("Nome de Álbum Nulo");
        }

        if(mb_strlen($name) > 120) {
            throw new InvalidAlbumDataException("Nome de Álbum Excepcionalmente Grande");
        }

        $this->name = $name;
    }

    private function setDuration(int $duration) {

        if($duration <= 0) {
            throw new InvalidAlbumDataException("Duração deve ser Positiva");
        }

        $this->duration = $duration;
        return true;
    }

    private function setDesc(?string $desc) {

        if($desc != null && mb_strlen($desc) > 1000) {
            throw new InvalidAlbumDataException("Descrição Desnecessáriamente Longa");
        }

        $this->desc = $desc;

        return true;
    }

    private function setArtist(?string $artist) {

        if($artist != null && mb_strlen($artist) > 120) {
            throw new InvalidAlbumDataException("Nome de Artista Muito Longo");
        }
         
        $this->artist = $artist;
        return true;
    }

    private function setGenre(?string $genre) {

        if($genre != null && mb_strlen($genre) > 120) {
            throw new InvalidAlbumDataException("Nome de Genêro Muito Longo");
        }

        $this->genre = $genre;
        return true;
    }

    public function getId() : int {
        return $this->id;
    }

    public function getName() : string {
        return $this->name;
    }   

    public function getDuration() : int {
        return $this->duration;
    } 

    public function getDesc() : ?string {
        return $this->desc;
    }   

    public function getArtist() : ?string {
        return $this->artist;
    }   

    public function getGenre() : ?string {
        return $this->genre;
    }   
      
}