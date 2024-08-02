<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ExternalApp;

class ExternalAppApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_external_app()
    {
        $externalApp = factory(ExternalApp::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/external_apps', $externalApp
        );

        $this->assertApiResponse($externalApp);
    }

    /**
     * @test
     */
    public function test_read_external_app()
    {
        $externalApp = factory(ExternalApp::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/external_apps/'.$externalApp->id
        );

        $this->assertApiResponse($externalApp->toArray());
    }

    /**
     * @test
     */
    public function test_update_external_app()
    {
        $externalApp = factory(ExternalApp::class)->create();
        $editedExternalApp = factory(ExternalApp::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/external_apps/'.$externalApp->id,
            $editedExternalApp
        );

        $this->assertApiResponse($editedExternalApp);
    }

    /**
     * @test
     */
    public function test_delete_external_app()
    {
        $externalApp = factory(ExternalApp::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/external_apps/'.$externalApp->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/external_apps/'.$externalApp->id
        );

        $this->response->assertStatus(404);
    }
}
