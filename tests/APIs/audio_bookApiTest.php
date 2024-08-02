<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\audio_book;

class audio_bookApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_audio_book()
    {
        $audioBook = factory(audio_book::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/audio_books', $audioBook
        );

        $this->assertApiResponse($audioBook);
    }

    /**
     * @test
     */
    public function test_read_audio_book()
    {
        $audioBook = factory(audio_book::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/audio_books/'.$audioBook->id
        );

        $this->assertApiResponse($audioBook->toArray());
    }

    /**
     * @test
     */
    public function test_update_audio_book()
    {
        $audioBook = factory(audio_book::class)->create();
        $editedaudio_book = factory(audio_book::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/audio_books/'.$audioBook->id,
            $editedaudio_book
        );

        $this->assertApiResponse($editedaudio_book);
    }

    /**
     * @test
     */
    public function test_delete_audio_book()
    {
        $audioBook = factory(audio_book::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/audio_books/'.$audioBook->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/audio_books/'.$audioBook->id
        );

        $this->response->assertStatus(404);
    }
}
