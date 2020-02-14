<?php namespace Tests\Repositories;

use App\Models\categorie;
use App\Repositories\categorieRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class categorieRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var categorieRepository
     */
    protected $categorieRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->categorieRepo = \App::make(categorieRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_categorie()
    {
        $categorie = factory(categorie::class)->make()->toArray();

        $createdcategorie = $this->categorieRepo->create($categorie);

        $createdcategorie = $createdcategorie->toArray();
        $this->assertArrayHasKey('id', $createdcategorie);
        $this->assertNotNull($createdcategorie['id'], 'Created categorie must have id specified');
        $this->assertNotNull(categorie::find($createdcategorie['id']), 'categorie with given id must be in DB');
        $this->assertModelData($categorie, $createdcategorie);
    }

    /**
     * @test read
     */
    public function test_read_categorie()
    {
        $categorie = factory(categorie::class)->create();

        $dbcategorie = $this->categorieRepo->find($categorie->id);

        $dbcategorie = $dbcategorie->toArray();
        $this->assertModelData($categorie->toArray(), $dbcategorie);
    }

    /**
     * @test update
     */
    public function test_update_categorie()
    {
        $categorie = factory(categorie::class)->create();
        $fakecategorie = factory(categorie::class)->make()->toArray();

        $updatedcategorie = $this->categorieRepo->update($fakecategorie, $categorie->id);

        $this->assertModelData($fakecategorie, $updatedcategorie->toArray());
        $dbcategorie = $this->categorieRepo->find($categorie->id);
        $this->assertModelData($fakecategorie, $dbcategorie->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_categorie()
    {
        $categorie = factory(categorie::class)->create();

        $resp = $this->categorieRepo->delete($categorie->id);

        $this->assertTrue($resp);
        $this->assertNull(categorie::find($categorie->id), 'categorie should not exist in DB');
    }
}
