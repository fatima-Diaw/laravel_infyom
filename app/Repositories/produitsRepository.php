<?php

namespace App\Repositories;

use App\Models\produits;
use App\Repositories\BaseRepository;

/**
 * Class produitsRepository
 * @package App\Repositories
 * @version February 14, 2020, 3:39 pm UTC
*/

class produitsRepository extends BaseRepository
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
        return produits::class;
    }
}
