<?php

namespace app\Models\Database;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Community
 * @package app\Models\Database
 *
 * Občina
 */
class Community extends Model
{
    protected $fillable = [
        'id', 'name'
    ];

    public function faculties()
    {
        return $this->hasMany('app\Models\Database\Faculty', 'faculty_id');
    }
}