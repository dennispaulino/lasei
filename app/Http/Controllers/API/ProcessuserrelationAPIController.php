<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Processuserrelation;

class ProcessuserrelationAPIController extends Controller
{

    public function index() {
        return response()->json("", 204);
    }
    
    public function getProcessUserInfoByIdProcess($idProcess) {
        $result = Processuserrelation::getIdUserByIdProcessModel($idProcess);
        if (count($result) > 0)
            return response()->json($result, 200);
        else
            return response()->json("", 204);
    }

    public function getProcessUserInfoByIdUser($idUser) {
        $result= Processuserrelation::getIdProcessByIdUserModel($idUser);
        if(count($result)>0)
           return response()->json($result, 200);
        else
           return response()->json("", 204);
    }

    
    public function store(Request $request) {
        //var that will store 0 if it cannot be found the user in database, >0 if the user could be found
      
        if ($request->has('idUser') && $request->has('idProcess')) {
            
            $parametersToMatch = ['idUser' => $request->idUser, 'idProcess' => $request->idProcess];
             
            $parametersToStore = ['idUser' => $request->idUser, 'idProcess' => $request->idProcess];
           
            $result= Processuserrelation::userProcessRelationCreateorUpdateModel($parametersToMatch,$parametersToStore);
            
            if ($result ==1) 
                return response()->json("User Process Relation was created!", 201);
            else if ($result ==0) 
                return response()->json("User Process Relation already existed", 208);
        }     
       
        return response()->json("", 204);
    }

}
