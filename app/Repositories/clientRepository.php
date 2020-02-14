<?php

namespace App\Repositories;

use App\Models\client;
use App\Repositories\BaseRepository;

/**
 * Class clientRepository
 * @package App\Repositories
 * @version February 12, 2020, 3:36 pm UTC
*/

class clientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'prenom',
        'nom',
        'adresse',
        'email',
        'telephone'
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
        return client::class;
    }
}
