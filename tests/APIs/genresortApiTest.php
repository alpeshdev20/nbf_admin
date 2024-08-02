<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\genresort;

class genresortApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_genresort()
    {
        $genresort = factory(genresort::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/genresorts', $genresort
        );

        $this->assertApiResponse($genresort);
    }

    /**
     * @test
     */
    public function test_read_genresort()
    {
        $genresort = factory(genresort::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/genresorts/'.$genresort->id
        );

        $this->assertApiResponse($genresort->toArray());
    }

    /**
     * @test
     */
    public function test_update_genresort()
    {
        $genresort = factory(genresort::class)->create();
        $editedgenresort = factory(genresort::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/genresorts/'.$genresort->id,
            $editedgenresort
        );

        $this->assertApiResponse($editedgenresort);
    }

    /**
     * @test
     */
    public function test_delete_genresort()
    {
        $genresort = factory(genresort::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/genresorts/'.$genresort->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/genresorts/'.$genresort->id
        );

        $this->response->assertStatus(404);
    }
}
