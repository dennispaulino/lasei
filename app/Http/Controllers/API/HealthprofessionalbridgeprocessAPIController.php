<?php

namespace App\Http\Controllers\API;

use App\Models\Healthprofessionalbridgeprocess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class HealthprofessionalbridgeprocessAPIController extends Controller
{
  
    public function index() {
        return response()->json("", 204);
    }
    public function getSystemProcessIdByIdHealthProfessional(Request $request,$idHealthProfessional) 
    {
       $result=[];
        $idApp = $request->query('idApp', -1);

        if ($this->validateValue($idApp, "alpha_num") && $this->validateValue($idHealthProfessional, 'required|numeric'))
            $result = Healthprofessionalbridgeprocess::getSystemProcessIdByIdHealthProfessionalModel($idHealthProfessional, $idApp);
        else 
             return response()->json("", 422);

        if (count($result) > 0)
            return response()->json($result, 200);
        else
            return response()->json("", 204);
    }

    public function getIdHealthProfessionalBySystemProcessId(Request $request,$systemProcessId) {
        $result=[]; 
        $idApp = $request->query('idApp',-1);
          
        if ($this->validateValue($idApp, "alpha_num") && $this->validateValue($systemProcessId, 'required|numeric'))
             $result= Healthprofessionalbridgeprocess::getIdHealthProfessionalBySystemProcessIdModel($systemProcessId,$idApp);
        else 
             return response()->json("", 422); 
          
    
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }

    public function getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId(Request $request,$idHealthProfessional,$systemProcessId) {
         $result=[];
        $idApp = $request->query('idApp', -1);
        
          if ($this->validateValue($idApp, "alpha_num") && $this->validateValue($systemProcessId, 'required|numeric')&& $this->validateValue($idHealthProfessional, 'required|numeric'))
              $result= Healthprofessionalbridgeprocess::getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId($idHealthProfessional,$systemProcessId,$idApp);
         else 
             return response()->json("", 422); 
          
         if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }
    public function getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId(Request $request,$idHealthProfessional,$externalProcessId) {
         $result=[];
        $idApp = $request->query('idApp', -1);
        
        if ($this->validateValue($idApp, "alpha_num") && $this->validateValue($externalProcessId, 'required|numeric')&& $this->validateValue($idHealthProfessional, 'required|numeric'))
              $result= Healthprofessionalbridgeprocess::getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId($idHealthProfessional,$externalProcessId,$idApp);
        else 
             return response()->json("", 422); 
        
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }


    public function store(Request $request) {
        $result = -1;
        $idApp = 1; //optional
        $state = 1; //1-> this record is active


        if ($request->has('idHealthProfessional') && $request->has('systemProcessId')) {

            $parametersToMatch = ['idHealthProfessional' => $request->idHealthProfessional, 'systemProcessId' => $request->systemProcessId];

            $parametersToStore = ['idHealthProfessional' => $request->idHealthProfessional, 'systemProcessId' => $request->systemProcessId];

            if ($request->has('idApp')) {
                $idApp = $request->idApp;
                $parametersToStore = array_merge($parametersToStore, ['idApp' => $idApp]);
            }
            if ($request->has('state')) {
                $state = $request->state;
                $parametersToStore = array_merge($parametersToStore, ['state' => $state]);
            }

            if ($this->validateValue($idApp, "alpha_num") && $this->validateValue($request->systemProcessId, 'required|numeric') && $this->validateValue($request->idHealthProfessional, 'required|numeric') && $this->validateValue($state, "alpha_num")) {
                $result = Healthprofessionalbridgeprocess::healthProfessionalBridgeProcessCreateModel($parametersToMatch, $parametersToStore);    
                if ($result == 1)
                    return response()->json("Health Professional Bridge Process was created!", 201);
                else if ($result == 2)
                    return response()->json("Health Professional Bridge Process already existed", 208);
                else
                    return response()->json("", 204);
            }
        }

        return response()->json("", 422);
    }

    private static function validateValue($value,$rules)
    {
        //needs to be an assoc
        $assoc = ['value'=>$value];

        $validator = Validator::make($assoc, [
            'value' => $rules,
        ]);

        return !$validator->fails();

    }

}
