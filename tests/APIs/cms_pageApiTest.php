<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\cms_page;

class cms_pageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cms_page()
    {
        $cmsPage = factory(cms_page::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/cms_pages', $cmsPage
        );

        $this->assertApiResponse($cmsPage);
    }

    /**
     * @test
     */
    public function test_read_cms_page()
    {
        $cmsPage = factory(cms_page::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/cms_pages/'.$cmsPage->id
        );

        $this->assertApiResponse($cmsPage->toArray());
    }

    /**
     * @test
     */
    public function test_update_cms_page()
    {
        $cmsPage = factory(cms_page::class)->create();
        $editedcms_page = factory(cms_page::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/cms_pages/'.$cmsPage->id,
            $editedcms_page
        );

        $this->assertApiResponse($editedcms_page);
    }

    /**
     * @test
     */
    public function test_delete_cms_page()
    {
        $cmsPage = factory(cms_page::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/cms_pages/'.$cmsPage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/cms_pages/'.$cmsPage->id
        );

        $this->response->assertStatus(404);
    }
}
