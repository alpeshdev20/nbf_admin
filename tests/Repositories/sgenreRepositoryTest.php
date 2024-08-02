<?php namespace Tests\Repositories;

use App\Models\sgenre;
use App\Repositories\sgenreRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class sgenreRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var sgenreRepository
     */
    protected $sgenreRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->sgenreRepo = \App::make(sgenreRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_sgenre()
    {
        $sgenre = factory(sgenre::class)->make()->toArray();

        $createdsgenre = $this->sgenreRepo->create($sgenre);

        $createdsgenre = $createdsgenre->toArray();
        $this->assertArrayHasKey('id', $createdsgenre);
        $this->assertNotNull($createdsgenre['id'], 'Created sgenre must have id specified');
        $this->assertNotNull(sgenre::find($createdsgenre['id']), 'sgenre with given id must be in DB');
        $this->assertModelData($sgenre, $createdsgenre);
    }

    /**
     * @test read
     */
    public function test_read_sgenre()
    {
        $sgenre = factory(sgenre::class)->create();

        $dbsgenre = $this->sgenreRepo->find($sgenre->id);

        $dbsgenre = $dbsgenre->toArray();
        $this->assertModelData($sgenre->toArray(), $dbsgenre);
    }

    /**
     * @test update
     */
    public function test_update_sgenre()
    {
        $sgenre = factory(sgenre::class)->create();
        $fakesgenre = factory(sgenre::class)->make()->toArray();

        $updatedsgenre = $this->sgenreRepo->update($fakesgenre, $sgenre->id);

        $this->assertModelData($fakesgenre, $updatedsgenre->toArray());
        $dbsgenre = $this->sgenreRepo->find($sgenre->id);
        $this->assertModelData($fakesgenre, $dbsgenre->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_sgenre()
    {
        $sgenre = factory(sgenre::class)->create();

        $resp = $this->sgenreRepo->delete($sgenre->id);

        $this->assertTrue($resp);
        $this->assertNull(sgenre::find($sgenre->id), 'sgenre should not exist in DB');
    }
}
