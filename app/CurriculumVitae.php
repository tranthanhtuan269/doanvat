<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurriculumVitae extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'curriculum_vitaes';

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
    protected $fillable = ['user', 'avatar', 'birthday', 'gender', 'address', 'city', 'district', 'town', 'education','school', 'word_experience', 'language', 'interests', 'references', 'qualification', 'career_objective', 'images', 'active', 'time_can_work', 'salary_want', 'jobs', 'created_at'];

    
}
