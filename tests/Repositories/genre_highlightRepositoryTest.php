<?php namespace Tests\Repositories;

use App\Models\genre_highlight;
use App\Repositories\genre_highlightRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class genre_highlightRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var genre_highlightRepository
     */
    protected $genreHighlightRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->genreHighlightRepo = \App::make(genre_highlightRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->make()->toArray();

        $createdgenre_highlight = $this->genreHighlightRepo->create($genreHighlight);

        $createdgenre_highlight = $createdgenre_highlight->toArray();
        $this->assertArrayHasKey('id', $createdgenre_highlight);
        $this->assertNotNull($createdgenre_highlight['id'], 'Created genre_highlight must have id specified');
        $this->assertNotNull(genre_highlight::find($createdgenre_highlight['id']), 'genre_highlight with given id must be in DB');
        $this->assertModelData($genreHighlight, $createdgenre_highlight);
    }

    /**
     * @test read
     */
    public function test_read_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->create();

        $dbgenre_highlight = $this->genreHighlightRepo->find($genreHighlight->id);

        $dbgenre_highlight = $dbgenre_highlight->toArray();
        $this->assertModelData($genreHighlight->toArray(), $dbgenre_highlight);
    }

    /**
     * @test update
     */
    public function test_update_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->create();
        $fakegenre_highlight = factory(genre_highlight::class)->make()->toArray();

        $updatedgenre_highlight = $this->genreHighlightRepo->update($fakegenre_highlight, $genreHighlight->id);

        $this->assertModelData($fakegenre_highlight, $updatedgenre_highlight->toArray());
        $dbgenre_highlight = $this->genreHighlightRepo->find($genreHighlight->id);
        $this->assertModelData($fakegenre_highlight, $dbgenre_highlight->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_genre_highlight()
    {
        $genreHighlight = factory(genre_highlight::class)->create();

        $resp = $this->genreHighlightRepo->delete($genreHighlight->id);

        $this->assertTrue($resp);
        $this->assertNull(genre_highlight::find($genreHighlight->id), 'genre_highlight should not exist in DB');
    }
}
