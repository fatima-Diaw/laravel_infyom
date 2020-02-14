<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class client
 * @package App\Models
 * @version February 12, 2020, 3:36 pm UTC
 *
 * @property string prenom
 * @property string nom
 * @property string adresse
 * @property string email
 * @property string telephone
 */
class client extends Model
{
    use SoftDeletes;

    public $table = 'clients';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'prenom',
        'nom',
        'adresse',
        'email',
        'telephone'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'prenom' => 'string',
        'nom' => 'string',
        'adresse' => 'string',
        'email' => 'string',
        'telephone' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'prenom' => 'required',
        'nom' => 'required',
        'adresse' => 'required',
        'email' => 'required',
        'telephone' => 'required'
    ];

    
}
