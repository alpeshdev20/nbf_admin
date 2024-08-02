<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\class_note;

class class_noteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_class_note()
    {
        $classNote = factory(class_note::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/class_notes', $classNote
        );

        $this->assertApiResponse($classNote);
    }

    /**
     * @test
     */
    public function test_read_class_note()
    {
        $classNote = factory(class_note::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/class_notes/'.$classNote->id
        );

        $this->assertApiResponse($classNote->toArray());
    }

    /**
     * @test
     */
    public function test_update_class_note()
    {
        $classNote = factory(class_note::class)->create();
        $editedclass_note = factory(class_note::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/class_notes/'.$classNote->id,
            $editedclass_note
        );

        $this->assertApiResponse($editedclass_note);
    }

    /**
     * @test
     */
    public function test_delete_class_note()
    {
        $classNote = factory(class_note::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/class_notes/'.$classNote->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/class_notes/'.$classNote->id
        );

        $this->response->assertStatus(404);
    }
}
