<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\app_user;

class app_userApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_user()
    {
        $appUser = factory(app_user::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_users', $appUser
        );

        $this->assertApiResponse($appUser);
    }

    /**
     * @test
     */
    public function test_read_app_user()
    {
        $appUser = factory(app_user::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_users/'.$appUser->id
        );

        $this->assertApiResponse($appUser->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_user()
    {
        $appUser = factory(app_user::class)->create();
        $editedapp_user = factory(app_user::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_users/'.$appUser->id,
            $editedapp_user
        );

        $this->assertApiResponse($editedapp_user);
    }

    /**
     * @test
     */
    public function test_delete_app_user()
    {
        $appUser = factory(app_user::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_users/'.$appUser->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_users/'.$appUser->id
        );

        $this->response->assertStatus(404);
    }
}
