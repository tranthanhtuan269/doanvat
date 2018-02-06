<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shops';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user', 'banner', 'logo', 'name', 'sologan', 'city', 'district', 'town', 'address', 'description', 'images', 'lat', 'lng', 'youtube_link', 'show_master'];

    public function getPhoneNumber($user_id){
        $user = User::findOrFail($user_id);
        if($user)
            return $user->phone;
        return '';
    }

    public function getShop($district, $city, $from, $number_get){
        $sql = "SELECT 
                    shops.id, 
                    shops.name, 
                    shops.logo, 
                    shops.sologan
                FROM 
                    shops ";
        $sql .= "WHERE 
                    1 = 1 ";

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND shops.district = $district";
            }else{
                $sql .= " AND shops.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND shops.city NOT IN (1, 2, 3)";
        }
        $sql .= " ORDER BY shops.id DESC";
        $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }
}
