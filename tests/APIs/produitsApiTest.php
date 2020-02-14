<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\produits;

class produitsApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_produits()
    {
        $produits = factory(produits::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/produits', $produits
        );

        $this->assertApiResponse($produits);
    }

    /**
     * @test
     */
    public function test_read_produits()
    {
        $produits = factory(produits::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/produits/'.$produits->id
        );

        $this->assertApiResponse($produits->toArray());
    }

    /**
     * @test
     */
    public function test_update_produits()
    {
        $produits = factory(produits::class)->create();
        $editedproduits = factory(produits::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/produits/'.$produits->id,
            $editedproduits
        );

        $this->assertApiResponse($editedproduits);
    }

    /**
     * @test
     */
    public function test_delete_produits()
    {
        $produits = factory(produits::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/produits/'.$produits->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/produits/'.$produits->id
        );

        $this->response->assertStatus(404);
    }
}
