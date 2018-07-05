<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Jun 2018 22:37:59 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Processuserrelation
 * 
 * @property int $idProcess
 * @property int $idUser
 *
 * @package App\Models
 */
class Processuserrelation extends Eloquent
{
	protected $table = 'processuserrelation';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idProcess' => 'int',
		'idUser' => 'int'
	];

	protected $fillable = [
		'idProcess',
		'idUser'
	];
        
    public static function getIdUserByIdProcessModel($idProcess) 
    {
          $parametersToMatch = ['idProcess' => $idProcess];
          $result = Processuserrelation::where($parametersToMatch)->get();

          return $result;
    }
    
    public static function getIdProcessByIdUserModel($idUser) 
    {
          $parametersToMatch = ['idUser' => $idUser];
          $result = Processuserrelation::where($parametersToMatch)->get();

          return $result;
    }
    
    public static function userProcessRelationCreateorUpdateModel($parametersToMatch,$parametersToStore)
    {
        try{
            $userProcessRelationToCreate = Processuserrelation::firstOrCreate($parametersToMatch, $parametersToStore);
            $userProcessRelationToCreate->save();
          if ($userProcessRelationToCreate->wasRecentlyCreated)
              return 1;
          else 
              return 2;
        }
        catch(\Exception $e)
        {
            return -1;
        }
   }
        
}
