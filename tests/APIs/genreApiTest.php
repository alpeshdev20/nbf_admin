<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\genre;

class genreApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_genre()
    {
        $genre = factory(genre::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/genres', $genre
        );

        $this->assertApiResponse($genre);
    }

    /**
     * @test
     */
    public function test_read_genre()
    {
        $genre = factory(genre::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/genres/'.$genre->id
        );

        $this->assertApiResponse($genre->toArray());
    }

    /**
     * @test
     */
    public function test_update_genre()
    {
        $genre = factory(genre::class)->create();
        $editedgenre = factory(genre::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/genres/'.$genre->id,
            $editedgenre
        );

        $this->assertApiResponse($editedgenre);
    }

    /**
     * @test
     */
    public function test_delete_genre()
    {
        $genre = factory(genre::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/genres/'.$genre->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/genres/'.$genre->id
        );

        $this->response->assertStatus(404);
    }
}
