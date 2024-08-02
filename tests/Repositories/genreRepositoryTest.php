<?php namespace Tests\Repositories;

use App\Models\genre;
use App\Repositories\genreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class genreRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var genreRepository
     */
    protected $genreRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->genreRepo = \App::make(genreRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_genre()
    {
        $genre = factory(genre::class)->make()->toArray();

        $createdgenre = $this->genreRepo->create($genre);

        $createdgenre = $createdgenre->toArray();
        $this->assertArrayHasKey('id', $createdgenre);
        $this->assertNotNull($createdgenre['id'], 'Created genre must have id specified');
        $this->assertNotNull(genre::find($createdgenre['id']), 'genre with given id must be in DB');
        $this->assertModelData($genre, $createdgenre);
    }

    /**
     * @test read
     */
    public function test_read_genre()
    {
        $genre = factory(genre::class)->create();

        $dbgenre = $this->genreRepo->find($genre->id);

        $dbgenre = $dbgenre->toArray();
        $this->assertModelData($genre->toArray(), $dbgenre);
    }

    /**
     * @test update
     */
    public function test_update_genre()
    {
        $genre = factory(genre::class)->create();
        $fakegenre = factory(genre::class)->make()->toArray();

        $updatedgenre = $this->genreRepo->update($fakegenre, $genre->id);

        $this->assertModelData($fakegenre, $updatedgenre->toArray());
        $dbgenre = $this->genreRepo->find($genre->id);
        $this->assertModelData($fakegenre, $dbgenre->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_genre()
    {
        $genre = factory(genre::class)->create();

        $resp = $this->genreRepo->delete($genre->id);

        $this->assertTrue($resp);
        $this->assertNull(genre::find($genre->id), 'genre should not exist in DB');
    }
}
