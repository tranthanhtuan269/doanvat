<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
    protected $fillable = ['user', 'banner', 'logo', 'name', 'sologan', 'city', 'district', 'town', 'address', 'description', 'images', 'branchs', 'lat', 'lng', 'youtube_link', 'template', 'site_url', 'show_master'];

    public function getPhoneNumber($user_id){
        $user = User::findOrFail($user_id);
        if($user)
            return $user->phone;
        return '';
    }

    public function getCompany($district, $city, $field, $from, $number_get){
        $sql = "SELECT 
                    companies.id, 
                    companies.name, 
                    companies.logo, 
                    companies.sologan
                FROM 
                    companies ";
        $sql .= "WHERE 
                    1 = 1 ";

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND companies.district = $district";
            }else{
                $sql .= " AND companies.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND companies.city NOT IN (1, 2, 3)";
        }
        $sql .= " ORDER BY companies.id DESC";
        $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }
}
