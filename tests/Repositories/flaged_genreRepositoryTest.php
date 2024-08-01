<?php namespace Tests\Repositories;

use App\Models\flaged_genre;
use App\Repositories\flaged_genreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class flaged_genreRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var flaged_genreRepository
     */
    protected $flagedGenreRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->flagedGenreRepo = \App::make(flaged_genreRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->make()->toArray();

        $createdflaged_genre = $this->flagedGenreRepo->create($flagedGenre);

        $createdflaged_genre = $createdflaged_genre->toArray();
        $this->assertArrayHasKey('id', $createdflaged_genre);
        $this->assertNotNull($createdflaged_genre['id'], 'Created flaged_genre must have id specified');
        $this->assertNotNull(flaged_genre::find($createdflaged_genre['id']), 'flaged_genre with given id must be in DB');
        $this->assertModelData($flagedGenre, $createdflaged_genre);
    }

    /**
     * @test read
     */
    public function test_read_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->create();

        $dbflaged_genre = $this->flagedGenreRepo->find($flagedGenre->id);

        $dbflaged_genre = $dbflaged_genre->toArray();
        $this->assertModelData($flagedGenre->toArray(), $dbflaged_genre);
    }

    /**
     * @test update
     */
    public function test_update_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->create();
        $fakeflaged_genre = factory(flaged_genre::class)->make()->toArray();

        $updatedflaged_genre = $this->flagedGenreRepo->update($fakeflaged_genre, $flagedGenre->id);

        $this->assertModelData($fakeflaged_genre, $updatedflaged_genre->toArray());
        $dbflaged_genre = $this->flagedGenreRepo->find($flagedGenre->id);
        $this->assertModelData($fakeflaged_genre, $dbflaged_genre->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->create();

        $resp = $this->flagedGenreRepo->delete($flagedGenre->id);

        $this->assertTrue($resp);
        $this->assertNull(flaged_genre::find($flagedGenre->id), 'flaged_genre should not exist in DB');
    }
}
