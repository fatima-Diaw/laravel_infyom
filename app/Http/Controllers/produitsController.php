<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproduitsRequest;
use App\Http\Requests\UpdateproduitsRequest;
use App\Repositories\produitsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class produitsController extends AppBaseController
{
    /** @var  produitsRepository */
    private $produitsRepository;

    public function __construct(produitsRepository $produitsRepo)
    {
        $this->produitsRepository = $produitsRepo;
    }

    /**
     * Display a listing of the produits.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $produits = $this->produitsRepository->all();

        return view('produits.index')
            ->with('produits', $produits);
    }

    /**
     * Show the form for creating a new produits.
     *
     * @return Response
     */
    public function create()
    {
        return view('produits.create');
    }

    /**
     * Store a newly created produits in storage.
     *
     * @param CreateproduitsRequest $request
     *
     * @return Response
     */
    public function store(CreateproduitsRequest $request)
    {
        $input = $request->all();

        $produits = $this->produitsRepository->create($input);

        Flash::success('Produits saved successfully.');

        return redirect(route('produits.index'));
    }

    /**
     * Display the specified produits.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $produits = $this->produitsRepository->find($id);

        if (empty($produits)) {
            Flash::error('Produits not found');

            return redirect(route('produits.index'));
        }

        return view('produits.show')->with('produits', $produits);
    }

    /**
     * Show the form for editing the specified produits.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $produits = $this->produitsRepository->find($id);

        if (empty($produits)) {
            Flash::error('Produits not found');

            return redirect(route('produits.index'));
        }

        return view('produits.edit')->with('produits', $produits);
    }

    /**
     * Update the specified produits in storage.
     *
     * @param int $id
     * @param UpdateproduitsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproduitsRequest $request)
    {
        $produits = $this->produitsRepository->find($id);

        if (empty($produits)) {
            Flash::error('Produits not found');

            return redirect(route('produits.index'));
        }

        $produits = $this->produitsRepository->update($request->all(), $id);

        Flash::success('Produits updated successfully.');

        return redirect(route('produits.index'));
    }

    /**
     * Remove the specified produits from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $produits = $this->produitsRepository->find($id);

        if (empty($produits)) {
            Flash::error('Produits not found');

            return redirect(route('produits.index'));
        }

        $this->produitsRepository->delete($id);

        Flash::success('Produits deleted successfully.');

        return redirect(route('produits.index'));
    }
}
