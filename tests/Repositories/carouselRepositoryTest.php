<?php namespace Tests\Repositories;

use App\Models\carousel;
use App\Repositories\carouselRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class carouselRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var carouselRepository
     */
    protected $carouselRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->carouselRepo = \App::make(carouselRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_carousel()
    {
        $carousel = factory(carousel::class)->make()->toArray();

        $createdcarousel = $this->carouselRepo->create($carousel);

        $createdcarousel = $createdcarousel->toArray();
        $this->assertArrayHasKey('id', $createdcarousel);
        $this->assertNotNull($createdcarousel['id'], 'Created carousel must have id specified');
        $this->assertNotNull(carousel::find($createdcarousel['id']), 'carousel with given id must be in DB');
        $this->assertModelData($carousel, $createdcarousel);
    }

    /**
     * @test read
     */
    public function test_read_carousel()
    {
        $carousel = factory(carousel::class)->create();

        $dbcarousel = $this->carouselRepo->find($carousel->id);

        $dbcarousel = $dbcarousel->toArray();
        $this->assertModelData($carousel->toArray(), $dbcarousel);
    }

    /**
     * @test update
     */
    public function test_update_carousel()
    {
        $carousel = factory(carousel::class)->create();
        $fakecarousel = factory(carousel::class)->make()->toArray();

        $updatedcarousel = $this->carouselRepo->update($fakecarousel, $carousel->id);

        $this->assertModelData($fakecarousel, $updatedcarousel->toArray());
        $dbcarousel = $this->carouselRepo->find($carousel->id);
        $this->assertModelData($fakecarousel, $dbcarousel->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_carousel()
    {
        $carousel = factory(carousel::class)->create();

        $resp = $this->carouselRepo->delete($carousel->id);

        $this->assertTrue($resp);
        $this->assertNull(carousel::find($carousel->id), 'carousel should not exist in DB');
    }
}
