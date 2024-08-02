<?php namespace Tests\Repositories;

use App\Models\video;
use App\Repositories\videoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class videoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var videoRepository
     */
    protected $videoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->videoRepo = \App::make(videoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_video()
    {
        $video = factory(video::class)->make()->toArray();

        $createdvideo = $this->videoRepo->create($video);

        $createdvideo = $createdvideo->toArray();
        $this->assertArrayHasKey('id', $createdvideo);
        $this->assertNotNull($createdvideo['id'], 'Created video must have id specified');
        $this->assertNotNull(video::find($createdvideo['id']), 'video with given id must be in DB');
        $this->assertModelData($video, $createdvideo);
    }

    /**
     * @test read
     */
    public function test_read_video()
    {
        $video = factory(video::class)->create();

        $dbvideo = $this->videoRepo->find($video->id);

        $dbvideo = $dbvideo->toArray();
        $this->assertModelData($video->toArray(), $dbvideo);
    }

    /**
     * @test update
     */
    public function test_update_video()
    {
        $video = factory(video::class)->create();
        $fakevideo = factory(video::class)->make()->toArray();

        $updatedvideo = $this->videoRepo->update($fakevideo, $video->id);

        $this->assertModelData($fakevideo, $updatedvideo->toArray());
        $dbvideo = $this->videoRepo->find($video->id);
        $this->assertModelData($fakevideo, $dbvideo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_video()
    {
        $video = factory(video::class)->create();

        $resp = $this->videoRepo->delete($video->id);

        $this->assertTrue($resp);
        $this->assertNull(video::find($video->id), 'video should not exist in DB');
    }
}
