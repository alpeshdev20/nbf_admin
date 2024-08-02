<?php namespace Tests\Repositories;

use App\Models\app_publisher;
use App\Repositories\app_publisherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class app_publisherRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var app_publisherRepository
     */
    protected $appPublisherRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appPublisherRepo = \App::make(app_publisherRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->make()->toArray();

        $createdapp_publisher = $this->appPublisherRepo->create($appPublisher);

        $createdapp_publisher = $createdapp_publisher->toArray();
        $this->assertArrayHasKey('id', $createdapp_publisher);
        $this->assertNotNull($createdapp_publisher['id'], 'Created app_publisher must have id specified');
        $this->assertNotNull(app_publisher::find($createdapp_publisher['id']), 'app_publisher with given id must be in DB');
        $this->assertModelData($appPublisher, $createdapp_publisher);
    }

    /**
     * @test read
     */
    public function test_read_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->create();

        $dbapp_publisher = $this->appPublisherRepo->find($appPublisher->id);

        $dbapp_publisher = $dbapp_publisher->toArray();
        $this->assertModelData($appPublisher->toArray(), $dbapp_publisher);
    }

    /**
     * @test update
     */
    public function test_update_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->create();
        $fakeapp_publisher = factory(app_publisher::class)->make()->toArray();

        $updatedapp_publisher = $this->appPublisherRepo->update($fakeapp_publisher, $appPublisher->id);

        $this->assertModelData($fakeapp_publisher, $updatedapp_publisher->toArray());
        $dbapp_publisher = $this->appPublisherRepo->find($appPublisher->id);
        $this->assertModelData($fakeapp_publisher, $dbapp_publisher->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_publisher()
    {
        $appPublisher = factory(app_publisher::class)->create();

        $resp = $this->appPublisherRepo->delete($appPublisher->id);

        $this->assertTrue($resp);
        $this->assertNull(app_publisher::find($appPublisher->id), 'app_publisher should not exist in DB');
    }
}
