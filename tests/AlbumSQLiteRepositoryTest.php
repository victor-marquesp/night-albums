<?php

namespace Tests;

use App\Data\Repositories\AlbumSQLiteRepository;
use App\Domain\Models\Album;
use Faker\Generator;

class AlbumSQLiteRepositoryTest {

    public function __construct(
        private AlbumSQLiteRepository $albumSQLiteRepository,
        private Generator $faker
    ) {}

    public function test_findById() {

        $result = $this->albumSQLiteRepository->findById(20);

        print_r($result);

    }

    public function test_findAll() {
        $result = $this->albumSQLiteRepository->findAll();

        print_r($result);
    }

    public function test_save() {

        for ($i = 0; $i <= 10; $i++) {

            $this->albumSQLiteRepository->save(
                new Album(
                        id: $this->faker->randomDigit(),
                        name: $this->faker->word(),
                        duration: $this->faker->randomNumber()
                    )
            );

        }
    }

    public function test_update() {

        $albums = $this->albumSQLiteRepository->findAll();
        $last = array_last($albums);

        $data = new Album(
            id: $last->getId(),
            name: 'teste_update',
            duration: 30
        );

        $this->albumSQLiteRepository->update($data);

    }

    public function test_destroy() {

        $albums = $this->albumSQLiteRepository->findAll();

        $last = array_last($albums)->getId();

        for($i = 0; $i <= 10; $i++, $last--) {

            $this->albumSQLiteRepository->destroy($last);

        }

    }

}