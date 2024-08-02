<?php namespace Tests\Repositories;

use App\Models\ExternalApp;
use App\Repositories\ExternalAppRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ExternalAppRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExternalAppRepository
     */
    protected $externalAppRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->externalAppRepo = \App::make(ExternalAppRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_external_app()
    {
        $externalApp = factory(ExternalApp::class)->make()->toArray();

        $createdExternalApp = $this->externalAppRepo->create($externalApp);

        $createdExternalApp = $createdExternalApp->toArray();
        $this->assertArrayHasKey('id', $createdExternalApp);
        $this->assertNotNull($createdExternalApp['id'], 'Created ExternalApp must have id specified');
        $this->assertNotNull(ExternalApp::find($createdExternalApp['id']), 'ExternalApp with given id must be in DB');
        $this->assertModelData($externalApp, $createdExternalApp);
    }

    /**
     * @test read
     */
    public function test_read_external_app()
    {
        $externalApp = factory(ExternalApp::class)->create();

        $dbExternalApp = $this->externalAppRepo->find($externalApp->id);

        $dbExternalApp = $dbExternalApp->toArray();
        $this->assertModelData($externalApp->toArray(), $dbExternalApp);
    }

    /**
     * @test update
     */
    public function test_update_external_app()
    {
        $externalApp = factory(ExternalApp::class)->create();
        $fakeExternalApp = factory(ExternalApp::class)->make()->toArray();

        $updatedExternalApp = $this->externalAppRepo->update($fakeExternalApp, $externalApp->id);

        $this->assertModelData($fakeExternalApp, $updatedExternalApp->toArray());
        $dbExternalApp = $this->externalAppRepo->find($externalApp->id);
        $this->assertModelData($fakeExternalApp, $dbExternalApp->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_external_app()
    {
        $externalApp = factory(ExternalApp::class)->create();

        $resp = $this->externalAppRepo->delete($externalApp->id);

        $this->assertTrue($resp);
        $this->assertNull(ExternalApp::find($externalApp->id), 'ExternalApp should not exist in DB');
    }
}
