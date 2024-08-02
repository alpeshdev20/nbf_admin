<?php namespace Tests\Repositories;

use App\Models\cms_page;
use App\Repositories\cms_pageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class cms_pageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var cms_pageRepository
     */
    protected $cmsPageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->cmsPageRepo = \App::make(cms_pageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cms_page()
    {
        $cmsPage = factory(cms_page::class)->make()->toArray();

        $createdcms_page = $this->cmsPageRepo->create($cmsPage);

        $createdcms_page = $createdcms_page->toArray();
        $this->assertArrayHasKey('id', $createdcms_page);
        $this->assertNotNull($createdcms_page['id'], 'Created cms_page must have id specified');
        $this->assertNotNull(cms_page::find($createdcms_page['id']), 'cms_page with given id must be in DB');
        $this->assertModelData($cmsPage, $createdcms_page);
    }

    /**
     * @test read
     */
    public function test_read_cms_page()
    {
        $cmsPage = factory(cms_page::class)->create();

        $dbcms_page = $this->cmsPageRepo->find($cmsPage->id);

        $dbcms_page = $dbcms_page->toArray();
        $this->assertModelData($cmsPage->toArray(), $dbcms_page);
    }

    /**
     * @test update
     */
    public function test_update_cms_page()
    {
        $cmsPage = factory(cms_page::class)->create();
        $fakecms_page = factory(cms_page::class)->make()->toArray();

        $updatedcms_page = $this->cmsPageRepo->update($fakecms_page, $cmsPage->id);

        $this->assertModelData($fakecms_page, $updatedcms_page->toArray());
        $dbcms_page = $this->cmsPageRepo->find($cmsPage->id);
        $this->assertModelData($fakecms_page, $dbcms_page->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cms_page()
    {
        $cmsPage = factory(cms_page::class)->create();

        $resp = $this->cmsPageRepo->delete($cmsPage->id);

        $this->assertTrue($resp);
        $this->assertNull(cms_page::find($cmsPage->id), 'cms_page should not exist in DB');
    }
}
