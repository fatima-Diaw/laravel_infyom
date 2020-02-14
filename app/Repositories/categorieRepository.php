<?php

namespace App\Repositories;

use App\Models\categorie;
use App\Repositories\BaseRepository;

/**
 * Class categorieRepository
 * @package App\Repositories
 * @version February 14, 2020, 4:04 pm UTC
*/

class categorieRepository extends BaseRepository
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
        return categorie::class;
    }
}
