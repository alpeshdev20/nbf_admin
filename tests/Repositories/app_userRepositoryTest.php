<?php namespace Tests\Repositories;

use App\Models\app_user;
use App\Repositories\app_userRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class app_userRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var app_userRepository
     */
    protected $appUserRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->appUserRepo = \App::make(app_userRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_app_user()
    {
        $appUser = factory(app_user::class)->make()->toArray();

        $createdapp_user = $this->appUserRepo->create($appUser);

        $createdapp_user = $createdapp_user->toArray();
        $this->assertArrayHasKey('id', $createdapp_user);
        $this->assertNotNull($createdapp_user['id'], 'Created app_user must have id specified');
        $this->assertNotNull(app_user::find($createdapp_user['id']), 'app_user with given id must be in DB');
        $this->assertModelData($appUser, $createdapp_user);
    }

    /**
     * @test read
     */
    public function test_read_app_user()
    {
        $appUser = factory(app_user::class)->create();

        $dbapp_user = $this->appUserRepo->find($appUser->id);

        $dbapp_user = $dbapp_user->toArray();
        $this->assertModelData($appUser->toArray(), $dbapp_user);
    }

    /**
     * @test update
     */
    public function test_update_app_user()
    {
        $appUser = factory(app_user::class)->create();
        $fakeapp_user = factory(app_user::class)->make()->toArray();

        $updatedapp_user = $this->appUserRepo->update($fakeapp_user, $appUser->id);

        $this->assertModelData($fakeapp_user, $updatedapp_user->toArray());
        $dbapp_user = $this->appUserRepo->find($appUser->id);
        $this->assertModelData($fakeapp_user, $dbapp_user->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_app_user()
    {
        $appUser = factory(app_user::class)->create();

        $resp = $this->appUserRepo->delete($appUser->id);

        $this->assertTrue($resp);
        $this->assertNull(app_user::find($appUser->id), 'app_user should not exist in DB');
    }
}
