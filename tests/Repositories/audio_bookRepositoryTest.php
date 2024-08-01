<?php namespace Tests\Repositories;

use App\Models\audio_book;
use App\Repositories\audio_bookRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class audio_bookRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var audio_bookRepository
     */
    protected $audioBookRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->audioBookRepo = \App::make(audio_bookRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_audio_book()
    {
        $audioBook = factory(audio_book::class)->make()->toArray();

        $createdaudio_book = $this->audioBookRepo->create($audioBook);

        $createdaudio_book = $createdaudio_book->toArray();
        $this->assertArrayHasKey('id', $createdaudio_book);
        $this->assertNotNull($createdaudio_book['id'], 'Created audio_book must have id specified');
        $this->assertNotNull(audio_book::find($createdaudio_book['id']), 'audio_book with given id must be in DB');
        $this->assertModelData($audioBook, $createdaudio_book);
    }

    /**
     * @test read
     */
    public function test_read_audio_book()
    {
        $audioBook = factory(audio_book::class)->create();

        $dbaudio_book = $this->audioBookRepo->find($audioBook->id);

        $dbaudio_book = $dbaudio_book->toArray();
        $this->assertModelData($audioBook->toArray(), $dbaudio_book);
    }

    /**
     * @test update
     */
    public function test_update_audio_book()
    {
        $audioBook = factory(audio_book::class)->create();
        $fakeaudio_book = factory(audio_book::class)->make()->toArray();

        $updatedaudio_book = $this->audioBookRepo->update($fakeaudio_book, $audioBook->id);

        $this->assertModelData($fakeaudio_book, $updatedaudio_book->toArray());
        $dbaudio_book = $this->audioBookRepo->find($audioBook->id);
        $this->assertModelData($fakeaudio_book, $dbaudio_book->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_audio_book()
    {
        $audioBook = factory(audio_book::class)->create();

        $resp = $this->audioBookRepo->delete($audioBook->id);

        $this->assertTrue($resp);
        $this->assertNull(audio_book::find($audioBook->id), 'audio_book should not exist in DB');
    }
}
