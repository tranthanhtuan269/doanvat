<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyCompanyType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company_company_types';
    public $timestamps = false;
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
    protected $fillable = ['company', 'company_type'];

    
}
