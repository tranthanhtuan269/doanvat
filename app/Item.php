<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

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
    protected $fillable = ['name', 'description', 'image', 'price', 'shop', 'views', 'likes', 'public'];

    public function getItem($district, $city, $shop, $from, $number_get){
        $ret_data = [];

            $sql = "SELECT 
                    items.id AS id, 
                    items.name AS name, 
                    items.views as views, 
                    items.likes AS likes,
                    items.price AS price,
                    shops.logo, 
                    shops.name AS shopname, 
                    cities.name AS city, 
                    districts.name AS district 
                FROM 
                    items
                JOIN 
                    shops ON shops.id = items.shop";

            $sql .= " JOIN
                        cities ON cities.id = shops.city
                    JOIN
                        districts ON districts.id = shops.district";

            $sql .= " WHERE 1 = 1";

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND shops.district = $district";
            }else{
                $sql .= " AND shops.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND shops.city NOT IN (1, 2, 3)";
        }

            $sql .= " ORDER BY items.id DESC";
            $sql .= " LIMIT $from, $number_get";

        return \DB::select($sql);
    }

    public function getItemNumber($district, $city, $shop, $from, $number_get){
        $ret_data = [];

            $sql = "SELECT 
                    count(items.id) AS number_item
                FROM 
                    items
                JOIN 
                    shops ON shops.id = items.shop";

            $sql .= " JOIN
                        cities ON cities.id = shops.city
                    JOIN
                        districts ON districts.id = shops.district";

            $sql .= " WHERE 1 = 1";

        if($city > 0 && $city != 1000){
            if($district > 0){
                $sql .= " AND shops.district = $district";
            }else{
                $sql .= " AND shops.city = $city";
            }
        }else if($city == 1000){
            $sql .= " AND shops.city NOT IN (1, 2, 3)";
        }

        return \DB::select($sql);
    }
}
