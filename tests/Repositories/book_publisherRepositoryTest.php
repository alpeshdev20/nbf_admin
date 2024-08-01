<?php namespace Tests\Repositories;

use App\Models\book_publisher;
use App\Repositories\book_publisherRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class book_publisherRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var book_publisherRepository
     */
    protected $bookPublisherRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bookPublisherRepo = \App::make(book_publisherRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->make()->toArray();

        $createdbook_publisher = $this->bookPublisherRepo->create($bookPublisher);

        $createdbook_publisher = $createdbook_publisher->toArray();
        $this->assertArrayHasKey('id', $createdbook_publisher);
        $this->assertNotNull($createdbook_publisher['id'], 'Created book_publisher must have id specified');
        $this->assertNotNull(book_publisher::find($createdbook_publisher['id']), 'book_publisher with given id must be in DB');
        $this->assertModelData($bookPublisher, $createdbook_publisher);
    }

    /**
     * @test read
     */
    public function test_read_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->create();

        $dbbook_publisher = $this->bookPublisherRepo->find($bookPublisher->id);

        $dbbook_publisher = $dbbook_publisher->toArray();
        $this->assertModelData($bookPublisher->toArray(), $dbbook_publisher);
    }

    /**
     * @test update
     */
    public function test_update_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->create();
        $fakebook_publisher = factory(book_publisher::class)->make()->toArray();

        $updatedbook_publisher = $this->bookPublisherRepo->update($fakebook_publisher, $bookPublisher->id);

        $this->assertModelData($fakebook_publisher, $updatedbook_publisher->toArray());
        $dbbook_publisher = $this->bookPublisherRepo->find($bookPublisher->id);
        $this->assertModelData($fakebook_publisher, $dbbook_publisher->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_book_publisher()
    {
        $bookPublisher = factory(book_publisher::class)->create();

        $resp = $this->bookPublisherRepo->delete($bookPublisher->id);

        $this->assertTrue($resp);
        $this->assertNull(book_publisher::find($bookPublisher->id), 'book_publisher should not exist in DB');
    }
}
