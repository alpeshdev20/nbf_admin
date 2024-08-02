<?php namespace Tests\Repositories;

use App\Models\book;
use App\Repositories\bookRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class bookRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var bookRepository
     */
    protected $bookRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bookRepo = \App::make(bookRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_book()
    {
        $book = factory(book::class)->make()->toArray();

        $createdbook = $this->bookRepo->create($book);

        $createdbook = $createdbook->toArray();
        $this->assertArrayHasKey('id', $createdbook);
        $this->assertNotNull($createdbook['id'], 'Created book must have id specified');
        $this->assertNotNull(book::find($createdbook['id']), 'book with given id must be in DB');
        $this->assertModelData($book, $createdbook);
    }

    /**
     * @test read
     */
    public function test_read_book()
    {
        $book = factory(book::class)->create();

        $dbbook = $this->bookRepo->find($book->id);

        $dbbook = $dbbook->toArray();
        $this->assertModelData($book->toArray(), $dbbook);
    }

    /**
     * @test update
     */
    public function test_update_book()
    {
        $book = factory(book::class)->create();
        $fakebook = factory(book::class)->make()->toArray();

        $updatedbook = $this->bookRepo->update($fakebook, $book->id);

        $this->assertModelData($fakebook, $updatedbook->toArray());
        $dbbook = $this->bookRepo->find($book->id);
        $this->assertModelData($fakebook, $dbbook->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_book()
    {
        $book = factory(book::class)->create();

        $resp = $this->bookRepo->delete($book->id);

        $this->assertTrue($resp);
        $this->assertNull(book::find($book->id), 'book should not exist in DB');
    }
}
