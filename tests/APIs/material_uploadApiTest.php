<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\material_upload;

class material_uploadApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_material_upload()
    {
        $materialUpload = factory(material_upload::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/material_uploads', $materialUpload
        );

        $this->assertApiResponse($materialUpload);
    }

    /**
     * @test
     */
    public function test_read_material_upload()
    {
        $materialUpload = factory(material_upload::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/material_uploads/'.$materialUpload->id
        );

        $this->assertApiResponse($materialUpload->toArray());
    }

    /**
     * @test
     */
    public function test_update_material_upload()
    {
        $materialUpload = factory(material_upload::class)->create();
        $editedmaterial_upload = factory(material_upload::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/material_uploads/'.$materialUpload->id,
            $editedmaterial_upload
        );

        $this->assertApiResponse($editedmaterial_upload);
    }

    /**
     * @test
     */
    public function test_delete_material_upload()
    {
        $materialUpload = factory(material_upload::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/material_uploads/'.$materialUpload->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/material_uploads/'.$materialUpload->id
        );

        $this->response->assertStatus(404);
    }
}
