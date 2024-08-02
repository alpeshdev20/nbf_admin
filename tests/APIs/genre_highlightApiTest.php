<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\genre_highlight;

class genre_highlightApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/genre_highlights', $genreHighlight
        );

        $this->assertApiResponse($genreHighlight);
    }

    /**
     * @test
     */
    public function test_read_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/genre_highlights/'.$genreHighlight->id
        );

        $this->assertApiResponse($genreHighlight->toArray());
    }

    /**
     * @test
     */
    public function test_update_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->create();
        $editedgenre_highlight = factory(genre_highlight::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/genre_highlights/'.$genreHighlight->id,
            $editedgenre_highlight
        );

        $this->assertApiResponse($editedgenre_highlight);
    }

    /**
     * @test
     */
    public function test_delete_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/genre_highlights/'.$genreHighlight->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/genre_highlights/'.$genreHighlight->id
        );

        $this->response->assertStatus(404);
    }
}
