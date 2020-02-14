<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\client;

class clientApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_client()
    {
        $client = factory(client::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/clients', $client
        );

        $this->assertApiResponse($client);
    }

    /**
     * @test
     */
    public function test_read_client()
    {
        $client = factory(client::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/clients/'.$client->id
        );

        $this->assertApiResponse($client->toArray());
    }

    /**
     * @test
     */
    public function test_update_client()
    {
        $client = factory(client::class)->create();
        $editedclient = factory(client::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/clients/'.$client->id,
            $editedclient
        );

        $this->assertApiResponse($editedclient);
    }

    /**
     * @test
     */
    public function test_delete_client()
    {
        $client = factory(client::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/clients/'.$client->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/clients/'.$client->id
        );

        $this->response->assertStatus(404);
    }
}
