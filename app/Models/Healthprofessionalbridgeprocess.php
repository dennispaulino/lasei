<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class Healthprofessionalbridgeprocess
 * @package App\Models
 * @version July 4, 2018, 1:59 pm UTC
 *
 */
class Healthprofessionalbridgeprocess extends Model
{

    public $table = 'healthprofessionalbridgeprocess';
    public $timestamps = false;


    public $fillable = [
        'idHealthProfessional',
        'systemProcessId',
    
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public static function getSystemProcessIdByIdHealthProfessionalModel($idHealthProfessional) 
    {

          $parametersToMatch = ['idHealthProfessional' => $idHealthProfessional];
          $result = Healthprofessionalbridgeprocess::where($parametersToMatch)->get();

          return $result;
    }
    
     public static function getIdHealthProfessionalBySystemProcessIdModel($systemProcessId) 
    {

          $parametersToMatch = ['systemProcessId' => $systemProcessId];
          $result = Healthprofessionalbridgeprocess::where($parametersToMatch)->get();

          return $result;
    }
    
    public static function getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId($idHealthProfessional,$systemProcessId)
    {
        $parametersToMatch = ['idHealthProfessional'=>$idHealthProfessional,'systemProcessId' => $systemProcessId];
        $result = Healthprofessionalbridgeprocess::where($parametersToMatch)->get();

        return $result;
    }
    public static function healthProfessionalBridgeProcessCreateModel($parametersToMatch,$parametersToStore)
    {
        try {
               
            // it will check within the database if the healthprofessional exists             
            $systemProcessCheck = Systemprocess::getSystemProcessBySystemProcessIdModel($parametersToMatch['systemProcessId']);

            if (count($systemProcessCheck) > 0) {
                $healthProfessionalBridgeProcessToCreate = Healthprofessionalbridgeprocess::firstOrCreate($parametersToStore);
                $healthProfessionalBridgeProcessToCreate->save();
                if ($healthProfessionalBridgeProcessToCreate->wasRecentlyCreated)
                    return 1;
                else 
                    return 2;
            }
                  
             return 0;
        } catch(\Exception $e)
        {
            return -1;
        }
   }
}
