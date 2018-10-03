<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Systemprocess;
use Validator;
class SystemprocessAPIController extends Controller
{
   
    public function index() {
        return response()->json("", 204);
    }
    public function getSystemProcessByExternalProcessId($externalProcessId) {
        $result=[];
        if ($this->validateValue($externalProcessId, "required|max:255|regex:[A-Za-z1-9 ]"))
           $result= Systemprocess::getSystemProcessByExternalProcessIdModel($externalProcessId);
        else
            return response()->json("", 422);

        if (count($result) > 0)
            return response()->json($result, 200);
        else
            return response()->json("", 204);
    }

    public function getSystemProcessBySystemProcessId($systemProcessId) {
        $result=[];
        if ($this->validateValue($systemProcessId, "required|max:255|regex:[A-Za-z1-9 ]"))
             $result= Systemprocess::getSystemProcessBySystemProcessIdModel($systemProcessId);
        else
            return response()->json("", 422);
        
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }
    
   
    
      public function store(Request $request) {
        $result=-1;
        //var that will store 0 if it cannot be found the user in database, >0 if the user could be found
        // in thi method it will be created a system process or update to generate token and return it
        if ($request->has('externalProcessId') && $request->has('idApp')) {

            $parametersToMatch = ['externalProcessId' => $request->externalProcessId];

            $parametersToStore = ['externalProcessId' => $request->externalProcessId, 'idApp' => $request->idApp];

            if ($this->validateValue($request->externalProcessId, "required|max:255|regex:[A-Za-z1-9 ]") && $this->validateValue($request->idApp, "required|max:255|regex:[A-Za-z1-9 ]"))
                $result = Systemprocess::systemProcessIdCreateorUpdateModel($parametersToMatch, $parametersToStore);
            else
                return response()->json("", 422);

            if ($result == -2)
                return response()->json("System Process already existed", 208);
            else if ($result == -1)
                return response()->json("", 204);
            else
                return response()->json($result, 201);
        }
        else if ($request->has('systemProcessId') && $request->has('idApp')) {
            if ($this->validateValue($request->systemProcessId, "required|max:255|regex:[A-Za-z1-9 ]") && $this->validateValue($request->idApp, "required|max:255|regex:[A-Za-z1-9 ]"))
                $result = Systemprocess::updateProcessGenerateTokenModel($request->systemProcessId, $request->idApp);
            else
                return response()->json("", 422);


            if ($result != null)
                return response()->json($result, 200);
            else
                return response()->json("", 204);
        }

        return response()->json("", 204);
    }

    public function verifyToken(Request $request) 
     {  
        $result=-1;
        if ($request->has('token') && $request->has('systemProcessId') && $request->has('idApp')) {  
        
            if ($this->validateValue($request->systemProcessId, "required|max:255|regex:[A-Za-z1-9 ]") && $this->validateValue($request->token, "required|max:255|regex:[A-Za-z1-9 ]")&& $this->validateValue($request->idApp, "required|max:255|regex:[A-Za-z1-9 ]"))
                 $result= Systemprocess::checkIfTokenIsValid($request->systemProcessId,$request->token,$request->idApp);
            else
                return response()->json("", 422);

             
            if ($result == 1) 
                return response()->json("The token is valid!", 200);
          
        }     
       
        return response()->json("", 401);
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
