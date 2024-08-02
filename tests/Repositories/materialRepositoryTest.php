<?php namespace Tests\Repositories;

use App\Models\material;
use App\Repositories\materialRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class materialRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var materialRepository
     */
    protected $materialRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->materialRepo = \App::make(materialRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_material()
    {
        $material = factory(material::class)->make()->toArray();

        $createdmaterial = $this->materialRepo->create($material);

        $createdmaterial = $createdmaterial->toArray();
        $this->assertArrayHasKey('id', $createdmaterial);
        $this->assertNotNull($createdmaterial['id'], 'Created material must have id specified');
        $this->assertNotNull(material::find($createdmaterial['id']), 'material with given id must be in DB');
        $this->assertModelData($material, $createdmaterial);
    }

    /**
     * @test read
     */
    public function test_read_material()
    {
        $material = factory(material::class)->create();

        $dbmaterial = $this->materialRepo->find($material->id);

        $dbmaterial = $dbmaterial->toArray();
        $this->assertModelData($material->toArray(), $dbmaterial);
    }

    /**
     * @test update
     */
    public function test_update_material()
    {
        $material = factory(material::class)->create();
        $fakematerial = factory(material::class)->make()->toArray();

        $updatedmaterial = $this->materialRepo->update($fakematerial, $material->id);

        $this->assertModelData($fakematerial, $updatedmaterial->toArray());
        $dbmaterial = $this->materialRepo->find($material->id);
        $this->assertModelData($fakematerial, $dbmaterial->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_material()
    {
        $material = factory(material::class)->create();

        $resp = $this->materialRepo->delete($material->id);

        $this->assertTrue($resp);
        $this->assertNull(material::find($material->id), 'material should not exist in DB');
    }
}
