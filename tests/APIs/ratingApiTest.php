<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\rating;

class ratingApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_rating()
    {
        $rating = factory(rating::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/ratings', $rating
        );

        $this->assertApiResponse($rating);
    }

    /**
     * @test
     */
    public function test_read_rating()
    {
        $rating = factory(rating::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/ratings/'.$rating->id
        );

        $this->assertApiResponse($rating->toArray());
    }

    /**
     * @test
     */
    public function test_update_rating()
    {
        $rating = factory(rating::class)->create();
        $editedrating = factory(rating::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/ratings/'.$rating->id,
            $editedrating
        );

        $this->assertApiResponse($editedrating);
    }

    /**
     * @test
     */
    public function test_delete_rating()
    {
        $rating = factory(rating::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/ratings/'.$rating->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/ratings/'.$rating->id
        );

        $this->response->assertStatus(404);
    }
}
