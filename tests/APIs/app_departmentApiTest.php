<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\app_department;

class app_departmentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_app_department()
    {
        $appDepartment = factory(app_department::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/app_departments', $appDepartment
        );

        $this->assertApiResponse($appDepartment);
    }

    /**
     * @test
     */
    public function test_read_app_department()
    {
        $appDepartment = factory(app_department::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/app_departments/'.$appDepartment->id
        );

        $this->assertApiResponse($appDepartment->toArray());
    }

    /**
     * @test
     */
    public function test_update_app_department()
    {
        $appDepartment = factory(app_department::class)->create();
        $editedapp_department = factory(app_department::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/app_departments/'.$appDepartment->id,
            $editedapp_department
        );

        $this->assertApiResponse($editedapp_department);
    }

    /**
     * @test
     */
    public function test_delete_app_department()
    {
        $appDepartment = factory(app_department::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/app_departments/'.$appDepartment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/app_departments/'.$appDepartment->id
        );

        $this->response->assertStatus(404);
    }
}
