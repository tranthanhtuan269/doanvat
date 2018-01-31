<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentCurriculumVitae extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comment_curriculum_vitaes';

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
    protected $fillable = ['created_by', 'curriculumvitae', 'description', 'star'];

    
}
