<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateproduitsAPIRequest;
use App\Http\Requests\API\UpdateproduitsAPIRequest;
use App\Models\produits;
use App\Repositories\produitsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class produitsController
 * @package App\Http\Controllers\API
 */

class produitsAPIController extends AppBaseController
{
    /** @var  produitsRepository */
    private $produitsRepository;

    public function __construct(produitsRepository $produitsRepo)
    {
        $this->produitsRepository = $produitsRepo;
    }

    /**
     * Display a listing of the produits.
     * GET|HEAD /produits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $produits = $this->produitsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($produits->toArray(), 'Produits retrieved successfully');
    }

    /**
     * Store a newly created produits in storage.
     * POST /produits
     *
     * @param CreateproduitsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateproduitsAPIRequest $request)
    {
        $input = $request->all();

        $produits = $this->produitsRepository->create($input);

        return $this->sendResponse($produits->toArray(), 'Produits saved successfully');
    }

    /**
     * Display the specified produits.
     * GET|HEAD /produits/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var produits $produits */
        $produits = $this->produitsRepository->find($id);

        if (empty($produits)) {
            return $this->sendError('Produits not found');
        }

        return $this->sendResponse($produits->toArray(), 'Produits retrieved successfully');
    }

    /**
     * Update the specified produits in storage.
     * PUT/PATCH /produits/{id}
     *
     * @param int $id
     * @param UpdateproduitsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproduitsAPIRequest $request)
    {
        $input = $request->all();

        /** @var produits $produits */
        $produits = $this->produitsRepository->find($id);

        if (empty($produits)) {
            return $this->sendError('Produits not found');
        }

        $produits = $this->produitsRepository->update($input, $id);

        return $this->sendResponse($produits->toArray(), 'produits updated successfully');
    }

    /**
     * Remove the specified produits from storage.
     * DELETE /produits/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var produits $produits */
        $produits = $this->produitsRepository->find($id);

        if (empty($produits)) {
            return $this->sendError('Produits not found');
        }

        $produits->delete();

        return $this->sendSuccess('Produits deleted successfully');
    }
}
