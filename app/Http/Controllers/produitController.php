<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproduitRequest;
use App\Http\Requests\UpdateproduitRequest;
use App\Repositories\produitRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class produitController extends AppBaseController
{
    /** @var  produitRepository */
    private $produitRepository;

    public function __construct(produitRepository $produitRepo)
    {
        $this->produitRepository = $produitRepo;
    }

    /**
     * Display a listing of the produit.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $produits = $this->produitRepository->all();

        return view('produits.index')
            ->with('produits', $produits);
    }

    /**
     * Show the form for creating a new produit.
     *
     * @return Response
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created produit in storage.
     *
     * @param CreateproduitRequest $request
     *
     * @return Response
     */
    public function store(CreateproduitRequest $request)
    {
        $input = $request->all();

        $produit = $this->produitRepository->create($input);

        Flash::success('Produit saved successfully.');

        return redirect(route('produits.index'));
    }

    /**
     * Display the specified produit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        return view('produits.show')->with('produit', $produit);
    }

    /**
     * Show the form for editing the specified produit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        return view('produits.edit')->with('produit', $produit);
    }

    /**
     * Update the specified produit in storage.
     *
     * @param int $id
     * @param UpdateproduitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproduitRequest $request)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        $produit = $this->produitRepository->update($request->all(), $id);

        Flash::success('Produit updated successfully.');

        return redirect(route('produits.index'));
    }

    /**
     * Remove the specified produit from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $produit = $this->produitRepository->find($id);

        if (empty($produit)) {
            Flash::error('Produit not found');

            return redirect(route('produits.index'));
        }

        $this->produitRepository->delete($id);

        Flash::success('Produit deleted successfully.');

        return redirect(route('produits.index'));
    }
}
