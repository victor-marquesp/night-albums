<?php

namespace Tests;

use App\Data\DatabaseConnection;

use App\Domain\Mappers\AlbumMapper;
use App\Data\Repositories\AlbumSQLiteRepository;

use Tests\AlbumSQLiteRepositoryTest;

use Faker\Factory;

function runTest() {

    $faker = Factory::create();

    $connection = new DatabaseConnection();

    $albumMapper = new AlbumMapper();
    $albumSQLiteRepository = new AlbumSQLiteRepository($connection->getConnection(), $albumMapper);

    $albumSQLiteRepositoryTest = new AlbumSQLiteRepositoryTest($albumSQLiteRepository,  $faker);

    $albumSQLiteRepositoryTest->test_findAll();

    exit(0);

}

