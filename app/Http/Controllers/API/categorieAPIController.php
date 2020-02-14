<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecategorieAPIRequest;
use App\Http\Requests\API\UpdatecategorieAPIRequest;
use App\Models\categorie;
use App\Repositories\categorieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class categorieController
 * @package App\Http\Controllers\API
 */

class categorieAPIController extends AppBaseController
{
    /** @var  categorieRepository */
    private $categorieRepository;

    public function __construct(categorieRepository $categorieRepo)
    {
        $this->categorieRepository = $categorieRepo;
    }

    /**
     * Display a listing of the categorie.
     * GET|HEAD /categories
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $categories = $this->categorieRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($categories->toArray(), 'Categories retrieved successfully');
    }

    /**
     * Store a newly created categorie in storage.
     * POST /categories
     *
     * @param CreatecategorieAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecategorieAPIRequest $request)
    {
        $input = $request->all();

        $categorie = $this->categorieRepository->create($input);

        return $this->sendResponse($categorie->toArray(), 'Categorie saved successfully');
    }

    /**
     * Display the specified categorie.
     * GET|HEAD /categories/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var categorie $categorie */
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            return $this->sendError('Categorie not found');
        }

        return $this->sendResponse($categorie->toArray(), 'Categorie retrieved successfully');
    }

    /**
     * Update the specified categorie in storage.
     * PUT/PATCH /categories/{id}
     *
     * @param int $id
     * @param UpdatecategorieAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategorieAPIRequest $request)
    {
        $input = $request->all();

        /** @var categorie $categorie */
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            return $this->sendError('Categorie not found');
        }

        $categorie = $this->categorieRepository->update($input, $id);

        return $this->sendResponse($categorie->toArray(), 'categorie updated successfully');
    }

    /**
     * Remove the specified categorie from storage.
     * DELETE /categories/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var categorie $categorie */
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            return $this->sendError('Categorie not found');
        }

        $categorie->delete();

        return $this->sendSuccess('Categorie deleted successfully');
    }
}
