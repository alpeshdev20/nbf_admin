<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\material;

class materialApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_material()
    {
        $material = factory(material::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/materials', $material
        );

        $this->assertApiResponse($material);
    }

    /**
     * @test
     */
    public function test_read_material()
    {
        $material = factory(material::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/materials/'.$material->id
        );

        $this->assertApiResponse($material->toArray());
    }

    /**
     * @test
     */
    public function test_update_material()
    {
        $material = factory(material::class)->create();
        $editedmaterial = factory(material::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/materials/'.$material->id,
            $editedmaterial
        );

        $this->assertApiResponse($editedmaterial);
    }

    /**
     * @test
     */
    public function test_delete_material()
    {
        $material = factory(material::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/materials/'.$material->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/materials/'.$material->id
        );

        $this->response->assertStatus(404);
    }
}
