<?php namespace Tests\Repositories;

use App\Models\app_material;
use App\Repositories\app_materialRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class app_materialRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var app_materialRepository
     */
    protected $appMaterialRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appMaterialRepo = \App::make(app_materialRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_material()
    {
        $appMaterial = factory(app_material::class)->make()->toArray();

        $createdapp_material = $this->appMaterialRepo->create($appMaterial);

        $createdapp_material = $createdapp_material->toArray();
        $this->assertArrayHasKey('id', $createdapp_material);
        $this->assertNotNull($createdapp_material['id'], 'Created app_material must have id specified');
        $this->assertNotNull(app_material::find($createdapp_material['id']), 'app_material with given id must be in DB');
        $this->assertModelData($appMaterial, $createdapp_material);
    }

    /**
     * @test read
     */
    public function test_read_app_material()
    {
        $appMaterial = factory(app_material::class)->create();

        $dbapp_material = $this->appMaterialRepo->find($appMaterial->id);

        $dbapp_material = $dbapp_material->toArray();
        $this->assertModelData($appMaterial->toArray(), $dbapp_material);
    }

    /**
     * @test update
     */
    public function test_update_app_material()
    {
        $appMaterial = factory(app_material::class)->create();
        $fakeapp_material = factory(app_material::class)->make()->toArray();

        $updatedapp_material = $this->appMaterialRepo->update($fakeapp_material, $appMaterial->id);

        $this->assertModelData($fakeapp_material, $updatedapp_material->toArray());
        $dbapp_material = $this->appMaterialRepo->find($appMaterial->id);
        $this->assertModelData($fakeapp_material, $dbapp_material->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_material()
    {
        $appMaterial = factory(app_material::class)->create();

        $resp = $this->appMaterialRepo->delete($appMaterial->id);

        $this->assertTrue($resp);
        $this->assertNull(app_material::find($appMaterial->id), 'app_material should not exist in DB');
    }
}
