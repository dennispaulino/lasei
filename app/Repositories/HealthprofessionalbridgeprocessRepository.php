<?php

namespace App\Repositories;

use App\Models\Healthprofessionalbridgeprocess;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class HealthprofessionalbridgeprocessRepository
 * @package App\Repositories
 * @version July 4, 2018, 1:59 pm UTC
 *
 * @method Healthprofessionalbridgeprocess findWithoutFail($id, $columns = ['*'])
 * @method Healthprofessionalbridgeprocess find($id, $columns = ['*'])
 * @method Healthprofessionalbridgeprocess first($columns = ['*'])
*/
class HealthprofessionalbridgeprocessRepository extends BaseRepository
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
        return Healthprofessionalbridgeprocess::class;
    }
}
