<?php namespace Tests\Repositories;

use App\Models\userfav;
use App\Repositories\userfavRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class userfavRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var userfavRepository
     */
    protected $userfavRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->userfavRepo = \App::make(userfavRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_userfav()
    {
        $userfav = factory(userfav::class)->make()->toArray();

        $createduserfav = $this->userfavRepo->create($userfav);

        $createduserfav = $createduserfav->toArray();
        $this->assertArrayHasKey('id', $createduserfav);
        $this->assertNotNull($createduserfav['id'], 'Created userfav must have id specified');
        $this->assertNotNull(userfav::find($createduserfav['id']), 'userfav with given id must be in DB');
        $this->assertModelData($userfav, $createduserfav);
    }

    /**
     * @test read
     */
    public function test_read_userfav()
    {
        $userfav = factory(userfav::class)->create();

        $dbuserfav = $this->userfavRepo->find($userfav->id);

        $dbuserfav = $dbuserfav->toArray();
        $this->assertModelData($userfav->toArray(), $dbuserfav);
    }

    /**
     * @test update
     */
    public function test_update_userfav()
    {
        $userfav = factory(userfav::class)->create();
        $fakeuserfav = factory(userfav::class)->make()->toArray();

        $updateduserfav = $this->userfavRepo->update($fakeuserfav, $userfav->id);

        $this->assertModelData($fakeuserfav, $updateduserfav->toArray());
        $dbuserfav = $this->userfavRepo->find($userfav->id);
        $this->assertModelData($fakeuserfav, $dbuserfav->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_userfav()
    {
        $userfav = factory(userfav::class)->create();

        $resp = $this->userfavRepo->delete($userfav->id);

        $this->assertTrue($resp);
        $this->assertNull(userfav::find($userfav->id), 'userfav should not exist in DB');
    }
}
