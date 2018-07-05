<?php

namespace App\Repositories;

use App\Models\Healthprofessionalbridge;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HealthprofessionalbridgeRepository
 * @package App\Repositories
 * @version July 4, 2018, 1:58 pm UTC
 *
 * @method Healthprofessionalbridge findWithoutFail($id, $columns = ['*'])
 * @method Healthprofessionalbridge find($id, $columns = ['*'])
 * @method Healthprofessionalbridge first($columns = ['*'])
*/
class HealthprofessionalbridgeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Healthprofessionalbridge::class;
    }
}
