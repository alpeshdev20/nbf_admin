<?php namespace Tests\Repositories;

use App\Models\Subscription_plan;
use App\Repositories\Subscription_planRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Subscription_planRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Subscription_planRepository
     */
    protected $subscriptionPlanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->subscriptionPlanRepo = \App::make(Subscription_planRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->make()->toArray();

        $createdSubscription_plan = $this->subscriptionPlanRepo->create($subscriptionPlan);

        $createdSubscription_plan = $createdSubscription_plan->toArray();
        $this->assertArrayHasKey('id', $createdSubscription_plan);
        $this->assertNotNull($createdSubscription_plan['id'], 'Created Subscription_plan must have id specified');
        $this->assertNotNull(Subscription_plan::find($createdSubscription_plan['id']), 'Subscription_plan with given id must be in DB');
        $this->assertModelData($subscriptionPlan, $createdSubscription_plan);
    }

    /**
     * @test read
     */
    public function test_read_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->create();

        $dbSubscription_plan = $this->subscriptionPlanRepo->find($subscriptionPlan->id);

        $dbSubscription_plan = $dbSubscription_plan->toArray();
        $this->assertModelData($subscriptionPlan->toArray(), $dbSubscription_plan);
    }

    /**
     * @test update
     */
    public function test_update_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->create();
        $fakeSubscription_plan = factory(Subscription_plan::class)->make()->toArray();

        $updatedSubscription_plan = $this->subscriptionPlanRepo->update($fakeSubscription_plan, $subscriptionPlan->id);

        $this->assertModelData($fakeSubscription_plan, $updatedSubscription_plan->toArray());
        $dbSubscription_plan = $this->subscriptionPlanRepo->find($subscriptionPlan->id);
        $this->assertModelData($fakeSubscription_plan, $dbSubscription_plan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->create();

        $resp = $this->subscriptionPlanRepo->delete($subscriptionPlan->id);

        $this->assertTrue($resp);
        $this->assertNull(Subscription_plan::find($subscriptionPlan->id), 'Subscription_plan should not exist in DB');
    }
}
