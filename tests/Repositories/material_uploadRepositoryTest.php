<?php namespace Tests\Repositories;

use App\Models\material_upload;
use App\Repositories\material_uploadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class material_uploadRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var material_uploadRepository
     */
    protected $materialUploadRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->materialUploadRepo = \App::make(material_uploadRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_material_upload()
    {
        $materialUpload = factory(material_upload::class)->make()->toArray();

        $createdmaterial_upload = $this->materialUploadRepo->create($materialUpload);

        $createdmaterial_upload = $createdmaterial_upload->toArray();
        $this->assertArrayHasKey('id', $createdmaterial_upload);
        $this->assertNotNull($createdmaterial_upload['id'], 'Created material_upload must have id specified');
        $this->assertNotNull(material_upload::find($createdmaterial_upload['id']), 'material_upload with given id must be in DB');
        $this->assertModelData($materialUpload, $createdmaterial_upload);
    }

    /**
     * @test read
     */
    public function test_read_material_upload()
    {
        $materialUpload = factory(material_upload::class)->create();

        $dbmaterial_upload = $this->materialUploadRepo->find($materialUpload->id);

        $dbmaterial_upload = $dbmaterial_upload->toArray();
        $this->assertModelData($materialUpload->toArray(), $dbmaterial_upload);
    }

    /**
     * @test update
     */
    public function test_update_material_upload()
    {
        $materialUpload = factory(material_upload::class)->create();
        $fakematerial_upload = factory(material_upload::class)->make()->toArray();

        $updatedmaterial_upload = $this->materialUploadRepo->update($fakematerial_upload, $materialUpload->id);

        $this->assertModelData($fakematerial_upload, $updatedmaterial_upload->toArray());
        $dbmaterial_upload = $this->materialUploadRepo->find($materialUpload->id);
        $this->assertModelData($fakematerial_upload, $dbmaterial_upload->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_material_upload()
    {
        $materialUpload = factory(material_upload::class)->create();

        $resp = $this->materialUploadRepo->delete($materialUpload->id);

        $this->assertTrue($resp);
        $this->assertNull(material_upload::find($materialUpload->id), 'material_upload should not exist in DB');
    }
}
