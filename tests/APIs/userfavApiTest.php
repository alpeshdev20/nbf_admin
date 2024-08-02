<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\userfav;

class userfavApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_userfav()
    {
        $userfav = factory(userfav::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/userfavs', $userfav
        );

        $this->assertApiResponse($userfav);
    }

    /**
     * @test
     */
    public function test_read_userfav()
    {
        $userfav = factory(userfav::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/userfavs/'.$userfav->id
        );

        $this->assertApiResponse($userfav->toArray());
    }

    /**
     * @test
     */
    public function test_update_userfav()
    {
        $userfav = factory(userfav::class)->create();
        $editeduserfav = factory(userfav::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/userfavs/'.$userfav->id,
            $editeduserfav
        );

        $this->assertApiResponse($editeduserfav);
    }

    /**
     * @test
     */
    public function test_delete_userfav()
    {
        $userfav = factory(userfav::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/userfavs/'.$userfav->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/userfavs/'.$userfav->id
        );

        $this->response->assertStatus(404);
    }
}
