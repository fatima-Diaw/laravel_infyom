<?php namespace Tests\Repositories;

use App\Models\client;
use App\Repositories\clientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class clientRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var clientRepository
     */
    protected $clientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->clientRepo = \App::make(clientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_client()
    {
        $client = factory(client::class)->make()->toArray();

        $createdclient = $this->clientRepo->create($client);

        $createdclient = $createdclient->toArray();
        $this->assertArrayHasKey('id', $createdclient);
        $this->assertNotNull($createdclient['id'], 'Created client must have id specified');
        $this->assertNotNull(client::find($createdclient['id']), 'client with given id must be in DB');
        $this->assertModelData($client, $createdclient);
    }

    /**
     * @test read
     */
    public function test_read_client()
    {
        $client = factory(client::class)->create();

        $dbclient = $this->clientRepo->find($client->id);

        $dbclient = $dbclient->toArray();
        $this->assertModelData($client->toArray(), $dbclient);
    }

    /**
     * @test update
     */
    public function test_update_client()
    {
        $client = factory(client::class)->create();
        $fakeclient = factory(client::class)->make()->toArray();

        $updatedclient = $this->clientRepo->update($fakeclient, $client->id);

        $this->assertModelData($fakeclient, $updatedclient->toArray());
        $dbclient = $this->clientRepo->find($client->id);
        $this->assertModelData($fakeclient, $dbclient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_client()
    {
        $client = factory(client::class)->create();

        $resp = $this->clientRepo->delete($client->id);

        $this->assertTrue($resp);
        $this->assertNull(client::find($client->id), 'client should not exist in DB');
    }
}
