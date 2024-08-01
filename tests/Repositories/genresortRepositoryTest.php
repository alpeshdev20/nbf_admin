<?php namespace Tests\Repositories;

use App\Models\genresort;
use App\Repositories\genresortRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class genresortRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var genresortRepository
     */
    protected $genresortRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->genresortRepo = \App::make(genresortRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_genresort()
    {
        $genresort = factory(genresort::class)->make()->toArray();

        $createdgenresort = $this->genresortRepo->create($genresort);

        $createdgenresort = $createdgenresort->toArray();
        $this->assertArrayHasKey('id', $createdgenresort);
        $this->assertNotNull($createdgenresort['id'], 'Created genresort must have id specified');
        $this->assertNotNull(genresort::find($createdgenresort['id']), 'genresort with given id must be in DB');
        $this->assertModelData($genresort, $createdgenresort);
    }

    /**
     * @test read
     */
    public function test_read_genresort()
    {
        $genresort = factory(genresort::class)->create();

        $dbgenresort = $this->genresortRepo->find($genresort->id);

        $dbgenresort = $dbgenresort->toArray();
        $this->assertModelData($genresort->toArray(), $dbgenresort);
    }

    /**
     * @test update
     */
    public function test_update_genresort()
    {
        $genresort = factory(genresort::class)->create();
        $fakegenresort = factory(genresort::class)->make()->toArray();

        $updatedgenresort = $this->genresortRepo->update($fakegenresort, $genresort->id);

        $this->assertModelData($fakegenresort, $updatedgenresort->toArray());
        $dbgenresort = $this->genresortRepo->find($genresort->id);
        $this->assertModelData($fakegenresort, $dbgenresort->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_genresort()
    {
        $genresort = factory(genresort::class)->create();

        $resp = $this->genresortRepo->delete($genresort->id);

        $this->assertTrue($resp);
        $this->assertNull(genresort::find($genresort->id), 'genresort should not exist in DB');
    }
}
