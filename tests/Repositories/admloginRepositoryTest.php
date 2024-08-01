<?php namespace Tests\Repositories;

use App\Models\admlogin;
use App\Repositories\admloginRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class admloginRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var admloginRepository
     */
    protected $admloginRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->admloginRepo = \App::make(admloginRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_admlogin()
    {
        $admlogin = factory(admlogin::class)->make()->toArray();

        $createdadmlogin = $this->admloginRepo->create($admlogin);

        $createdadmlogin = $createdadmlogin->toArray();
        $this->assertArrayHasKey('id', $createdadmlogin);
        $this->assertNotNull($createdadmlogin['id'], 'Created admlogin must have id specified');
        $this->assertNotNull(admlogin::find($createdadmlogin['id']), 'admlogin with given id must be in DB');
        $this->assertModelData($admlogin, $createdadmlogin);
    }

    /**
     * @test read
     */
    public function test_read_admlogin()
    {
        $admlogin = factory(admlogin::class)->create();

        $dbadmlogin = $this->admloginRepo->find($admlogin->id);

        $dbadmlogin = $dbadmlogin->toArray();
        $this->assertModelData($admlogin->toArray(), $dbadmlogin);
    }

    /**
     * @test update
     */
    public function test_update_admlogin()
    {
        $admlogin = factory(admlogin::class)->create();
        $fakeadmlogin = factory(admlogin::class)->make()->toArray();

        $updatedadmlogin = $this->admloginRepo->update($fakeadmlogin, $admlogin->id);

        $this->assertModelData($fakeadmlogin, $updatedadmlogin->toArray());
        $dbadmlogin = $this->admloginRepo->find($admlogin->id);
        $this->assertModelData($fakeadmlogin, $dbadmlogin->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_admlogin()
    {
        $admlogin = factory(admlogin::class)->create();

        $resp = $this->admloginRepo->delete($admlogin->id);

        $this->assertTrue($resp);
        $this->assertNull(admlogin::find($admlogin->id), 'admlogin should not exist in DB');
    }
}
