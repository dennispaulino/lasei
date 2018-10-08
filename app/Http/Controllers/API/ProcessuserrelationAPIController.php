<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Processuserrelation;
use Validator;
class ProcessuserrelationAPIController extends Controller
{

    public function index() {
        return response()->json("", 204);
    }
    
    public function getProcessUserInfoByIdProcess($idProcess) {
        
         $result=[];
        if ($this->validateValue($idProcess, "alpha_num"))
            $result = Processuserrelation::getIdUserByIdProcessModel($idProcess);
        else 
            return response()->json("", 422); 
        
        
        if (count($result) > 0)
            return response()->json($result, 200);
        else
            return response()->json("", 204);
    }

    public function getProcessUserInfoByIdUser($idUser) {
         $result=[];
        if ($this->validateValue($idUser, "alpha_num"))
           $result= Processuserrelation::getIdProcessByIdUserModel($idUser);
        else 
            return response()->json("", 422); 
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }

    
    public function store(Request $request) {
        //var that will store 0 if it cannot be found the user in database, >0 if the user could be found
      $result=-1;
        if ($request->has('idUser') && $request->has('idProcess')) {
            
            $parametersToMatch = ['idUser' => $request->idUser, 'idProcess' => $request->idProcess];
             
            $parametersToStore = ['idUser' => $request->idUser, 'idProcess' => $request->idProcess];
           
            
            if ($this->validateValue($idUser, "alpha_num")&&$this->validateValue($idProcess, "alpha_num"))
                $result= Processuserrelation::userProcessRelationCreateorUpdateModel($parametersToMatch,$parametersToStore);
            else 
                 return response()->json("", 422); 
        
            
            if ($result ==1) 
                return response()->json("User Process Relation was created!", 201);
            else if ($result ==0) 
                return response()->json("User Process Relation already existed", 208);
        }     
        return response()->json("", 204);
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
