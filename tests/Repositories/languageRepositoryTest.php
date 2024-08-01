<?php namespace Tests\Repositories;

use App\Models\language;
use App\Repositories\languageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class languageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var languageRepository
     */
    protected $languageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->languageRepo = \App::make(languageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_language()
    {
        $language = factory(language::class)->make()->toArray();

        $createdlanguage = $this->languageRepo->create($language);

        $createdlanguage = $createdlanguage->toArray();
        $this->assertArrayHasKey('id', $createdlanguage);
        $this->assertNotNull($createdlanguage['id'], 'Created language must have id specified');
        $this->assertNotNull(language::find($createdlanguage['id']), 'language with given id must be in DB');
        $this->assertModelData($language, $createdlanguage);
    }

    /**
     * @test read
     */
    public function test_read_language()
    {
        $language = factory(language::class)->create();

        $dblanguage = $this->languageRepo->find($language->id);

        $dblanguage = $dblanguage->toArray();
        $this->assertModelData($language->toArray(), $dblanguage);
    }

    /**
     * @test update
     */
    public function test_update_language()
    {
        $language = factory(language::class)->create();
        $fakelanguage = factory(language::class)->make()->toArray();

        $updatedlanguage = $this->languageRepo->update($fakelanguage, $language->id);

        $this->assertModelData($fakelanguage, $updatedlanguage->toArray());
        $dblanguage = $this->languageRepo->find($language->id);
        $this->assertModelData($fakelanguage, $dblanguage->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_language()
    {
        $language = factory(language::class)->create();

        $resp = $this->languageRepo->delete($language->id);

        $this->assertTrue($resp);
        $this->assertNull(language::find($language->id), 'language should not exist in DB');
    }
}
