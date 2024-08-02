<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\language;

class languageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_language()
    {
        $language = factory(language::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/languages', $language
        );

        $this->assertApiResponse($language);
    }

    /**
     * @test
     */
    public function test_read_language()
    {
        $language = factory(language::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/languages/'.$language->id
        );

        $this->assertApiResponse($language->toArray());
    }

    /**
     * @test
     */
    public function test_update_language()
    {
        $language = factory(language::class)->create();
        $editedlanguage = factory(language::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/languages/'.$language->id,
            $editedlanguage
        );

        $this->assertApiResponse($editedlanguage);
    }

    /**
     * @test
     */
    public function test_delete_language()
    {
        $language = factory(language::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/languages/'.$language->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/languages/'.$language->id
        );

        $this->response->assertStatus(404);
    }
}
