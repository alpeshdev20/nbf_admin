<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\app_subject;

class app_subjectApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_subject()
    {
        $appSubject = factory(app_subject::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_subjects', $appSubject
        );

        $this->assertApiResponse($appSubject);
    }

    /**
     * @test
     */
    public function test_read_app_subject()
    {
        $appSubject = factory(app_subject::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_subjects/'.$appSubject->id
        );

        $this->assertApiResponse($appSubject->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_subject()
    {
        $appSubject = factory(app_subject::class)->create();
        $editedapp_subject = factory(app_subject::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_subjects/'.$appSubject->id,
            $editedapp_subject
        );

        $this->assertApiResponse($editedapp_subject);
    }

    /**
     * @test
     */
    public function test_delete_app_subject()
    {
        $appSubject = factory(app_subject::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_subjects/'.$appSubject->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_subjects/'.$appSubject->id
        );

        $this->response->assertStatus(404);
    }
}
