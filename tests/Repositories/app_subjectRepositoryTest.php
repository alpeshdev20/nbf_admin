<?php namespace Tests\Repositories;

use App\Models\app_subject;
use App\Repositories\app_subjectRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class app_subjectRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var app_subjectRepository
     */
    protected $appSubjectRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appSubjectRepo = \App::make(app_subjectRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_subject()
    {
        $appSubject = factory(app_subject::class)->make()->toArray();

        $createdapp_subject = $this->appSubjectRepo->create($appSubject);

        $createdapp_subject = $createdapp_subject->toArray();
        $this->assertArrayHasKey('id', $createdapp_subject);
        $this->assertNotNull($createdapp_subject['id'], 'Created app_subject must have id specified');
        $this->assertNotNull(app_subject::find($createdapp_subject['id']), 'app_subject with given id must be in DB');
        $this->assertModelData($appSubject, $createdapp_subject);
    }

    /**
     * @test read
     */
    public function test_read_app_subject()
    {
        $appSubject = factory(app_subject::class)->create();

        $dbapp_subject = $this->appSubjectRepo->find($appSubject->id);

        $dbapp_subject = $dbapp_subject->toArray();
        $this->assertModelData($appSubject->toArray(), $dbapp_subject);
    }

    /**
     * @test update
     */
    public function test_update_app_subject()
    {
        $appSubject = factory(app_subject::class)->create();
        $fakeapp_subject = factory(app_subject::class)->make()->toArray();

        $updatedapp_subject = $this->appSubjectRepo->update($fakeapp_subject, $appSubject->id);

        $this->assertModelData($fakeapp_subject, $updatedapp_subject->toArray());
        $dbapp_subject = $this->appSubjectRepo->find($appSubject->id);
        $this->assertModelData($fakeapp_subject, $dbapp_subject->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_subject()
    {
        $appSubject = factory(app_subject::class)->create();

        $resp = $this->appSubjectRepo->delete($appSubject->id);

        $this->assertTrue($resp);
        $this->assertNull(app_subject::find($appSubject->id), 'app_subject should not exist in DB');
    }
}
