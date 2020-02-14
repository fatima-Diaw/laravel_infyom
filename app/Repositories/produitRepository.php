<?php

namespace App\Repositories;

use App\Models\produit;
use App\Repositories\BaseRepository;

/**
 * Class produitRepository
 * @package App\Repositories
 * @version February 14, 2020, 4:05 pm UTC
*/

class produitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return produit::class;
    }
}
