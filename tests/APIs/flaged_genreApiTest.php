<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\flaged_genre;

class flaged_genreApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/flaged_genres', $flagedGenre
        );

        $this->assertApiResponse($flagedGenre);
    }

    /**
     * @test
     */
    public function test_read_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/flaged_genres/'.$flagedGenre->id
        );

        $this->assertApiResponse($flagedGenre->toArray());
    }

    /**
     * @test
     */
    public function test_update_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->create();
        $editedflaged_genre = factory(flaged_genre::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/flaged_genres/'.$flagedGenre->id,
            $editedflaged_genre
        );

        $this->assertApiResponse($editedflaged_genre);
    }

    /**
     * @test
     */
    public function test_delete_flaged_genre()
    {
        $flagedGenre = factory(flaged_genre::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/flaged_genres/'.$flagedGenre->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/flaged_genres/'.$flagedGenre->id
        );

        $this->response->assertStatus(404);
    }
}
