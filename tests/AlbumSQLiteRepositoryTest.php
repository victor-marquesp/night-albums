<?php

namespace Tests;

use PDO;
use PHPUnit\Framework\TestCase;

use App\Data\Repositories\AlbumSQLiteRepository;
use App\Domain\Mappers\AlbumMapper;
use App\Domain\Models\Album;
use App\Shared\DTO\NewAlbumData;
use App\Shared\DTO\AlbumPersistedData;

class AlbumSQLiteRepositoryTest extends TestCase
{
    private PDO $db;
    private AlbumSQLiteRepository $repository;
    private AlbumMapper $mapper;

    protected function setUp(): void
    {
        $this->db = new PDO('sqlite::memory:');

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $schema = file_get_contents('./database/schema.sql');
        $seed = file_get_contents('./database/seed.sql');

        $this->db->exec($schema);
        $this->db->exec($seed);

        $this->mapper = new AlbumMapper();

        $this->repository = new AlbumSQLiteRepository(pdo: $this->db, albumMapper: $this->mapper);
    }

    public function testCanCreateWithValidData(): void
    {

        $data = new NewAlbumData(
            name: 'PHPUnit Album',
            duration: 35
        );

        $persistedData = $this->repository->save($data);

        $this->assertInstanceOf(AlbumPersistedData::class, $persistedData);

        $this->assertGreaterThan(0, $persistedData->id);

        $this->assertSame($data->name, $persistedData->name);
        $this->assertSame($data->duration, $persistedData->duration);
        $this->assertSame($data->desc,$persistedData->desc);
        $this->assertSame($data->artist, $persistedData->artist);

        $this->assertSame($data->genre, $persistedData->genre);
    }

    public function testCanFindAll(): void
    {
        $stmt = $this->db->query('SELECT COUNT(*) FROM albums');
        $databaseCount = (int) $stmt->fetchColumn();

        $albums = $this->repository->findAll();

        $this->assertCount($databaseCount, $albums);

        foreach ($albums as $album) {
            $this->assertInstanceOf(Album::class, $album);
            $this->assertGreaterThan(0, $album->getId());
        }
    }

    public function testCanFindById(): void
    {

        $stmt = $this->db->query('SELECT * FROM albums ORDER BY id DESC LIMIT 1');
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $album = $this->mapper->fromArray($data);

        $fetchData = $this->repository->findById((int) $data['id']);

        $this->assertInstanceOf(Album::class, $fetchData);

        $this->assertEquals($album, $fetchData);
    }

    public function testCanUpdate(): void
    {

        $stmt = $this->db->query('SELECT * FROM albums ORDER BY id LIMIT 1');
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $album = new Album(
            id: (int) $data['id'],
            name: 'Updated Album',
            duration: 42,
            desc: 'Updated description',
            artist: 'Updated Artist',
            genre: 'Updated Genre'
        );

        $updatedAlbum = $this->repository->update($album);

        $this->assertInstanceOf(Album::class, $updatedAlbum);

        $this->assertSame($album->getId(), $updatedAlbum->getId());

        $this->assertSame($album->getName(), $updatedAlbum->getName());

        // Verifica persistência
        $persistedAlbum = $this->repository->findById($album->getId());
        $this->assertSame('Updated Album', $persistedAlbum->getName());
        $this->assertSame(42, $persistedAlbum->getDuration());
        $this->assertSame('Updated description', $persistedAlbum->getDesc());
        $this->assertSame('Updated Artist', $persistedAlbum->getArtist());
        $this->assertSame('Updated Genre', $persistedAlbum->getGenre());
    }

    public function testCanDestroy(): void
    {

        $stmt = $this->db->query('SELECT id FROM albums ORDER BY id LIMIT 1');
        $id = (int) $stmt->fetchColumn();

        $destroyedId = $this->repository->destroy($id);

        $this->assertSame($id, $destroyedId);

        $stmt = $this->db->prepare('SELECT COUNT(*) FROM albums WHERE id = :id');

        $stmt->execute(['id' => $id]);
        $count = (int) $stmt->fetchColumn();

        $this->assertSame(0, $count);
    }
}