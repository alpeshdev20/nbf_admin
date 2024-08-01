<?php namespace Tests\Repositories;

use App\Models\app_adv;
use App\Repositories\app_advRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class app_advRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var app_advRepository
     */
    protected $appAdvRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appAdvRepo = \App::make(app_advRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_adv()
    {
        $appAdv = factory(app_adv::class)->make()->toArray();

        $createdapp_adv = $this->appAdvRepo->create($appAdv);

        $createdapp_adv = $createdapp_adv->toArray();
        $this->assertArrayHasKey('id', $createdapp_adv);
        $this->assertNotNull($createdapp_adv['id'], 'Created app_adv must have id specified');
        $this->assertNotNull(app_adv::find($createdapp_adv['id']), 'app_adv with given id must be in DB');
        $this->assertModelData($appAdv, $createdapp_adv);
    }

    /**
     * @test read
     */
    public function test_read_app_adv()
    {
        $appAdv = factory(app_adv::class)->create();

        $dbapp_adv = $this->appAdvRepo->find($appAdv->id);

        $dbapp_adv = $dbapp_adv->toArray();
        $this->assertModelData($appAdv->toArray(), $dbapp_adv);
    }

    /**
     * @test update
     */
    public function test_update_app_adv()
    {
        $appAdv = factory(app_adv::class)->create();
        $fakeapp_adv = factory(app_adv::class)->make()->toArray();

        $updatedapp_adv = $this->appAdvRepo->update($fakeapp_adv, $appAdv->id);

        $this->assertModelData($fakeapp_adv, $updatedapp_adv->toArray());
        $dbapp_adv = $this->appAdvRepo->find($appAdv->id);
        $this->assertModelData($fakeapp_adv, $dbapp_adv->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_adv()
    {
        $appAdv = factory(app_adv::class)->create();

        $resp = $this->appAdvRepo->delete($appAdv->id);

        $this->assertTrue($resp);
        $this->assertNull(app_adv::find($appAdv->id), 'app_adv should not exist in DB');
    }
}
