<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\admlogin;

class admloginApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_admlogin()
    {
        $admlogin = factory(admlogin::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admlogins', $admlogin
        );

        $this->assertApiResponse($admlogin);
    }

    /**
     * @test
     */
    public function test_read_admlogin()
    {
        $admlogin = factory(admlogin::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admlogins/'.$admlogin->id
        );

        $this->assertApiResponse($admlogin->toArray());
    }

    /**
     * @test
     */
    public function test_update_admlogin()
    {
        $admlogin = factory(admlogin::class)->create();
        $editedadmlogin = factory(admlogin::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admlogins/'.$admlogin->id,
            $editedadmlogin
        );

        $this->assertApiResponse($editedadmlogin);
    }

    /**
     * @test
     */
    public function test_delete_admlogin()
    {
        $admlogin = factory(admlogin::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admlogins/'.$admlogin->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admlogins/'.$admlogin->id
        );

        $this->response->assertStatus(404);
    }
}
