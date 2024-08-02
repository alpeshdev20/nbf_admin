<?php namespace Tests\Repositories;

use App\Models\class_note;
use App\Repositories\class_noteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class class_noteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var class_noteRepository
     */
    protected $classNoteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classNoteRepo = \App::make(class_noteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_class_note()
    {
        $classNote = factory(class_note::class)->make()->toArray();

        $createdclass_note = $this->classNoteRepo->create($classNote);

        $createdclass_note = $createdclass_note->toArray();
        $this->assertArrayHasKey('id', $createdclass_note);
        $this->assertNotNull($createdclass_note['id'], 'Created class_note must have id specified');
        $this->assertNotNull(class_note::find($createdclass_note['id']), 'class_note with given id must be in DB');
        $this->assertModelData($classNote, $createdclass_note);
    }

    /**
     * @test read
     */
    public function test_read_class_note()
    {
        $classNote = factory(class_note::class)->create();

        $dbclass_note = $this->classNoteRepo->find($classNote->id);

        $dbclass_note = $dbclass_note->toArray();
        $this->assertModelData($classNote->toArray(), $dbclass_note);
    }

    /**
     * @test update
     */
    public function test_update_class_note()
    {
        $classNote = factory(class_note::class)->create();
        $fakeclass_note = factory(class_note::class)->make()->toArray();

        $updatedclass_note = $this->classNoteRepo->update($fakeclass_note, $classNote->id);

        $this->assertModelData($fakeclass_note, $updatedclass_note->toArray());
        $dbclass_note = $this->classNoteRepo->find($classNote->id);
        $this->assertModelData($fakeclass_note, $dbclass_note->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_class_note()
    {
        $classNote = factory(class_note::class)->create();

        $resp = $this->classNoteRepo->delete($classNote->id);

        $this->assertTrue($resp);
        $this->assertNull(class_note::find($classNote->id), 'class_note should not exist in DB');
    }
}
