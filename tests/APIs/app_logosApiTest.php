<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\app_logos;

class app_logosApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_logos()
    {
        $appLogos = factory(app_logos::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_logos', $appLogos
        );

        $this->assertApiResponse($appLogos);
    }

    /**
     * @test
     */
    public function test_read_app_logos()
    {
        $appLogos = factory(app_logos::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_logos/'.$appLogos->id
        );

        $this->assertApiResponse($appLogos->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_logos()
    {
        $appLogos = factory(app_logos::class)->create();
        $editedapp_logos = factory(app_logos::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_logos/'.$appLogos->id,
            $editedapp_logos
        );

        $this->assertApiResponse($editedapp_logos);
    }

    /**
     * @test
     */
    public function test_delete_app_logos()
    {
        $appLogos = factory(app_logos::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_logos/'.$appLogos->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_logos/'.$appLogos->id
        );

        $this->response->assertStatus(404);
    }
}
