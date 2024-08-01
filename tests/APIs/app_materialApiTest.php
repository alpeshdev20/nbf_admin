<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\app_material;

class app_materialApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_material()
    {
        $appMaterial = factory(app_material::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_materials', $appMaterial
        );

        $this->assertApiResponse($appMaterial);
    }

    /**
     * @test
     */
    public function test_read_app_material()
    {
        $appMaterial = factory(app_material::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_materials/'.$appMaterial->id
        );

        $this->assertApiResponse($appMaterial->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_material()
    {
        $appMaterial = factory(app_material::class)->create();
        $editedapp_material = factory(app_material::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_materials/'.$appMaterial->id,
            $editedapp_material
        );

        $this->assertApiResponse($editedapp_material);
    }

    /**
     * @test
     */
    public function test_delete_app_material()
    {
        $appMaterial = factory(app_material::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_materials/'.$appMaterial->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_materials/'.$appMaterial->id
        );

        $this->response->assertStatus(404);
    }
}
