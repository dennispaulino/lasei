<?php

namespace App\Http\Controllers\API;

use App\Models\Healthprofessionalbridgeprocess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthprofessionalbridgeprocessAPIController extends Controller
{
  
    public function index() {
        return response()->json("", 204);
    }
    public function getSystemProcessIdByIdHealthProfessional(Request $request,$idHealthProfessional) {
        
      $idApp = $request->query('idApp', -1);
      $result= Healthprofessionalbridgeprocess::getSystemProcessIdByIdHealthProfessionalModel($idHealthProfessional,$idApp);
        if(count($result)>0)
            return response()->json($result, 200);
        else
           return response()->json("", 204);
    }

    public function getIdHealthProfessionalBySystemProcessId(Request $request,$systemProcessId) {
          $idApp = $request->query('idApp', -1);
        $result= Healthprofessionalbridgeprocess::getIdHealthProfessionalBySystemProcessIdModel($systemProcessId,$idApp);
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }

    public function getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId(Request $request,$idHealthProfessional,$systemProcessId) {
        $idApp = $request->query('idApp', -1);
        $result= Healthprofessionalbridgeprocess::getHealthProfessionalBridgeInfoByIdHealthProfessionalAndSystemProcessId($idHealthProfessional,$systemProcessId,$idApp);
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }
    public function getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId(Request $request,$idHealthProfessional,$externalProcessId) {
        $idApp = $request->query('idApp', -1);
        $result= Healthprofessionalbridgeprocess::getHealthProfessionalBridgeInfoByIdHealthProfessionalAndExternalProcessId($idHealthProfessional,$externalProcessId,$idApp);
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }


    public function store(Request $request) {
        //var that will store 0 if it cannot be found the user in database, >0 if the user could be found
        //if the request from the client side has the property 'date' and 'idUser', if not it will not save the request in the database        

        if ($request->has('idHealthProfessional') && $request->has('systemProcessId')) {
            
            $parametersToMatch = ['idHealthProfessional' => $request->idHealthProfessional, 'systemProcessId' => $request->systemProcessId];
             
            $parametersToStore = ['idHealthProfessional' => $request->idHealthProfessional, 'systemProcessId' => $request->systemProcessId];
           
            if($request->has('idApp'))
                 $parametersToStore = ['idHealthProfessional' => $request->idHealthProfessional, 'systemProcessId' => $request->systemProcessId,'idApp'=>$request->idApp];
          
            $result= Healthprofessionalbridgeprocess::healthProfessionalBridgeProcessCreateModel($parametersToMatch,$parametersToStore);
         
            if ($result == 1) 
                return response()->json("Health Professional Bridge Process was created!", 201);
            else if ($result == 2) 
                return response()->json("Health Professional Bridge Process already existed", 208);
        }     
       
        return response()->json("", 204);
    }
    
    
    

}
