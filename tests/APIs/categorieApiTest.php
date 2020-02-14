<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\categorie;

class categorieApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_categorie()
    {
        $categorie = factory(categorie::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/categories', $categorie
        );

        $this->assertApiResponse($categorie);
    }

    /**
     * @test
     */
    public function test_read_categorie()
    {
        $categorie = factory(categorie::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/categories/'.$categorie->id
        );

        $this->assertApiResponse($categorie->toArray());
    }

    /**
     * @test
     */
    public function test_update_categorie()
    {
        $categorie = factory(categorie::class)->create();
        $editedcategorie = factory(categorie::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/categories/'.$categorie->id,
            $editedcategorie
        );

        $this->assertApiResponse($editedcategorie);
    }

    /**
     * @test
     */
    public function test_delete_categorie()
    {
        $categorie = factory(categorie::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/categories/'.$categorie->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/categories/'.$categorie->id
        );

        $this->response->assertStatus(404);
    }
}
