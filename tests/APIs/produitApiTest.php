<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\produit;

class produitApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_produit()
    {
        $produit = factory(produit::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/produits', $produit
        );

        $this->assertApiResponse($produit);
    }

    /**
     * @test
     */
    public function test_read_produit()
    {
        $produit = factory(produit::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/produits/'.$produit->id
        );

        $this->assertApiResponse($produit->toArray());
    }

    /**
     * @test
     */
    public function test_update_produit()
    {
        $produit = factory(produit::class)->create();
        $editedproduit = factory(produit::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/produits/'.$produit->id,
            $editedproduit
        );

        $this->assertApiResponse($editedproduit);
    }

    /**
     * @test
     */
    public function test_delete_produit()
    {
        $produit = factory(produit::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/produits/'.$produit->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/produits/'.$produit->id
        );

        $this->response->assertStatus(404);
    }
}
