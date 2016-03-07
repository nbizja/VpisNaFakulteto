<?php

namespace app\Models\Database;


use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'id', 'name'
    ];

    public function faculties()
    {
        return $this->hasMany('app\Models\Database\Faculty', 'university_id');
    }
}