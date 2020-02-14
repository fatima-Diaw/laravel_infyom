<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateclientAPIRequest;
use App\Http\Requests\API\UpdateclientAPIRequest;
use App\Models\client;
use App\Repositories\clientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class clientController
 * @package App\Http\Controllers\API
 */

class clientAPIController extends AppBaseController
{
    /** @var  clientRepository */
    private $clientRepository;

    public function __construct(clientRepository $clientRepo)
    {
        $this->clientRepository = $clientRepo;
    }

    /**
     * Display a listing of the client.
     * GET|HEAD /clients
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $clients = $this->clientRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($clients->toArray(), 'Clients retrieved successfully');
    }

    /**
     * Store a newly created client in storage.
     * POST /clients
     *
     * @param CreateclientAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateclientAPIRequest $request)
    {
        $input = $request->all();

        $client = $this->clientRepository->create($input);

        return $this->sendResponse($client->toArray(), 'Client saved successfully');
    }

    /**
     * Display the specified client.
     * GET|HEAD /clients/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var client $client */
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            return $this->sendError('Client not found');
        }

        return $this->sendResponse($client->toArray(), 'Client retrieved successfully');
    }

    /**
     * Update the specified client in storage.
     * PUT/PATCH /clients/{id}
     *
     * @param int $id
     * @param UpdateclientAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateclientAPIRequest $request)
    {
        $input = $request->all();

        /** @var client $client */
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            return $this->sendError('Client not found');
        }

        $client = $this->clientRepository->update($input, $id);

        return $this->sendResponse($client->toArray(), 'client updated successfully');
    }

    /**
     * Remove the specified client from storage.
     * DELETE /clients/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var client $client */
        $client = $this->clientRepository->find($id);

        if (empty($client)) {
            return $this->sendError('Client not found');
        }

        $client->delete();

        return $this->sendSuccess('Client deleted successfully');
    }
}
