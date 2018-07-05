<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 25 Jun 2018 22:38:22 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Systemprocess
 * 
 * @property int $systemProcessId
 * @property int $externalProcessId
 * @property \Carbon\Carbon $dateToken
 * @property string $token
 * @property int $idApp
 *
 * @package App\Models
 */
class Systemprocess extends Eloquent
{
	protected $table = 'systemprocess';
	protected $primaryKey = 'systemProcessId';
	public $timestamps = false;

	protected $casts = [
		'externalProcessId' => 'int',
		'idApp' => 'int'
	];

	protected $dates = [
		'dateToken'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'externalProcessId',
		'dateToken',
		'token',
		'idApp'
	];
        
    public static function getSystemProcessByExternalProcessIdModel($externalProcessId) 
    {
          $parametersToMatch = ['externalProcessId' => $externalProcessId];
          $result = Systemprocess::where($parametersToMatch)->get();

          return $result;
    }
    
    public static function getSystemProcessBySystemProcessIdModel($systemProcessId) 
    {
          $parametersToMatch = ['systemProcessId' => $systemProcessId];
          $result = Systemprocess::where($parametersToMatch)->get();

          return $result;
    }
    
    
    public static function systemProcessIdCreateorUpdateModel($parametersToMatch, $parametersToStore) {
        try {

               $systemProcessToCreate = Systemprocess::updateOrCreate($parametersToMatch, $parametersToStore);
                $systemProcessToCreate->save();
                if ($systemProcessToCreate->wasRecentlyCreated)
                    return 1;
                else
                    return 0;
          
        } catch (\Exception $e) {
            return -1;
        }
    }

    public static function updateProcessGenerateTokenModel($externalProcessId) {

        try {
            $processExisted = Systemprocess::where(['externalProcessId' => $externalProcessId])->update(['dateToken' => new \DateTime(), 'token' => str_random(10)]);
            if (count($processExisted) > 0) {
                return 1;
            }
            return 0;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public static function checkIfTokenDateIsValid($externalProcessId, $tokenString) {
        //compares if the actual date is still valid to the token date (expires after one day)          
        try {
            $processExisted = Systemprocess::where(['externalProcessId' => $externalProcessId, 'state' => 1, 'token' => $tokenString])->get()->first();
            if ((time() - strtotime($processExisted->dateToken)) < 86400)
                return 1;

            return 0;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
