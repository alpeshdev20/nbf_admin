<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\book_publisher;

class book_publisherApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/book_publishers', $bookPublisher
        );

        $this->assertApiResponse($bookPublisher);
    }

    /**
     * @test
     */
    public function test_read_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/book_publishers/'.$bookPublisher->id
        );

        $this->assertApiResponse($bookPublisher->toArray());
    }

    /**
     * @test
     */
    public function test_update_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->create();
        $editedbook_publisher = factory(book_publisher::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/book_publishers/'.$bookPublisher->id,
            $editedbook_publisher
        );

        $this->assertApiResponse($editedbook_publisher);
    }

    /**
     * @test
     */
    public function test_delete_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/book_publishers/'.$bookPublisher->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/book_publishers/'.$bookPublisher->id
        );

        $this->response->assertStatus(404);
    }
}
