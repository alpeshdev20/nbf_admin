<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Subscription_plan;

class Subscription_planApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/subscription_plans', $subscriptionPlan
        );

        $this->assertApiResponse($subscriptionPlan);
    }

    /**
     * @test
     */
    public function test_read_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/subscription_plans/'.$subscriptionPlan->id
        );

        $this->assertApiResponse($subscriptionPlan->toArray());
    }

    /**
     * @test
     */
    public function test_update_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->create();
        $editedSubscription_plan = factory(Subscription_plan::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/subscription_plans/'.$subscriptionPlan->id,
            $editedSubscription_plan
        );

        $this->assertApiResponse($editedSubscription_plan);
    }

    /**
     * @test
     */
    public function test_delete_subscription_plan()
    {
        $subscriptionPlan = factory(Subscription_plan::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/subscription_plans/'.$subscriptionPlan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/subscription_plans/'.$subscriptionPlan->id
        );

        $this->response->assertStatus(404);
    }
}
