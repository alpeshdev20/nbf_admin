<?php namespace Tests\Repositories;

use App\Models\app_department;
use App\Repositories\app_departmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class app_departmentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var app_departmentRepository
     */
    protected $appDepartmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appDepartmentRepo = \App::make(app_departmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_department()
    {
        $appDepartment = factory(app_department::class)->make()->toArray();

        $createdapp_department = $this->appDepartmentRepo->create($appDepartment);

        $createdapp_department = $createdapp_department->toArray();
        $this->assertArrayHasKey('id', $createdapp_department);
        $this->assertNotNull($createdapp_department['id'], 'Created app_department must have id specified');
        $this->assertNotNull(app_department::find($createdapp_department['id']), 'app_department with given id must be in DB');
        $this->assertModelData($appDepartment, $createdapp_department);
    }

    /**
     * @test read
     */
    public function test_read_app_department()
    {
        $appDepartment = factory(app_department::class)->create();

        $dbapp_department = $this->appDepartmentRepo->find($appDepartment->id);

        $dbapp_department = $dbapp_department->toArray();
        $this->assertModelData($appDepartment->toArray(), $dbapp_department);
    }

    /**
     * @test update
     */
    public function test_update_app_department()
    {
        $appDepartment = factory(app_department::class)->create();
        $fakeapp_department = factory(app_department::class)->make()->toArray();

        $updatedapp_department = $this->appDepartmentRepo->update($fakeapp_department, $appDepartment->id);

        $this->assertModelData($fakeapp_department, $updatedapp_department->toArray());
        $dbapp_department = $this->appDepartmentRepo->find($appDepartment->id);
        $this->assertModelData($fakeapp_department, $dbapp_department->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_department()
    {
        $appDepartment = factory(app_department::class)->create();

        $resp = $this->appDepartmentRepo->delete($appDepartment->id);

        $this->assertTrue($resp);
        $this->assertNull(app_department::find($appDepartment->id), 'app_department should not exist in DB');
    }
}
