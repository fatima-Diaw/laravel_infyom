<?php namespace Tests\Repositories;

use App\Models\produit;
use App\Repositories\produitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class produitRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var produitRepository
     */
    protected $produitRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->produitRepo = \App::make(produitRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_produit()
    {
        $produit = factory(produit::class)->make()->toArray();

        $createdproduit = $this->produitRepo->create($produit);

        $createdproduit = $createdproduit->toArray();
        $this->assertArrayHasKey('id', $createdproduit);
        $this->assertNotNull($createdproduit['id'], 'Created produit must have id specified');
        $this->assertNotNull(produit::find($createdproduit['id']), 'produit with given id must be in DB');
        $this->assertModelData($produit, $createdproduit);
    }

    /**
     * @test read
     */
    public function test_read_produit()
    {
        $produit = factory(produit::class)->create();

        $dbproduit = $this->produitRepo->find($produit->id);

        $dbproduit = $dbproduit->toArray();
        $this->assertModelData($produit->toArray(), $dbproduit);
    }

    /**
     * @test update
     */
    public function test_update_produit()
    {
        $produit = factory(produit::class)->create();
        $fakeproduit = factory(produit::class)->make()->toArray();

        $updatedproduit = $this->produitRepo->update($fakeproduit, $produit->id);

        $this->assertModelData($fakeproduit, $updatedproduit->toArray());
        $dbproduit = $this->produitRepo->find($produit->id);
        $this->assertModelData($fakeproduit, $dbproduit->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_produit()
    {
        $produit = factory(produit::class)->create();

        $resp = $this->produitRepo->delete($produit->id);

        $this->assertTrue($resp);
        $this->assertNull(produit::find($produit->id), 'produit should not exist in DB');
    }
}
