<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Systemprocess;

class SystemprocessAPIController extends Controller
{
   
    public function index() {
        return response()->json("", 204);
    }
    public function getSystemProcessByExternalProcessId($externalProcessId) {
      $result= Systemprocess::getSystemProcessByExternalProcessIdModel($externalProcessId);
        if(count($result)>0)
            return response()->json($result, 200);
        else
           return response()->json("", 204);
    }

    public function getSystemProcessBySystemProcessId($systemProcessId) {
        $result= Systemprocess::getSystemProcessBySystemProcessIdModel($systemProcessId);
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }
    
     public function generateAndReturnTokenFromSystemProcessId($systemProcessId) {
        $result= Systemprocess::getSystemProcessBySystemProcessIdModel($systemProcessId);
        if($result!=0 &&$result!=-1)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }

    
      public function store(Request $request) {
        //var that will store 0 if it cannot be found the user in database, >0 if the user could be found
    
        if ($request->has('externalProcessId') && $request->has('idApp')) {
            
            $parametersToMatch = ['externalProcessId' => $request->externalProcessId];
             
            $parametersToStore = ['externalProcessId' => $request->externalProcessId, 'idApp' => $request->idApp];
           
         
            $result= Systemprocess::systemProcessIdCreateorUpdateModel($parametersToMatch,$parametersToStore);
            
            
            if ($result ==-2) 
                return response()->json("System Process already existed", 208);
            else if ($result ==-1)
                  return response()->json("", 204);
            else 
                 return response()->json($result, 201);
        }     
        else if ($request->has('systemProcessId') && $request->has('idApp')) {
                 $result= Systemprocess::updateProcessGenerateTokenModel($request->systemProcessId,$request->idApp);
            if($result!=null)
               return response()->json($result, 200);
            else
               return response()->json("", 204);
        }
          
        return response()->json("", 204);
    }
    
    
     public function verifyToken(Request $request) 
     {
        //var that will store 0 if it cannot be found the user in database, >0 if the user could be found
        //if the request from the client side has the property 'date' and 'idUser', if not it will not save the request in the database        
         
        if ($request->has('token') && $request->has('systemProcessId') && $request->has('idApp')) {  
        
            $result= Systemprocess::checkIfTokenIsValid($request->systemProcessId,$request->token,$request->idApp);
            
            if ($result == 1) 
                return response()->json("The token is valid!", 200);
            else
               return response()->json("", 401);
        }     
       
        return response()->json("", 401);
    }

}
