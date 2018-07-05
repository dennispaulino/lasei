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

    
      public function store(Request $request) {
        //var that will store 0 if it cannot be found the user in database, >0 if the user could be found
    
        if ($request->has('externalProcessId') && $request->has('idApp')) {
            
            $parametersToMatch = ['externalProcessId' => $request->externalProcessId];
             
            $parametersToStore = ['externalProcessId' => $request->externalProcessId, 'idApp' => $request->idApp];
           
            $result= Systemprocess::systemProcessIdCreateorUpdateModel($parametersToMatch,$parametersToStore);
       
            if ($result ==1) 
                return response()->json("System Process was created!", 201);
            else if ($result ==0) 
                return response()->json("System Process already existed", 208);
        }     
       
          
        return response()->json("", 204);
    }

}
