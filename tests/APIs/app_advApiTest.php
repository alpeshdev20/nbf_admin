<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\app_adv;

class app_advApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_adv()
    {
        $appAdv = factory(app_adv::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_advs', $appAdv
        );

        $this->assertApiResponse($appAdv);
    }

    /**
     * @test
     */
    public function test_read_app_adv()
    {
        $appAdv = factory(app_adv::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_advs/'.$appAdv->id
        );

        $this->assertApiResponse($appAdv->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_adv()
    {
        $appAdv = factory(app_adv::class)->create();
        $editedapp_adv = factory(app_adv::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_advs/'.$appAdv->id,
            $editedapp_adv
        );

        $this->assertApiResponse($editedapp_adv);
    }

    /**
     * @test
     */
    public function test_delete_app_adv()
    {
        $appAdv = factory(app_adv::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_advs/'.$appAdv->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_advs/'.$appAdv->id
        );

        $this->response->assertStatus(404);
    }
}
