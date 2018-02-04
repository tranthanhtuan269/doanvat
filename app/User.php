<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'type', 'password', 'facebook_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'phone', 'type', 'remember_token',
    ];

    public function getUserInfo(){
        $shop_id = -1;
        $cv_id = -1;
        $returnData = [];
        if (\Auth::check()) {
            $current_id = \Auth::user()->id;
            //get shop 
            $shop = \DB::table('shops')
                    ->where('shops.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($shop){
                $shop_id = $shop->id;
            }
            
            //get CV 
            $cv_user = \DB::table('curriculum_vitaes')
                    ->where('curriculum_vitaes.user', $current_id)
                    ->select(
                        'id'
                    )
                    ->first();
            if($cv_user != null){
                $cv_id = $cv_user->id;
            }

            $returnData['user_id'] = $current_id;
            $returnData['shop_id'] = $shop_id;
            $returnData['cv_id'] = $cv_id;
            return $returnData;
        }
    }
}
