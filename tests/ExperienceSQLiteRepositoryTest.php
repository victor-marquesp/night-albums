<?php

namespace Tests;

use PDO;
use PHPUnit\Framework\TestCase;

use App\Data\Repositories\ExperienceSQLiteRepository;
use App\Domain\Mappers\ExperienceMapper;
use App\Domain\Models\Experience;
use App\Shared\DTO\NewExperienceData;
use App\Shared\DTO\ExperiencePersistedData;

class ExperienceSQLiteRepositoryTest extends TestCase {

    private PDO $db;
    private ExperienceSQLiteRepository $repository;
    private ExperienceMapper $mapper;

    protected function setUp() : void {
        $this->db = new PDO('sqlite::memory:');

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $schema = file_get_contents('./database/schema.sql');
        $seed = file_get_contents('./database/seed.sql');

        $this->db->exec($schema);
        $this->db->exec($seed);

        $this->mapper = new ExperienceMapper();

        $this->repository = new ExperienceSQLiteRepository(pdo: $this->db, experienceMapper: $this->mapper);
    }

    public function testCanCreateWithValidData() : void {

        $data = new NewExperienceData(
            albumId: 5,
            title: 'teste',
            mood: 'teste',
            stars: 5
        );
        
        $persistedData = $this->repository->save($data);

        $this->assertInstanceOf(ExperiencePersistedData::class, $persistedData);

        $this->assertGreaterThan(0, $persistedData->id);

        $this->assertSame($data->albumId, $persistedData->albumId);
        $this->assertSame($data->mood, $persistedData->mood);
        $this->assertSame($data->stars, $persistedData->stars);
        $this->assertSame($data->desc, $persistedData->desc);

    }

    public function testCanFindAll() : void {

        $stmt = $this->db->query('SELECT COUNT(*) FROM experiences');
        $databaseCount = (int) $stmt->fetchColumn();

        $experiences = $this->repository->findAll();

        $this->assertCount($databaseCount, $experiences);

        foreach ($experiences as $experience) {
            $this->assertInstanceOf(Experience::class, $experience);
            $this->assertGreaterThan(0, $experience->getId());
        }
    }

    public function testCanFindById() : void {

        $stmt = $this->db->query('SELECT * FROM experiences ORDER BY id DESC LIMIT 1');
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $experience = $this->mapper->fromArray($data);

        $fetchData = $this->repository->findById((int) $data['id']);

        $this->assertInstanceOf(Experience::class, $fetchData);

        $this->assertEquals($experience, $fetchData);
    }

    public function testCanFindByAlbum() : void {

        $stmt = $this->db->query('SELECT COUNT(*) FROM experiences WHERE album_id = 1');
        $databaseCount = (int) $stmt->fetchColumn();

        $experiences = $this->repository->findByAlbum(1);

        $this->assertCount($databaseCount, $experiences);

        foreach ($experiences as $experience) {
            $this->assertInstanceOf(Experience::class, $experience);
            $this->assertGreaterThan(0, $experience->getId());
        }
    }

    public function testCanUpdate() : void {

        $stmt = $this->db->query('SELECT * FROM experiences ORDER BY id LIMIT 1');
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $experience = new Experience(
            id: (int) $data['id'],
            title: 'teste',
            albumId: (int) $data['album_id'],
            mood: 'teste mood',
            stars: 2,
            desc: 'teste update'
        );

        $updatedExperience = $this->repository->update($experience);

        $this->assertInstanceOf(Experience::class, $updatedExperience);

        $this->assertEquals($experience, $updatedExperience);

        // Verifica persistência
        $persistedExperience = $this->repository->findById($experience->getId());
        $this->assertEquals($experience, $persistedExperience);

    }

    public function testCanDestroy() : void {

        $stmt = $this->db->query('SELECT id FROM experiences ORDER BY id LIMIT 1');
        $id = (int) $stmt->fetchColumn();

        $destroyedId = $this->repository->destroy($id);

        $this->assertSame($id, $destroyedId);

        $stmt = $this->db->prepare('SELECT COUNT(*) FROM experiences WHERE id = :id');

        $stmt->execute(['id' => $id]);
        $count = (int) $stmt->fetchColumn();

        $this->assertSame(0, $count);
    }
}