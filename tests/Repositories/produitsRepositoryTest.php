<?php namespace Tests\Repositories;

use App\Models\produits;
use App\Repositories\produitsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class produitsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var produitsRepository
     */
    protected $produitsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->produitsRepo = \App::make(produitsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_produits()
    {
        $produits = factory(produits::class)->make()->toArray();

        $createdproduits = $this->produitsRepo->create($produits);

        $createdproduits = $createdproduits->toArray();
        $this->assertArrayHasKey('id', $createdproduits);
        $this->assertNotNull($createdproduits['id'], 'Created produits must have id specified');
        $this->assertNotNull(produits::find($createdproduits['id']), 'produits with given id must be in DB');
        $this->assertModelData($produits, $createdproduits);
    }

    /**
     * @test read
     */
    public function test_read_produits()
    {
        $produits = factory(produits::class)->create();

        $dbproduits = $this->produitsRepo->find($produits->id);

        $dbproduits = $dbproduits->toArray();
        $this->assertModelData($produits->toArray(), $dbproduits);
    }

    /**
     * @test update
     */
    public function test_update_produits()
    {
        $produits = factory(produits::class)->create();
        $fakeproduits = factory(produits::class)->make()->toArray();

        $updatedproduits = $this->produitsRepo->update($fakeproduits, $produits->id);

        $this->assertModelData($fakeproduits, $updatedproduits->toArray());
        $dbproduits = $this->produitsRepo->find($produits->id);
        $this->assertModelData($fakeproduits, $dbproduits->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_produits()
    {
        $produits = factory(produits::class)->create();

        $resp = $this->produitsRepo->delete($produits->id);

        $this->assertTrue($resp);
        $this->assertNull(produits::find($produits->id), 'produits should not exist in DB');
    }
}
