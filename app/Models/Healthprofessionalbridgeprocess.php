<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Support\Facades\DB;

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
        'idApp'
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

    public static function getSystemProcessIdByIdHealthProfessionalModel($idHealthProfessional,$idApp) 
    {
       $parametersToMatch=[];
        
        if($idApp==-1)
             $parametersToMatch = ['healthprofessionalbridgeprocess.idHealthProfessional' => $idHealthProfessional];
        else
             $parametersToMatch = ['healthprofessionalbridgeprocess.idHealthProfessional' => $idHealthProfessional,'healthprofessionalbridgeprocess.idApp'=>$idApp];
        $result =  DB::table('healthprofessionalbridgeprocess')
             ->join('systemprocess', 'healthprofessionalbridgeprocess.systemProcessId', '=', 'systemprocess.systemProcessId')  
            ->where($parametersToMatch)   
            ->select('healthprofessionalbridgeprocess.*', 'systemprocess.externalProcessId')
            ->get();
          return $result;
    }
    
     public static function getIdHealthProfessionalBySystemProcessIdModel($systemProcessId,$idApp) 
    {
        $parametersToMatch=[];
        
        if($idApp==-1)
             $parametersToMatch = ['healthprofessionalbridgeprocess.systemProcessId' => $systemProcessId];
        else
             $parametersToMatch = ['healthprofessionalbridgeprocess.systemProcessId' => $systemProcessId,'healthprofessionalbridgeprocess.idApp'=>$idApp];
       
          $result =  DB::table('healthprofessionalbridgeprocess')
             ->join('systemprocess', 'healthprofessionalbridgeprocess.systemProcessId', '=', 'systemprocess.systemProcessId')  
             ->where($parametersToMatch)   
             ->select('healthprofessionalbridgeprocess.*', 'systemprocess.externalProcessId')
                  ->get();
          return $result;
    }
    
    public static function getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId($idHealthProfessional,$systemProcessId,$idApp)
    {
         
       $parametersToMatch=[];
        
        if($idApp==-1)
             $parametersToMatch = ['healthprofessionalbridgeprocess.idHealthProfessional'=>$idHealthProfessional,'healthprofessionalbridgeprocess.systemProcessId' => $systemProcessId];
        else
             $parametersToMatch = ['healthprofessionalbridgeprocess.idHealthProfessional'=>$idHealthProfessional,'healthprofessionalbridgeprocess.systemProcessId' => $systemProcessId,'healthprofessionalbridgeprocess.idApp'=>$idApp];
        $result =  DB::table('healthprofessionalbridgeprocess')
            ->join('systemprocess', 'healthprofessionalbridgeprocess.systemProcessId', '=', 'systemprocess.systemProcessId')  
                 ->where($parametersToMatch)
            ->select('healthprofessionalbridgeprocess.*', 'systemprocess.externalProcessId') 
                 ->get();
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
