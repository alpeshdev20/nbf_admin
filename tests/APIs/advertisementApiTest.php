<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\advertisement;

class advertisementApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_advertisement()
    {
        $advertisement = factory(advertisement::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/advertisements', $advertisement
        );

        $this->assertApiResponse($advertisement);
    }

    /**
     * @test
     */
    public function test_read_advertisement()
    {
        $advertisement = factory(advertisement::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/advertisements/'.$advertisement->id
        );

        $this->assertApiResponse($advertisement->toArray());
    }

    /**
     * @test
     */
    public function test_update_advertisement()
    {
        $advertisement = factory(advertisement::class)->create();
        $editedadvertisement = factory(advertisement::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/advertisements/'.$advertisement->id,
            $editedadvertisement
        );

        $this->assertApiResponse($editedadvertisement);
    }

    /**
     * @test
     */
    public function test_delete_advertisement()
    {
        $advertisement = factory(advertisement::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/advertisements/'.$advertisement->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/advertisements/'.$advertisement->id
        );

        $this->response->assertStatus(404);
    }
}
