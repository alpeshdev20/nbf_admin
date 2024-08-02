<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\sgenre;

class sgenreApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_sgenre()
    {
        $sgenre = factory(sgenre::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/sgenres', $sgenre
        );

        $this->assertApiResponse($sgenre);
    }

    /**
     * @test
     */
    public function test_read_sgenre()
    {
        $sgenre = factory(sgenre::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/sgenres/'.$sgenre->id
        );

        $this->assertApiResponse($sgenre->toArray());
    }

    /**
     * @test
     */
    public function test_update_sgenre()
    {
        $sgenre = factory(sgenre::class)->create();
        $editedsgenre = factory(sgenre::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/sgenres/'.$sgenre->id,
            $editedsgenre
        );

        $this->assertApiResponse($editedsgenre);
    }

    /**
     * @test
     */
    public function test_delete_sgenre()
    {
        $sgenre = factory(sgenre::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/sgenres/'.$sgenre->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/sgenres/'.$sgenre->id
        );

        $this->response->assertStatus(404);
    }
}
