<?php namespace Tests\Repositories;

use App\Models\app_logos;
use App\Repositories\app_logosRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class app_logosRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var app_logosRepository
     */
    protected $appLogosRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appLogosRepo = \App::make(app_logosRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_logos()
    {
        $appLogos = factory(app_logos::class)->make()->toArray();

        $createdapp_logos = $this->appLogosRepo->create($appLogos);

        $createdapp_logos = $createdapp_logos->toArray();
        $this->assertArrayHasKey('id', $createdapp_logos);
        $this->assertNotNull($createdapp_logos['id'], 'Created app_logos must have id specified');
        $this->assertNotNull(app_logos::find($createdapp_logos['id']), 'app_logos with given id must be in DB');
        $this->assertModelData($appLogos, $createdapp_logos);
    }

    /**
     * @test read
     */
    public function test_read_app_logos()
    {
        $appLogos = factory(app_logos::class)->create();

        $dbapp_logos = $this->appLogosRepo->find($appLogos->id);

        $dbapp_logos = $dbapp_logos->toArray();
        $this->assertModelData($appLogos->toArray(), $dbapp_logos);
    }

    /**
     * @test update
     */
    public function test_update_app_logos()
    {
        $appLogos = factory(app_logos::class)->create();
        $fakeapp_logos = factory(app_logos::class)->make()->toArray();

        $updatedapp_logos = $this->appLogosRepo->update($fakeapp_logos, $appLogos->id);

        $this->assertModelData($fakeapp_logos, $updatedapp_logos->toArray());
        $dbapp_logos = $this->appLogosRepo->find($appLogos->id);
        $this->assertModelData($fakeapp_logos, $dbapp_logos->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_logos()
    {
        $appLogos = factory(app_logos::class)->create();

        $resp = $this->appLogosRepo->delete($appLogos->id);

        $this->assertTrue($resp);
        $this->assertNull(app_logos::find($appLogos->id), 'app_logos should not exist in DB');
    }
}
