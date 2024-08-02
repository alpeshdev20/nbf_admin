<?php namespace Tests\Repositories;

use App\Models\advertisement;
use App\Repositories\advertisementRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class advertisementRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var advertisementRepository
     */
    protected $advertisementRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->advertisementRepo = \App::make(advertisementRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_advertisement()
    {
        $advertisement = factory(advertisement::class)->make()->toArray();

        $createdadvertisement = $this->advertisementRepo->create($advertisement);

        $createdadvertisement = $createdadvertisement->toArray();
        $this->assertArrayHasKey('id', $createdadvertisement);
        $this->assertNotNull($createdadvertisement['id'], 'Created advertisement must have id specified');
        $this->assertNotNull(advertisement::find($createdadvertisement['id']), 'advertisement with given id must be in DB');
        $this->assertModelData($advertisement, $createdadvertisement);
    }

    /**
     * @test read
     */
    public function test_read_advertisement()
    {
        $advertisement = factory(advertisement::class)->create();

        $dbadvertisement = $this->advertisementRepo->find($advertisement->id);

        $dbadvertisement = $dbadvertisement->toArray();
        $this->assertModelData($advertisement->toArray(), $dbadvertisement);
    }

    /**
     * @test update
     */
    public function test_update_advertisement()
    {
        $advertisement = factory(advertisement::class)->create();
        $fakeadvertisement = factory(advertisement::class)->make()->toArray();

        $updatedadvertisement = $this->advertisementRepo->update($fakeadvertisement, $advertisement->id);

        $this->assertModelData($fakeadvertisement, $updatedadvertisement->toArray());
        $dbadvertisement = $this->advertisementRepo->find($advertisement->id);
        $this->assertModelData($fakeadvertisement, $dbadvertisement->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_advertisement()
    {
        $advertisement = factory(advertisement::class)->create();

        $resp = $this->advertisementRepo->delete($advertisement->id);

        $this->assertTrue($resp);
        $this->assertNull(advertisement::find($advertisement->id), 'advertisement should not exist in DB');
    }
}
