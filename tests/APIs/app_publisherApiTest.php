<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\app_publisher;

class app_publisherApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_publishers', $appPublisher
        );

        $this->assertApiResponse($appPublisher);
    }

    /**
     * @test
     */
    public function test_read_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_publishers/'.$appPublisher->id
        );

        $this->assertApiResponse($appPublisher->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->create();
        $editedapp_publisher = factory(app_publisher::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_publishers/'.$appPublisher->id,
            $editedapp_publisher
        );

        $this->assertApiResponse($editedapp_publisher);
    }

    /**
     * @test
     */
    public function test_delete_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_publishers/'.$appPublisher->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_publishers/'.$appPublisher->id
        );

        $this->response->assertStatus(404);
    }
}
