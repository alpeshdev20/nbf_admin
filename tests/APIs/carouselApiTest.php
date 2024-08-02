<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\carousel;

class carouselApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_carousel()
    {
        $carousel = factory(carousel::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/carousels', $carousel
        );

        $this->assertApiResponse($carousel);
    }

    /**
     * @test
     */
    public function test_read_carousel()
    {
        $carousel = factory(carousel::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/carousels/'.$carousel->id
        );

        $this->assertApiResponse($carousel->toArray());
    }

    /**
     * @test
     */
    public function test_update_carousel()
    {
        $carousel = factory(carousel::class)->create();
        $editedcarousel = factory(carousel::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/carousels/'.$carousel->id,
            $editedcarousel
        );

        $this->assertApiResponse($editedcarousel);
    }

    /**
     * @test
     */
    public function test_delete_carousel()
    {
        $carousel = factory(carousel::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/carousels/'.$carousel->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/carousels/'.$carousel->id
        );

        $this->response->assertStatus(404);
    }
}
